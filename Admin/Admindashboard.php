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
$db = new Ride();
$Us = new User();
$db->connect('localhost', 'root', '', 'CabBooking');
$Us->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->count_pending_ride();
$confirm = $db->count_ride();
$confirm_rides = $db->count_confirm_ride();
$count_user = $Us->count_user();
$count_pending_user = $Us->count_pending_request();
$total_revenue = $db->Total_Revenue();
$blocked = $Us->count_blocked();
if (!empty(isset($_SESSION['userdata']))) {
    $user = $_SESSION['userdata']['username'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=login.php");
}
require 'header.php';
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Welcome &nbsp;<?php if (!empty($user)) {
                                    echo $user;
                                } ?></h1>
        </div>
        <div class="maintiles">
            <div class="tiles"><a href="pending_ride.php">
                    <p><i class="fa fa-bar-chart"></i></p>Pending Rides &nbsp; <?php echo $sql ?>
                </a></div>
            <div class="tiles"><a href="pending_request.php">
                    <p><i class="fa fa-cubes"></i></p>Pending User &nbsp; <?php echo $count_pending_user ?>
                </a></div>
            <div class="tiles"><a href="All_rides.php">
                    <p><i class="fa fa-group"></i></p>Total Rides &nbsp; <?php echo $confirm ?>
                </a></div>
            <div class="tiles"><a href="manageCustomer.php">
                    <p><i class="fa fa-handshake-o"></i></p>All Users &nbsp; <?php echo $count_user ?>
                </a></div>
        </div>
        <div class="maintiles">
            <div class="tiles"><a href="pending_ride.php">
                    <p><i class="fa fa-hourglass-2"></i></p>Confirm_Rides &nbsp;<?php echo $confirm_rides ?>
                </a></div>
            <div class="tiles"><a href="pending_request.php">
                    <?php
                    $sum = 0;
                    foreach ($total_revenue as $key) {
                        $sum += $key['total_fare'];
                    }   ?>
                    <p><i class="fa fa-line-chart"></i></p>Total_Revenue <?php echo $sum ?></a></div>
            <div class="tiles"><a href="pending_rides.php">
                    <p><i class="fa fa-search-plus"></i></p>Blocked_Users <br> <?php echo $blocked ?>
                </a></div>
            <div class="tiles"><a href="manageCustomers.php">
                    <p><i class="fa fa-signal"></i></p>All Users
                </a></div>
        </div>
    </div>
    <script src="../script.js"></script>
</body>