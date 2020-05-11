<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class FloatValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;

    public function validate(ValueObject $data)
    {
        if (!$this->isFloatValue($data->value())) {
            $this->error = "{$data->name()} must be float";
            return false;
        }

        $data->setType(ValueObject::FLOAT);
        return true;
    }

    protected function isFloatValue($value)
    {
        if (is_bool($value)) return false;
        return is_float($value) || preg_match('/^[\d\.]+$/', $value);
    }

}