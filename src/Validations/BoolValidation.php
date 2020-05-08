<?php


namespace Lexuss1979\Validol\Validations;


class BoolValidation implements ValidationInterface
{
    protected $error;

    public function validate($data, $key)
    {
        $testedValue = $data[$key] ?? null;
        if(! $this->isBool($testedValue)) {
            $this->error = "$key must be bool";
            return false;
        }
        return true;
    }

    public function error()
    {
        return $this->error;
    }

    protected function isBool($value){
        return is_bool($value) ||in_array($value,[0,1], true);
    }
}