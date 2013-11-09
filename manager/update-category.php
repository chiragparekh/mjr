<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_GET['q']))
        header("location: category.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Update Sub Category</title>

<?php include_once "includes/common-css-js.php";?>

<style type="text/css">
    #mediagal{
    background-position: 0 -86px;
    border-top: 1px solid #657D92;}
</style>

</head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Update Sub Category</h5>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="category.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-category.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
             if(isset($_GET['q']))
             {
                include_once "includes/connection.php";
                $con=new MySQL();
                $id=$_GET['q'];
                $rs=mysql_query("select * from tbl_sub_category where id=".$id);
                $r=mysql_fetch_array($rs);
                $con->CloseConnection();
             }
        ?>
        <form  style="margin-top:20px;" action="update-category2.php" method="post" class="form" id="validate">
            <input type="hidden" name="hidId" value="<?php echo $r['id']; ?>" />
        	<fieldset>
                <div class="widget" style="margin-top: 20px;">
                    <div class="title">
                        <img class="titleIcon" alt="" src="images/icons/dark/pencil.png" />
                        <h6>Update Sub Category</h6>
                    </div>
                    <div class="formRow">
                        <label>Parent Category:&nbsp;<span class="req">*</span></label>
                        <select name="lstCategory" >
                           <option selected="" value="-1">- - Select - -</option>
                           <?php
                                include_once "includes/connection.php";
                                $con=new MySQL();
                                $rs2=mysql_query("select id,name from tbl_category");
                                if(mysql_num_rows($rs2)>0)
                                {
                                    while($r2=mysql_fetch_array($rs2))
                                    {
                           ?>
                                        <option <?php echo ($r['category_id']==$r2['id'])?"selected=\"\"":""; ?> value="<?php echo $r2['id']; ?>"><?php echo $r2['name']; ?></option>
                           <?php
                                    }
                                }
                                $con->CloseConnection();
                           ?>
                        </select>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Sub Category Name:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="text" value="<?php echo $r['name']; ?>" id="txtSubCatName" name="txtSubCatName" class="validate[required]" />
                        </div><div class="clear"></div>
                    </div>
                    <div class="formSubmit">
                        <input type="submit" class="redB" name="btnSubmit" value="save" />
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>