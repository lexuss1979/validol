<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\Exceptions\InvalidValidationNameException;
use PharIo\Manifest\Email;

class ValidationFactory
{
    protected $map;

    public function __construct()
    {
        $this->map = [
            'required' => RequiredValidation::class,
            'int' => IntValidation::class,
            'bool' => BoolValidation::class,
            'max' => MaxValidation::class,
            'min' => MinValidation::class,
            'email' => EmailValidation::class,
        ];
    }

    /**
     * @param $validation
     * @return ValidationInterface
     */
    public function get($validation){
        $options = explode(':', $validation);
        $validationName = array_shift($options);
        if(!array_key_exists($validationName, $this->map)){
            throw new InvalidValidationNameException('unknowk validation name '. $validationName);
        }
        return new $this->map[$validationName]($options);
    }
}