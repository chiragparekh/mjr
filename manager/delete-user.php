<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: all-user.php");
    else
    {
        $id=$_GET['q'];        
        include_once("includes/connection.php");
        $con=new MySQL();        
        mysql_query("delete from tbl_user where type like 'user' and id=".$id);
        $con->CloseConnection();
        header("location: all-user.php");
    }
?>