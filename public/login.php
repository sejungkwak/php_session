<?php
require_once ('config.php'); // This is where the username and password are currently stored.
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">
    <title>Sign in</title>
</head>

<body>
    <div class="container">
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputUsername" >Username</label>
            <input name="Username" type="text" id="inputUsername" class="form-control" placeholder="Username" minlength="4" required autofocus>
            <label for="inputPassword">Password</label>
            <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" minlength="4" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <p><a href="signup.php">I don't have an account</a></p>
            <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
        </form>

<?php
/* Check if login form has been submitted */
/* isset — Determine if a variable is declared and is different than NULL*/
if(isset($_POST['Submit']))
{
    /* Check if the form's username and password matches */
    /* these currently check against variable values stored in
    config.php but later we will see how these can be checked against
    information in a database. */

    try {
        require "common.php";
        require_once "../src/DBconnect.php";

        $sql = "SELECT username, password FROM users WHERE username = :username";
        $username = escape($_POST['Username']);

        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $password = escape($_POST['Password']);

        if($username && $row['password'] == $password) {
            $_SESSION['Username'] = $username; // store Username to the session
            $_SESSION['Active'] = true;
            header("location: index.php"); // 'header()' is used to redirect the browser
            exit; // terminate all current code so that it doesn't run when we redirect
        } else
            echo 'Incorrect Username or Password';
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

    </div>
</body>
</html>