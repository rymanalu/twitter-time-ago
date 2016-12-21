<?php

namespace Rymanalu\TwitterTimeAgo;

use Carbon\Carbon;

class Parser
{
    /**
     * The Carbon time instance.
     *
     * @var \Carbon\Carbon
     */
    protected $time;

    /**
     * The difference in seconds between the Carbon time and current time.
     *
     * @var int
     */
    protected $diffInSeconds;

    /**
     * The timezone that will be used.
     *
     * @var string
     */
    protected $timezone;

    /**
     * Create a new Parser instance.
     *
     * @param  \Carbon\Carbon  $time
     * @param  string  $timezone
     * @return void
     */
    public function __construct(Carbon $time, $timezone = null)
    {
        $this->time = $time;
        $this->timezone = $timezone;
        $this->setDifference($time);
    }

    /**
     * Parse to the Twitter-like "time ago".
     *
     * @return string
     */
    public function parse()
    {
        if ($this->isTheYearDifferent()) {
            return $this->time->format('j M y');
        }

        if ($this->isMoreThanSixDays()) {
            return $this->time->format('j M');
        }

        if ($this->isMoreThanADay()) {
            return $this->time->diffInDays().'d';
        }

        if ($this->isMoreThanAHour()) {
            return $this->time->diffInHours().'h';
        }

        if ($this->isMoreThanAMinute()) {
            return $this->time->diffInMinutes().'m';
        }

        return $this->diffInSeconds.'s';
    }

    /**
     * Determine if the difference is more than a minute.
     *
     * @return bool
     */
    protected function isMoreThanAMinute()
    {
        return $this->diffInSeconds >= 60;
    }

    /**
     * Determine if the difference is more than a hour.
     *
     * @return bool
     */
    protected function isMoreThanAHour()
    {
        return $this->diffInSeconds >= 3600;
    }

    /**
     * Determine if the difference is more than a day.
     *
     * @return bool
     */
    protected function isMoreThanADay()
    {
        return $this->diffInSeconds >= 86400;
    }

    /**
     * Determine if the difference is more than 6 days.
     *
     * @return bool
     */
    protected function isMoreThanSixDays()
    {
        return $this->diffInSeconds > 518400;
    }

    /**
     * Determine if the Carbon time's year is different with current year.
     *
     * @return bool
     */
    protected function isTheYearDifferent()
    {
        return $this->time->year !== Carbon::now($this->timezone)->year;
    }

    /**
     * Set the difference property.
     *
     * @param  string  $time
     * @return void
     */
    protected function setDifference($time)
    {
        $this->diffInSeconds = Carbon::now($this->timezone)->diffInSeconds(
            $time instanceof Carbon ? $time : $this->freshCarbon($time)
        );
    }

    /**
     * Handle type juggling to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->parse();
    }
}
