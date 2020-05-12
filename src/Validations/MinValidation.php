<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class MinValidation extends AbstractValidation implements ValidationInterface
{
    public function isValid(ValueObject $data)
    {
        return mb_strlen($data->value()) >= $this->options[0];
    }

    public function errorMessage()
    {
        return "{$this->data->name()} is too small (minimum {$this->options[0]})";
    }

}

