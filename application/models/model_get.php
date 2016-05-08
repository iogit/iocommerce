<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class model_get extends CI_Model
{


function getData(){
//in 'cibasic' database in 'pagedata' table find in the array which has '$page' variable value at the "page column"
//$query=$this->db->get_where('products', array("price"=>$page)); 
$query=$this->db->query("SELECT * FROM products ORDER BY date_added DESC");
$productCount=$query->num_rows(); //count output amount
$dynamiclist='';
if($productCount>0)
{
  
	//while ($row=$query->row_array()){
	foreach ($query->result() as $row){
	
	$id=$row->id;
	$product_name=$row->product_name;
	$product_price=$row->price;
	$product_category=$row->category;
	$product_subcategory=$row->subcategory;
	$product_details=$row->details;
	$date_added=strftime("%b %d, %y",strtotime($row->date_added));
	$dynamiclist.='
        <div id="container_products">
          <div id="littlebox_image">
		  <a href="product.php?id='.$id.'">
		  <img style="border:#666 1px solid"  src="'.base_url().'images/product_images/'.$id.'.jpg" width="166" height="166" alt="$dynamictitle" />
		  </a>
		  </div>
		  <div id="littlebox_name">
		  <p>'.$product_name.'</p>
		  </div>
		  <div id="littlebox_price">
            <p>$'.$product_price.'</p>
			</div>
           
			<div id="littlebox_details">
			<a href="product.php?id='.$id.'">view product Details</a></p>
		  </div>
		  </div>';
	}
	}
	else
	
	{
	$dynamiclist="We have no products listed in our store yet";	
		
		}


return $dynamiclist;
mysql_close();








}





}

?>