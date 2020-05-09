<?php


namespace Lexuss1979\Validol;


class DataProvider
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function get($key){
        if(!isset($this->data[$key])) return new NullValueObject($key, null);

        return new ValueObject($key, $this->data[$key]);
    }


}