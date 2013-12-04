<!--Category-->
<div class="category"> <img src="images/category-heading.png" width="187" height="40" alt="" />		
    <div id="firstpane" class="menu_list"> <!--Code for menu starts here-->
        <?php
        include_once 'includes/connection.php';
        $con = new MySQL();
        $q_cat = "SELECT c.id as 'c_id',c.name as 'c_name',pro.image_path as 'path',sc.name as 'sub_name' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id group by c_name";
        $result_category = mysql_query($q_cat);
        if (mysql_num_rows($result_category) > 0) {
            while ($rc = mysql_fetch_array($result_category)) {                
                ?>
                <p class="menu_head"><a href="javascript:void(0)"><?php echo ucwords($rc['c_name']); ?></a></p>
                <div class="menu_body">
                    <?php
                    $q_sub_cat = "select sc.id as id,sc.category_id as category_id,sc.name as name from tbl_sub_category sc inner join tbl_product p on sc.id=p.sub_category_id where sc.category_id=" . $rc["c_id"]." group by sc.id";
                    $result_subcat = mysql_query($q_sub_cat);
                    if (mysql_num_rows($result_subcat) > 0) {
                        while ($rsub = mysql_fetch_array($result_subcat)) {
                            ?>
                            <a href="gallery.php?q=<?php echo $rsub["id"] ?>"><?php echo ucwords($rsub["name"]); ?></a>                   
                            <?php
                        }
                    } else {
                        ?>
                        <a href="javascript:void(0)" style="text-decoration: none;color:white"><?php echo "No sub category found."; ?></a>                                           
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="custom-message-sidebar">
                <?php
                echo "No category found.";
                ?>
            </div>
            <?php
        }
        ?>
    </div>  <!--Code for menu ends here-->
</div>
<!--Category-->