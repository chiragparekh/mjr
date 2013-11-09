<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_POST['btnSubmit']))
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
</style>

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
             if(isset($_POST['btnSubmit']))
             {
                include_once "includes/connection.php";
                include_once "includes/image.php";
                    $con=new MySQL();
                    $id=$_POST['hidId'];
                    $path=$_POST['hidPath'];
                    $oldSubcatname=$_POST['hidSubcatName'];
                    $subCatId=$_POST['lstSubCategory'];
                    $name=$_POST['txtProductName'];
                    
                    $desc=$_POST['txtDesc'];
                    
                    
                    $rs=mysql_query("select name from tbl_sub_category where id=".$subCatId);
                    $r=mysql_fetch_array($rs);
                    $subcatname=$r['name'];
                    
                    if(!is_dir("uploads"))
                	{
                        mkdir("uploads");
                	}
                    if(!is_dir("uploads/thumbs"))
                	{
                        mkdir("uploads/thumbs");
                	}
                    if(!is_dir("uploads/thumbs/".$subcatname))
                	{
                        mkdir("uploads/thumbs/".$subcatname);
                	}
                    if(!is_dir("uploads/original"))
                	{
                        mkdir("uploads/original");
                	}                
                    if(!is_dir("uploads/original/".$subcatname))
                	{
                        mkdir("uploads/original/".$subcatname);
                	}
                    
                    $img_name=$_FILES['fileImage']['name'];
                    $img_tmp_name=$_FILES['fileImage']['tmp_name'];
                    $img_type=$_FILES['fileImage']['type'];
                    
                    $weight=substr($img_name,0,strrpos($img_name,"."));
                    
                    date_default_timezone_set('Asia/Calcutta');
                    
                    $prod_img_path=str_replace(' ','',$r['name']).'_'.str_replace(' ','',$weight).'_'.date('dmYHis');
                    $ext="";
                    switch($img_type)
                    {
                        case "image/gif":
                            $ext=".gif";
                            break;
                        case "image/bmp":
                            $ext=".bmp";
                            break;
                        case "image/jpeg":
                            $ext=".jpg";
                            break;
                        case "image/png":
                            $ext=".png";
                            break;
                    }
                    
                    $p="uploads/original/".$subcatname."/".$prod_img_path.$ext;
                    
                    if($subCatId!="-1" && trim($name)!="" && trim($weight)!="" && trim($desc)!="")
                    {
                        $q="";
                        if($img_name!="" && ($img_type=="image/gif" or $img_type=="image/bmp" or $img_type=="image/jpeg" or $img_type=="image/png"))
                        {
                            $q="update tbl_product set sub_category_id=".$subCatId.", name='".$name."', weight=".$weight.", image_path='".$prod_img_path.$ext."', description='".$desc."' where id=".$id;
                        }
                        else
                        {   
                            $e=explode('.',$path);
                            $ext= end($e);
                            $ext='.'.$ext;
                            $newpath=str_replace(' ','',$r['name']).'_'.str_replace(' ','',$weight).'_'.date('dmYHis');
                            $q="update tbl_product set sub_category_id=".$subCatId.", name='".$name."', weight=".$weight.", image_path='".$newpath.$ext."', description='".$desc."' where id=".$id;
                        }
                        if(mysql_query($q))
                        {
                            if($img_name!="" && ($img_type=="image/gif" or $img_type=="image/bmp" or $img_type=="image/jpeg" or $img_type=="image/png"))
                            {
                                unlink("uploads/original/".$oldSubcatname."/".$path);
                                unlink("uploads/thumbs/".$oldSubcatname."/".$path);
                                move_uploaded_file($img_tmp_name,"uploads/original/".$subcatname."/".$prod_img_path.$ext);
                                $image = new SimpleImage();
                                $image->load($p);
                                $image->resize(150,150);
                                $image->save("uploads/thumbs/".$subcatname."/".$prod_img_path.$ext);
                                $q="update tbl_product set sub_category_id=".$subCatId.", name='".$name."', weight=".$weight.", image_path='".$prod_img_path.$ext."', description='".$desc."' where id=".$id;
                            }
                            else
                            {
                                $e=explode('.',$path);
                                $ext= end($e);
                                $ext='.'.$ext;
                                $newpath=str_replace(' ','',$r['name']).'_'.str_replace(' ','',$weight).'_'.date('dmYHis');
                                
                                copy("uploads/original/".$oldSubcatname."/".$path,"uploads/original/".$subcatname."/".$newpath.$ext);
                                unlink("uploads/original/".$oldSubcatname."/".$path);
                                copy("uploads/thumbs/".$oldSubcatname."/".$path,"uploads/thumbs/".$subcatname."/".$newpath.$ext);
                                unlink("uploads/thumbs/".$oldSubcatname."/".$path);
                                
                                $q="update tbl_product set sub_category_id=".$subCatId.", name='".$name."', weight=".$weight.", image_path='".$newpath.$ext."', description='".$desc."' where id=".$id;
                            }
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Product updated successfully.</p>
                         </div>
        <?php
                        }
                        else
                        {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to update product. Please try again.</p>
                        </div>
        <?php
                        }
                    }
                    $con->CloseConnection();
            }
        ?>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>