<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\NullValueObject;
use Lexuss1979\Validol\ValueObject;

class RequiredValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::REQUIREMENTS_GROUP;


    public function validate(ValueObject $data)
    {
        if ($data instanceof NullValueObject) {
            $this->error = "{$data->name()} must be specified";
            return false;
        }
        return true;
    }

}