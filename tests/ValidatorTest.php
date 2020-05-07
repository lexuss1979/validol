<?php


use Lexuss1979\Validol\Validator;

class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    protected $validator;
    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new Validator();
    }

    /** @test */
    public function it_can_validate_required_negative()
    {
        $data = [];
        $result = $this->validator->validate($data,[
            "name" => 'required'
        ]);
        $this->assertFalse($result);
    }

    /** @test */
    public function it_can_validate_required_positive()
    {
        $data = ["name" => "Alex"];
        $result = $this->validator->validate($data,[
            "name" => 'required'
        ]);
        $this->assertTrue($result);
    }

    /** @test */
    public function it_can_process_several_keys()
    {
        $invalidData = ["name" => "Alex"];
        $validData = ["name" => "Alex", "age" => 25];
        $rules = [
            "name" => 'required',
            "age" => 'required'
        ];

        $this->assertFalse($this->validator->validate($invalidData,$rules));
        $this->assertTrue($this->validator->validate($validData,$rules));
    }

    /** @test
     * @dataProvider intProvider
     */
    public function it_validate_int($val, $result)
    {
        $rules = [ "age" => 'int'];
        $this->assertSame($result,
            $this->validator->validate(['age' => $val], $rules)
        );
    }

    public function intProvider()
    {
        return [
            ["string", false],
            ["true", false],
            ["1", true],
            ["123", true],
            ["123.6", false],
            [0, true],
            [1, true],
            [123, true],
            [true, false],
            [false, false],
            [12.4, false],
        ];
    }


    /** @test
     * @dataProvider boolProvider
     */
    public function it_validate_bool($val, $result)
    {
        $rules = [ "access" => 'bool'];
        $this->assertSame($result,
            $this->validator->validate(['access' => $val], $rules)
        );
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

    /** @test */
    public function it_can_process_several_validation_per_value()
    {
        $validData = ['age' => '55'];
        $invalidData1 = ['name' => 'Alex'];
        $invalidData2 = ['name' => 'Alex', 'age' => 'fifty five'];
        $rules = [ "age" => 'require int'];
        $this->assertTrue( $this->validator->validate($validData, $rules) );
        $this->assertFalse( $this->validator->validate($invalidData1, $rules) );
        $this->assertFalse( $this->validator->validate($invalidData2, $rules) );
    }

    /** @test */
    public function it_return_validated_values_for_success_validation()
    {
        $data = [
            "name" => "Alex",
            "age" => 25,
            "email" => "mymail@mail.com"
        ];
        $this->validator->validate($data,[
            'name' => 'required'
        ]);
        $this->assertEquals(['name' => 'Alex'], $this->validator->validated());
    }

    /** @test */
    public function it_can_return_validated_values_if_validation_fails()
    {
        $data = [
            "name" => "Alex",
            "age" => 25,
            "email" => "mymail@mail.com"
        ];
        $result = $this->validator->validate($data,[
            'name' => 'required',
            'age' => 'int',
            'email' => 'required bool' //this validation will fail,

        ]);
        $this->assertEquals(['name' => 'Alex', 'age' => 25], $this->validator->validated());
        $this->assertFalse($result);
    }


    /** @test */
    public function it_returns_no_errors_if_validation_success()
    {
        $this->validator->validate(['name'=>'Alex'], ['name' => 'required']);
        $this->assertEmpty($this->validator->errors());
    }

    /** @test */
    public function it_returns_errors_if_validation_fail()
    {
        $this->validator->validate(['name'=>'Alex'], ['age' => 'required']);
        $this->assertCount(1, $this->validator->errors());
    }
}