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
$sql = $db->show_approved();
?>

<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Approved Users</h1>
        </div>
    </div>
    <table id="AdminTable">
        <tr>
            <th>User_ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
        </tr>
        <?php if (isset($sql)) {
            foreach ($sql as $key) { ?>
                <tr>
                    <td><?php echo $key['user_id'] ?></td>
                    <td><?php echo $key['username'] ?></td>
                    <td><?php echo $key['email'] ?></td>
                    <td><?php echo $key['mobile'] ?></td>
                    <td><?php if ($key['is_block'] == '1') {
                            echo "Approved";
                        } ?>
                </tr>
        <?php }
        } ?>
    </table>
    <script src="../script.js"></script>
</body>