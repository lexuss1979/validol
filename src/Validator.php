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

    public function validate($data, $rules)
    {
        $validationResult = true;
        $this->validated = [];
        $this->errors = [];

        $dataProvider = new DataProvider($data);

        foreach ($rules as $dataKey => $rule){
            $testedValue = $dataProvider->get($dataKey);
            $validations = explode(" ",$rule);

            $valueIsValid = true;
            foreach ($validations as $validation){
                $validation = $this->validationFactory->get($validation);
                if(!$validation->validate($testedValue)){
                    $this->errors[$dataKey][] = $validation->error();
                    $valueIsValid = false;
                }
            }

            if($valueIsValid) {
                $this->validated[$testedValue->name()] = $testedValue->value();
            } else {
                $validationResult = false;
            }

        }
        return $validationResult;
    }

    public function errors(){
        return $this->errors;
    }

    public function validated(){
        return $this->validated;
    }

    public static function process($data, $rules){
        $validator = new static();
        $result = $validator->validate($data, $rules);

        return new ValidationResult(
            $result,
            $validator->validated(),
            $validator->errors()
        );
    }
}