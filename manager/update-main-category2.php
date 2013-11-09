<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_POST['btnSubmit']))
        header("location: main-category.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Update Category</title>

<?php include_once "includes/common-css-js.php";?>

<style type="text/css">
    #photogal{
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
                <h5>Update Category</h5>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="main-category.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-main-category.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
             if(isset($_POST['btnSubmit']))
             {
                if(trim($_POST['txtCatName'])!="")
                {
                    include_once "includes/connection.php";
                    $con=new MySQL();
                    $id=$_POST['hidId'];
                    $name=$_POST['txtCatName'];
                    $rs=mysql_query("select id,name from tbl_category where name like '".$name."'");
                    if(mysql_num_rows($rs)>0)
                    {
                        $r=mysql_fetch_array($rs);
                        if($r['name'] == $name)
                        {
        ?>
                        <div class="nNote nWarning hideit">
                            <p><strong>WARNING: </strong>Category with this name already exists. Specify different name.</p>
                        </div>
        <?php
                        }
                        else
                        {
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Category name updated successfully.</p>
                         </div>   
        <?php
                        }
                    }
                    else if(mysql_query("update tbl_category set name='".$name."' where id=".$id))
                    {
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Category name updated successfully.</p>
                         </div>
        <?php
                    }
                    else
                    {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to update category. Please try again.</p>
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