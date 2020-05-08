<?php


namespace Lexuss1979\Validol\Validations;


interface ValidationInterface
{
    /**
     * @param $data
     * @param $key
     * @return bool
     */
    public function validate($data, $key);

    /**
     * @return string
     */
    public function error();
}