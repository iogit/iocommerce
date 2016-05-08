<?php

Class Search_model Extends CI_Model  
{  
  
    function __construct()  
    {  
        parent::__construct();  
        $this->load->database();  
    }
	/*
	function getSearchResults ($phrase, $description = TRUE)
	{
		$this->db->like('product_name', $phrase);
		$this->db->order_by('product_name');
		$query = $this->db->get('products');
		if ($query->num_rows() > 0) {
			$output = '<ul>';
			foreach ($query->result() as $search_info) {
				if ($description) {
					$output .= '<li><strong>' . $search_info->product_name . '</strong><br />';
					$output .= $search_info->details . '</li>';
				} else {
					$output .= '<li>' . $search_info->product_name . '</li>';
				}
			}
			$output .= '</ul>';
			return $output;
		} else {
			return '<p>Sorry, no results returned.</p>';
		}
	}
	
	*/
	function getSearchResults ($phrase,$phrase_org, $description = TRUE)
	{
	
	if ($phrase==-1 || $phrase_org==-1){
	
	$dynamiclist="En az iki karakter giriniz";
	return $dynamiclist;
	}else{

$dynamiclist="";
//$find_specific=$phrase;
//$sql=mysql_query("SELECT * FROM products WHERE type='$find_specific' ORDER BY date_added DESC");  //or ASC
$this->db->like('prdct_name', $phrase_org); //search in english character
$this->db->or_like('prdct_shortDesc', $phrase); //search in english character
$this->db->or_like('prdct_shortDesc', $phrase); //search in english character
//$this->db->or_like('brand', $phrase); //search in english character
//$this->db->or_like('details', $phrase_org); //search in details with turkish character
$this->db->order_by('prdct_name');
$query = $this->db->get('prdcts_tbl');

/*###############table brands search start######################*/
/*###############table brands search finish######################*/
         

//$productCount=mysql_num_rows($query); //count output amount
$productCount=$query->num_rows(); //count output amount
$url=base_url();
if($productCount>0)
{
	
	foreach ($query->result() as $row) {
	
	$id=$row->prdct_id;
	$product_name=$row->prdct_name;
	$product_price=$row->prdct_unitPrice;
	$product_details=$row->prdct_shortDesc;

	$prdct_addDate=strftime("%b %d, %y",strtotime($row->prdct_addDate));
	$dynamiclist.='
        <div id="container_products">
		
          <a href="'.$url.'det?id='.$id.'">
		  <img style="border:#666 0px solid"  src="'.$url.'/images/product_images/'.$id.'.jpg" width="250" height="166" alt="$dynamictitle" /></a>
		  
		  <div id="container_products_sub">
		 
		   <div id="container_products_subname">
		  
		 <IMG SRC="'.$url.'images/line.jpg" ALT="some text" WIDTH=200 HEIGHT=2>

		  <p>'.$product_name.'</p>
		  </div>
		  <div id="container_products_subprice">
            <p>$'.$product_price.'</p>
			</div>
			<div id="container_products_subdetails">
            <p><a href="'.$url.'det?id='.$id.'">view product Details</a></p>
			</div>
			</div>
		  </div>';
	}
	}else
	
	{
	$dynamiclist="We have no products listed in our store yet";	
		
		}





//$query=$this->db->query('SELECT * FROM sehirler');

return $dynamiclist;
}

	}
	
	
function getSearchResultsInv ($phrase,$phrase_org, $description = TRUE)
	{
	
	if ($phrase==-1 || $phrase_org==-1){
	
	$dynamiclist="En az iki karakter giriniz";
	return $dynamiclist;
	}else{

$product_list="";
//$find_specific=$phrase;
//$sql=mysql_query("SELECT * FROM products WHERE type='$find_specific' ORDER BY date_added DESC");  //or ASC
$this->db->like('prdct_name', $phrase_org); //search in english character
$this->db->or_like('prdct_shortDesc', $phrase); //search in english character
//$this->db->or_like('brand', $phrase); //search in english character
//$this->db->or_like('details', $phrase_org); //search in details with turkish character
		$this->db->order_by('prdct_name');
		$query = $this->db->get('prdcts_tbl');
         

//$productCount=mysql_num_rows($query); //count output amount
$productCount=$query->num_rows(); //count output amount
$url=base_url();
if($productCount>0)
{
	
	foreach ($query->result() as $row) {
	
	$prdct_id=$row->prdct_id;
	$prdct_name=$row->prdct_name;
	$prdct_unitPrice=$row->prdct_unitPrice;
	$ctgry_id=$row->ctgry_id;
	$brnd_id=$row->brnd_id ;
	$prdct_shortDesc=$row->prdct_shortDesc ;
	$prdct_longDesc=$row->prdct_longDesc ;
	$prdct_discount=$row->prdct_discount ;
	$units_inStock=$row->units_inStock ;
	$units_onOrder=$row->units_onOrder ;
	$prdct_available=$row->prdct_available ;
	$dscnt_available=$row->dscnt_available ;
	$shipping=$row->prdct_shipping ;
	$prdct_addDate=strftime("%b %d, %y",strtotime($row->prdct_addDate));
	
	$product_list.='<tr>';
	$product_list.="<td bgcolor='#FFFFFF'> $prdct_id </td>"; 
	$product_list.="<td bgcolor='#d7e0ec'>$prdct_name</td>"; 
    $product_list.="<td bgcolor='#FFFFFF'>$$prdct_unitPrice</td>";
	//$product_list.="<td bgcolor='#d7e0ec'>$ctgry_id</td>"; 
	
	//$product_list.="<td bgcolor='#FFFFFF'>$brnd_id</td>";
	$product_list.="<td bgcolor='#d7e0ec'>$prdct_shortDesc</td>";
	
	$product_list.="<td bgcolor='#FFFFFF'><div style='width: 490px; height:75px; overflow: auto; padding:4px;'>$prdct_longDesc</div></td>";
	$product_list.="<td bgcolor='#d7e0ec'>%&nbsp$prdct_discount </td>";
	$product_list.="<td bgcolor='#FFFFFF'>$units_inStock</td> ";
	$product_list.="<td bgcolor='#d7e0ec'>$prdct_available</td>";
	$product_list.="<td bgcolor='#FFFFFF'>$dscnt_available</td>";
	$product_list.="<td bgcolor='#d7e0ec'>$shipping</td>";
	$product_list.="<td bgcolor='#FFFFFF'>$prdct_addDate</td>";
	
	
	
	$product_list.="<td bgcolor='#FFFFFF'> <div id='admin_edit'><a href='".$url."inventory_edit?pid=$prdct_id'>Düzenle</a> </a>&nbsp; <div id='admin_delete'><a href='".$url."inventory?deleteid=$prdct_id'>Sil</a></div><br/></td>";
$product_list.='<tr>';
	}
	return $product_list;	
	}else
	
	{
	$product_list="you have no products listed in your store yet";	
		return $product_list;	
		}

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}

	
}
	?>