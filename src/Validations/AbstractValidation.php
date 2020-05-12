<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

abstract class AbstractValidation
{
    const REQUIREMENTS_GROUP = 'requirements';
    const TYPE_GROUP = 'type';
    const COMMON_GROUP = 'common';
    protected $error;
    protected $data;
    protected $options;
    protected $group = self::COMMON_GROUP;
    protected $errorMessage = '{name} is not valid';

    public function __construct($options = null)
    {
        $this->options = $options;
    }

    public function setErrorMessage($message){
        $this->errorMessage = $message;
    }

    public function error()
    {
        return $this->error;
    }

    public function validate(ValueObject $data){
        $this->data = $data;
        if (! $this->isValid($data) ) {
            $this->error = $this->getErrorMessage();
            $this->afterFailedValidation();
            return false;
        }
        $this->afterSuccessValidation();
        return true;
    }
    public function getErrorMessage(){
        return str_replace("{name}", $this->data->name(), $this->errorMessage);
    }

    abstract public function isValid(ValueObject $data);

    protected function afterSuccessValidation(){

    }

    protected function afterFailedValidation(){

    }

    public function group()
    {
        return $this->group;
    }
}