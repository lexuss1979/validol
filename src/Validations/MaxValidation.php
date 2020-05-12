<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class MaxValidation extends AbstractValidation implements ValidationInterface
{
    public function isValid(ValueObject $data)
    {
        return mb_strlen($data->value()) <= $this->options[0];
    }

    protected function errorMessage()
    {
        return "{$this->data->name()} is too big (maximum {$this->options[0]})";
    }

}