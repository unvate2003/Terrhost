<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
//if(isset($_SESSION['username'])){



//if(isset($_COOKIE['idkhach']) && isset($_COOKIE['pass'])){
    setcookie("idkhach", "$username", time() - (86400 * 10000), "/");
    setcookie("pass", "$password", time() - (86400 * 10000), "/");
    //setcookie("idkhach", "");
    //setcookie("pass", "");
//}

session_unset();
session_destroy();



unset($_SESSION['username']);



header("Location: /");
//}