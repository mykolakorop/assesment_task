<?php
require_once "../db/db_connect.php";
function generate_money_prize($min_prize, $max_prize, $account_id, $user)
{
    $prize = rand($min_prize, $max_prize);
    $query = mysql_query("SELECT amount from money_balance WHERE id=$account_id") or die(mysql_error());
    $value = mysql_fetch_assoc($query);

    if ($value["amount"] < $prize){
        generate_money_prize($min_prize, $max_prize, $account_id, $user);
    }

    $query = mysql_query("SELECT money_amount from users WHERE username='$user'") or die(mysql_error());
    $value_user = mysql_fetch_assoc($query);

    $user_money = $value_user["money_amount"] + $prize;
    $account_money = $value["amount"] - $prize;
    mysql_query("UPDATE users SET money_amount = $user_money WHERE username='$user'") or die(mysql_error());
    mysql_query("UPDATE money_balance SET amount = $account_money WHERE id=$account_id") or die(mysql_error());
    return $prize;
}

function generate_loyalty_points_prize($min_prize, $max_prize, $user)
{
    $prize = rand($min_prize, $max_prize);
    $query = mysql_query("SELECT loyalty_point_amount from users WHERE username='$user'") or die(mysql_error());
    $value_user = mysql_fetch_assoc($query);
    $user_points = $value_user["loyalty_point_amount"] + $prize;
    mysql_query("UPDATE users SET loyalty_point_amount = $user_points WHERE username='$user'") or die(mysql_error());
    return $prize;
}

function generate_item_prize()
{
    $query = mysql_query("SELECT * from items_list WHERE amount > 0 ORDER BY RAND() LIMIT 1");
    $value = mysql_fetch_assoc($query);
    $item = new item();
    $item->id=$value["id"];
    $item->name=$value["name"];
    $item->item_url=$value["item_url"];
    $item->amount=$value["amount"];
    mysql_query("UPDATE items_list SET amount=$item->amount - 1 WHERE id = $item->id");
    return $item;
}

class item
{
}

?>