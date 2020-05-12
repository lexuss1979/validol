<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class IntValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;

    protected $errorMessage = "{name} must be integer";

    public function isValid(ValueObject $data)
    {
        if (is_bool($data->value())) return false;
        return is_int($data->value()) || preg_match('/^\d+$/', $data->value());
    }

    protected function afterSuccessValidation()
    {
        $this->data->setType(ValueObject::INT);
        parent::afterSuccessValidation();
    }

}