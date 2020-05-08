<?php


namespace Lexuss1979\Validol\Validations;


class RequiredValidation implements ValidationInterface
{
    protected $error;

    public function validate($data, $key)
    {
        $testedValue = $data[$key] ?? null;
        if(! isset($testedValue)) {
            $this->error = "$key must be specified";
            return false;
        }
        return true;
    }

    public function error()
    {
        return $this->error;
    }
}