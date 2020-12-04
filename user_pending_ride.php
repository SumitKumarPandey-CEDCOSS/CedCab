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
if (isset($_SESSION['userdata']) && ($_SESSION['userdata']['is_admin'] == 'user')) {
    $username = $_SESSION['userdata']['username'];
    $user = $_SESSION['userdata']['user_id'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=Admin/login.php");
}
if (isset($_REQUEST['canid'])) {
    $ride_id = $_REQUEST['canid'];
    echo $db->cancelled($ride_id);
    echo "<script>alert('Ride cancelled SuccessFully')</script>";
    header("Refresh:0;url=user_pending_ride.php");
}
if (empty($user)) {
    header('Location:Admin/login.php');
}
$sql = $db->pending($user);

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = `ride_date`;
}
$sql = $db->pending_user_sort($user, $sort);
?>

<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Pending Rides</h1>
        </div>
        <div class="dropdown sort">
            <button class="dropbtn sortbtn">Sort By</button>
            <div class="dropdown-content sortcontent">
            <a href="user_pending_ride.php?sort=ride_date">Ride Date<p hidden>A $_GET</p></a>
                <a href="user_pending_ride.php?sort=ASC">ASC by Fare<p hidden>A $_GET</p></a>
                <a href="user_pending_ride.php?sort=DESC">DESC by Fare<p hidden>A $_GET</p></a>
            </div>
        </div>
        <div class="dropdown sort" style="margin-left:-5px;">
            <button class="dropbtn sortbtn">Filter By</button>
            <div class="dropdown-content sortcontent">
                <a href="user_pending_ride.php?sort=week">WEEK<p hidden>A $_GET</p></a>
                <a href="user_pending_ride.php?sort=month">Monthly<p hidden>A $_GET</p></a>
                <a href="user_pending_ride.php?sort=year">Yearly<p hidden>A $_GET</p></a>
                <a href="user_pending_ride.php?sort=all">Show All<p hidden>A $_GET</p></a>
            </div>
        </div>
        <table id="LocationTable" class="ridetable">
            <tr>
                <th>User Id</th>
                <th>PickUp Location</th>
                <th>Drop Location</th>
                <th>Total Distance</th>
                <th>Luggage</th>
                <th>Ride Date</th>
                <th>Total_fare</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php if (isset($sql)) {
                foreach ($sql as $key) { ?>
                    <tr>
                        <td id="td" hidden><?php echo $key['ride_id'] ?></td>
                        <td id="td"><?php echo $key['user_id'] ?></td>
                        <td id="td"><?php echo $key['pickup'] ?></td>
                        <td id="td"><?php echo $key['droplocation'] ?></td>
                        <td id="td"><?php echo $key['total_distance'] ?></td>
                        <td id="td"><?php echo $key['luggage'] ?></td>
                        <td id="td"><?php echo $key['ride_date'] ?></td>
                        <td id="td"><?php echo $key['total_fare'] ?></td>
                        <td id="td"><?php if ($key['status'] == '1') {
                                        echo "pending";
                                    } ?></td>
                        <td id="td"><a href="user_pending_ride.php?canid=<?php echo $key['ride_id'] ?>">Cancelled</a></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <?php require 'Admin/footer.php' ?>
    <script src="../script.js"></script>
</body>