<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Product :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
<!--//---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function()
{
    $("#advance-search").addClass("active");
            /*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
});
</script>


</head>
<body>
<?php include_once 'includes/header.php'; ?>
    <div class="category">
        <br /> 
        <div style="color: #DBCBFF;font-weight: bold;text-align: center;font-size:22px;text-decoration: underline;"> Search Product</div>		
      <div style="margin: 10px 10px;">
        <table style="color: #DBCBFF;" cellpadding="5">
            <tr>
                <td class="pull-right">
                    Min. Weight
                </td>
                <td>
                    <select name="lstMinWeight">
                        <option value="-1">- - Select - -</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pull-right">
                    Max. Weight
                </td>
                <td>
                    <select name="lstMaxWeight">
                        <option value="-1">- - Select - -</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pull-right">
                    Category
                </td>
                <td>
                    <select name="lstCategory">
                        <option value="-1">- - Select - -</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pull-right">
                    Sub Category
                </td>
                <td>
                    <select name="lstSubCategory">
                        <option value="-1">- - Select - -</option>
                    </select>
                </td>
            </tr>
        </table>  
      </div>  <!--Code for menu ends here-->
    </div>
<!--search-->   
<!--right-content-->
    <div class="right-content">
        <div class="pro-name">
            <h1>Search Result</h1>
    	</div>
        <?php
            for($i=1;$i<=9;$i++)
            {
        ?>
        <div class="product">
        	<div class="pro-heading"><h1 class="center">Product <?php echo $i;?></h1></div>
            <div class="pro-img"><a rel="example_group" href="./images/large1.jpg" title=""><img src="images/tumb1.jpg" width="180" height="160" alt="" /></a></div>
            <div class="pro-detail"><a href="product.php">View Detail</a><a href="product.php">Add to Cart</a></div>
        </div>
        <?php
            }
        ?>
    </div>
    <!--right-content-->
<!--endo-of-search-->
<?php include_once 'includes/footer.php'; ?>
</body>
</html>
