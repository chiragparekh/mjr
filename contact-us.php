<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Us :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #address
    {
        float:left;
        margin-left: 20px;
    }
    #feedback
    {
        float: right;
        margin-right: 20px;
    }
</style>
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
    $("#contact-us").addClass("active");
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
<!--contact-us-->   
<div class="right-content">
    <div class="pro-name">
    <h1>Contact Us</h1>
	<div class="content">
        <br />
        <div id="address">
            <table>
                <caption class="tbl-caption">Address</caption>
                <tr>
                    <td>
                        12-Panna Manek Complex,<br />
                        Opp. Ashapura Temple, Palace Road,<br />
                        Rajkot<br /> 
                        Ph:0281-2220075<br />
                        email: <a href="mailto:manojranpara@ymail.com">manojranpara@ymail.com</a><br />
                        website: <a href="http://www.mjrjewels.com">www.mjrjewels.com</a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="feedback">
            <table cellpadding="5">
                <caption class="tbl-caption">Feedback</caption>
                <tr>
                <td class="pull-right">
                    Name 
                </td>
                <td>
                    <input type="text" name="name" />
                </td>
            </tr>
            <tr>
                <td class="pull-right">
                    Email 
                </td>
                <td>
                    <input type="text" name="email" />
                </td>
            </tr>
            <tr>
                <td class="pull-right">
                    Mobile
                </td>
                <td>
                    <input type="text" name="mobile" />
                </td>
            </tr>   
            <tr>
                <td class="pull-right valign-top">
                    Description 
                </td>
                <td>
                    <textarea name="description" ></textarea>
                </td>
            </tr>
            <tr>
                        <td class="pull-right valign-top">
                                <span >Enter Image Text</span>
                        </td>
                        <td>
                            <input name="captcha" type="text" style="margin-bottom:  5px;" /><br />
                            <img src="captcha.php" />
                        </td>      
            </tr>
            <tr>
                        <td colspan="2" align="center">
                                <input type="submit" name="btnSubmit" value="Send" />
                        </td>                              
            </tr>            
            </table>
        </div>
        <div class="clear">
            
        </div>
    </div>
    </div>
</div>
<!--endo-of-contact-us-->
<?php include_once 'includes/footer.php'; ?>
</body>
</html>
