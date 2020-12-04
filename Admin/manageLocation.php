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

    if (preg_match('/^[a-zA-Z]+[a-zA-Z0-9-_]+$/', $locname)) {
        $db->setLocation($user_id, $locname, $distance, $avail);
    } else {
        echo "<script>alert('Enter valid Location')</script>";
    }
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
if (isset($_REQUEST['delid'])) {
    $id = $_REQUEST['delid'];
    echo $db->deleteloc($id);
    header("Refresh:0;url=manageLocation.php");
}
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Locations</h1>
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
                            <td><input type="text" name="distance" pattern="[0-9]+" value="<?php echo $key['distance'] ?>" /></td>
                            <td>
                                <select name="available">
                                    <option value="<?php if ($key['is_available'] == '1') {
                                                        echo '1';
                                                    } else {
                                                        echo '0';
                                                    } ?>" selected="<?php if ($key['is_available'] == '1') {
                                                                        echo 'Available';
                                                                    } else {
                                                                        echo 'Not Available';
                                                                    } ?>"><?php if ($key['is_available'] == '1') {
                                                                                echo 'Available';
                                                                            } else {
                                                                                echo 'Not Available';
                                                                            } ?></option>
                                    <option value="<?php if ($key['is_available'] == '1') {
                                                        echo '0';
                                                    } else {
                                                        echo '1';
                                                    } ?>"><?php if ($key['is_available'] == '1') {
                                                                echo 'Not Available';
                                                            } else {
                                                                echo 'Available';
                                                            } ?></option>
                                </select>
                            </td>
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
                                <a  onClick="javascript: return confirm('Please confirm deletion');" href="manageLocation.php?delid=<?php echo $key['id'] ?>">Delete</a></td>
                        </form>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <?php require 'footer.php' ?>
    <script src="../script.js"></script>
</body>