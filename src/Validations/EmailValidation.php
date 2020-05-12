<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class EmailValidation extends AbstractValidation implements ValidationInterface
{

    protected $errorMessage = "incorrect email address in {name}";

    public function isValid(ValueObject $data)
    {
        return filter_var($data->value(), FILTER_VALIDATE_EMAIL);
    }
}

