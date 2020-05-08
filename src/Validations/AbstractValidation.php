<?php


namespace Lexuss1979\Validol\Validations;


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

    abstract public function validate($data, $key);
}