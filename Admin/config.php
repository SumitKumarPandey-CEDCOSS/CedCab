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
session_start();

class DB
{
    public function connect($host, $user, $pass, $dtb)
    {
        $this->serverame = $host;
        $this->username = $user;
        $this->password = $pass;
        $this->dbname   = $dtb;

        return $this->conn = mysqli_connect($host, $user, $pass, $dtb) or die('Could Not Connect.');
    }
    public function insert($fields, $data, $table)
    {
        try {
            $queryFields = implode(",", $fields);

            $queryValues = implode('","', $data);

            $insert = 'INSERT INTO ' . $table . '(' . $queryFields . ') VALUES ("' . $queryValues . '")';

            if (mysqli_query($this->conn, $insert)) {
                unset($_SESSION['bookdata']);
                return true;
            } else {
                die(mysqli_error($this->conn));
            }
        } catch (Exception $ex) {
            echo "Some Exception Occured " . $ex;
        }
    }
}
class User extends DB
{
    public function login($username, $password, $roles)
    {
        $is_block = 1;
        $sql = 'SELECT * FROM userTable WHERE 
        `username`="' . $username . '" AND 
        `password`="' . $password . '" AND is_admin="' . $roles . '" AND is_block="' . $is_block . '"';
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['is_admin'] == 'admin') {
                    $rtn = "Login Success";
                    $_SESSION["userdata"] = array('username' => $row['username'], 'user_id' => $row['user_id'], 'is_admin' => 'admin' );
                    header("Refresh:0; url=Admindashboard.php");
                } elseif ($row['is_admin'] == 'user') {
                    $rtn = "Login Success";
                    $_SESSION["userdata"] = array('username' => $row['username'], 'user_id' => $row['user_id'], 'is_admin' => 'user' );
                    $cookie_name = $row['username'];
                    header("Refresh:0; url=../userdashboard.php");
                } else {
                    $rtn = "Login Failed";
                    unset($_SESSION['bookdata']);
                }
                return $rtn;
            }
        }
    }
    public function signup_request()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_block`= '0' AND `is_admin`!='admin'");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function approved($user_id)
    {
        $result = mysqli_query($this->conn, "UPDATE userTable SET `is_block`='1' WHERE `user_id`='" . $user_id . "'");
        return "SuccessFully Approved";
    }
    public function show_approved()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_block`='1' ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function reject($user_id)
    {
        $result = mysqli_query($this->conn, "DELETE FROM userTable  WHERE `user_id`='" . $user_id . "'");
        return "Rejected SuccessFully";
    }
    public function blocked($user_id)
    {
        $result = mysqli_query($this->conn, "UPDATE userTable SET `is_block`='1' WHERE `user_id`='" . $user_id . "'");
        return "Blocked SuccessFully";
    }
    public function unblocked($user_id)
    {
        $result = mysqli_query($this->conn, "UPDATE userTable SET `is_block`='0' WHERE `user_id`='" . $user_id . "'");
        return "UnBlocked SuccessFully";
    }
    public function getData($sort)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_admin`!='admin' ORDER BY $sort ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function count_user()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_admin`!='admin' ");
        return $result->num_rows;
    }
    public function count_pending_request()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_block`= '0' AND `is_admin`!='admin'");
        return $result->num_rows;
    }
    public function count_blocked()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_block`='0'");
        return $result->num_rows;
    }
    public function current_user($user_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM userTable WHERE `user_id`='$user_id' ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function setuser($user_id, $username, $mobile, $email, $date)
    {
        $result = mysqli_query($this->conn, "UPDATE userTable SET `username`='$username',`mobile`='$mobile',`email`='$email',`date`='$date' WHERE `user_id`='" . $user_id . "'");
        return "SuccessFull Updated";
    }
    public function changepassword($newpassword, $user) {
        $result = mysqli_query($this->conn, "UPDATE userTable SET `password`='$newpassword' WHERE `user_id` = '" .$user. "' ") ;
        return "Password changed SuccessFully";
    }
}
class LocationTable extends DB
{
    public function location_getData()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM LocationTable ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function setLocation($user_id, $locname, $distance, $avail)
    {
        $result = mysqli_query($this->conn, "UPDATE LocationTable SET `name`='$locname',`distance`='$distance',`is_available`='$avail' WHERE `id`='" . $user_id . "'");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function count_location() 
    {
        $result = mysqli_query($this->conn, "SELECT * FROM LocationTable");
        return $result->num_rows;
    }
    public function deleteloc($id)
    {
        $result = mysqli_query($this->conn, "DELETE FROM LocationTable  WHERE `id`='" . $id ."' ");
        return "Deleted SuccessFully";
    }
}
class Ride extends DB
{

    public function pending_ride()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '1'");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function completed_ride()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '2'");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function All_ride($order)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable ORDER BY $order");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function cancelled_ride()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '0'");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function count_ride()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable");
        return $result->num_rows;
    }
    ///count pending_ride
    public function count_pending_ride()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '1'");
        return $result->num_rows;
    }
    public function confirm($ride_id)
    {
        $result = mysqli_query($this->conn, "UPDATE rideTable SET `status`='2' WHERE `ride_id`='" . $ride_id . "'");
        return "Confirm SuccessFully";
    }
    public function count_confirm_ride()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '2'");
        return $result->num_rows;
    }
    public function cancelled($ride_id)
    {
        $result = mysqli_query($this->conn, "UPDATE rideTable SET `status`='0' WHERE `ride_id`='" . $ride_id . "'");
        return "Cancelled Approved";
    }
    public function Total_Revenue()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '2'");
        if (mysqli_num_rows($result)) {
            return $result;
        }
    }
    public function blocked_Ride($user_id)
    {
        $result = mysqli_query($this->conn, "UPDATE LocationTable SET `is_block`='1' WHERE `id`='" . $user_id . "'");
        return "Blocked SuccessFully";
    }
    public function unblocked_Ride($user_id)
    {
        $result = mysqli_query($this->conn, "UPDATE LocationTable SET `is_block`='0' WHERE `id`='" . $user_id . "'");
        return "UnBlocked SuccessFully";
    }
    public function user_completed_ride($user_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '2' AND `user_id`='$user_id '");
        return $result->num_rows;
    }
    public function user_pending_ride($user_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '1' AND `user_id`='$user_id' ");
        return $result->num_rows;
    }
    public function user_revenue($user_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '2' AND `user_id`='$user_id' ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function complete_ride($user_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '2' AND `user_id`='$user_id '");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function pending($user_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '1' AND `user_id`='$user_id' ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function ride_user($user_id, $sort)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `user_id`='$user_id' ORDER BY $sort ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function confirm_ride($ride_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `ride_id`='$ride_id' AND `status`='2' ");
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function filter_user($user_id, $sort)
    {
        if ($sort == 'day') {
            $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `user_id`='$user_id' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY) ");
        } elseif ($sort == 'month') {
            $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `user_id`='$user_id' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH) ");
        } elseif ($sort == 'year') {
            $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `user_id`='$user_id' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR) ");
        } else {
            $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `user_id`='$user_id' ");
        }
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function user_ride($user_id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `user_id`='$user_id' ");
        return $result->num_rows;
    }
    public function delete($ride_id)
    {
        $result = mysqli_query($this->conn, "DELETE FROM rideTable  WHERE `ride_id`='" . $ride_id ."'");
        return "Deleted SuccessFully";
    }
}
