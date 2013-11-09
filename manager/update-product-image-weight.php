<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_GET['q']))
        header("location: product.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Update Product</title>

<?php include_once "includes/common-css-js.php";?>

<style type="text/css">
    #photogal{
    background-position: 0 -86px;
    border-top: 1px solid #657D92;}
    #loading
    {
        display: none;
    }
</style>
<script type="text/javascript">
    
    function checkWeight(value){        
        if(value=="image"){
            $("#txtWeight").hide();
        }else if(value=="manual"){
            $("#txtWeight").show();            
        }
    }
    function getSubCat(cid)
    {
        $("#loading").show();
        $.ajax({
            type: "post",
            url: "ajax-get-sub-category.php",
            data: "id="+cid,
            complete: function(){$("#loading").hide();},
            success: function(data) {
                $("#lstSubCategory").html(data);
            }
        });
    }
</script>

</head>

<body>



<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Update Product</h5>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="product.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-product.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        
        <?php
             if(isset($_GET['q']))
             {
                include_once "includes/connection.php";
                $con=new MySQL();
                $id=$_GET['q'];
                                                
                $rs=mysql_query("select p.id as id,p.name as name,p.weight as weight,p.description as description,p.image_path as image_path,sc.category_id as catid,sc.id as subcatid,sc.name as subcat_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id=".$id);
                $r=mysql_fetch_array($rs);
                $con->CloseConnection();
             }
        ?>
        <form enctype="multipart/form-data" style="margin-top:20px;" action="update-product-image-weight2.php" method="post" class="form" id="validate">
            <input type="hidden" name="hidId" value="<?php echo $r['id']; ?>" />
        	<fieldset>
                <div class="widget" style="margin-top: 20px;">
                    <div class="title">
                        <img class="titleIcon" alt="" src="images/icons/dark/pencil.png" />
                        <h6>Update Product</h6>
                    </div>
                    <div class="formRow">
                        <label>Select Category:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                        <select name="lstCategory" onchange="javascript:getSubCat(this.value)">
                           <option selected="" value="-1">- - Select Category - -</option>
                           <?php
                                include_once "includes/connection.php";
                                $con=new MySQL();
                                $rs2=mysql_query("select id,name from tbl_category");
                                if(mysql_num_rows($rs)>0)
                                {
                                        while($r2=mysql_fetch_array($rs2))
                                        {
                                            if(isset($_GET['q']))
                                            {
                                                if($r['catid']==$r2['id'])
                                                    $s="selected=\"\"";
                                                else
                                                    $s="";
                                            }
                                            else // if(!(isset($_GET['q'])))
                                            {
                                                if($_REQUEST['lstCategory']==$r2['id'])
                                                    $s="selected=\"\"";
                                                else
                                                    $s="";
                                            }
                               ?>
                                            <option <?php echo $s;?> value="<?php echo $r2['id']; ?>"><?php echo $r2['name']; ?></option>
                               <?php
                                        }
                                }
                                $con->CloseConnection();
                           ?>
                        </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Select Sub Category:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                        <select name="lstSubCategory" id="lstSubCategory">
                           <option selected="" value="-1">- - Select Sub Category - -</option>
                           <?php
                                include_once "includes/connection.php";
                                $con=new MySQL();
                                $rs2=mysql_query("select id,name from tbl_sub_category where category_id=".$r['catid']);
                                if(mysql_num_rows($rs2)>0)
                                {
                                    while($r2=mysql_fetch_array($rs2))
                                        {
                                            if($r['subcatid']==$r2['id'])
                                                $s="selected=\"\"";
                                            else
                                                $s="";
                               ?>
                                            <option <?php echo $s;?> value="<?php echo $r2['id']; ?>"><?php echo $r2['name']; ?></option>
                               <?php
                                        }
                                }
                                $con->CloseConnection();
                           ?>
                        </select>
                        <div id="loading">
                            &nbsp;&nbsp;
                            <img alt="" src="images/loaders/loader.gif" />
                            &nbsp;<strong>Please wait...</strong>
                        </div>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Product Name:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">                       
                            <input type="text" value="<?php echo $r['name'];?>" id="txtProductName" name="txtProductName" class="validate[required]" />
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Weight:</label>
                        <div class="formRight">                       
                            <input type="text" readonly="" value="<?php echo $r['weight'];?>" id="txtWeight" name="txtWeight" class="validate[required]" />
                            <span style="color: red;">Weight is readonly and can only be changed from selected image.</span>
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Description:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <textarea name="txtDesc" id="txtDesc" class="validate[required]" ><?php echo $r['description'];?></textarea>
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <input type="hidden" name="hidSubcatName" value="<?php echo $r['subcat_name']; ?>" />
                        <input type="hidden" name="hidPath" value="<?php echo $r['image_path']; ?>" />
                        <a style="float: left;margin-right: 20px;" rel="lightbox" title="" href="uploads/original/<?php echo $r['subcat_name']."/".$r["image_path"]; ?>">
                            <img style="height: 60px;width: 60px;border:2px solid #cecece" alt="" src="uploads/thumbs/<?php echo $r['subcat_name']."/".$r["image_path"]; ?>" />
                        </a>
                        <label>Change Image:</label>
                        <div class="formRight">
                            <input type="file" id="fileImage" name="fileImage" /><br />
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