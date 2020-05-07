<?php


namespace Lexuss1979\Validol;


class Validator
{
    private $validated;
    private $errors;

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
                switch ($validation){
                    case "required":
                        if(! isset($testedValue)) {
                            $valueIsValid = false;
                            $this->errors[$dataKey][] = "$dataKey must be specified";
                        }
                        break;

                    case "int":
                        if(! $this->isIntValue($testedValue)) {
                            $valueIsValid = false;
                            $this->errors[$dataKey][] = "$dataKey must be integer";
                        }
                        break;

                    case "bool":
                        if(! $this->isBool($testedValue) ) {
                            $valueIsValid = false;
                            $this->errors[$dataKey][] = "$dataKey must be bool";
                        }
                        break;
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

    protected function isIntValue($value){
        if(is_bool($value)) return false;
        return  is_int($value) || preg_match('/^\d+$/',$value);
    }

    protected function isBool($value){
        return is_bool($value) ||in_array($value,[0,1], true);
    }
}