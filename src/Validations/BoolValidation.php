<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class BoolValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;
    protected $errorMessage = "{name} must be of bool type";

    public function isValid(ValueObject $data)
    {
        return is_bool($data->value()) || in_array($data->value(), [0, 1], true);
    }

    protected function afterSuccessValidation()
    {
        $this->data->setType(ValueObject::BOOL);
        parent::afterSuccessValidation();
    }
}