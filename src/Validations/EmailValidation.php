<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class EmailValidation extends AbstractValidation implements ValidationInterface
{
    public function validate(ValueObject $data)
    {

        if(! $this->isEmail($data->value())) {
            $this->error = "incorrect email address in {$data->name()}";
            return false;
        }
        return true;
    }

    protected function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    
}

