<?php

use Rymanalu\TwitterTimeAgo\TwitterTimeAgo;

class TwitterTimeAgoTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_set_the_timezone_to_default_timezone_when_create_a_new_instance_without_parameters()
    {
        date_default_timezone_set('Asia/Jakarta');

        $instance = $this->createInstance();

        $this->assertEquals('Asia/Jakarta', $instance->getTimezone());
    }

    /** @test */
    public function it_set_the_timezone_properly_even_the_default_timezone_is_not_same()
    {
        date_default_timezone_set('Asia/Jakarta');

        $instance = $this->createInstance('Asia/Jayapura');

        $this->assertEquals('Asia/Jayapura', $instance->getTimezone());
    }

    /**
     * @test
     * @expectedException  \BadMethodCallException
     */
    public function it_throws_an_exception_when_calling_methods_dynamically_except_parse()
    {
        $instance = $this->createInstance();

        $instance->foo();
    }

    protected function createInstance($timezone = null)
    {
        return new TwitterTimeAgo($timezone);
    }
}
