<?php


use Lexuss1979\Validol\Exceptions\ValueObjectInvalidTypeException;
use Lexuss1979\Validol\ValueObject;
use PHPUnit\Framework\TestCase;

class ValueObjectTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $obj = new ValueObject(1);
        $this->assertInstanceOf(ValueObject::class, $obj);
    }

    /** @test */
    public function it_throws_if_type_incorrect()
    {
        $this->expectException(ValueObjectInvalidTypeException::class);
        $obj = new ValueObject(1, 'wrong_type');
    }

    /** @test */
    public function it_can_be_invoked()
    {
        $obj = new ValueObject(123);
        $this->assertSame(123, $obj() );
    }

    /** @test */
    public function it_can_get_value()
    {
        $obj = new ValueObject(123);
        $this->assertSame(123, $obj->value() );
    }

    /** @test */
    public function it_can_get_type()
    {
        $obj = new ValueObject(123, ValueObject::INT);
        $this->assertSame(ValueObject::INT, $obj->type() );
    }

    /** @test */
    public function it_has_is_int_method()
    {
        $obj = new ValueObject(123, ValueObject::INT);
        $this->assertTrue($obj->isInt());
        $this->assertFalse($obj->isString());

    }

    /** @test */
    public function it_has_is_string_method()
    {
        $obj = new ValueObject("some string", ValueObject::STRING);
        $this->assertTrue($obj->isString());
        $this->assertFalse($obj->isInt());
    }

    /** @test */
    public function it_has_is_float_method()
    {
        $obj = new ValueObject(3.14, ValueObject::FLOAT);
        $this->assertTrue($obj->isFloat());
        $this->assertFalse($obj->isInt());
    }

    /** @test */
    public function it_has_is_bool_method()
    {
        $obj = new ValueObject(false, ValueObject::BOOL);
        $this->assertTrue($obj->isBool());
        $this->assertFalse($obj->isInt());
    }

    /** @test */
    public function it_has_is_undefined_method()
    {
        $obj = new ValueObject(false);
        $this->assertTrue($obj->isUndefinedType());
        $this->assertFalse($obj->isBool());
    }

}