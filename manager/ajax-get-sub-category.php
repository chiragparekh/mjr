<option selected="" value="-1">- - Select Sub Category - -</option>
<?php
include_once("includes/connection.php");
$con=new MySQL();
if( $_REQUEST['id'] )
{
   $q="select id,name from tbl_sub_category where category_id=".$_REQUEST['id'];
   $rs=mysql_query($q);
   while($r=mysql_fetch_array($rs)){
    ?>
        <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
    <?php
   }
      
}
    $con->CloseConnection();
?>  