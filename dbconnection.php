<?php
$server = 'xxxxxxxxx';
$username = 'xxxx';
$password = 'xxxxxxxx';
$dbname = 'xxxx';
$dbconn = new mysqli($server,$username,$password,$dbname) or die($dbconn->error);
?>