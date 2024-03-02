<?php 

define("DB_HOST", "localhost");
define("DB_USER", "sead");
define("DB_PASS", "sonyxperiaM5");
define("DB_NAME", "feedback");

//Create connection
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($connection->connect_error) {
    die("Connection failed $connection->connect_error");
}

echo "CONNECTED";