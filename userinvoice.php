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
require 'Admin/config.php';
require 'userheader.php';
$db = new Ride();

if (isset($_REQUEST['ride_id'])) {
    $ride_id = $_REQUEST['ride_id'];
    $user_id = $_REQUEST['user_id'];
    $username = $_SESSION['userdata']['username'];
}
$db->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->confirm_ride($ride_id);
$expense = $db->user_revenue($user_id);
?>

<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>Invoice</h1>
        </div>
        <div class="table1">
            <?php foreach ($sql as $key) { ?>
                <form action="" method="post" class="formid">
                    <p>
                        <label for="">UserName :</label> <?php echo $username ?>
                    </p>
                    <p>
                        <label for="">Pickup Location :</label><?php echo $key['pickup']; ?>
                    </p>
                    <p>
                        <label for="">Drop Location :</label><?php echo $key['droplocation']; ?>
                    </p>
                    <p>
                        <label for="">Date:</label><?php echo $key['ride_date']; ?>
                    </p>
                    <p>
                        <label for="">Total Distance:</label><?php echo $key['total_distance']; ?>&nbsp;Km
                    </p>
                    <p>
                        <label for="">Luggage:</label><?php echo $key['luggage']; ?>&nbsp;Kg
                    </p>
                    <p>
                        <label for="">Total Fare:</label><?php echo $key['total_fare']; ?>&nbsp;$
                    </p>
                    <p>
                        <input type="button" class="btn1" onclick="window.print()" name="update" value="Print" id="edit" class="editbtn" />
                    </p>
                </form>
            <?php } ?>
        </div>
    </div>
    <?php require 'Admin/footer.php' ?>
</body>