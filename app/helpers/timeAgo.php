<?php

// setting up the time Zone
// It Depends on your location or your P.c settings
define('TIMEZONE', 'America/Mexico_City');
date_default_timezone_set(TIMEZONE);

function last_seen($date_time)
{
 $timestamp = strtotime($date_time);

 $strTime = array("segundos", "minutos", "hora", "día", "mes", "año");
 $length  = array("60", "60", "24", "30", "12", "10");

 $currentTime = time();
 if ($currentTime >= $timestamp) {
  $diff = time() - $timestamp;
  for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
   $diff = $diff / $length[$i];
  }

  $diff = round($diff);
  if ($diff < 59 && $strTime[$i] == "segundo") {
   return 'Active';
  } else {
   return "hace " . $diff . " " . $strTime[$i] . "(s)";
  }

 }
}
