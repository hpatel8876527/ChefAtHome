<?php 

session_start();

include("classes/user.php");

if($_GET["logout_user"]){

    session_destroy();
    header("Location: index.php");
    exit;

}