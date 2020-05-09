<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

abstract class AbstractValidation
{
    protected $error;
    protected $options;
    public function __construct($options = null)
    {
        $this->options = $options;
    }

    public function error(){
        return $this->error;
    }

    abstract public function validate(ValueObject $data);
}