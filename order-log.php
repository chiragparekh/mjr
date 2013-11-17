<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order History :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript">
<!--//---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function()
{
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
	$("#firstpane p.menu_head").click(function()
    {
		$(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(left.png)"});
	});
	//slides the element with class "menu_body" when mouse is over the paragraph
	$("#secondpane p.menu_head").mouseover(function()
    {
	     $(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
         $(this).siblings().css({backgroundImage:"url(left.png)"});
	});
});
</script>


</head>
<body>
<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php'; ?>
<!--cart-->   
<div class="right-content">
    <div class="pro-name">
    <h1>Order / Inquiry History</h1>
	<div class="content">
        <table cellpadding="5" border="1" rules="all" style="margin:10px auto">
            <tr class="heading">
                <th style="width:130px">Product Name</th>
                <th>Weight</th>
                <th>Quantity</th>
                <th style="width:200px">Description</th>
                <th style="width: 70px;">Image</th>
            </tr>
            <?php
                for($i=1;$i<=9;$i++)
                {
            ?>
            <tr>
                <td>Product Name <?php echo $i; ?></td>
                <td>Weight <?php echo $i; ?></td>
                <td>Quantity <?php echo $i; ?></td>
                <td>Description <?php echo $i; ?></td>
                <td>Image <?php echo $i; ?></td>
            </tr>
            <?php
                }
            ?>
            <tr>
                        <td colspan="5">
                           <div align="center" style="text-align: center;">                     
                                <input value="Export to Excel" type="submit" name="btnConfirm" id="btnConfirm" />                        
                            </div> 
                        </td>
                    </tr>
        </table>
    </div>
    </div>
</div>
<!--endo-of-cart-->
<?php include_once 'includes/footer.php'; ?>
</body>
</html>
