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
$con = new DB();
$con->connect('localhost', 'root', '', 'CabBooking');
$msg = '';
$error = array();
if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $repassword = md5($_POST['repassword']);
    $mobile = $_POST['mobile'];

    if (!empty($mobile)) // phone number is not empty
    {
        if (preg_match('/^\d{10}$/', $mobile)) // phone number is valid
        {
            $mobile = '0' . $mobile;
        } else {
            echo "<script>alert('Enter valid Mobile Number')</script>";
            $error = array('input' => 'password', 'msg' => 'Enter Valid Mobile Number');
        }
    }
    $email = $_POST['email'];
    echo $username, $password;
    if ($password != $repassword) {
        $error = array('input' => 'password', 'msg' => 'password doesnt match');
    }
    if (sizeof($error) == 0) {
        $fields = array('username', 'mobile', 'password', 'email');
        $values = array($username, $mobile, $password, $email);

        $res = $con->insert($fields, $values, 'userTable');

        if ($res) {
            echo "<script>alert('inserted')</script>";
            $error = array('input' => 'form', 'msg' => "1 Row inserted");
            header('refresh:0; url=login.php');
        }
    }
}
?>
<html>
<head>
    <title>
        Register
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
    <div id="wrapper">
        <div id="signup-form">
            <form action="" method="POST">
                <div class="loginlogo"><span>Sign Up</span></div>
                <p class="input">
                    <label for="username">Username:
                        <input type="text" name="username" required>
                    </label>
                </p>
                <p class="input">
                    <label for="password">Password:
                        <input type="password" name="password" required>
                    </label>
                </p>
                <p class="input">
                    <label for="repassword">Re-Password:
                        <input type="password" name="repassword" required>
                    </label>
                </p>
                <p class="input">
                    <label for="mobile">Mobile:
                        <input type="text" name="mobile" required>
                    </label>
                </p>
                <p class="input">
                    <label for="email">Email:
                        <input type="email" name="email" required>
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="Submit">
                </p>
                <p class="bottom">
                    <a href="login.php" style="margin-left:70px;">Click Here To Login</a>
                    <!-- <a href="index.php" style="margin-left:70px;">Book Ride Now</a> -->
                </p>
            </form>
        </div>
    </div>
</body>

</html>