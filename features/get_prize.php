<?php
require_once("prize_generator.php");

function show_prize($user)
{
    $random = rand(1, 3);
    $prize = "";
    if ($random == 1){
        $prize = '{"' . 'prize_title' . '" : ' . '"' . 'money prize: $' . '",' . '"' . 'value' . '" : ' . '"' . generate_money_prize(0, 200, 1, $user) . '"}';
    } elseif ($random == 2){
        $prize = '{"' . 'prize_title' . '" : ' . '"' . 'loyalty points: ' . '",' . '"' . 'value' . '" : ' . '"' . generate_loyalty_points_prize(500, 6000, $user) . '"}';
    } elseif ($random == 3){
        $item = generate_item_prize();
        $prize = '{"' . 'prize_title' . '" : ' . '"' . 'amazing item: ' . '",' . '"' . 'item_id' . '" : ' . '"' . $item ->id . '",' . '"' . 'name' . '" : ' . '"' . $item->name . '",' . '"' . 'item_url' . '" : ' . '"' . $item->item_url .'"}';
    }
    echo $prize;
}
show_prize($_POST['name']);
?>
