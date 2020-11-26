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
            
            $insert = 'INSERT INTO '.$table.'('.$queryFields.') VALUES ("'.$queryValues.'")';

            if (mysqli_query($this->conn, $insert)) {
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
    public function login($username,$password,$roles) 
    {
        $is_block=1;
        $sql ='SELECT * FROM userTable WHERE 
        `username`="'.$username.'" AND 
        `password`="'.$password.'" AND is_admin="'.$roles.'" AND is_block="'.$is_block.'"';
        $result = $this->conn->query($sql);
        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["userdata"]=array('username' => $row['username'],'user_id'=> $row['user_id']);
                if ($row['is_admin']=='admin') {
                    $rtn = "Login Success";
                    header("Refresh:0; url=Admindashboard.php");
                } elseif ($row['is_admin']=='user') {
                    $rtn = "Login Success";
                    header("Refresh:0; url=../index.php");
                } else {
                    $rtn = "Login Failed";
                }
                return $rtn;
            }
        }
    }
    public function signup_request() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_block`= '0' AND `is_admin`!='admin'");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
    public function approved($user_id) 
    {
        $result=mysqli_query($this->conn, "UPDATE userTable SET `is_block`='1' WHERE `user_id`='".$user_id."'");
        return "SuccessFully Approved";
    }
    public function show_approved() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_block`='1' ");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
    public function reject($user_id) 
    {
        $result=mysqli_query($this->conn, "DELETE FROM userTable  WHERE `user_id`='".$user_id."'");
        return "Rejected SuccessFully";
    }
    public function blocked($user_id) 
    {
        $result=mysqli_query($this->conn, "UPDATE userTable SET `is_block`='1' WHERE `user_id`='".$user_id."'");
        return "Blocked SuccessFully";
    }
    public function unblocked($user_id) 
    {
        $result=mysqli_query($this->conn, "UPDATE userTable SET `is_block`='0' WHERE `user_id`='".$user_id."'");
        return "UnBlocked SuccessFully";
    }
    public function getData()  
    {
        $result=mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_admin`!='admin' ");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
}
class LocationTable extends DB 
{
    public function location_getData()  
    {
        $result=mysqli_query($this->conn, "SELECT * FROM LocationTable ");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
    public function setLocation($user_id, $locname, $distance, $avail) 
    {
        $result=mysqli_query($this->conn, "UPDATE LocationTable SET `name`='$locname',`distance`='$distance',`is_available`='$avail' WHERE `id`='".$user_id."'");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    } 
}
class Ride extends DB 
{

    public function pending_ride() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '1'");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
    public function completed_ride() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '2'");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
    public function All_ride() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM rideTable");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
    public function cancelled_ride() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM rideTable WHERE `status`= '0'");
        if (mysqli_num_rows($result)>0) {
            return $result;
        }
    }
    public function confirm($ride_id) 
    {
        $result=mysqli_query($this->conn, "UPDATE rideTable SET `status`='2' WHERE `ride_id`='".$ride_id."'");
        return "Confirm SuccessFully";
    }
    public function cancelled($ride_id) 
    {
        $result=mysqli_query($this->conn, "UPDATE rideTable SET `status`='0' WHERE `ride_id`='".$ride_id."'");
        return "Cancelled Approved";
    }
}
