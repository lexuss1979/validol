<?php


namespace Lexuss1979\Validol\Validations;


use Lexuss1979\Validol\ValueObject;

interface ValidationInterface
{
    /**
     * @param ValueObject $data
     * @return bool
     */
    public function validate(ValueObject $data);

    /**
     * @return string
     */
    public function error();

    public function group();
}