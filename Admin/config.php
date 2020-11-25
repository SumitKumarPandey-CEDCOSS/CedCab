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
    public function select() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM userTable WHERE `is_block`= '0' AND `is_admin`!='admin'");
        return $result;
    }
    public function approved($user_id) 
    {
        $result=mysqli_query($this->conn, "UPDATE userTable SET `is_block`='1' WHERE `user_id`='".$user_id."'");
        return "SuccessFully Approved";
    }
    public function reject($user_id) 
    {
        $result=mysqli_query($this->conn, "DELETE FROM userTable  WHERE `user_id`='".$user_id."'");
        return "Rejected SuccessFully";
    }
}
class User extends DB
{
    public function login($username,$password,$roles) 
    {
        $sql ='SELECT * FROM userTable WHERE 
        `username`="'.$username.'" AND 
        `password`="'.$password.'" AND is_admin="'.$roles.'"';
        $result = $this->conn->query($sql);
        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["userdata"]=array('username' => $row['username']);
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
}
// class location extends DB 
// {
//     public function userlocation($location,$distance)
//     {
//         $sql
//     }
// }
?>  