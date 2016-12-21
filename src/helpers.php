<?php

use Rymanalu\TwitterTimeAgo\TwitterTimeAgo;

if (! function_exists('twitter_time_ago')) {
    /**
     * Parse the given date to "time ago" like Twitter.
     *
     * @param  string  $time
     * @return string
     */
    function twitter_time_ago($time)
    {
        return TwitterTimeAgo::parse($time);
    }
}
