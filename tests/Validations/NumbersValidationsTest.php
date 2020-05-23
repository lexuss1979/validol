<?php


namespace Validations;


use Lexuss1979\Validol\Validations\In;
use Lexuss1979\Validol\Validations\ValidationFactory;
use Lexuss1979\Validol\Validator;
use Lexuss1979\Validol\ValueObject;
use PHPUnit\Framework\TestCase;

class NumbersValidationsTest extends TestCase
{

    /** @test */
    public function it_change_value_object_type_to_int_after_validation()
    {
        $value = new ValueObject('var', 123);
        $validation = (new ValidationFactory())->get('int');
        $this->assertFalse($value->isInt());
        $validation->validate($value);
        $this->assertTrue($value->isInt());
    }

    /** @test */
    public function it_change_value_object_type_to_float_after_validation()
    {
        $value = new ValueObject('var', 12.3);
        $validation = (new ValidationFactory())->get('float');
        $this->assertFalse($value->isFloat());
        $validation->validate($value);
        $this->assertTrue($value->isFloat());
    }


    /** @test
     * @dataProvider intProvider
     */
    public function it_can_detect_int($val, $result)
    {
        $this->assertEquals($result, (Validator::process(['int_val' => $val], ['int_val' => 'required int']))->success());
    }

    public function intProvider()
    {
        return [
            [2, true],
            [1000000000, true],
            ['2', true],
            [3.14, false],
            ['str', false],
            ['3str', false],
            [true, false],
            [false, false],
        ];
    }

    /** @test
     * @dataProvider floatProvider
     */
    public function it_can_detect_float($val, $result)
    {
        $this->assertEquals($result, (Validator::process(['int_val' => $val], ['int_val' => 'required float']))->success());
    }

    public function floatProvider()
    {
        return [
            [2, true],
            [1000000000, true],
            ['2', true],
            [3.14, true],
            ['str', false],
            ['3str', false],
            [true, false],
            [false, false],
        ];
    }

    /** @test
     * @dataProvider inValidationProvider
     */
    public function it_can_perform_in_for_numbers($value, $result)
    {
        $data  = ['length'=> $value];
        $rules= [
            'length' => ['required', In::array([10,100,100.45, 24.2345])]
        ];
        $this->assertEquals($result, Validator::process($data, $rules)->success());
    }

    public function inValidationProvider()
    {
        return [
            [10, true],
            [20, false],
            [24.2345, true],
            [30, false],
            [46, false],
            [100, true],
            [100.45, true],
        ];
    }

}
