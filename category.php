<?php include_once './includes/checksession.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Categories :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/pagination-style.css" media="screen"/>
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="js/jquery.blockUI.js"></script>
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
        <script type="text/javascript">
            function block()
            {
                $.blockUI(
                        {
                            css: {
                                border: '2px solid #654E9D',
                                padding: '4px',
                                backgroundColor: '#fff',
                                '-webkit-border-radius': '5px',
                                '-moz-border-radius': '5px',
                                'border-radius': '5px',
                                opacity: .8,
                                color: '#000',
                            },
                            message: "<img alt='Please Wait...' src='images/loader.gif'/>"
                        }
                );
            }
            $(document).ready(function()
            {
                getCategory(1);
            });
            function getCategory(page_id)
            {
                block();
                var formData = {page: page_id};
                $.ajax({
                    url: "ajax-get-category.php",
                    type: "POST",
                    data: formData,
                    success: function(data, textStatus, jqXHR)
                    {
                        $("#category-result").html(data);
                        $("#category-result").hide();
                        $("#category-result").fadeIn('slow');
                        $.unblockUI();
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $.unblockUI();
                    }
                });
            }
        </script>        
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>        
        <!--right-content-->
        <div class="right-content">
            <div class="pro-name">
                <h1>Product Categories</h1>
            </div>
            <div id="category-result"></div>
        </div>
        <!--right-content-->
        <?php include_once 'includes/footer.php'; ?>

    </body>
</html>
