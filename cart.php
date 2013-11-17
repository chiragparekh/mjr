<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Cart :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
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
    <h1>Order / Inquiry Cart</h1><div class="clear"></div>
    <div style="float: right;margin-right: 55px;margin-top: 5px;">
        <a style="font-weight: bold;color: #DBCBFF;" href="order-log.php">View Order History</a>
    </div>
	<div class="content">
        <table cellpadding="5" border="1" rules="all" style="margin:10px 10px">
            <tr class="heading">
                <th style="width:130px">Product Name</th>
                <th>Weight</th>
                <th>Quantity</th>
                <th style="width:200px">Description</th>
                <th style="width: 70px;">Image</th>
                <th style="width: 100px;">Edit</th>
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
                <td>Edit | Delete</td>
            </tr>
            <?php
                }
            ?>
            <tr>
                        <td colspan="6">
                           <div align="center" style="text-align: center;">                     
                                <input value="Confirm" type="submit" name="btnConfirm" id="btnConfirm" />
                                <input value="Delete All" type="submit" name="btnClear" id="btnClear" />
                                <input value="Print" onclick="printDiv()" type="button" name="btnPrint" id="btnPrint" />                        
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
