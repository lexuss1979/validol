<?php


namespace Lexuss1979\Validol;


use Lexuss1979\Validol\Validations\ValidationFactory;

class Rule
{
    protected $validations;
    protected $factory;
    protected $errors = [];

    public function __construct($options, ValidationFactory $validationFactory)
    {
        $this->validations = explode(" ",$options);
        $this->factory = $validationFactory;
    }

    public function process(ValueObject $data){
        $dataIsValid = true;
        foreach ($this->validations as $validation){
            $validation = $this->factory->get($validation);
            if(!$validation->validate($data)){
                $this->errors[] = $validation->error();
                $dataIsValid = false;
            }
        }
        return $dataIsValid;
    }

    public function errors(){
        return $this->errors;
    }
}