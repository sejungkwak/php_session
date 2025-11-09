<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">
    <title>Sign up</title>
</head>

<body>
    <div class="container">
        <form action="" method="post" name="Signup_Form" class="form-signin">

<?php

if (isset($_POST['Submit'])) {
    require "common.php";
    require_once "../src/DBconnect.php";

    try {
        $new_user = array(
            "username" => escape($_POST['Username']),
            "password" => escape($_POST['Password'])
        );
        $sql = sprintf( "INSERT INTO %s (%s) values (%s)", "users", implode(", ",
            array_keys($new_user)), ":" . implode(", :", array_keys($new_user)) );
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

if (isset($_POST['Submit']) && $statement) {
    echo $new_user['username'] . " has been registered successfully. <br> <a href=\"index.php\">Sign in to my account</a>";
}

?>

            <h1 class="form-signin-heading">Please sign up</h1>
            <label for="inputUsername">Username</label>
            <input name="Username" type="text" id="inputUsername" class="form-control" placeholder="Username" minlength="4" required autofocus>
            <label for="inputPassword">Password</label>
            <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" minlength="4" required>

            <p><a href="login.php">I have an account</a></p>
            <button name="Submit" class="button" type="submit">Sign up</button>
        </form>
    </div>
</body>

</html>
