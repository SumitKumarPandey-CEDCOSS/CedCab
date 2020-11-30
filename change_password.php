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
?>
<body class="admintop">
    <div class="adminbody">
        <img src="images/taxi4.jpg" alt="">
        <div id="AdminWelcomeQuote">
            <h1>User Details</h1>
        </div>
        <div class="changepassword">
        <?php foreach ($sql as $key) {?>
            <form action="" method="post" class="formid">
                <p>
                <input type="hidden" name="newpassword" value="<?php echo $key['newpassword'] ?>" />
                </p>
                <p>
                <label for="">UserName :</label>
                <input type="text" name="confirmpassword" value="<?php echo $key['confirmpassword'] ?>" /> 
                </p>
                <p>
                <input type="submit" class="btn1" name="update" value="Update" id="update" />
                </p>
            </form>
            <? } ?>
    </div>