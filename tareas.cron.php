<?php

$time = "20:00";
 
$entry = "Información guardada a las $time.\n";
 
$file = "/var/www/tesoreria/test.cron.txt";
 
$open = fopen($file,"a");
 
 
if ( $open ) {
 
 	fwrite($open,$entry);

    fclose($open);
}
?>