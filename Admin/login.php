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
$user = new User();
$user->connect('localhost', 'root', '', 'CabBooking');
$msg = "";
$error = array();
if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $roles = $_POST['roles'];
    echo $user->login($username, $password, $roles);
    if (isset($_POST['rememberme'])) {
        setcookie('username', $_POST['username'], time()+60*60*24*365);  
    }
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
<header style="margin-top:-2%;">
    <ul id="headernav">
        <li><img src="../images/logo.png" alt="Logo"></li>
        <li><a href="Admindashboard.php">CEDCABB</a></li>
    </ul>
</header>
<div class="main">
    <ul id="nav">
        <li class="dropdown">
            <a href="../index.php" class="dropbtn">Book Ride</a>
        </li>
    </ul>
</div>
<body class="body" style="margin:0;">
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
                    <?php if (sizeof($error) > 0) : ?>
                        <ul>
                            <?php foreach ($error as $value) : ?>
                                <li><?php echo $error['msg'];
                                    break ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <p class="input">
                    <label for="username">Username:
                        <input type="text" name="username" value="<?php if (isset($_COOKIE['username'])) { echo $_COOKIE['username'] ; } ?>" required></label>
                </p>
                <p class="input">
                    <label for="password">Password:
                        <input type="password" name="password" required></label>
                </p>
                <p class="input">
                    <label for="">Remember Me:
                        <input type="checkbox" name="rememberme" value="1"><br>
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="Login">
                </p>
                <span class='bottom'>Need a account? <a href="signup.php" style="margin-left:70px;">Sign Up</a>
                <br>
                <br>
                <!-- <a href="../index.php" style="margin-left:70px;">Book Ride Now</a></span> -->          
            </form>
        </div>
    </div>
</body>

</html>