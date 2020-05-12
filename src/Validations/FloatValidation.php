<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class FloatValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;

    protected $errorMessage = "{name} must be float";

    public function isValid(ValueObject $data)
    {
        if (is_bool($data->value())) return false;
        return is_float($data->value()) || preg_match('/^[\d\.]+$/', $data->value());
    }

    protected function afterSuccessValidation()
    {
        $this->data->setType(ValueObject::FLOAT);
        parent::afterSuccessValidation();
    }


}