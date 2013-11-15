<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Product</title>

<?php include_once "includes/common-css-js.php";?>

<style type="text/css">
    #productgal{
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
                <h5>Product</h5>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-product.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
            include_once("includes/checksession.php");
            if(isset($_GET['btnDelete']))
            {
                $ids=$_GET['checkRow'];
                if(count($ids)>0)
                {
                      include_once("includes/connection.php");         
                      $qid="";
                      foreach($ids as $id) 
                      {
             	        $qid.=$id.",";
                      }
                      $qid=substr($qid,0,strlen($qid)-1);
                      $con=new MySQL();
                      
                      $rs=mysql_query("select p.image_path as image_path,sc.name as subcat_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id in(".$qid.")");
                        while($r=mysql_fetch_array($rs))
                        {
                            unlink("uploads/original/".$r['subcat_name']."/".$r['image_path']);
                            unlink("uploads/thumbs/".$r['subcat_name']."/".$r['image_path']);
                        }
                      
                      
                     
                      if(mysql_query("delete from tbl_product where id in(".$qid.")"))
                      {
        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected product deleted successfully.</p>
                        </div>
        <?php
                        echo "<script type=\"text/javascript\">location.href='product.php';</script>";
                      }
                      else
                      {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to delete selected product. Please try again.</p>
                        </div>
        <?php  
                      }
                      $con->CloseConnection();
                }
                else
                {
        ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one product.</p>
                    </div>
        <?php
                }
          }
        ?>
        <form id="frmProd" name="frmProd" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
        <br />
        <select id="lstCategory" name="lstCategory" onchange="javascript:document.forms[0].submit();">
           <option selected="" value="-1">- - Select Category - -</option>
           <?php
                include_once "includes/connection.php";
                $con=new MySQL();
                $rs=mysql_query("select id,name from tbl_category");
                $s="";
                if(mysql_num_rows($rs)>0)
                {
                    while($r=mysql_fetch_array($rs))
                    {
                        if((isset($_GET['lstCategory']) && $_GET['lstCategory']!="-1" && $r['id']==$_GET['lstCategory']))
                            $s="selected=\"\"";
                        else
                            $s="";
           ?>
                        <option <?php echo $s;?> value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
           <?php
                    }
                }
                $con->CloseConnection();
           ?>
        </select>
        <div style="float:left;margin-left: 10px;">&nbsp;</div>
        <select name="lstSubCategory" id="lstSubCategory">
            <option selected="" value="-1">- - Select Sub Category - -</option>
           <?php
                include_once "includes/connection.php";
                $con=new MySQL();
                $rs=mysql_query("select id,name from tbl_sub_category where category_id=".$_GET['lstCategory']);
                $s="";
                if(mysql_num_rows($rs)>0)
                {
                    while($r=mysql_fetch_array($rs))
                    {
                        if((isset($_GET['lstSubCategory']) && $_GET['lstSubCategory']!="-1" && $r['id']==$_GET['lstSubCategory']))
                            $s="selected=\"\"";
                        else
                            $s="";
           ?>
                        <option <?php echo $s;?> value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
           <?php
                    }
                }
                $con->CloseConnection();
           ?>
        </select>
        <div style="float: left;margin: 0px;margin-left:10px" class="formSubmit">
            <input class="greenB" type="submit" value="Filter" />
        </div>      
        <div class="clear"></div>
        <br />
        <div class="widget" style="margin-top:5px;">
            <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck" /></span><h6>Product</h6></div>
            
            <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                <thead>
                    <tr>
                        <td><img alt="" src="images/icons/tableArrows.png" /></td>
                        <td class="sortCol">Product Name</td>
                        <td class="sortCol">Sub Category Name</td>
                        <td class="sortCol">Weight</td>
                        <td class="sortCol">Description</td>
                        <td style="width: 10%;">Image</td>
                        <td style="width: 11%;">Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div style="float: left;" class="formSubmit">
                                <input onclick="javascript: return confirm('Do you really want to delete selected product?');" name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        include_once "includes/connection.php";
                        $con=new MySQL();
                        $q="";
                        $found=false;
                        $numRows=0;
                        $rs=null;
                        $all=false;
                        $subCatId=-1;
                        if(isset($_GET['lstSubCategory']) && $_GET['lstSubCategory']!="-1")
                        {
                            $all=false;
                            $subCatId=$_GET['lstSubCategory'];
                            //$rs=mysql_query("select count(id) from tbl_product where sub_category_id=".$subCatId."");
                            //$r=mysql_fetch_array($rs);
                            //$numRows=intval($r[0]); 
                            //if($numRows>0)
                            //{
                                $found=true;
                                $q="select p.id as id,p.name as name,p.weight as weight,p.description as description,p.image_path as image_path,sc.name as sub_category from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where sub_category_id=".$subCatId." order by id";
                            //}
                        }
                        else
                        {
                            $all=true;
                            //$rs=mysql_query("select count(id) from tbl_product");
                            //$r=mysql_fetch_array($rs);
                            //$numRows=intval($r[0]); 
                            //if($numRows>0)
                            //{
                                $found=true;
                                $q="select p.id as id,p.name as name,p.weight as weight,p.description as description,p.image_path as image_path,sc.name as sub_category from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id order by id";
                            //}
                        }
                        
                       	$tbl_name="tbl_product";
                    	$adjacents = 3;
                        if($all)
                    	   $query = "SELECT COUNT(*) as num FROM $tbl_name";
                        else
                            $query = "SELECT COUNT(*) as num FROM $tbl_name where sub_category_id=".$subCatId;
                    	$total_pages = mysql_fetch_array(mysql_query($query));
                        $totalcount=$total_pages;
                    	$total_pages = $total_pages['num'];
                    	
                    	$targetpage = "product.php";
                    	$limit = 10;							//how many items to show per page
                    	$page = isset($_GET['page'])?$_GET['page']:null;
                    	if($page) 
                    		$start = ($page - 1) * $limit; 			//first item to display on this page
                    	else
                    		$start = 0;
                            
                        $sql=$q." LIMIT $start, $limit";    
                    	$result = mysql_query($sql);
                    	
                    	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
                    	$prev = $page - 1;							//previous page is page - 1
                    	$next = $page + 1;							//next page is page + 1
                    	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
                    	$lpm1 = $lastpage - 1;						//last page minus 1
                    	
                    	$pagination = "";
                    	if($lastpage > 1)
                    	{	
                    		$pagination .= "<div style=\"margin-top:0px\" class=\"pagination\"><ul class=\"pages\">";
                    		if ($page > 1)         
                                $pagination.= "<li class=\"prev\"><a href=\"$targetpage?page=$prev&lstSubCategory=$subCatId\">Previous</a></li>";
                    		else
                                $pagination.= "<li class=\"prev fg-button ui-button ui-state-disabled\">Previous</li>";
                                	
                    		//pages	
                    		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
                    		{	
                    			for ($counter = 1; $counter <= $lastpage; $counter++)
                    			{
                    				if ($counter == $page)                
                                        $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    				else
                                        $pagination.= "<li><a href=\"$targetpage?page=$counter&lstSubCategory=$subCatId\">$counter</a></li>";					
                    			}
                    		}
                    		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
                    		{
                    			//close to beginning; only hide later pages
                    			if($page < 1 + ($adjacents * 2))		
                    			{
                    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    				{
                    					if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    					else
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter&lstSubCategory=$subCatId\">$counter</a></li>";					
                    				}
                    				$pagination.= "...";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lpm1&lstSubCategory=$subCatId\">$lpm1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lastpage&lstSubCategory=$subCatId\">$lastpage</a></li>";		
                    			}
                    			//in middle; hide some front and some back
                    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    			{
                    				$pagination.= "<li><a href=\"$targetpage?page=1&lstSubCategory=$subCatId\">1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=2&lstSubCategory=$subCatId\">2</a></li>";
                    				$pagination.= "...";
                    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    				{
                    					if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    					else
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter&lstSubCategory=$subCatId\">$counter</a></li>";					
                    				}
                    				$pagination.= "...";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lpm1&lstSubCategory=$subCatId\">$lpm1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=$lastpage&lstSubCategory=$subCatId\">$lastpage</a></li>";		
                    			}
                    			//close to end; only hide early pages
                    			else
                    			{
                    				$pagination.= "<li><a href=\"$targetpage?page=1&lstSubCategory=$subCatId\">1</a></li>";
                    				$pagination.= "<li><a href=\"$targetpage?page=2&lstSubCategory=$subCatId\">2</a></li>";                
                    				$pagination.= "...";
                    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    				{
                    					if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                    					else
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter&lstSubCategory=$subCatId\">$counter</a></li>";					
                    				}
                    			}
                    		}
                    		
                    		//next button
                    		if ($page < $counter - 1) 
                                $pagination.= "<li class=\"next\"><a href=\"$targetpage?page=$next&lstSubCategory=$subCatId\">Next</a></li>";
                    		else
                                $pagination.= "<li class=\"next fg-button ui-button ui-state-disabled\">Next</li>";
                    		$pagination.= "</ul></div>\n";
                        }	
                        //if($found)
                        //{      
                            if(mysql_num_rows($result)>0){
                        		while($r = mysql_fetch_array($result))
                                {
                   	  ?>
                            <tr>
                                <td>
                                    <input value="<?php echo $r['id'] ?>" type="checkbox" name="checkRow[]" id="checkRow<?php echo $r['id'] ?>" id="titleCheck2" />
                                </td>
                                <td align="left"><?php echo $r["name"]; ?></td>
                                <td align="left"><?php echo $r["sub_category"]; ?></td>
                                <td align="left"><?php echo $r["weight"]; ?></td>
                                <td align="left"><?php echo $r["description"]; ?></td>
                                <td align="center">
                                    <a rel="lightbox" title="" href="uploads/original/<?php echo $r["sub_category"]."/".$r["image_path"]; ?>">
                                        <img style="height: 60px;width: 60px;border:2px solid #cecece" alt="" src="uploads/thumbs/<?php echo $r["sub_category"]."/".$r["image_path"]; ?>" />
                                    </a>
                                </td>                    
                                <td class="actBtns">
                                    <a class="tipS" title="Update(weight manually)" href="update-product.php?q=<?php echo $r["id"];?>">
                                        <img style="height: 12px;width: 12px" alt="" src="images/icons/edit.png" />
                                    </a>
                                    &nbsp;&nbsp;
                                    <a class="tipS" title="Update(weight from image)" href="update-product-image-weight.php?q=<?php echo $r["id"];?>">
                                        <img style="height: 12px;width: 12px" alt="" src="images/icons/edit.png" />
                                    </a>
                                    &nbsp;&nbsp;
                                    <a onclick="javascript: return confirm('Do you really want to delete this product?');" class="tipS" title="Remove" href="delete-product.php?q=<?php echo $r["id"];?>">
                                        <img style="height: 12px;width: 12px" alt="" src="images/icons/remove.png" />
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            }
                        //}
                        else
                        {
                    ?>
                            <tr>
                                <td colspan="7">
                                    <div style="margin-top: 0px;" class="nNote nInformation hideit">
                                        <p><strong>INFORMATION: </strong>No product found.</p>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                        $con->CloseConnection();
                    ?>        
                </tbody>
            </table>
            <div>
                <?php echo $pagination;?>
            </div>
            </form>
        </div>
    
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>