<?php
define('DB_SERVER', 'sql1.njit.edu');
define('DB_USERNAME', 'af288');
define('DB_PASSWORD', 'Mojojojo@2020');
define('DB_NAME', 'af288');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>