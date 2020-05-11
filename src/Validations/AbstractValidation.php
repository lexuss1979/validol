<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

abstract class AbstractValidation
{
    const REQUIREMENTS_GROUP = 'requirements';
    const TYPE_GROUP = 'type';
    const COMMON_GROUP = 'common';
    protected $error;
    protected $options;
    protected $group = self::COMMON_GROUP;

    public function __construct($options = null)
    {
        $this->options = $options;
    }

    public function error()
    {
        return $this->error;
    }

    abstract public function validate(ValueObject $data);

    public function group()
    {
        return $this->group;
    }
}