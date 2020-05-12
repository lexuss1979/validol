<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class ArrayValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;

    protected $errorMessage = "{name} must be an array";

    public function isValid(ValueObject $data)
    {
        return is_array($data->value());
    }

    protected function afterSuccessValidation()
    {
        $this->data->setType(ValueObject::ARRAY);
        parent::afterSuccessValidation();
    }
}