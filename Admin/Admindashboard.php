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
session_start();
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
        <div class="tiles"><a href="pending_ride.php"><p><i class="fa fa-bar-chart"></i></p>Pending Rides</a></div>
        <div class="tiles"><a href="pending_request.php"><p><i class="fa fa-cubes"></i></p>Pending User</a></div>
        <div class="tiles"><a href="pending_rides.php"><p><i class="fa fa-group"></i></p>Total Rides</a></div>
        <div class="tiles"><a href="manageCustomers.php"><p><i class="fa fa-handshake-o"></i></p>All Users</a></div>
        </div>
        <div class="maintiles">
        <div class="tiles"><a href="pending_ride.php"><p><i class="fa fa-hourglass-2"></i></p>Pending Rides</a></div>
        <div class="tiles"><a href="pending_request.php"><p><i class="fa fa-line-chart"></i></p>Pending User</a></div>
        <div class="tiles"><a href="pending_rides.php"><p><i class="fa fa-search-plus"></i></p>Total Rides</a></div>
        <div class="tiles"><a href="manageCustomers.php"><p><i class="fa fa-signal"></i></p>All Users</a></div>
        </div>
    </div>
    <script src="../script.js"></script>
</body>