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

if (isset($_SESSION['userdata']) && ($_SESSION['userdata']['is_admin'] == 'user')) {
    $username = $_SESSION['userdata']['username'];
    $user = $_SESSION['userdata']['user_id'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=Admin/login.php");
}
$db->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->complete_ride($user);

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'ASC';
}
$sql = $db->completed_order($user, $sort);
?>

<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Completed Rides</h1>
        </div>
        <div class="dropdown sort">
            <button class="dropbtn sortbtn">Sort By</button>
            <div class="dropdown-content sortcontent">
            <a href="completed_rides.php?sort=ride_date">Ride Date<p hidden>A $_GET</p></a>
                <a href="completed_rides.php?sort=ASC">ASC by Fare<p hidden>A $_GET</p></a>
                <a href="completed_rides.php?sort=DESC">DESC by Fare<p hidden>A $_GET</p></a>
            </div>
        </div>
        <div class="dropdown sort" style="margin-left:-5px;">
            <button class="dropbtn sortbtn">Filter By</button>
            <div class="dropdown-content sortcontent">
                <a href="completed_rides.php?sort=week">WEEK<p hidden>A $_GET</p></a>
                <a href="completed_rides.php?sort=month">Monthly<p hidden>A $_GET</p></a>
                <a href="completed_rides.php?sort=year">Yearly<p hidden>A $_GET</p></a>
                <a href="completed_rides.php?sort=all">Show All<p hidden>A $_GET</p></a>
            </div>
        </div>
        <table id="LocationTable" class="ridetable">
            <tr>
                <th>ID</th>
                <th>PickUp Location</th>
                <th>Drop Location</th>
                <th>Total Distance</th>
                <th>Luggage</th>
                <th>Ride Date</th>
                <th>Total_fare</th>
                <th>Status</th>
                <th>Invoice</th>
            </tr>
            <?php if (isset($sql)) {
                foreach ($sql as $key) { ?>
                    <tr>
                        <td id="td"><?php echo $key['user_id'] ?></td>
                        <td id="td" hidden><?php echo $key['ride_id'] ?></td>
                        <td id="td"><?php echo $key['pickup'] ?></td>
                        <td id="td"><?php echo $key['droplocation'] ?></td>
                        <td id="td"><?php echo $key['total_distance'] ?></td>
                        <td id="td"><?php echo $key['luggage'] ?></td>
                        <td id="td"><?php echo $key['ride_date'] ?></td>
                        <td id="td"><?php echo $key['total_fare'] ?></td>
                        <td id="td"><?php if ($key['status'] == '2') {
                                        echo "completed";
                                    } ?></td>
                        <td><a href="userinvoice.php?ride_id=<?php echo $key['ride_id'] ?>&amp;user_id=<?php echo $key['user_id'] ?>">Invoice</a></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <?php require 'Admin/footer.php' ?>
</body>