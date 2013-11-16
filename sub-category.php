<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gallery :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>
 	
	<script type="text/javascript">
		$(document).ready(function() {
            $("#gallery").addClass("active");
		});
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
    <!--right-content-->
    <div class="right-content">
        <div class="pro-name">
        <h1>Sub Categories of Category</h1>
        <span><a href="sub-category.php">Category 01</a></span>
        <span><a href="sub-category.php">Category 02</a></span>
        <span><a href="sub-category.php">Category 03</a></span>
    	</div>
            <?php
                for($i=1;$i<=9;$i++)
                {
            ?>
            <div class="category-thumb">
            	<div class="pro-heading"><h1 class="center">Sub Category <?php echo $i;?></h1></div>
                <div class="pro-img"><a href="gallery.php?q=<?php echo $i;?>" title=""><img src="images/tumb1.jpg" width="180" height="160" alt="" /></a></div>
            </div>
            <?php
                }
            ?>
    </div>
    <!--right-content-->
<?php include_once 'includes/footer.php'; ?>

</body>
</html>
