<?php


namespace Lexuss1979\Validol;


class NullValueObject extends ValueObject
{
    public function isNull()
    {
        return true;
    }
}