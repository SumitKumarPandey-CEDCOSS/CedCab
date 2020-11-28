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
require 'header.php';
$db = new Ride();
$db->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->confirm_ride();
?>
<body class="admintop">
    <div id="AdminWelcomeQuote">
        <h1>User Invoice</h1>     
    </div>
    <table id="invoice">
        <tr>
            <th>User Id</th>
            <th>Name</th>
            <th>Cab Type</th>
            <th>Total Fare</th>
        </tr>
        <?php foreach ($sql as $key) { ?>
            <tr>
                <td><?php echo $key['user_id'] ?></td>
                <td><?php echo $key['cabType'] ?></td>
                <td><?php echo $key['pickup'] ?></td>
                <td><?php echo $key['total_fare'] ?>$</td>
            </tr>
        <?php } ?>
    </table>
</body>