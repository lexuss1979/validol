<?php


namespace Lexuss1979\Validol\Validations;


use DateTime;
use Lexuss1979\Validol\ValueObject;

class DateValidation extends AbstractValidation implements ValidationInterface
{
    public function isValid(ValueObject $data)
    {
        if( ! is_string($data->value()) ) return false;
        if(isset($this->options[0])){
            $dateObj = DateTime::createFromFormat($this->options[0], $data->value());
            return $dateObj && $dateObj->format($this->options[0]) === $data->value();
        }
       return strtotime($data->value()) > 0;
    }

    protected function afterSuccessValidation()
    {
        $this->data->setType(ValueObject::DATE);
        parent::afterSuccessValidation();
    }

    public function errorMessage()
    {
        if(isset($this->options[0]))   return "{$this->data->name()} is not in date format {$this->options[0]}";

        return "{$this->data->name()} must be a valid date";
    }
}