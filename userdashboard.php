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
require 'userheader.php';
require 'Admin/config.php';
$db = new Ride();
$db->connect('localhost', 'root', '', 'CabBooking');
if (empty($_SESSION['userdata'])) {
    echo "<script>alert('please login to entered')</script>";
    header('Refresh:0; url=Admin/login.php');
}
if (isset($_SESSION['userdata'])) {
    $user = $_SESSION['userdata']['user_id'];
    $username = $_SESSION['userdata']['username'];
}
$sql = $db->user_completed_ride($user);
$pending_ride = $db->user_pending_ride($user);
$expense = $db->Total_Revenue($user);
?>

<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Welcome &nbsp;<?php if (!empty($username)) {
                                    echo $username;
                                } ?></h1>
        </div>
    </div>
    <div class="maintiles">
        <div class="tiles"><a href="user_pending_ride.php">
                <p><i class="fa fa-bar-chart"></i></p>Pending Rides :&nbsp; <?php echo $pending_ride ?>
            </a></div>
        <div class="tiles"><a href="completed_rides.php">
                <p><i class="fa fa-group"></i></p>Completed Rides :&nbsp;<?php echo $sql ?>
            </a></div>
        <?php
        $sum = 0;
        foreach ($expense as $key) {
            $sum += $key['total_fare'];
        } ?>
        <div class="tiles"><a href="#">
                <p><i class="fa fa-handshake-o"></i></p>Total Expense : &nbsp; <?php echo $sum ?> $
            </a></div>
    </div>
</body>