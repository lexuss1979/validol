<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class ArrayValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;

    public function validate(ValueObject $data)
    {
        if ( !is_array($data->value()) ) {
            $this->error = "{$data->name()} must be an array";
            return false;
        }

        $data->setType(ValueObject::ARRAY);
        return true;
    }
}