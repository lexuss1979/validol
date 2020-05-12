<?php


use Lexuss1979\Validol\Validator;
use PHPUnit\Framework\TestCase;

class ValidationSignatureTest extends TestCase
{
    /** @test */
    public function it_can_be_an_array()
    {
        $validation_String = Validator::process(
            $this->data(),
            ['name' => 'required string min_len:2']
        );
        $validation_Array = Validator::process(
            $this->data(),
            [
                'name' => ['required', 'string', 'min_len:2']
            ]
        );
        $this->assertEquals($validation_Array, $validation_String);
    }

    protected function data()
    {
        return [
            'name' => 'John',
            'surname' => 'Doe',
            'age' => 40,
            'male' => true,
            'dob' => '12.01.1980'
        ];
    }

    /** @test */
    public function it_can_be_array_of_grouped_string_validation()
    {
        $validation_String = Validator::process(
            $this->data(),
            ['name' => 'required string min_len:2']
        );
        $validation_Array = Validator::process(
            $this->data(),
            [
                'name' => ['required string', 'min_len:2']
            ]
        );
        $this->assertEquals($validation_Array, $validation_String);
    }

    /** @test */
    public function it_can_assign_alternative_error_message_for_group_validation()
    {
        $validation = Validator::process(
            $this->data(),
            [
                'name' => ['required string min_len:220' => 'Name is incorrect']
            ]
        );
        $this->assertEquals([
            'name' => ['Name is incorrect']
        ], $validation->errors());
    }

    /** @test */
    public function it_returns_only_unique_messages_for_group()
    {
        $validation = Validator::process(
            $this->data(),
            [
                'name' => ['required string min_len:220 max_len:1' => 'Name is incorrect']
            ]
        );
        $this->assertEquals([
            'name' => ['Name is incorrect']
        ], $validation->errors());
    }
}