<?php


namespace Lexuss1979\Validol\Validations;


class In
{
    public static function array($array){
        return new InValidation([$array]);
    }
}