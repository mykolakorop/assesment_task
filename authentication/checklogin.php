<?php
session_start();
require_once "../db/db_connect.php";

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);

$query = mysql_query("SELECT * from users WHERE username='$username'");
$exists = mysql_num_rows($query);
$table_users = "";
$table_password = "";
if($exists > 0)
{
    while($row = mysql_fetch_assoc($query))
    {
        $table_users = $row['username'];
        $table_password = $row['password'];
    }
    if(($username == $table_users) && ($password == $table_password))
    {
        if($password == $table_password)
        {
            $_SESSION['user'] = $username;
            header("location: ../main/home.php");
        }

    }
    else
    {
        Print '<script>alert("Incorrect Password!");</script>';
        Print '<script>window.location.assign("authentication/login.php");</script>';
    }
}
else
{
    Print '<script>alert("Incorrect Username!");</script>';
    Print '<script>window.location.assign("authentication/login.php");</script>';
}
?>