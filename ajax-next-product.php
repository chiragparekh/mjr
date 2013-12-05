<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once 'includes/connection.php';
$con = new MySQL();
$pro_id = $_POST["pro_id"];

$q="select p.name as pro_name,p.description as description,p.weight as weight,p.id as p_id,p.image_path as path,sc.name as sc_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where sub_category_id in ( select sub_category_id from tbl_product where id=".$pro_id.") and p.id<".$pro_id." order by p.id desc limit 0,1";
$result=  mysql_query($q);
if(mysql_num_rows($result)>0){
    $arr_result = mysql_fetch_array($result);    
    $pro_id = $arr_result["p_id"];
    $sc_name = $arr_result["sc_name"];
    $path = $arr_result["path"];    
    $weight = $arr_result["weight"];
    $desc = $arr_result["description"];
    $pro_name = $arr_result["pro_name"];
    $data = array('length'=>1,'name'=> $pro_name,'weight'=>$weight,'desc'=>$desc,'p_id'=>$pro_id,'path'=>$path,'sc_name'=>$sc_name);    
    echo json_encode($data);
    
}else{
    $data = array('length'=> 0);    
    echo json_encode($data);
}



