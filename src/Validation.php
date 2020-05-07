<?php

namespace Lexuss1979\Validol;

use Closure;

class Validation
{
    protected $name;
    /**
     * @var Closure
     */
    private $closure;

    public function __construct($name, Closure $closure)
    {
        $this->name = $name;
        $this->closure = $closure;
    }
    public function check($data){
        if (! $data instanceof ValueObject) $data = ValueObject::get($data);
        try {
            return call_user_func($this->closure,$data);
        } catch (\Exception $exception){
            return false;
        }

    }

    public function name(){
        return $this->name;
    }

}