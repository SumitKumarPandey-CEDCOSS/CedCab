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
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    echo $username,$password;
    if ($password!=$repassword) {
        $error=array('input'=>'password','msg'=>'password doesnt match');
    }
    if (sizeof($error) == 0) {
        $fields = array('username', 'mobile', 'password', 'email');
        $values = array($username, $mobile, $password, $email);

        $res = $con->insert($fields, $values, 'userTable');

        if ($res) {
            echo "<script>alert('inserted')</script>";
            $error=array('input'=>'form','msg'=>"1 Row inserted");
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
<body class="body">
<div id="wrapper">
    <div id="signup-form">    
        <form action="" method="POST">
        <div class="loginlogo"><span>Sign Up</span></div>
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
                </p>
        </form>
    </div>
</div>
</body>
</html>