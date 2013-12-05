<?php //include_once './includes/checksession.php';?>
<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/easySlider1.7.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#slider").easySlider({
				auto: true, 
				continuous: true
				
			});
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
    $("#home").addClass("active");
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
    <!--Slider-->
    <div class="slider">
    <div id="slider">
			<ul>				
				<li><img src="images/01.jpg" alt=" " /></li>
				<li><img src="images/02.jpg" alt=" " /></li>
				<li><<img src="images/03.jpg" alt=" " /></li>
				<li><img src="images/04.jpg" alt=" " /></li>
				<li><img src="images/05.jpg" alt=" " /></li>			
			</ul>
		</div>
    </div>
    <!--Slider-->
<?php include_once 'includes/footer.php'; ?>
</body>
</html>
