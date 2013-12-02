<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//code for thumbnails in product for a category selected
include_once 'includes/connection.php';
$con = new MySQL();
$start = $_POST["start"];
$operation = $_POST["operation"];
$pro_id = $_POST["pro_id"];
$total_display = 4;

if ($operation == "next") {
    $start = $start + 4;
} else if ($operation == "previous") {
    $start = $start - 4;
} else if ($operation == "update-image") {
    $start = 0;
}
if ($start < 0) {
    echo "0";
    return;
}
$q = "select p.id as p_id,p.image_path as path,sc.name as sc_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where sub_category_id in ( select sub_category_id from tbl_product where id=" . $pro_id . ") and p.id not in (" . $pro_id . ") order by p.id desc limit " . $start . "," . $total_display;
$result = mysql_query($q);
if (mysql_num_rows($result) > 0) {
    ?>    
    <!--<a href="#"><div class="left-arrow"></div></a>-->
    <input type="hidden" name="start_paging" value="<?php echo $start ?>" id="start_paging" />                    
    <input type="button" onclick="javascript:showNextImages(<?php echo $pro_id ?>, 'previous')"  value="" class="left-arrow" style="border:0"/>
    <?php
    while ($r = mysql_fetch_array($result)) {
        ?>
                            <!--<div class="scroll-image-first"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>
                            <div class="scroll-image"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>
                            <div class="scroll-image"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>
                            <div class="scroll-image"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>-->
        <a href="javascript:showProductData(<?php echo $r["p_id"] ?>)"><div class="scroll-image"><img src="manager/uploads/thumbs/<?php echo $r["sc_name"] ?>/<?php echo $r["path"] ?>" width="140" height="140" alt="" /></div></a>
        <?php
    }
    ?>
    <input type="button" onclick="javascript:showNextImages(<?php echo $pro_id ?>, 'next')"  value="" class="right-arrow" style="border:0"/>
    <!--<a href="#"><div class="right-arrow"></div></a>-->    
    <?php
} else {
    echo "0";
}
?>

