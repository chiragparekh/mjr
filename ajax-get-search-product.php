<?php
include_once './includes/connection.php';
$con = new MySQL();
$minWeight = $_POST["minweight"];
$maxWeight = $_POST["maxweight"];
$category = $_POST["category"];
$subcategory = $_POST["subcategory"];

$q = "select p.name as name,p.description as description,p.id as pid,p.weight as weight,p.image_path as image_path,sc.name as sub_cat_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where 1=1";
if($minWeight!="-1")
    $q.=" and p.weight >= $minWeight";
if($maxWeight!="-1")
    $q.=" and p.weight <= $maxWeight";
if($category!="-1")
    $q.=" and sc.category_id = $category";
if($subcategory !="-1")
    $q.=" and p.sub_category_id = $subcategory";
$rs = mysql_query($q);
while ($row = mysql_fetch_array($rs)) {
    ?>
    <div class="product">
        <div class="pro-heading"><h1 class="center"><?php echo ucwords($row['name']); ?></h1></div>
        <div class="pro-img"><a rel="example_group" href="manager/uploads/original/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" width="180" height="160" alt="" /></a></div>
        <div class="pro-detail"><a href="product.php?q=<?php echo $row["pid"] ?>">View Detail</a><a href="product.php">Add to Cart</a></div>
    </div>
    <?php
}
$con->CloseConnection();
?>