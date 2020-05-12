<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class DateBetweenValidation extends AbstractValidation implements ValidationInterface
{
    public function isValid(ValueObject $data)
    {
        $valueTime = strtotime($data->value());
        $targetStartTime = strtotime($this->options[0]);
        $targetEndTime = strtotime($this->options[1]);

        return ( $valueTime > $targetStartTime ) && ( $valueTime < $targetEndTime);
    }

    public function errorMessage()
    {
        return "{$this->data->name()} must be after {$this->options[0]} and before {$this->options[1]}";
    }
}