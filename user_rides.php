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

if (isset($_SESSION['userdata'])) {
    $user = $_SESSION['userdata']['user_id'];
}
if (isset($_REQUEST['delid'])) {
    $user_id = $_REQUEST['delid'];
    echo $db->delete($user_id);
    header("Refresh:0;url=user_rides.php");
}
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = `ride_date`;
}
$sql = $db->filter_user($user, $sort);
?>
<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>All Rides</h1>
            <div class="dropdown sort">
                <button class="dropbtn sortbtn">Filter By</button>
                <div class="dropdown-content sortcontent">
                    <a href="user_rides.php?sort=week">WEEK<p hidden>A $_GET</p></a>
                    <a href="user_rides.php?sort=month">Monthly<p hidden>A $_GET</p></a>
                    <a href="user_rides.php?sort=year">Yearly<p hidden>A $_GET</p></a>
                </div>
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
                        <td id="td"><?php if ($key['status'] == '2') {
                                        echo "completed";
                                    } elseif ($key['status'] == '1') {
                                        echo "pending";
                                    } else {
                                        echo "cancelled";
                                    } ?></td>
                        <td><a href="user_rides.php?delid=<?php echo $key['ride_id'] ?>">Delete</a></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <?php require 'Admin/footer.php' ?>
    <script src="../script.js"></script>
</body>