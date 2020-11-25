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
require 'config.php';
$db = new DB();
$db->connect('localhost', 'root', '', 'CabBooking');
$sql=$db->select();
if (isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    echo $db->approved($user_id);
    header("Refresh:0;url=Admindashboard.php");
} 
if (isset($_REQUEST['delid'])) {
    $user_id = $_REQUEST['delid'];
    echo $db->reject($user_id);
    header("Refresh:0;url=Admindashboard.php");
}
if (!empty(isset($_SESSION['userdata']))) {
    $user = $_SESSION['userdata']['username'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=login.php");
}
require 'header.php';
?>
<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Welcome &nbsp;<?php if (!empty($user)) { echo $user; } ?></h1>
        </div>
    </div>
    <table id="AdminTable">
        <tr>
            <th>User_ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php 
        while ($row =mysqli_fetch_assoc($sql)) { ?>
        <tr>
            <td><?php echo $row['user_id'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><a href="Admindashboard.php?user_id=<?php echo $row['user_id']?>">Approved</a>
               <a href="Admindashboard.php?delid=<?php echo $row['user_id']?>">Reject</a></td>
        </tr>
        <?php } ?>
    </table>
    <script src="../script.js"></script>
</body>