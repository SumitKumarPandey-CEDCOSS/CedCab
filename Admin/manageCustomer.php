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
$db = new User();
$db->connect('localhost', 'root', '', 'CabBooking');
if (isset($_GET['blocked_id'])) {
    $user_id = $_GET['blocked_id'];
    echo $user_id;
    echo $db->blocked($user_id);
    header("Refresh:0;url=manageCustomer.php");
}
if (isset($_GET['unblocked_id'])) {
    $user_id = $_GET['unblocked_id'];
    echo $db->unblocked($user_id);
    header("Refresh:0;url=manageCustomer.php");
}
if (isset($_REQUEST['delid'])) {
    $user_id = $_REQUEST['delid'];
    echo $db->reject($user_id);
    header("Refresh:0;url=manageCustomer.php");
}
?>
<?php if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'user_id';
}
$sql = $db->getData($sort);
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>All Users</h1>
        </div>
        <div class="dropdown sort">
            <button class="dropbtn sortbtn">Sort</button>
            <div class="dropdown-content sortcontent">
                <a href="manageCustomer.php?sort=username">Name<p hidden>A $_GET</p></a>
                <a href="manageCustomer.php?sort=date">Date<p hidden>A $_GET</p></a>
                <a href="manageCustomer.php?sort=is_block">Blocked wise<p hidden>A $_GET</p></a>
            </div>
        </div>
        <table id="AdminTable">
            <tr>
                <th>User_ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Date of Signup</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php if (isset($sql)) {
                foreach ($sql as $key) { ?>
                    <tr>
                        <td><?php echo $key['user_id'] ?></td>
                        <td><?php echo $key['username'] ?></td>
                        <td><?php echo $key['email'] ?></td>
                        <td><?php echo $key['mobile'] ?></td>
                        <td><?php echo $key['date'] ?></td>
                        <td><?php if ($key['is_block'] == '1') {
                                echo "Unblocked";
                            } else {
                                echo "Blocked";
                            } ?></td>
                        <td><a id="blocked" href="manageCustomer.php?<?php if ($key['is_block'] == '0') {
                                                                            echo "blocked";
                                                                        } else {
                                                                            echo "unblocked";
                                                                        }
                                                                        ?>_id=<?php echo $key['user_id'] ?>">
                                <?php if ($key['is_block'] == '0') {
                                    echo "Unblock";
                                } else {
                                    echo "blocked";
                                }
                                ?><p hidden>A $_GET</p>
                            </a>

                            <a href="manageCustomer.php?delid=<?php echo $key['user_id'] ?>">Delete</a></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <?php require 'footer.php' ?>
    <script src="../script.js"></script>
</body>