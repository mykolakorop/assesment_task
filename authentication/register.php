<html>
    <head>
        <title>Test Assigmant PHP</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
    <div class="container">
        <div class="menu">
            <span class="page_header">Registration Page</span>
            <a href="../index.php" id="logout_button">back</a>
        </div>

        <form action="register.php" id="register_form" method="POST">
            <label class="form_label" for="username_input">Username:</label>
            <input class="form_input" type="text" name="username" id="username_input" required="required"/> <br/>
            <label class="form_label" for="password_input">Password:</label>
            <input class="form_input" type="password" name="password" id="password_input" required="required"/> <br/>
            <input class="form_submit" type="submit" value="Register"/>
        </form>
    </div>
    </body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "../db/db_connect.php";

    $username = mysql_escape_string($_POST['username']);
    $password = mysql_escape_string($_POST['password']);
    $bool = true;
    $query =  mysql_query("SELECT * FROM users");
    while ($row = mysql_fetch_array($query))
    {
        $table_users = $row['username'];
        if($username == $table_users)
        {
            $bool = false;
            Print '<script>alert("Usernme already taken");</script>';
            Print '<script>window.location.assign("register.php")</script>';
        }
    }

    if($bool)
    {
        mysql_query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        Print '<script>alert("Successfully registered");</script>';
        Print '<script>window.location.assign("login.php")</script>';
    }
}
?>