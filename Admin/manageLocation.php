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
$sql=$db->getData();
?>
<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Location</h1>
        </div>
    </div>
    <table id="AdminTable">
        <tr>
            <th>ID</th>
            <th>Location</th>
            <th>Distance</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
        <?php 
        while ($row =mysqli_fetch_assoc($sql)) { ?>
        <tr>
            <td><input type="text" value="<?php echo $row['user_id'] ?>"/></td>
            <td><input type="text" value="<?php echo $row['location'] ?>"/></td>
            <td><input type="text" value="<?php echo $row['user_id'] ?>"/></td>
            <td><input type="text" value="<?php echo $row['user_id'] ?>"/></td>
            <td><a href="manageLocation.php?user_id=<?php echo $row['user_id']?>">Update</a></td>
            <td><a href="manageLocation.php?delid=<?php echo $row['user_id']?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <script src="../script.js"></script>
</body>
