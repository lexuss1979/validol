<?php


namespace Lexuss1979\Validol;


use Lexuss1979\Validol\Exceptions\RequirementsConflictValidationException;
use Lexuss1979\Validol\Exceptions\TypeConflictValidationException;
use Lexuss1979\Validol\Validations\AbstractValidation;
use Lexuss1979\Validol\Validations\ValidationFactory;

class Rule
{
    protected $options;
    protected $validations;
    protected $errors = [];
    protected $value;
    protected $status;

    protected $validationCache = [];

    public function __construct($options, ValidationFactory $validationFactory)
    {
        $signatures = $this->getSignatures($options);

        foreach ($signatures as $key => $val) {
            if (is_string($key)) {
                /** @var AbstractValidation $validation */
                $validation = $validationFactory->get($key);
                $validation->setErrorMessage($val);
            } else {
                if($this->isCachedValidation($val)){
                    $validation = $this->validationCache[$val];
                } else {
                    $validation = $validationFactory->get($val);
                }

            }

            $this->validations[$validation->group()][] = $validation;
        }

        $this->requirementsGuard();
        $this->typeGuard();

    }

    /**
     * @param $options mixed|array|string
     */
    protected function getSignatures($options)
    {
        if (is_array($options)) {
            $signatures = [];
            foreach ($options as $key => $option) {
                $associativeArray = is_string($key);
                if ($associativeArray) {
                    $part = $this->getSignatures($key);
                    $partValidation = [];
                    foreach ($part as $item) {
                        $partValidation[$item] = $option;
                    }
                    $signatures = array_merge($signatures, $partValidation);
                } else {
                    $part = $this->getSignatures($option);
                    $signatures = array_merge($signatures, $part);
                }

            }
            return $signatures;
        } elseif ($options instanceof AbstractValidation){
            return [$this->addToCache($options)];
        }

        return explode(" ", $options);
    }

    protected function requirementsGuard()
    {
        if (count($this->requirementsValidations()) > 1) {
            throw new RequirementsConflictValidationException("Multiple requirement validations detected");
        }
    }

    protected function requirementsValidations()
    {
        return $this->validations[AbstractValidation::REQUIREMENTS_GROUP] ?? [];
    }

    protected function typeGuard()
    {
        if (count($this->typeValidations()) > 1) {
            throw new TypeConflictValidationException("Multiple type validations detected");
        }
    }

    protected function typeValidations()
    {
        return $this->validations[AbstractValidation::TYPE_GROUP] ?? [];
    }

    public function process(ValueObject $data)
    {
        $this->value = $data;
        $this->status = true;

        $this->processRequirements();
        $needToContinueValidate = $this->status === true && !$this->value->isNull();

        if ($needToContinueValidate) {
            $this->processTypes();
            $this->processCommon();
        }

        return $this->status;
    }

    protected function processRequirements()
    {
        $this->processValidationGroup($this->requirementsValidations());
    }

    protected function processValidationGroup(array $validations)
    {
        foreach ($validations as $validation) {
            if (!$validation->validate($this->value)) {
                $this->errors[] = $validation->error();
                $this->status = false;
            }
        }
    }

    protected function processTypes()
    {
        $this->processValidationGroup($this->typeValidations());
    }

    protected function processCommon()
    {
        $this->processValidationGroup($this->commonValidations());
    }

    protected function commonValidations()
    {
        return $this->validations[AbstractValidation::COMMON_GROUP] ?? [];
    }

    public function getValidations($group = null)
    {
        if (isset($group)) {
            return $this->validations[$group];
        }
        return $this->validations;
    }

    public function errors()
    {
        return array_unique($this->errors);
    }

    protected function addToCache(AbstractValidation $validation){
        $key = '__cache__' . sizeof($this->validationCache);
        $this->validationCache[$key] = $validation;
        return $key;
    }

    protected function isCachedValidation($name){
        return array_key_exists($name, $this->validationCache);
    }

}