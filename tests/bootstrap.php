<?php

/* Register the Composer Auto Loader */
require __DIR__.'/../vendor/autoload.php';

use Carbon\Carbon;

/* Set the Default Timezone */
date_default_timezone_set('UTC');

Carbon::setTestNow(Carbon::create(2016, 12, 21, 18, 21, 45));
