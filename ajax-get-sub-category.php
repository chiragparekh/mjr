<?php
include_once './includes/connection.php';
$con = new MySQL();
$cid = mysql_real_escape_string($_GET['cid']);
$query = mysql_query("SELECT id,name FROM tbl_sub_category WHERE category_id =" . $cid);
echo '<option value="-1">- - Select - -</option>';
while ($row = mysql_fetch_array($query)) {
    echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
}
$con->CloseConnection();
?>