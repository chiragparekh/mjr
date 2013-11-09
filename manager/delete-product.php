<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: product.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/connection.php");
        $con=new MySQL();
        $rs=mysql_query("select p.image_path as image_path,sc.name as subcat_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id=".$id);
        
        while($r=mysql_fetch_array($rs))
        {
            unlink("uploads/original/".$r['subcat_name']."/".$r['image_path']);
            unlink("uploads/thumbs/".$r['subcat_name']."/".$r['image_path']);
        }
        mysql_query("delete from tbl_product where id=".$id);
        $con->CloseConnection();
        header("location: product.php");
    }
?>