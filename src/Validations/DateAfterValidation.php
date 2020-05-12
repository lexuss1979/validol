<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class DateAfterValidation extends AbstractValidation implements ValidationInterface
{

    public function isValid(ValueObject $data)
    {
        $valueTime = strtotime($data->value());
        $targetTime = strtotime($this->options[0]);
        return $valueTime > $targetTime;
    }

    protected function getDateForCompare(){
        if(isset($this->options[0]) ) return $this->options[0];
    }

    protected function errorMessage()
    {
        return "{$this->data->name()} must be after {$this->options[0]}";
    }
}