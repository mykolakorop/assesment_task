<html>
<head>
    <title>Test Assigmant PHP</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</head>

<?php
session_start();
if ($_SESSION['user']) { // checks if the user is logged in
} else {
    header("location: index.php");
}
$user = $_SESSION['user'];

require_once("../features/prize_generator.php");
require_once("../features/functions.php");
require_once("../db/db_connect.php");

$item = generate_item_prize();
$balance = get_user_balance($user);

?>

<body>
<div class="container">
    <div class="menu">
        <span class="page_header">Personal Account: <b><?php echo $user; ?></b> </span>
        <a href="../authentication/logout.php" id="logout_button">Log Out</a><br/><br/>
    </div>

    <div class="content_left">
        <button class="play_button" value="<?php echo $user ?>">Try to win</button>
    </div>

    <div class="content_right">
        <p>Your Money Balance: <b>$<?php echo $balance->money_amount ?></b></p>
        <p>Your Loyalty Points Balance: <b> <?php echo $balance->loyalty_point_amount ?> </b> points</p>

        <form action="../features/functions.php" id="exchange_form" method="POST" onSubmit="document.getElementById(" exchange_form").reset()">
            <button id="exchange_submit" type="submit">Exchange</button>
            <input type="number" name="amount" max="<?php echo $balance->money_amount; ?>">
            <input type="text" value="<?php echo $user; ?>" name="user" hidden>
            <input type="text" value="exchange_money" name="action" hidden>
        </form>
        <div class="prize_box">
            <span id="congrag">Congratulations!!!<span id="close_congrad">&cross;</span><span id="item_id"></span></span>
            <br>
            <span id="win_message">You win <span id="prize_type"></span> </span>
            <img id="item_foto" width="auto" height="200px"/>
            <button type="button" id="cancel_item_prize" value="">I don't want prize</button>
            <button type="button" id="delivery_item" value="">Order Delivery</button>
        </div>
    </div>
</div>




