<?php
require $_SERVER['DOCUMENT_ROOT']."/core/database.php";
@session_start();
if(empty($_SESSION['username'])){
	header('location: /');
	die();
}
if($setup['coming-soon']=="ON"){
    header('location: /bao-tri');
    die();
} else{
    header('location: /');
    die();
}
?>