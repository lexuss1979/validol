<?php


use Lexuss1979\Validol\ValidationResult;
use Lexuss1979\Validol\Validator;
use PHPUnit\Framework\TestCase;

class ValidationResultTest extends TestCase
{
    /** @test */
    public function it_returns_correct_result()
    {
        $validation = Validator::process(
            ['name' => 'Alex'],
            ['email' => 'required email', 'name' => 'required']
        );
        $this->assertInstanceOf(ValidationResult::class, $validation);
        $this->assertFalse($validation->success());
        $this->assertTrue($validation->fails());
        $this->assertSame(['name' => 'Alex'], $validation->data());
        $errors = $validation->errors();
        $this->assertArrayHasKey('email', $errors);
        $this->assertCount(2, $errors['email']);
    }
}