<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class SometimesValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::REQUIREMENTS_GROUP;

    public function validate(ValueObject $data)
    {
        return true;
    }
}