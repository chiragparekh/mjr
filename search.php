<?php include_once './includes/checksession.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Search Product :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
<!--        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>-->
        <script src="js/jquery.1.7.1.min.js"></script>



        <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/pagination-style.css" media="screen"/>

        <script type="text/javascript" src="js/jquery.blockUI.js"></script>

        <script type="text/javascript">
            $(document).ready(function()
            {
                $("#advance-search").addClass("active");

                $("#lstCategory").change(function() {
                    //$("#loader").html('Please wait...');
                    block();
                    $.get('ajax-get-sub-category.php?cid=' + $(this).val(), function(data) {
                        $("#lstSubCategory").html(data);
                        //$('#loader').html('');
                        $.unblockUI();
                    });
                    searchProduct(1);
                });
                //searchProduct(1);
            });
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
            function searchProduct(page_id)
            {
                //$("#loader").html('Please wait...');
                block();
                var formData = {minweight: $("#sliderMinWeight").val(), maxweight: $("#sliderMaxWeight").val(), category: $("#lstCategory").val(), subcategory: $("#lstSubCategory").val(), page: page_id};
                $.ajax({
                    url: "ajax-get-search-product.php",
                    type: "POST",
                    data: formData,
                    success: function(data, textStatus, jqXHR)
                    {

                        $("#search-result").html(data);
                        //$('#loader').html('');
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
        </script>
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <div class="category">
            <br /> 
            <div style="color: #DBCBFF;font-weight: bold;text-align: center;font-size:18px;text-decoration: none;"> Search Product</div>		
            <div style="margin: 10px 10px;">
                <?php
                include_once './includes/connection.php';
                $con = new MySQL();
                $maxweight = 1;
                $rs = mysql_query("select round(max(weight)) as max_weight from tbl_product");
                while ($row = mysql_fetch_array($rs)) {
                    $maxweight = intval($row['max_weight']);
                    $con->CloseConnection();
                }
                ?>
                <table style="color: #DBCBFF;" cellpadding="8">
                    <tr>
                        <td class="pull-right">Min. Weight</td>
                        <td>
                            <div id="min-weight-val" style="background-color: white;color:black;padding: 4px"></div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="noUiSlider" id="sliderMinWeight"></div>
                            <script src="js/jquery.nouislider.min.js" type="text/javascript"></script>
                            <link href="css/jquery.nouislider.min.css" rel="stylesheet" />
                            <script>

                                // Wait until the document is ready.
                                $(function() {

                                    // Run noUiSlider
                                    $('.noUiSlider').noUiSlider({
                                        range: [1, <?php echo $maxweight; ?>],
                                        start: 1,
                                        step: 1,
                                        handles: 1,
                                        behaviour: 'tap',
                                        set: function() {
                                            searchProduct(1);
                                        },
                                        slide: function() {
                                            $("#min-weight-val").html($("#sliderMinWeight").val());
                                            $("#max-weight-val").html($("#sliderMaxWeight").val());
                                        }
                                    });
                                    $("#sliderMaxWeight").val(<?php echo $maxweight?>);
                                    $("#min-weight-val").html($("#sliderMinWeight").val());
                                    $("#max-weight-val").html($("#sliderMaxWeight").val());
                                    searchProduct(1);
                                });

                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td class="pull-right">Max. Weight</td>
                        <td>
                            <div id="max-weight-val" style="background-color: white;color:black;padding: 4px"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="noUiSlider" id="sliderMaxWeight"></div>

                        </td>
                    </tr>
                    <tr>
                        <td class="pull-right">
                            Category
                        </td>
                        <td>
                            <select name="lstCategory" id="lstCategory">
                                <option value="-1">- - Select - -</option>
                                <?php
                                include_once './includes/connection.php';
                                $con = new MySQL();
                                $rs = mysql_query("select id,name from tbl_category");
                                while ($row = mysql_fetch_array($rs)) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                }
                                $con->CloseConnection();
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="pull-right">
                            Sub Category
                        </td>
                        <td>
                            <select onchange="searchProduct(1)" name="lstSubCategory" id="lstSubCategory">
                                <option value="-1">- - Select - -</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center">
                            <div id="loader"></div>
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

            <div id="search-result">
            </div>
        </div>
        <!--right-content-->
        <!--endo-of-search-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
