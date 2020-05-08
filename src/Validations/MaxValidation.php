<?php


namespace Lexuss1979\Validol\Validations;


class MaxValidation implements ValidationInterface
{
    protected $error;
    protected $options;
    public function __construct($options = null)
    {
        $this->options = $options;
    }

    public function validate($data, $key)
    {
        $testedValue = $data[$key] ?? null;
        if(mb_strlen($testedValue) > $this->options[0]) {
            $this->error = "is too long (maximum {$this->options[0]} characters";
            return false;
        }
        return true;
    }

    public function error()
    {
        return $this->error;
    }
}