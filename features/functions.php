<?php
require_once("../db/db_connect.php");

Class user_balance{}


if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'cancel_item':
            cancel_item($_POST['id']);
            Print '<script>window.location.assign("../main/home.php")</script>';
            break;
        case 'exchange_money':
            $amount = mysql_escape_string($_POST['amount']);
            $user = mysql_escape_string($_POST['user']);
            $koeficient = 3;
            exchange_loyalty_points($amount, $koeficient, $user);
            Print '<script>window.location.assign("../main/home.php")</script>';
            break;
    }
}


function get_user_balance($user_name)
{
    $query = mysql_query("SELECT * FROM users WHERE username ='$user_name'") or die(mysql_error());
    $value = mysql_fetch_assoc($query);
    $user_balance = new user_balance();
    $user_balance->money_amount=$value["money_amount"];
    $user_balance->loyalty_point_amount=$value["loyalty_point_amount"];
    return $user_balance;
}

function exchange_loyalty_points($amount, $koeficient, $user_name)
{

    $query = mysql_query("SELECT money_amount from users WHERE username='$user_name'") or die(mysql_error());
    $value_user = mysql_fetch_assoc($query);

    $user_money = $value_user["money_amount"] - $amount;
    mysql_query("UPDATE users SET money_amount = $user_money WHERE username='$user_name'") or die(mysql_error());

    $query = mysql_query("SELECT loyalty_point_amount from users WHERE username='$user_name'") or die(mysql_error());
    $value_user = mysql_fetch_assoc($query);
    $user_points = $value_user["loyalty_point_amount"] + ($amount * $koeficient);
    mysql_query("UPDATE users SET loyalty_point_amount = $user_points WHERE username='$user_name'") or die(mysql_error());
    return 1;
}

function cancel_item($id){
    $query = mysql_query("SELECT * from items_list WHERE id='$id'") or die(mysql_error());
    $value_user = mysql_fetch_assoc($query);
    $items_amount = $value_user["amount"] + 1;
    mysql_query("UPDATE items_list SET amount = $items_amount WHERE id='$id'") or die(mysql_error());
}


?>