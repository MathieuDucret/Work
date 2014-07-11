<?php
$endtime = microtime();
$endarray = explode(" ", $endtime);
$endtime = $endarray[1] + $endarray[0];
$totaltime = $endtime-$starttime;
$totaltime = round($totaltime,5);
echo "<!-- This page loaded in $totaltime seconds.-->";
ob_end_flush();
