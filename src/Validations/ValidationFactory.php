<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\Exceptions\InvalidValidationNameException;

class ValidationFactory
{
    protected $map;

    public function __construct()
    {
        $this->map = [
            //REQUIREMENTS GROUP
            'required' => RequiredValidation::class,
            'sometimes' => SometimesValidation::class,

            //TYPE GROUP
            'int' => IntValidation::class,
            'float' => FloatValidation::class,
            'bool' => BoolValidation::class,
            'array' => ArrayValidation::class,
            'string' => StringValidation::class,

            //COMMON GROUP
            'max' => MaxValidation::class,
            'min' => MinValidation::class,
            'max_len' => MaxLenValidation::class,
            'min_len' => MinValidation::class,
            'email' => EmailValidation::class,
        ];
    }

    /**
     * @param $validation
     * @return ValidationInterface
     */
    public function get($validation)
    {
        $options = explode(':', $validation);
        $validationName = array_shift($options);
        if (!array_key_exists($validationName, $this->map)) {
            throw new InvalidValidationNameException('unknown validation name ' . $validationName);
        }
        return new $this->map[$validationName]($options);
    }

}