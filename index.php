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
require 'Admin/config.php';
if (!empty(isset($_SESSION['userdata']))) {
    $user = $_SESSION['userdata']['username'];
}
$db = new LocationTable();
$db->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->location_getData();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <title>Document</title>
    <script src="script.js"></script>
</head>
<header>
    <ul id="headernav">
        <li><img src="images/logo.png" alt="Logo"></li>
        <li><a href="#">CADCABB</a></li>
    </ul>
</header>
<div class="main">
    <ul id="nav">
        <?php if (isset($_SESSION['userdata']['username'])) {
        ?>
            <li class="dropdown">
                <a href="userdashboard.php" class="dropbtn">UserDashboard</a>
            <li class="dropdown">
                <a href="index.php" class="dropbtn">Book Ride</a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Ride</a>
                <div class="dropdown-content">
                    <a href="user_pending_ride.php">Pending Rides</a>
                    <a href="completed_rides.php">Completed Rides</a>
                    <a href="user_rides.php">All Ride</a>
                </div>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">User Account</a>
                <div class="dropdown-content">
                    <a href="user_account.php">View Details</a>
                    <a href="change_password.php">Change Password</a>
            <li class="dropdown">
                <a href="Admin/logout.php">Logout</a>
</div>
<?php } ?>
<?php if (empty($_SESSION['userdata']['username'])) { ?>
    <li class="dropdown">
        <a href="Admin/signup.php">Sign In</a>
        <a href="Admin/login.php">Login In</a>
    <?php }  ?>
    </li>
    </ul>
    </div>

    <body class="admintop">
        <div class="adminbody">
            <img src="images/taxi6.jpg" alt="taxiimage">
            <p class="location-logo">Book Ride</p>
            <div class="table1">
                <form action="" method="POST" class="bookid">
                    <p class="input">
                        <label for="username">Pickup:
                            <select id="sel1" name="sellist1">
                                <option value="0" class="dropdown-menu">Enter the Pickup</option>
                                <?php
                                foreach ($sql as $key) { ?>
                                    <option class="dropdown-item" value="<?php echo $key['name'] ?>"><?php echo $key['name'] ?></option>
                                <?php } ?>
                            </select>
                        </label>
                    </p>
                    <p class="input">
                        <label for="text">Drop:
                            <select id="sel2" name="sellist1">
                                <option value="0" class="dropdown-menu">Enter the Destination</option>
                                <?php
                                $sql = $db->location_getData();
                                foreach ($sql as $key) { ?>
                                    <option class="dropdown-item" value="<?php echo $key['name'] ?>"><?php echo $key['name'] ?></option>
                                <?php } ?>
                            </select></label>
                    </p>
                    <p class="input">
                        <label for="text">Select Cab:
                            <select id="sel3">
                                <option class="dropdown-menu" value="0">Choose...</option>
                                <option class="dropdown-item" value="1">CedMicro</option>
                                <option class="dropdown-item" value="2">CedMini</option>
                                <option class="dropdown-item" value="3">CedRoyal</option>
                                <option class="dropdown-item" value="4">CedSUV</option>
                            </select></label>
                    </p>
                    <p class="input">
                        <label for="text">Luggage:
                            <input type="text" placeholder="Enter the Luggage Weight" disabled="disabled" id="text3">&nbsp;<span id="errormsg"></span>
                    </p></label>
                    <p class="submit">
                        <button type="submit" id="btn1" class="btn1">Calculate
                            Fare</button>
                        <button type="submit" id="btn2" class="btn1">Book
                            Now</button>
                    </p>
                </form>
                <div class="booktable">
                    <p id="table1"></p>
                </div>
            </div>
        </div>
    </body>