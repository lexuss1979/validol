<?php


namespace Lexuss1979\Validol;


use Lexuss1979\Validol\Validations\ValidationFactory;

class Validator
{
    private $validated;
    private $errors;
    private $validationFactory;

    public function __construct()
    {
        $this->validationFactory = new ValidationFactory();
    }

    public static function process($data, $rules)
    {
        $validator = new static();
        $result = $validator->validate($data, $rules);

        return new ValidationResult(
            $result,
            $validator->validated(),
            $validator->errors()
        );
    }

    public function validate($data, $rules)
    {
        $validationResult = true;
        $this->validated = [];
        $this->errors = [];

        $dataProvider = new DataProvider($data);

        foreach ($rules as $dataKey => $ruleDescription) {
            $rule = new Rule($ruleDescription, $this->validationFactory);
            $testedValue = $dataProvider->get($dataKey);

            if ($testedValue->satisfy($rule)) {
                $this->validated[$testedValue->alias()] = $testedValue->value();
            } else {
                $this->errors[$dataKey] = $rule->errors();
                $validationResult = false;
            }

        }
        return $validationResult;
    }

    public function validated()
    {
        return $this->validated;
    }

    public function errors()
    {
        return $this->errors;
    }
}