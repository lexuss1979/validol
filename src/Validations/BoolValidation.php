<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class BoolValidation extends AbstractValidation implements ValidationInterface
{
    protected $group = self::TYPE_GROUP;

    public function validate(ValueObject $data)
    {
        if (!$this->isBool($data->value())) {
            $this->error = "{$data->name()} must be bool";
            return false;
        }
        return true;
    }

    protected function isBool($value)
    {
        return is_bool($value) || in_array($value, [0, 1], true);
    }
}