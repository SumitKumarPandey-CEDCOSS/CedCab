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
require 'userheader.php';
require 'Admin/config.php';
$conn = new User();
$conn->connect('localhost', 'root', '', 'CabBooking');
$db = new Ride();
$db->connect('localhost', 'root', '', 'CabBooking');
if (isset($_SESSION['userdata'])) {
    $user = $_SESSION['userdata']['user_id'];
}
$sql= $conn->current_user($user);
$expense = $db->Total_Revenue($user);

if (isset($_REQUEST['update'])) {
    $user_id = $_REQUEST['user_id'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    echo $conn->setuser($user_id, $username, $mobile, $email, $date);
}
?>
<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>User Details</h1>
        </div>
    <div class="table1">
    <?php foreach ($sql as $key) {?>
        <form action="" method="post" class="formid">
            <p>
            <label for="">UserName :</label> <?php echo $key['username']; ?> 
            </p>
            <p>
            <label for="">Mobile :</label><?php echo $key['mobile']; ?> 
            </p>
            <p>
            <label for="">Email:</label><?php echo $key['email']; ?> 
            </p>
            <p>
            <label for="">Date:</label><?php echo $key['date']; ?> 
            </p>
            <?php
                $sum=0; 
                foreach ($expense as $key) {
                 $sum += $key['total_fare'];    
                }?>
            <p>
            <label for="">Total Fare:</label><?php echo $sum; ?> 
            </p>
            <p>
            <input type="button" class="btn1" name="update" value="Edit" id="edit" class="editbtn" />
            </p>
        </form>
        <? } ?>
    </div>

    <div class="table2">
        <?php foreach ($sql as $key) {?>
            <form action="" method="post" class="formid">
                <p>
                <input type="hidden" name="user_id" value="<?php echo $key['user_id'] ?>" />
                </p>
                <p>
                <label for="">UserName :</label>
                <input type="text" name="username" value="<?php echo $key['username'] ?>" /> 
                </p>
                <p>
                <label for="">Mobile :</label>
                <input type="text" name="mobile" value="<?php echo $key['mobile'] ?>" /> 
                </p>
                <p>
                <label for="">Email: <?php echo $key['email'] ?></label>
                </p>
                <p>
                <input type="submit" class="btn1" name="update" value="Update" id="update" />
                </p>
            </form>
            <? } ?>
    </div>
    </div>
    <?php require 'Admin/footer.php'?>
    <script src="script.js"></script>
</body>