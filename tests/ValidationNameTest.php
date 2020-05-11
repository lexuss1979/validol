<?php


use Lexuss1979\Validol\Validator;
use PHPUnit\Framework\TestCase;

class ValidationNameTest extends TestCase
{
    /** @test */
    public function it_can_use_alias()
    {
        $validation = Validator::process(
            ['first_name' => 'Alex'],
            ['first_name as name' => 'required']);
        $this->assertTrue($validation->success());

        $this->assertEquals(['name' => 'Alex'], $validation->data());
    }
}