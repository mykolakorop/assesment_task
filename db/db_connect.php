<?php

$server = 'localhost';
$username = 'root';
$password = 'color3485';

$link = mysql_connect($server, $username, $password);
if (!$link) {
    die('Connection error: ' . mysql_error());
}
$selected_db = mysql_select_db("task_db") or die(mysql_error());
if (!$selected_db) {
    die('Database error: ' . mysql_error());
}

?>



