<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class InValidation extends AbstractValidation implements ValidationInterface
{
    public function isValid(ValueObject $data)
    {
        return in_array($data->value(), $this->options[0]);
    }

    protected function errorMessage()
    {
        return "{$this->data->name()} is not in (" . print_r($this->options[0],true) .")";
    }

}