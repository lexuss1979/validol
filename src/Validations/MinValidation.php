<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

class MinValidation extends AbstractValidation implements ValidationInterface
{
    public function validate(ValueObject $data)
    {
        if (mb_strlen($data->value()) < $this->options[0]) {
            $this->error = "{$data->name()} is too short ( minimum {$this->options[0]} characters";
            return false;
        }
        return true;
    }

}

