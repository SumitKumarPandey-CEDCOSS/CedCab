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
$loct = new DB();
$loct->connect('localhost', 'root', '', 'CabBooking');
$error = array();
if (isset($_POST["submit"])) {
    $location = $_POST['location'];
    $distance = $_POST['distance'];
    $fields = array('name', 'distance');
    $values = array($location, $distance);
    $loct->insert($fields, $values, 'LocationTable');
}
?>
<body class="admintop">
    <div class="adminbody">
        <img src="../images/taxi4.jpg" alt="">
    </div>
    <p class="location-logo">Add Locations</p> 
    <div id="admin-location-form">
            <form action="" method="POST">    
                <div id="errordiv">
                    <?php if (sizeof($error)>0) : ?>
                    <ul>
                        <?php foreach ($error as $value) : ?>
                        <li><?php echo $error['msg'] ;break ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif ; ?>
                </div>
                <p class="input">
                    <label for="username">Location:
                        <input type="text" name="location" required></label>
                </p>
                <p class="input">
                    <label for="text">Distance:
                        <input type="text" name="distance" required></label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="ADD">
                </p>
            </form>
        </div>
    </form>
</body>