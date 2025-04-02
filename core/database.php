<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
//error_reporting(0);
@session_start();
define("HACKER","Error! Conntact : facebook.com/rin1906");
define("DATABASE", "unvateco_nickvui");
define("USERNAME", "unvateco_nickvui");
define("PASSWORD", "Yy(BpQPg+=~u");
define("LOCALHOST", "localhost");

class NH
{
    private $ketnoi = NULL;
    function connect()
    {
        if (!$this->ketnoi)
        {
            $this->ketnoi = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE) or die ('ERROR CONNECT !');
            mysqli_query($this->ketnoi, "set names 'utf8'");
        }
    }
    
    function dis_connect()
    {
        if ($this->ketnoi)
        {
            mysqli_close($this->ketnoi);
        }
    }
  
      
    function site($data)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `setting` ")->fetch_array();
        return $row[$data];
    }
    
    function getUsers($data)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'")->fetch_array();
        return $row[$data];
    }
    
    function query($sql)
    {
        $this->connect();
        $row = $this->ketnoi->query($sql);
        return $row;
    }
    function cong($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` + '$sotien' WHERE $where ");
        return $row;
    }
    function tru($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` - '$sotien' WHERE $where ");
        return $row;
    }
    
    
    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value)
        {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->ketnoi, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->ketnoi, $sql);
    }
    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value)
        {
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        return mysqli_query($this->ketnoi, $sql);
    }
    function update_value($table, $data, $where, $value1)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where.' LIMIT '.$value1;
        return mysqli_query($this->ketnoi, $sql);
    }
    function remove($table, $where)
    {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->ketnoi, $sql);
    }
    function get_list($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database ');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database 2');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
    function num_rows($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database 2');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
}


$NH = new NH;
$day = date('d',time());
$month = date('m',time());
$year = date('Y',time()); 
$domain = "https:/nickvui.com";
$conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE);
mysqli_set_charset($conn,"UTF8");

if(!isset($_SESSION['username']) AND !isset($_SESSION['password']) ){
    if(isset($_COOKIE['idkhach']) && isset($_COOKIE['pass'])){
        $_SESSION['username'] = $_COOKIE['idkhach'];
        $_SESSION['password'] = $_COOKIE['pass'];
    }
}
/*
if(isset($_SESSION['username'])){
    $_SESSION['username'] = $_COOKIE['idkhach'];
    $username = $_SESSION['username'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'");
}
*/


if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' AND `password` = '".$_SESSION['password']."'"));
    
}else{
    $data = '';
}



/*
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $data = $conn->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'")->fetch_array();
} else {
    $data = '';
}
*/

$setup = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `setting` WHERE id='1'"));

$ip = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['WWW_HTTP_CLIENT_IP']))
{
    $ip = $SERVER['WWW_HTTP_CLIENT_IP'];
} else if
(!empty($_SERVER['WWW_HTTP_X_FORWARDED_FOR'])){
    $ip =
    $_SERVER['WWW_HTTP_X-FORWARDED_FOR'];
}
$browser = $_SERVER['HTTP_USER_AGENT'];

$time=time();
$home='https://'.$_SERVER['HTTP_HOST'];
$homeurl='https://'.$_SERVER['HTTP_HOST'];


$title='';

require_once 'func.php';

?>