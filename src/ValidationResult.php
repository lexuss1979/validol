<?php


namespace Lexuss1979\Validol;


class ValidationResult
{
    private $result;
    private $validated;
    private $errors;

    public function __construct($result, $validated, $errors)
    {
        $this->result = $result;
        $this->validated = $validated;
        $this->errors = $errors;
    }

    public function fails()
    {
        return !$this->success();
    }

    public function success()
    {
        return $this->result;
    }

    public function data()
    {
        return $this->validated;
    }

    public function errors()
    {
        return $this->errors;
    }

}