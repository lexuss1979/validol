<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class StringValidation extends AbstractValidation implements ValidationInterface
{

    protected $group = self::TYPE_GROUP;

    public function validate(ValueObject $data)
    {
        if ( !is_string($data->value()) ) {
            $this->error = "{$data->name()} must be a string";
            return false;
        }
        $data->setType(ValueObject::STRING);
        return true;
    }
}