<?php


namespace Lexuss1979\Validol\Validations;


class IntValidation implements ValidationInterface
{
    protected $error;
    public function validate($data, $key)
    {
        $testedValue = $data[$key] ?? null;
        if(! $this->isIntValue($testedValue)) {
            $this->error = "$key must be integer";
            return false;
        }
        return true;
    }

    public function error()
    {
        return $this->error;
    }

    protected function isIntValue($value){
        if(is_bool($value)) return false;
        return  is_int($value) || preg_match('/^\d+$/',$value);
    }
}