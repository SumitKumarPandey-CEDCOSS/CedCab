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
if (isset($_REQUEST['canid'])) {
    $ride_id = $_REQUEST['canid'];
    echo $db->cancelled($ride_id);
    echo "<script>alert('Ride cancelled SuccessFully')</script>";
    header("Refresh:0;url=user_pending_ride.php");
}
$sql = $db->pending($user);
?>

<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Pending Rides</h1>
        </div>
        <table id="LocationTable" class="ridetable">
            <tr>
                <th>ID</th>
                <th>PickUp Location</th>
                <th>Drop Location</th>
                <th>Total Distance</th>
                <th>Ride Date</th>
                <th>Total_fare</th>
                <th>User Id</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php if (isset($sql)) {
                foreach ($sql as $key) { ?>
                    <tr>
                        <td id="td"><?php echo $key['ride_id'] ?></td>
                        <td id="td"><?php echo $key['pickup'] ?></td>
                        <td id="td"><?php echo $key['droplocation'] ?></td>
                        <td id="td"><?php echo $key['total_distance'] ?></td>
                        <td id="td"><?php echo $key['ride_date'] ?></td>
                        <td id="td"><?php echo $key['total_fare'] ?></td>
                        <td id="td"><?php echo $key['user_id'] ?></td>
                        <td id="td"><?php if ($key['status'] == '1') {
                                        echo "pending";
                                    } ?></td>
                        <td id="td"><a href="user_pending_ride.php?canid=<?php echo $key['ride_id'] ?>">Cancelled</a></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <?php require 'footer.php' ?>
    <script src="../script.js"></script>
</body>