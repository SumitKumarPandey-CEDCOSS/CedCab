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
$db = new DB();
$db->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->getData();
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

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>All Users</h1>
        </div>
    </div>
    <table id="AdminTable">
        <tr>
            <th>User_ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($sql)) { ?>
            <tr>
                <td><?php echo $row['user_id'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['mobile'] ?></td>
                <td><?php if ($row['is_block'] == '1') {
                        echo "Unblocked";
                    } else {
                        echo "Blocked";
                    } ?></td>
                <td><a id="blocked" href="manageCustomer.php?<?php if ($row['is_block'] == '0') {
                                                                    echo "blocked";
                                                                } else {
                                                                    echo "unblocked";
                                                                }
                                                                ?>_id=<?php echo $row['user_id'] ?>">
                        <?php if ($row['is_block'] == '0') {
                                                                echo "Unblock";
                                                                } else {
                                                                    echo "blocked";
                                                                }
                                                                ?><p hidden>A $_GET</p>
                    </a>

                    <a href="manageCustomer.php?delid=<?php echo $row['user_id'] ?>">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
    <script src="../script.js"></script>
</body>