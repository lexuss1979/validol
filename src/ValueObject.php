<?php


namespace Lexuss1979\Validol;


use Lexuss1979\Validol\Exceptions\ValueObjectInvalidTypeException;

class ValueObject
{
    const STRING = 'string';
    const INT = 'int';
    const FLOAT = 'float';
    const BOOL = 'bool';

    private $value;
    /**
     * @var null
     */
    private $type;

    public function __construct($value, $type = null)
    {
        $this->value = $value;
        if(!in_array($type, $this->types())) throw new ValueObjectInvalidTypeException('Wrong type: '. $type);
        $this->type = $type;
    }

    public function __invoke(){
        return $this->value;
    }

    public function value(){
        return $this->value;
    }

    public function type(){
        return $this->type;
    }

    public function isInt(){
        return $this->type === self::INT;
    }


    public function isString(){
        return $this->type === self::STRING;
    }

    public function isBool(){
        return $this->type === self::BOOL;
    }

    public function isFloat(){
        return $this->type === self::FLOAT;
    }

    public function isUndefinedType(){
        return is_null($this->type);
    }

    protected function types(){
        return [null, self::BOOL, self::FLOAT, self::INT, self::STRING];
    }

    public static function get($value, $type = null){
        return new static($value, $type);
    }


}