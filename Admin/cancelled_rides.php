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
require 'header.php';
require 'config.php';
$db = new Ride();
$db->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->cancelled_ride();

if (isset($_REQUEST['delid'])) {
    $user_id = $_REQUEST['delid'];
    echo $db->reject($user_id);
    header("Refresh:0;url=cancelled_ride.php");
}
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Cancelled Rides</h1>
        </div>
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
                    <td id="td"><?php if ($key['status'] == '0') {
                                    echo "Cancelled Rides";
                                } ?></td>
                    <td><a href="cancelled_ride.php?delid=<?php echo $key['ride_id'] ?>">Delete</a></td>
                </tr>
        <?php }
        } ?>
    </table>
    <script src="../script.js"></script>
</body>