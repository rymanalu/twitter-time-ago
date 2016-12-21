<?php

namespace Rymanalu\TwitterTimeAgo;

use Carbon\Carbon;
use BadMethodCallException;

class TwitterTimeAgo
{
    /**
     * The timezone that will be used.
     *
     * @var string
     */
    protected $timezone;

    /**
     * Create a new TwitterTimeAgo instance.
     *
     * @param  string|null  $timezone
     * @return void
     */
    public function __construct($timezone = null)
    {
        $this->setTimezone($timezone);
    }

    /**
     * Get the timezone.
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set the timezone.
     *
     * @param  string  $timezone
     * @return void
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone ?: date_default_timezone_get();
    }

    /**
     * Create a new fresh Carbon instance.
     *
     * @param  string|null  $time
     * @return \Carbon\Carbon
     */
    protected function freshCarbon($time = null)
    {
        return new Carbon($time, $this->timezone);
    }

    /**
     * Handle dynamic method calls.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if ('parse' === $method) {
            return (string) new Parser($this->freshCarbon($parameters[0]), $this->timezone);
        }

        $className = get_called_class();

        throw new BadMethodCallException("Call to undefined method {$className}::{$method}()");
    }

    /**
     * Handle dynamic static method calls.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return call_user_func_array([new static, $method], $parameters);
    }
}
