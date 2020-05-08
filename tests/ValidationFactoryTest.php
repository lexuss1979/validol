<?php


use Lexuss1979\Validol\Exceptions\InvalidValidationNameException;
use Lexuss1979\Validol\Validations\ValidationFactory;
use PHPUnit\Framework\TestCase;

class ValidationFactoryTest extends TestCase
{
    /** @test */
    public function it_throws_if_unknown_validation_was_requested()
    {
        $factory = new ValidationFactory();
        $this->expectException(InvalidValidationNameException::class);
        $factory->get('wrong_name');
    }
}