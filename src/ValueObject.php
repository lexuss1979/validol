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
    private $name;
    private $alias;

    public function __construct($name, $value, $type = null)
    {
        $this->name = $name;
        $this->alias = $name;
        $this->value = $value;
        if(!in_array($type, $this->types())) throw new ValueObjectInvalidTypeException('Wrong type: '. $type);
        $this->type = $type;
    }

    public function setAlias($alias){
        $this->alias = $alias;
    }

    protected function setName($name){
        if(preg_match("/^(\S*)\s*as\s*(\S*)$/",$name, $matches)){
            $this->name = $matches[1];
            $this->alias = $matches[2];
        } else {
            $this->name = $name;
            $this->alias = $name;
        }

    }


    public function __invoke(){
        return $this->value;
    }

    public function name(){
        return $this->name;
    }

    public function alias(){
        return $this->alias;
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

    /**
     * @param Rule $rule
     * @return bool
     */
    public function satisfy(Rule $rule) {
        return $rule->process($this);
    }


}