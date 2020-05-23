<?php


namespace Validations;


use Lexuss1979\Validol\Validations\ValidationFactory;
use Lexuss1979\Validol\Validator;
use Lexuss1979\Validol\ValueObject;
use PHPUnit\Framework\TestCase;

class StringValidationsTest extends TestCase
{
    /** @test */
    public function it_change_value_object_type_after_validation()
    {
        $value = new ValueObject('name', 'Alex');
        $validation = (new ValidationFactory())->get('string');
        $this->assertFalse($value->isString());
        $validation->validate($value);
        $this->assertTrue($value->isString());
    }

    /** @test
     * @dataProvider stringProvider
     */
    public function it_can_detect_string($val, $result)
    {
        $validation = Validator::process(['test' => $val], ['test' => 'required string']);
        $this->assertSame($result, $validation->success());
    }


    public function stringProvider()
    {
        return [
            ['some string', true],
            ['а', true],
            ['long text long textlong text long textlong textlong text long textlong textlong textlong textlong text', true],
            [true, false],
            [false, false],
            [123, false],
            [-5, false],
            [1.22, false],
            [['string', 'string'], false],
        ];
    }

    /** @test
     * @dataProvider maxStringLenProvider
     */
    public function it_can_validate_max_string_len($val, $rule, $result)
    {
        $this->assertEquals($result, (Validator::process(['name' => $val], ['name' => $rule]))->success());
    }

    public function maxStringLenProvider()
    {
        return [
            ['unity', 'required string max_len:3', false],
            ['unity', 'required string max_len:4', false],
            ['unity', 'required string max_len:5', true],
            ['unity', 'required string max_len:6', true],
        ];
    }

    /** @test
     * @dataProvider minStringLenProvider
     */
    public function it_can_validate_min_string_len($val, $rule, $result)
    {
        $this->assertEquals($result, (Validator::process(['name' => $val], ['name' => $rule]))->success());
    }

    public function minStringLenProvider()
    {
        return [
            ['unity', 'required string min_len:4', true],
            ['unity', 'required string min_len:5', true],
            ['unity', 'required string min_len:6', false],
            ['unity', 'required string min_len:7', false],
        ];
    }


}