<?php

if (! function_exists('format_date_with_ordinal')) {
    function format_date_with_ordinal($date) {
        $day = (int) date('j', strtotime($date));
        $dayWithOrdinal = $day . date('S', mktime(0, 0, 0, 1, $day));
        $weekday = date('l', strtotime($date));
        return "{$dayWithOrdinal} ({$weekday})";
    }
}
