<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class IntValidation extends AbstractValidation implements ValidationInterface
{
    public function validate(ValueObject $data)
    {
        if(! $this->isIntValue($data->value())) {
            $this->error = "{$data->name()} must be integer";
            return false;
        }
        return true;
    }

    protected function isIntValue($value){
        if(is_bool($value)) return false;
        return  is_int($value) || preg_match('/^\d+$/',$value);
    }
}