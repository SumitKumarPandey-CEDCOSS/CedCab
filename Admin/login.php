<?php 
/**
 * Php version 7.2.10
 * 
 * @category Components
 * @package  Packagename
 * @author   Sumit kumar Pandey <pandeysumit399@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://localhost/training/php%20mysql%20task1/register/signup.php
 */
require 'config.php';
// $con = new DB();
$user = new User();
$user->connect('localhost', 'root', '', 'CabBooking');
$msg="";
$error = array();
if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $roles = $_POST['roles'];
    // echo $roles;
    echo $user->login($username, $password, $roles);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Login
    </title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body class="body">
    <div id="wrapper">
        <div id="login-form">
            <form action="" method="POST">
                <div class="loginlogo"><span>Login</span></div>
                <p>
                    <label for="roles" id="role">Login As:
                        <select id="roles" name="roles">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </Select></label>
                </p>
                <div id="errordiv">
                    <?php if (sizeof($error)>0) : ?>
                    <ul>
                        <?php foreach ($error as $value) : ?>
                        <li><?php echo $error['msg'] ;break ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif ; ?>
                </div>
                <p class="input">
                    <label for="username">Username:
                        <input type="text" name="username" required></label>
                </p>
                <p class="input">
                    <label for="password">Password:
                        <input type="password" name="password" required></label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="Login">
                </p>
                <span class='bottom'>Need a account? <a href="signup.php">Sign Up</a> </span>
            </form>
        </div>
    </div>
</body>
</html>