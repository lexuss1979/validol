<?php


use Lexuss1979\Validol\Validation;
use Lexuss1979\Validol\ValueObject;

class ValidationTest extends \PHPUnit\Framework\TestCase
{

    /** @test */
    public function it_can_validate()
    {
        $is_false = new Validation('is_false', function(ValueObject $data){
            return $data->value() === false;
        });
        $this->assertTrue($is_false->check(false));
        $this->assertFalse($is_false->check(true));
    }

    /** @test */
    public function it_has_name()
    {
        $is_false = new Validation('is_false', function(ValueObject $data){
            return $data->value() === false;
        });
        $this->assertSame('is_false', $is_false->name());
    }

    /** @test */
    public function it_ignore_internal_exceptions_and_return_false_if_exception_was_thrown()
    {
        $validationWithException = new Validation('is_false', function( ValueObject$data){
            throw new \Exception('some exception');
        });
        $this->assertFalse($validationWithException->check(false));
    }
}