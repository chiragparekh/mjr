<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: category.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/functions.php");
        include_once("includes/connection.php");
        $con=new MySQL();
        $trs=mysql_query("select name from tbl_sub_category where id =".$id);
        while($tr=mysql_fetch_array($trs)){
            deleteDirectory("uploads/thumbs/".$tr[0]);
            deleteDirectory("uploads/original/".$tr[0]);                             
        }
        mysql_query("delete from tbl_sub_category where id=".$id);
        $con->CloseConnection();
        header("location: category.php");
    }
?>