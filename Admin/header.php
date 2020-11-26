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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <title>Document</title>
</head>
<header>
    <ul id="headernav">
        <li><img src="../images/logo.png" alt="Logo"></li>
        <li><a href="#">CADCABB</a></li>
    </ul>
</header>
<div class="main">
    <ul id="nav">
        <li class="dropdown">
            <a href="Admindashboard.php" class="dropbtn">AdminDashboard</a>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Ride</a>
            <div class="dropdown-content">
                <a href="pending_ride.php">Pending Rides</a>
                <a href="completed_rides.php">Completed Rides</a>
                <a href="cancelled_rides.php">Cancelled Rides</a>
                <a href="All_rides.php">All Ride</a>
            </div>
        <li class="dropdown">
            <a href="javascript:void(0)">Location</a>
            <div class="dropdown-content">
                <a href="location.php">Add Location</a>
                <a href="manageLocation.php">Location List</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Users</a>
            <div class="dropdown-content">
                <a href="pending_request.php">Request Pending</a>
                <a href="request_approved.php">Request Approved</a>
                <a href="manageCustomer.php">All User</a>
        <li class="dropdown">
            <a href="logout.php">Logout</a>
</div>
</li>
</ul>
</div>