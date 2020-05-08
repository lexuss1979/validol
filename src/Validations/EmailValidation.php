<?php


namespace Lexuss1979\Validol\Validations;


class EmailValidation extends AbstractValidation implements ValidationInterface
{
    public function validate($data, $key)
    {
        $testedValue = $data[$key] ?? null;
        if(! $this->isEmail($testedValue)) {
            $this->error = "incorrect email address in $key";
            return false;
        }
        return true;
    }

    protected function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    
}

