<?php

use Carbon\Carbon;
use Rymanalu\TwitterTimeAgo\Parser;

class ParserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_parses_to_full_date_when_the_year_is_different()
    {
        $instance = $this->createInstance(Carbon::now()->subYear());

        $this->assertEquals('21 Dec 15', $instance->parse());
    }

    /** @test */
    public function it_parses_to_date_and_month_when_the_difference_is_more_than_or_equal_to_a_week()
    {
        $instance = $this->createInstance(Carbon::now()->subWeek());

        $this->assertEquals('14 Dec', $instance->parse());
    }

    /** @test */
    public function it_parses_to_number_of_days_when_the_difference_is_more_than_or_equal_to_a_day()
    {
        $instance = $this->createInstance(Carbon::now()->subDays(2));

        $this->assertEquals('2d', $instance->parse());
    }

    /** @test */
    public function it_parses_to_number_of_hours_when_the_difference_is_more_than_or_equal_to_a_hour()
    {
        $instance = $this->createInstance(Carbon::now()->subHours(3));

        $this->assertEquals('3h', $instance->parse());
    }

    /** @test */
    public function it_parses_to_number_of_minutes_when_the_difference_is_more_than_or_equal_to_a_minute()
    {
        $instance = $this->createInstance(Carbon::now()->subMinutes(12));

        $this->assertEquals('12m', $instance->parse());
    }

    /** @test */
    public function it_parses_to_number_of_seconds_when_the_difference_is_less_than_a_minute()
    {
        $instance = $this->createInstance(Carbon::now()->subSeconds(59));

        $this->assertEquals('59s', $instance->parse());
    }

    protected function createInstance(Carbon $time)
    {
        return new Parser($time);
    }
}
