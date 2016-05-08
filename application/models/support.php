<?php

Class Support Extends CI_Model  
{  
  
    function __construct()  
    {  
        parent::__construct();  
       
    }


function replace_tr($phrase_org) {



if(strlen($phrase_org)<2){

return $error=-1;
}
else{
$text = trim($phrase_org);
$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
$new_text = str_replace($search,$replace,$text);
return $new_text;
}

} 

function ctgryID($ctgryName) {


$ctgryNameSql=$this->db->query("SELECT * FROM ctgrs_tbl WHERE ctgry_name='$ctgryName' LIMIT 1");
	$ctgryCount=$ctgryNameSql->num_rows();
	
	
			if($ctgryCount==1){
				$ctgryrow=$ctgryNameSql->result_array();
      
		
			 $ctgry_id=$ctgryrow[0]["ctgry_id"];
			
			return $ctgry_id;
	
		}else{
		redirect('home');
		exit();
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.base_url().'index">   Click here </a>';
		exit();
			}


}

function ctgryName($ctgry_ID) {


$ctgryNameSql=$this->db->query("SELECT * FROM ctgrs_tbl WHERE ctgry_id='$ctgry_ID' LIMIT 1");
	$ctgryCount=$ctgryNameSql->num_rows();
	
	
			if($ctgryCount==1){
				$ctgryrow=$ctgryNameSql->result_array();
      
		
			 $ctgryName=$ctgryrow[0]["ctgry_nameText"];
			
			return $ctgryName;
	
		}else{
		redirect('home');
		exit();
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.base_url().'index">   Click here </a>';
		exit();
			}


}

function brndName($brnd_ID) {


$ctgryNameSql=$this->db->query("SELECT * FROM brnd_tbl WHERE brnd_id='$brnd_ID' LIMIT 1");
	$ctgryCount=$ctgryNameSql->num_rows();
	
	
			if($ctgryCount==1){
				$ctgryrow=$ctgryNameSql->result_array();
      
		
			 $brndName=$ctgryrow[0]["brnd_nameText"];
			
			return $brndName;
	
		}else{
		redirect('home');
		exit();
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.base_url().'index">   Click here </a>';
		exit();
			}


}

//take brnd_id from brnd_tbl

 function brndID($brndName) {  

$brndNameSql=$this->db->query("SELECT * FROM brnd_tbl WHERE brnd_name='$brndName' LIMIT 1");
	$brndCount=$brndNameSql->num_rows();
	
	
			if($brndCount==1){
				$brndrow=$brndNameSql->result_array();
      
		
			 $brnd_id=$brndrow[0]["brnd_id"];
			
			return $brnd_id;
	
		}else{
		redirect('home');
		exit();
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.$url.'site/index">   Click here </a>';
		exit();
			}


} 


function searchErr(){

$dynamiclist="";
$dynamiclist.='<div id="title-bar"></div>
	
		
	<div id="warningMessage">En az iki karakter giriniz</div>
			
	';
	return $dynamiclist;


}


function noProducts()
{
$dynamiclist="";
$dynamiclist.='<div id="title-bar"></div>
	
		
	<div id="warningMessage">Ürün Bulunamadı gakko 1</div>
			
	';
	return $dynamiclist;
}

function getAll_filtered_brands($dynamic_sql_filtered_brands,$ctgry_name){


 //$stack = array("brands");
 $filtered_brands="";
 $filtered_brands='<a href="c?c='.$ctgry_name.'">
<div id="filtered_brands">
	
	   Tüm markalar
</div></a>';

$denememarka="Brands";
$sql=$dynamic_sql_filtered_brands;

if($sql!=''){

//$sql=mysql_query("SELECT * FROM products ORDER BY prdct_addDate DESC");  //or ASC
$productCount=$sql->num_rows(); //count output amount
$url=base_url();
if($productCount>0)
{

		foreach ($sql->result_array() as $row)
	{
	
	$ctgry_id=$row["ctgry_id"];
	$brnd_id=$row["brnd_id"];
	
	/*--------------------Brand name start-------------------------*/
	
	$brnd_name_sql=$this->db->query("SELECT * FROM brnd_tbl WHERE brnd_id='$brnd_id' LIMIT 1");
	
	$ctgry_name_sql=$this->db->query("SELECT * FROM ctgrs_tbl WHERE ctgry_id='$ctgry_id' LIMIT 1");
	
	$brndNameCount=$brnd_name_sql->num_rows();
	$ctgryNameCount=$ctgry_name_sql->num_rows();
	
	
			if($brndNameCount==1 && $ctgryNameCount==1){
				$brndrow=$brnd_name_sql->result_array();
				$ctgryrow=$ctgry_name_sql->result_array();
      
		        
			 $brnd_name_text=$brndrow[0]["brnd_nameText"];
			 $brnd_name=$brndrow[0]["brnd_name"];
			 
			 $ctgry_name_text=$ctgryrow[0]["ctgry_nameText"];
			 $ctgry_name=$ctgryrow[0]["ctgry_name"];
			 
			  
			   
		       
			   if (strpos($denememarka, $brnd_name_text) !== FALSE){
			    $denememarka.=''.$brnd_name_text.'';
	}
else
{      $denememarka.=''.$brnd_name_text.'';
       $filtered_brands.='   <a href="cb?c='.$ctgry_name.'&b='.$brnd_name.'&ftype=b">
<div id="filtered_brands">
	
	   '.$brnd_name_text.'
</div></a>

	   
	   
	   
	   ';
	   
	   }				
		
			   
            //array_push($stack,$brnd_name_text);
	
		}else{
		
		redirect('home');
		exit();
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.base_url().'index">   Click here </a>';
			}
	
	
	/*--------------------Brand name stop -------------------------*/
	
	}
	
	}
	

return $filtered_brands;

}


}



function getAll_filtered_categories($dynamic_sql_filtered_categories,$brnd_name){


 //$stack = array("brands");
 $filtered_categories="";
 $filtered_categories='<a href="b?b='.$brnd_name.'">
<div id="filtered_brands">
	
	   Tüm kategoriler
</div></a>';

$tempcategory="Categories";
$sql=$dynamic_sql_filtered_categories;

if($sql!=''){

//$sql=mysql_query("SELECT * FROM products ORDER BY prdct_addDate DESC");  //or ASC
$productCount=$sql->num_rows(); //count output amount
$url=base_url();
if($productCount>0)
{

		foreach ($sql->result_array() as $row)
		
	{
	
	$ctgry_id=$row["ctgry_id"];
	$brnd_id=$row["brnd_id"];
	
	/*--------------------Brand name start-------------------------*/
	
	$brnd_name_sql=$this->db->query("SELECT * FROM brnd_tbl WHERE brnd_id='$brnd_id' LIMIT 1");
	
	$ctgry_name_sql=$this->db->query("SELECT * FROM ctgrs_tbl WHERE ctgry_id='$ctgry_id' LIMIT 1");
	
	$brndNameCount=$brnd_name_sql->num_rows();
	$ctgryNameCount=$ctgry_name_sql->num_rows();
	
	
			if($brndNameCount==1 && $ctgryNameCount==1){
				$brndrow=$brnd_name_sql->result_array();
				$ctgryrow=$ctgry_name_sql->result_array();
      
		        
			 $brnd_name_text=$brndrow[0]["brnd_nameText"];
			 $brnd_name=$brndrow[0]["brnd_name"];
			 
			 $ctgry_name_text=$ctgryrow[0]["ctgry_nameText"];
			 $ctgry_name=$ctgryrow[0]["ctgry_name"];
			 
			  
			   
		       
			   if (strpos($tempcategory, $ctgry_name_text) !== FALSE){
			    $tempcategory.=''.$ctgry_name_text.'';
	}
else
{      $tempcategory.=''.$ctgry_name_text.'';
       $filtered_categories.='   <a href="cb?c='.$ctgry_name.'&b='.$brnd_name.'&ftype=c">
<div id="filtered_brands">
	
	   '.$ctgry_name_text.'
</div></a>

	   
	   
	   
	   ';
	   
	   }				
		
			   
            //array_push($stack,$brnd_name_text);
	
		}else{
		
		redirect('home');
		exit();
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.base_url().'index">   Click here </a>';
			}
	
	
	/*--------------------Brand name stop -------------------------*/
	
	}
	
	}
	

return $filtered_categories;

}


}

function getCategoryPicture($ctgry_id)
{

$ctgryPicture="";
switch ($ctgry_id) {
       case 1:
$ctgryPicture="childonebgeye.jpg";
        break;
        case 2:
$ctgryPicture="childonebgeye.jpg";

        break;
        case 3:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 4:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 5:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 6:
$ctgryPicture="childonebgeye.jpg";

        break; 
		case 7:
$ctgryPicture="childonebgeye.jpg";

        break; 
		case 8:
$ctgryPicture="childonebgeye.jpg";

        break; 
		case 9:
$ctgryPicture="sunctgry.jpg";

        break;
		case 10:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 11:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 12:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 13:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 14:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 15:
$ctgryPicture="childonebgeye.jpg";

        break;
		case 16:
$ctgryPicture="childonebgeye.jpg";

        break;
		
}

return $ctgryPicture;



}


}
?>