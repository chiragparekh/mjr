<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'includes/connection.php';
$con=new MySQL();
$pro_id = $_POST["pro_id"];
$q="select p.name as name,p.description as description,p.id as p_id,p.weight as weight,p.image_path as image_path,sc.name as sc_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id=".$pro_id;
$result=  mysql_query($q);
$array_res = mysql_fetch_array($result);
$pro_name =  $array_res["name"];
$sub_cat_name =  $array_res["sc_name"];
$pro_desc = $array_res["description"];
$pro_id = $array_res["p_id"];
$pro_weight = $array_res["weight"];
$pro_path = $array_res["image_path"];
$data = array('name'=> $pro_name,'weight'=>$pro_weight,'desc'=>$pro_desc,'p_id'=>$pro_id,'path'=>$pro_path,'sc_name'=>$sub_cat_name);
// JSON encode and send back to the server
echo json_encode($data);


?>

