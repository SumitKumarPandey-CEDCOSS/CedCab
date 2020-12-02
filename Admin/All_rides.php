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

// Delete the Record From the database
if (isset($_REQUEST['delid'])) {
    $user_id = $_REQUEST['delid'];
    echo $db->delete($user_id);
    header("Refresh:0;url=All_rides.php");
}
?>
<!-- Sorting the data -->
<?php if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'ride_id';
}
$sql = $db->All_ride($sort);
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>All Rides</h1>
            <div class="dropdown sort">
                <button class="dropbtn sortbtn">Sort By</button>
                <div class="dropdown-content sortcontent">
                    <a href="All_rides.php?sort=pickup">Name<p hidden>A $_GET</p></a>
                    <a href="All_rides.php?sort=ride_date">Date<p hidden>A $_GET</p></a>
                    <a href="All_rides.php?sort=total_fare">Fare<p hidden>A $_GET</p></a>
                </div>
            </div>
        </div>
        <!-- Representing All Ride data in Table Form -->
        <table id="LocationTable" class="ridetable">
            <tr>
                <th>ID</th>
                <th>PickUp Location</th>
                <th>Drop Location</th>
                <th>Total Distance</th>
                <th>Luggage</th>
                <th>Ride Date</th>
                <th>Total_fare</th>
                <th>User Id</th>
                <th>Status</th>
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
                        <td><a href="All_rides.php?delid=<?php echo $key['ride_id'] ?>">Delete</a></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <!-- Footer -->
    <?php require 'footer.php' ?>
    <!-- Javascript -->
    <script src="../script.js"></script>
</body>