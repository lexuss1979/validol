<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class MaxValidation extends AbstractValidation implements ValidationInterface
{
    protected $errorMessage = null;

    public function isValid(ValueObject $data)
    {
        return mb_strlen($data->value()) <= $this->options[0];
    }

    public function getErrorMessage()
    {
        if(!is_null($this->errorMessage)) return parent::getErrorMessage();

        return "{$this->data->name()} is too big (maximum {$this->options[0]})";
    }

}