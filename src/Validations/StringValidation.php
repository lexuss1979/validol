<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class StringValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;

    protected $errorMessage = "{name} must be string";

    public function isValid(ValueObject $data)
    {
        return is_string($data->value());
    }

    protected function afterSuccessValidation()
    {
        $this->data->setType(ValueObject::STRING);
        parent::afterSuccessValidation();
    }
}