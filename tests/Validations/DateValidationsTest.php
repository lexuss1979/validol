<?php


namespace Validations;


use Lexuss1979\Validol\Validations\ValidationFactory;
use Lexuss1979\Validol\Validator;
use Lexuss1979\Validol\ValueObject;
use PHPUnit\Framework\TestCase;

class DateValidationsTest extends TestCase
{
    /** @test */
    public function it_change_value_object_type_after_validation()
    {
        $value = new ValueObject('created_at', '12-05-2020');
        $validation = (new ValidationFactory())->get('date');
        $this->assertFalse($value->isDate());
        $validation->validate($value);
        $this->assertTrue($value->isDate());
    }

    /** @test
     * @dataProvider dateProvider
     */
    public function it_can_detect_date($val, $result)
    {
        $this->assertEquals($result, (Validator::process(['date_val' => $val], ['date_val' => 'required date']))->success());
    }

    public function dateProvider()
    {
        return [
            [2, false],
            [1000000000, false],
            ['2', false],
            [3.14, false],
            ['str', false],
            ['3str', false],
            [true, false],
            [false, false],
            ['2019-11-01', true],
            ['2019-01-11', true],
            ['2019-11-11', true],
            ['2019-11-26', true],
            ['2019-26-11', false],
            ['01-12-2019', true],
            ['19-12-2019', true],
            ['02-22-2019', false],

            ['2019.11.01', false],
            ['2019.01.11', false],
            ['2019.11.11', false],
            ['2019.11.26', false],
            ['2019.26.11', false],
            ['01.12.2019', true],
            ['19.12.2019', true],
            ['02.22.2019', false],
        ];
    }

    /** @test */
    public function it_returns_correct_error_message()
    {
        $validation = Validator::process(['date_val' => '123'], ['date_val' => 'required date']);
        $this->assertEquals(['date_val' => ['date_val must be a valid date']], $validation->errors());
    }

    /** @test
     * @dataProvider dateWithFormatProvider
     */
    public function it_can_detect_date_with_format($val, $result)
    {
        $this->assertEquals($result, (Validator::process(['date_val' => $val], ['date_val' => 'required date:Y-m-d']))->success());
    }

    public function dateWithFormatProvider()
    {
        return [
            ['2019-11-01', true],
            ['2019-01-11', true],
            ['2019-11-11', true],
            ['2019-11-26', true],
            ['2019-26-11', false],
            ['01-12-2019', false],
            ['19-12-2019', false],
            ['02-22-2019', false],
            ['01.12.2019', false],
            ['19.12.2019', false],
        ];
    }

    /** @test */
    public function it_returns_correct_error_message_for_date_format_validation()
    {
        $validation = Validator::process(['date_val' => '12.04.2020'], ['date_val' => 'required date:Y-m-d']);
        $this->assertEquals(['date_val' => ['date_val is not in date format Y-m-d']], $validation->errors());
    }


    /** @test
     * @dataProvider  dateBeforeProvider
     * @param $val
     * @param $result
     */
    public function it_can_date_before($val, $result)
    {
        $this->assertEquals($result, (Validator::process(['date_val' => $val], ['date_val' => 'required date date_before:2019-11-30']))->success());
    }

    public function dateBeforeProvider()
    {
        return [
            ['2018-01-11', true],
            ['2019-01-11', true],
            ['2019-11-11', true],
            ['2019-11-29', true],
            ['2019-12-01', false],
            ['2020-01-01', false],
            ['01.05.2020', false],
        ];
    }

    /** @test */
    public function it_returns_correct_error_message_for_date_before_validation()
    {
        $validation = Validator::process(['date_val' => '12.04.2020'], ['date_val' => 'required date date_before:01-04-2020']);
        $this->assertEquals(['date_val' => ['date_val must be before 01-04-2020']], $validation->errors());
    }


    /** @test
     * @dataProvider  dateBeforeProvider
     * @param $val
     * @param $result
     */
    public function it_can_date_after($val, $result)
    {
        $this->assertEquals( ! $result, (Validator::process(['date_val' => $val], ['date_val' => 'required date date_after:2019-11-30']))->success());
    }

    /** @test */
    public function it_false_before_and_after_for_same_date()
    {
        $this->assertFalse((Validator::process(['date_val' => 2019-11-30], ['date_val' => 'required date date_before:2019-11-30']))->success());
        $this->assertFalse((Validator::process(['date_val' => 2019-11-30], ['date_val' => 'required date date_after:2019-11-30']))->success());
    }

    /** @test */
    public function it_returns_correct_error_message_for_date_after_validation()
    {
        $validation = Validator::process(['date_val' => '12.03.2020'], ['date_val' => 'required date date_after:01-04-2020']);
        $this->assertEquals(['date_val' => ['date_val must be after 01-04-2020']], $validation->errors());
    }

    /** @test
     * @dataProvider dateBetweenProvider
     * @param $val
     * @param $start
     * @param $end
     * @param $result
     */
    public function it_can_detect_between($val, $start, $end, $result)
    {
        $this->assertEquals( $result, (Validator::process(['date_val' => $val], ['date_val' => "required date date_between:$start:$end"]))->success());
    }

    public function dateBetweenProvider()
    {
        return [
            ['2020-05-01', '2020-04-01','2020-05-02', true],
            ['2020-05-01', '2020-04-01','2020-05-01', false],
            ['2020-05-01', '2020-05-01','2020-05-02', false],
            ['2020-05-01', '2020-05-05','2020-05-10', false],
            ['2020-05-01', '2020-04-05','2020-04-10', false],
        ];
    }

    /** @test */
    public function it_returns_correct_error_message_for_date_between_validation()
    {
        $validation = Validator::process(['date_val' => '12.03.2020'], ['date_val' => 'required date date_between:01-02-2020:01-03-2020']);
        $this->assertEquals(['date_val' => ['date_val must be after 01-02-2020 and before 01-03-2020']], $validation->errors());
    }

}