<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\NullValueObject;
use Lexuss1979\Validol\ValueObject;

class RequiredValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::REQUIREMENTS_GROUP;

    protected $errorMessage = "{name} must be specified";

    public function isValid(ValueObject $data)
    {
        return !($data instanceof NullValueObject);
    }
}