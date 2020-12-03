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
$sql = $db->pending_ride();

if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['is_admin'] == 'admin'))) {
    $user = $_SESSION['userdata']['username'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=login.php");
}

if (isset($_GET['Confirm_id'])) {
    $ride_id = $_GET['Confirm_id'];
    echo $ride_id;
    echo $db->confirm($ride_id);
    header("Refresh:0;url=pending_ride.php");
}
if (isset($_REQUEST['canid'])) {
    $ride_id = $_REQUEST['canid'];
    echo $db->cancelled($ride_id);
    header("Refresh:0;url=pending_ride.php");
}
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
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
                        <td><a id="blocked" href="pending_ride.php?<?php if ($key['status'] == '1') {
                                                                        echo "Confirm";
                                                                    }
                                                                    ?>_id=<?php echo $key['ride_id'] ?>">
                                <?php if ($key['status'] == '1') {
                                    echo "Confirm";
                                }
                                ?><p hidden>A $_GET</p>
                            </a>

                            <a href="pending_ride.php?canid=<?php echo $key['ride_id'] ?>">Cancelled</a></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <?php require 'footer.php' ?>
    <script src="../script.js"></script>
</body>