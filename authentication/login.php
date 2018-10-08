<html>
    <head>
        <title>Test Assigmant PHP</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
    <div class="container">
        <div class="menu">
            <span class="page_header">Login Page</span>
            <a href="../index.php" id="logout_button">back</a>
        </div>

        <form action="checklogin.php" id="login_form" method="POST">
            <label class="form_label" for="username_input">Username:</label>
            <input class="form_input" type="text" name="username" id="username_input" required="required"/> <br/>
            <label class="form_label" for="password_input">Password:</label>
            <input class="form_input" type="password" name="password" id="password_input" required="required"/> <br/>
            <input class="form_submit" type="submit" value="Login"/>
        </form>
    </div>
    </body>
</html>