<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_POST['btnSubmit']))
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
             if(isset($_POST['btnSubmit']))
             {
                if(trim($_POST['txtSubCatName'])!="" && $_POST['lstCategory']!="-1")
                {
                    include_once "includes/connection.php";
                    $con=new MySQL();
                    $id=$_POST['hidId'];
                    $cid=$_POST['lstCategory'];
                    $name=$_POST['txtSubCatName'];
                    $oldname = mysql_fetch_array(mysql_query("select name from tbl_sub_category  where id=".$id));
                    $oldname = $oldname[0];
                    if($oldname!=$name){
                        if(is_dir("uploads/thumbs/".$oldname)){                        
                            rename("uploads/thumbs/".$oldname,"uploads/thumbs/".$name);
                        }
                        if(is_dir("uploads/original/".$oldname)){
                            rename("uploads/original/".$oldname,"uploads/original/".$name);    
                        }
                        
                    }
                    if(mysql_query("update tbl_sub_category set category_id=".$cid.",name='".$name."' where id=".$id))
                    {
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Sub category updated successfully.</p>
                         </div>
        <?php
                    }
                    else
                    {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to update sub category. Please try again.</p>
                        </div>
        <?php
                    }
                    $con->CloseConnection();
                }
             }
        ?>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>