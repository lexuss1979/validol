<?php


namespace Validations;


use Lexuss1979\Validol\Validations\ValidationFactory;
use Lexuss1979\Validol\Validator;
use Lexuss1979\Validol\ValueObject;
use PHPUnit\Framework\TestCase;

class BoolValidationsTest extends TestCase
{
    /** @test */
    public function it_change_value_object_type_after_validation()
    {
        $value = new ValueObject('access',false);
        $validation = (new ValidationFactory())->get('bool');
        $this->assertFalse($value->isBool());
        $validation->validate($value);
        $this->assertTrue($value->isBool());
    }

    /** @test
     * @dataProvider boolProvider
     */
    public function it_validate_bool($val, $result)
    {
        $this->assertEquals($result, (Validator::process(['access' => $val],['access' => 'bool']))->success());
    }

    public function boolProvider()
    {
        return [
            ["string", false],
            ["true", false],
            ["1", false],
            [true, true],
            [false, true],
            [1, true],
            [0, true],
        ];
    }
}