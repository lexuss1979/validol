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

        foreach ($rules as $dataKey => $rule){
            $testedValue = $data[$dataKey] ?? null;
            $validations = explode(" ",$rule);

            $valueIsValid = true;
            foreach ($validations as $validation){
                $validation = $this->validationFactory->get($validation);
                if(!$validation->validate($data, $dataKey)){
                    $this->errors[$dataKey][] = $validation->error();
                    $valueIsValid = false;
                }
            }

            if($valueIsValid) {
                $this->validated[$dataKey] = $testedValue;
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
}