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
$db = new LocationTable();
$conn = new Ride();
$db->connect('localhost', 'root', '', 'CabBooking');
$conn->connect('localhost', 'root', '', 'CabBooking');
if (isset($_REQUEST['update'])) {
    $user_id = $_REQUEST['id'];
    $locname = $_POST['Location_Name'];
    $distance = $_POST['distance'];
    $avail = $_POST['available'];
    echo $locname, $user_id, $distance, $avail;
    echo $db->setLocation($user_id, $locname, $distance, $avail);
}
$sql = $db->location_getData();
if (isset($_GET['blocked_id'])) {
    $user_id = $_GET['blocked_id'];
    echo $user_id;
    echo $conn->blocked_Ride($user_id);
    header("Refresh:0;url=manageLocation.php");
}
if (isset($_GET['unblocked_id'])) {
    $user_id = $_GET['unblocked_id'];
    echo $conn->unblocked_Ride($user_id);
    header("Refresh:0;url=manageLocation.php");
}
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Locations</h1>
        </div>
    </div>
    <table id="LocationTable">
        <tr>
            <th>ID</th>
            <th>Location</th>
            <th>Distance</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
        <?php if (isset($sql)) {
            foreach ($sql as $key) { ?>
                <tr>
                    <form method="POST" action="">
                        <td style="color:white;"><input type="hidden" name="id" value="<?php echo $key['id'] ?>" /><?php echo $key['id'] ?></td>
                        <td><input type="text" name="Location_Name" value="<?php echo $key['name'] ?>" /></td>
                        <td><input type="text" name="distance" value="<?php echo $key['distance'] ?>" /></td>
                        <td><input type="text" name="available" value="<?php echo $key['is_available'] ?>" /></td>
                        <td><a href=""><input type="submit" name="update" style="border:none;" value="Update" id="update" /></a>
                        <a id="blocked" href="manageLocation.php?<?php if ($key['is_block'] == '0') {
                                                                        echo "blocked";
                                                                    } else {
                                                                        echo "unblocked";
                                                                    }
                                                                    ?>_id=<?php echo $key['id'] ?>">
                            <?php if ($key['is_block'] == '0') {
                                echo "Unblock";
                            } else {
                                echo "blocked";
                            }
                            ?><p hidden>A $_GET</p>
                        </a>
                            <a href="manageLocation.php?delid=<?php echo $key['id'] ?>">Delete</a></td>
                    </form>
                </tr>
        <?php }
        } ?>
    </table>
    <script src="../script.js"></script>
</body>