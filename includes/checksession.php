<?php
    session_start();
    if(!isset($_SESSION['userid']))
        header("location: login.php?auth=false");
    /*else if(isset($_SESSION['id']))
        header("location:index.php");*/
?>