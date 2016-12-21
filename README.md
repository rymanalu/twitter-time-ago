# Twitter Time Ago

[![Build Status](https://travis-ci.org/rymanalu/twitter-time-ago.svg?branch=master)](https://travis-ci.org/rymanalu/twitter-time-ago)

This package provides a function to parse a datetime to human readable time difference like [Twitter](https://twitter.com/).

## Installation
```
composer require rymanalu/twitter-time-ago
```

## Usage
```php
use Rymanalu\TwitterTimeAgo\TwitterTimeAgo;

$timeAgo = new TwitterTimeAgo; // or `new TwitterTimeAgo($timezone)`
echo $timeAgo->parse('2016-12-21 12:06:45');
// You can also just pass a date...
echo $timeAgo->parse('2016-12-12');

// Using static method...
echo TwitterTimeAgo::parse('2016-12-21 12:06:45');

// Using global helper...
echo twitter_time_ago($datetime);
```
