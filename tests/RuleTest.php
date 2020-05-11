<?php


use Lexuss1979\Validol\Exceptions\RequirementsConflictValidationException;
use Lexuss1979\Validol\Exceptions\TypeConflictValidationException;
use Lexuss1979\Validol\Rule;
use Lexuss1979\Validol\Validations\AbstractValidation;
use Lexuss1979\Validol\Validations\IntValidation;
use Lexuss1979\Validol\Validations\MinValidation;
use Lexuss1979\Validol\Validations\RequiredValidation;
use Lexuss1979\Validol\Validations\ValidationFactory;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    /** @test */
    public function it_create_correct_validation_set()
    {
        $ruleOptions = 'int required min:5';
        $rule = new Rule($ruleOptions, new ValidationFactory());

        $requirements = $rule->getValidations(AbstractValidation::REQUIREMENTS_GROUP);
        $this->assertIsArray($requirements);
        $this->assertInstanceOf(RequiredValidation::class, $requirements[0]);

        $types = $rule->getValidations(AbstractValidation::TYPE_GROUP);
        $this->assertIsArray($types);
        $this->assertInstanceOf(IntValidation::class, $types[0]);

        $common = $rule->getValidations(AbstractValidation::COMMON_GROUP);
        $this->assertIsArray($common);
        $this->assertInstanceOf(MinValidation::class, $common[0]);
    }

    /** @test */
    public function it_throws_if_types_conflict()
    {
        $this->expectException(TypeConflictValidationException::class);
        $ruleOptions = 'int bool min:5';
        new Rule($ruleOptions, new ValidationFactory());
    }

    /** @test */
    public function it_throws_if_requirements_conflict()
    {
        $this->expectException(RequirementsConflictValidationException::class);
        $ruleOptions = 'required sometimes bool min:5';
        new Rule($ruleOptions, new ValidationFactory());
    }
}