<?php include_once './includes/checksession.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Latest Arrivals :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>
        <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />

        <!--<link rel="stylesheet" type="text/css" href="css/pagination-style.css" media="screen"/>
        <script type="text/javascript" src="js/jquery.blockUI.js"></script>-->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#latest-arrivals").addClass("active");
                $("a[rel=example_group]").fancybox({
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'titlePosition': 'over',
                    'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
                        return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                    }
                });
                //getLatestProduct(1);
            });
            /*function getLatestProduct(page_id)
             {
             block();
             var formData = {page: page_id};
             $.ajax({
             url: "ajax-get-latest-arrival.php",
             type: "POST",
             data: formData,
             success: function(data, textStatus, jqXHR)
             {
             $("#latest-product-result").html(data);
             $.unblockUI();
             $("a[rel=example_group]").fancybox({
             'transitionIn': 'fade',
             'transitionOut': 'fade',
             'titlePosition': 'over',
             'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
             return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
             }
             });
             
             },
             error: function(jqXHR, textStatus, errorThrown)
             {
             $.unblockUI();
             }
             });
             }
             function block()
             {
             $.blockUI({css: {
             border: '4px solid gray',
             padding: '0px',
             backgroundColor: '#fff',
             '-webkit-border-radius': '5px',
             '-moz-border-radius': '5px',
             'border-radius': '5px',
             opacity: .8,
             color: '#000'
             }});
             }
             */
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
                    $(this).css({backgroundImage: "url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage: "url(left.png)"});
                });
                //slides the element with class "menu_body" when mouse is over the paragraph
                $("#secondpane p.menu_head").mouseover(function()
                {
                    $(this).css({backgroundImage: "url(down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage: "url(left.png)"});
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
                <h1>Latest Arrivals</h1>    
            </div>

            <?php
            include_once './includes/connection.php';
            $con = new MySQL();
            $rs = mysql_query("select p.id as pid,p.name as name, p.image_path as image_path,p.weight as weight,p.description as description,sc.name as sub_cat_name from  tbl_sub_category sc inner join tbl_product p on p.sub_category_id=sc.id order by p.id desc limit 10");
            if (mysql_num_rows($rs) > 0) {
                while ($row = mysql_fetch_array($rs)) {
                    ?>
                    <div class="product">
                        <div class="pro-heading"><h1 class="center"><?php echo ucwords($row['name']); ?></h1></div>
                        <div class="pro-img"><a rel="example_group" href="manager/uploads/original/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" width="180" height="160" alt="" /></a></div>
                        <div class="pro-detail"><a href="product.php?q=<?php echo $row["pid"] ?>">View Detail</a><a href="product.php">Add to Cart</a></div>
                    </div>
                    <?php
                }
            }
            else{
                ?>
            <div class="clear"></div>
            <div class="custom-message">No Product Found</div>
            <?php
            }
            $con->CloseConnection();
            ?>

        </div>
        <!--right-content-->
        <?php include_once 'includes/footer.php'; ?>

    </body>
</html>
