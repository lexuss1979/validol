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
        if(preg_match("/^(\S*)\s*as\s*(\S*)$/",$key, $matches)){
            $name = $matches[1];
            $alias = $matches[2];
        } else {
            $name = $key;
            $alias = $key;
        }
        if(!isset($this->data[$name])) return new NullValueObject($name, null);

        $value = new ValueObject($name, $this->data[$name]);
        $value->setAlias($alias);
        return  $value;
    }


}