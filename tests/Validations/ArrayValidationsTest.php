<?php


namespace Validations;


use Lexuss1979\Validol\Validations\ValidationFactory;
use Lexuss1979\Validol\Validator;
use Lexuss1979\Validol\ValueObject;
use PHPUnit\Framework\TestCase;

class ArrayValidationsTest extends TestCase
{
    /** @test */
    public function it_change_value_object_type_after_validation()
    {
        $value = new ValueObject('arr', [1, 2, 3]);
        $validation = (new ValidationFactory())->get('array');
        $this->assertFalse($value->isArray());
        $validation->validate($value);
        $this->assertTrue($value->isArray());
    }

    /** @test */
    public function it_can_detects_array()
    {
        $rules = ['test' => 'required array'];
        $result = Validator::process(['test' => [1, 2, 3]], $rules);
        $this->assertTrue($result->success());

        $result = Validator::process(['test' => '1,2,3'], $rules);
        $this->assertFalse($result->success());
    }
}