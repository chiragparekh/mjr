<?php include_once './includes/checksession.php'; ?>
<?php
if (!isset($_GET['q']) || $_GET['q'] == "") {
    header("location:category.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gallery :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
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
                getSubCategory(1,<?php echo $_GET['q'] ?>);
            });
            function getSubCategory(page_id, cat_id)
            {
                block();
                var formData = {page: page_id, cat_id: cat_id};
                $.ajax({
                    url: "ajax-get-sub-category-for-content.php",
                    type: "POST",
                    data: formData,
                    success: function(data, textStatus, jqXHR)
                    {
                        $("#sub-cat-result").html(data);
                        $("#sub-cat-result").hide();
                        $("#sub-cat-result").fadeIn('slow');
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
                <?php
                include_once 'includes/connection.php';
                $con = new MySQL();
                $cat_id = $_GET['q'];
                $q = "select name from tbl_category where id=" . $cat_id;
                $result = mysql_query($q);
                $array = mysql_fetch_array($result);
                $name = $array["name"];
                ?>
                <h1><?php echo $name; ?> Categories
                    <div style="float:right"><a href="javascript:history.back(-1);">Back</a></div>
                </h1>
                <?php
                /* $q = "SELECT c.id as 'c_id',c.name as 'c_name' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id group by c_name";
                  $result = mysql_query($q);
                  while ($r = mysql_fetch_array($result)) {
                  if ($r["c_id"] == $cat_id) {
                  ?>
                  <span><a href="sub-category.php?q=<?php echo $r["c_id"]; ?>" style="color:#d8c6ff;font-weight:bold"><?php echo $r["c_name"] ?></a></span>
                  <?php
                  } else {
                  ?>

                  <span><a href="sub-category.php?q=<?php echo $r["c_id"]; ?>"><?php echo $r["c_name"] ?></a></span>
                  <?php
                  }
                  } */
                ?>        
            </div>
            <div id="sub-cat-result"></div>             
        </div>
        <!--right-content-->
        <?php include_once 'includes/footer.php'; ?>

    </body>
</html>
