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
$error = array();
$conn->connect('localhost', 'root', '', 'CabBooking');
$db = new Ride();
$db->connect('localhost', 'root', '', 'CabBooking');
if (isset($_SESSION['userdata']) && ($_SESSION['userdata']['is_admin'] == 'user')) {
    $username = $_SESSION['userdata']['username'];
    $user = $_SESSION['userdata']['user_id'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=Admin/login.php");
}
$sql = $conn->current_user($user);
$expense = $db->user_revenue($user);

if (isset($_REQUEST['update'])) {
    $user_id = $_REQUEST['user_id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];

    if (!empty($mobile)) // phone number is not empty
    {
        if (!preg_match('/^\d{10}$/', $mobile)) // phone number is valid
        {
            echo "<script>alert('Enter valid Mobile Number')</script>";
            $error = array('input' => 'password', 'msg' => 'Enter Valid Mobile Number');
        }
    }
    // Name number is not empty
    if (!empty($name)) {
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            echo "<script>alert('Enter valid name ')</script>";
            $error = array('input' => 'password', 'msg' => 'Enter Valid Username');
        }
    }
    if (sizeof($error) == 0) {

        $sql = $conn->setuser($user_id, $username, $name, $mobile);
        if ($sql) {
            header("Location:user_account.php");
        }
    }
}
?>

<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="errordiv">
            <?php if (sizeof($error) > 0) : ?>
                <ul>
                    <?php foreach ($error as $value) : ?>
                        <li><?php echo $error['msg'];
                            break ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div id="AdminWelcomeQuote">
            <h1>User Details</h1>
        </div>
        <div class="table1">
            <?php foreach ($sql as $key) { ?>
                <form action="" method="post" class="formid">
                    <p>
                        <label for="">UserName :</label> <?php echo $key['username']; ?>
                    </p>
                    <p>
                        <label for="">Name :</label> <?php echo $key['name']; ?>
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
                    <p>
                        <input type="button" class="btn1" name="update" value="Edit" id="edit" class="editbtn" />
                    </p>
                </form>
            <?php } ?>
        </div>

        <div class="table2">
            <?php foreach ($sql as $key) { ?>
                <form action="" method="post" class="formid">
                    <p>
                        <input type="hidden" name="user_id" value="<?php echo $key['user_id'] ?>" />
                    </p>
                    <p>
                        <label for="">UserName :</label>
                        <input type="text" name="username" readonly value="<?php echo $key['username'] ?>" />
                    </p>
                    <p>
                        <label for="">Name :</label>
                        <input type="text" name="name" value="<?php echo $key['name'] ?>" />
                    </p>
                    <p>
                        <label for="">Mobile(10-Digits) :</label>
                        <input type="text" name="mobile" value="<?php echo $key['mobile'] ?>" />
                    </p>
                    <p>
                        <label for="">Email: <?php echo $key['email'] ?></label>
                    </p>
                    <p>
                        <input type="submit" class="btn1" name="update" value="Update" id="update" />
                    </p>
                </form>
            <?php } ?>
        </div>
    </div>
    <?php require 'Admin/footer.php' ?>
    <script src="script.js"></script>
</body>