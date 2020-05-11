<?php


namespace Validations;


use Lexuss1979\Validol\Validator;
use PHPUnit\Framework\TestCase;

class SometimesValidationTest extends TestCase
{
    /** @test */
    public function it_always_return_true()
    {
        $result1 = Validator::process(['name' => 'alex'], ['age' => 'sometimes']);
        $this->assertTrue($result1->success());

        $result2 = Validator::process(['name' => 'alex', 'age' => 12], ['age' => 'sometimes']);
        $this->assertTrue($result2->success());
    }

    /** @test */
    public function it_continue_validating_if_value_exists()
    {
        $result1 = Validator::process(['name' => 'alex'], ['age' => 'sometimes']);
        $this->assertTrue($result1->success());

        $result2 = Validator::process(['name' => 'alex', 'age' => 12], ['age' => 'sometimes bool']);
        $this->assertTrue($result2->fails());
        $this->assertArrayHasKey("age", $result2->errors());
    }
}