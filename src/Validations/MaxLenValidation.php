<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class MaxLenValidation extends AbstractValidation implements ValidationInterface
{
    public function isValid(ValueObject $data)
    {
        return mb_strlen($data->value()) <= $this->options[0];
    }

    protected function errorMessage()
    {
        return "{$this->data->name()} is too long (maximum {$this->options[0]} characters";
    }
}