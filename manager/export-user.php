<?php
ob_start();
include_once '../includes/connection.php';
$conn=new MySQL();
$sql1="select company_name,contact_person,email,contact_no,address,city,state,zip_code,is_approve from tbl_user where type like 'user'";
$sql=mysql_query($sql1);
$data = '';
$header="Company Name\tContact Person\tEmail\tContact No.\tAddress\tCity\tState\tZip Code\tStatus";

//fetch data each row, store on tabular row data
while($row = mysql_fetch_row($sql))
{
    $count=0;
    $line = '';
    foreach($row as $value)
    {
		$count++;
        if(!isset($value) || $value == "")
        {
            $value = "\t";
        }
        else
        {
			if($count==9)
			{
				if($value=="1")
				{
					$value="Approved";
					$value = str_replace('"', '""', $value);
					$value = '"'.$value.'"'."\t";
				}
				else
				{
					$value="Unapproved";
					$value = str_replace('"', '""', $value);
					$value = '"'.$value.'"'."\t";
				}
				
			}
			else
			{
				$value = str_replace('"', '""', $value);
				$value = '"'.$value.'"'."\t";
			}
			
        }
        $line .= $value;
    }

    $data .= trim($line)."\n";
    $data = str_replace("\r", "", $data);
}

/*while($row = mysql_fetch_row($sql))
{
   $count=0;
    $line = '';
    foreach($row as $value)
    {
        if(!isset($value) || $value == "")
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace('"', '""', $value);
            $value = '"'.$value.'"'."\t";
        }

        $line .= $value;
    }

    $data .= trim($line)."\n";
    $data = str_replace("\r", "", $data);
}*/

$conn->CloseConnection();
//Naming the excel sheet

$name = "MJR_Jewels_Website_Users"."_".date('d-m-y').".xls";
header("Content-type:application/vnd.ms-excel;name='excel'");
header("Content-Disposition: attachment; filename=$name");
header("Pragma: no-cache");
header("Expires: 0");

//Output Data

echo $header."\n\n".$data;

ob_end_flush();
?>