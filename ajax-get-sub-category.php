<?php

include_once './includes/connection.php';
$con = new MySQL();
$cid = mysql_real_escape_string($_GET['cid']);
$query = mysql_query("SELECT id,name FROM tbl_sub_category WHERE category_id =" . $cid);
echo '<option value="-1">- - Select - -</option>';
while ($row = mysql_fetch_array($query)) {
    $q_pro = "select id from tbl_product where sub_category_id=" . $row['id'];
    $rs_pro = mysql_query($q_pro);
    if (mysql_num_rows($rs_pro) > 0) {
        echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
    }
}
$con->CloseConnection();
?>