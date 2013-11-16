 <!--Category-->
    <div class="category"> <img src="images/category-heading.png" width="187" height="40" alt="" />		
      <div id="firstpane" class="menu_list"> <!--Code for menu starts here-->
        <?php
            for($i=1;$i<=5;$i++)
            {
        ?>
		<p class="menu_head"><a href="javascript:void(0)">Category-<?php echo $i;?></a></p>
		<div class="menu_body">
		<a href="gallery.php">Sub Category-<?php echo $i;?></a>
         <a href="gallery.php">Sub Category-<?php echo $i;?></a>
         <a href="gallery.php">Sub Category-<?php echo $i;?></a>	
		</div>
       <?php
            }
       ?>
  </div>  <!--Code for menu ends here-->
    </div>
    <!--Category-->