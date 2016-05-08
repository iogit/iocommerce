<?php

class Productpopular extends CI_model{

function productbanner($dynamicSql){

$productpopularlist="";
$productpopularlist.='';
                
$sql=$dynamicSql;

if($sql!=''){

//$sql=mysql_query("SELECT * FROM products ORDER BY prdct_addDate DESC");  //or ASC
$productCount=$sql->num_rows(); //count output amount
$url=base_url();
$productpopularcounter=0;
if($productCount>0)
{

    //	while($row=mysql_fetch_array($sql))
		foreach ($sql->result_array() as $row)
	{
	if($productpopularcounter<10){
	$prdct_id=$row["prdct_id"];
	$prdct_name=$row["prdct_name"];
	$prdct_unitPrice=$row["prdct_unitPrice"];
	$ctgry_id=$row["ctgry_id"];
	$brnd_id=$row["brnd_id"];
	$prdct_shortDesc=$row["prdct_shortDesc"];
	$prdct_longDesc=$row["prdct_longDesc"];
	$prdct_discount=$row["prdct_discount"];
	$units_inStock=$row["units_inStock"];
	$units_onOrder=$row["units_onOrder"];
	$prdct_available=$row["prdct_available"];
	$shipping=$row["prdct_shipping"];
	$dscnt_available=$row["dscnt_available"];
	
	$prdct_name_short="";
	if(12<strlen($prdct_name)){
	$prdct_name_short = substr($prdct_name, 0, 12);
	$prdct_name_short.="...";
	
	}else{
	
	$prdct_name_short =$prdct_name;
	}
	/*--------------------Brand name start-------------------------*/
	
	$brnd_name_sql=$this->db->query("SELECT * FROM brnd_tbl WHERE brnd_id='$brnd_id' LIMIT 1");
	$brndNameCount=$brnd_name_sql->num_rows();
	
	
			if($brndNameCount==1){
				$brndrow=$brnd_name_sql->result_array();
      
		
			 $brnd_name_text=$brndrow[0]["brnd_nameText"];
			
			
	
		}else{
		
		redirect('home');
		exit();
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.base_url().'index">   Click here </a>';
			}
	
	
	/*--------------------Brand name stop -------------------------*/
	
	
	$prdct_addDate=strftime("%b %d, %y",strtotime($row["prdct_addDate"]));
	
	 if (strcmp($dscnt_available,"no") == 0){
	 $banner_color="blue";
	 $discount="no.png";
	 }
	 else{
	 $banner_color="yellow";
	 $discount="disc.jpg";
	 }
	
	if($units_onOrder==0)
	{
	$star="50";
	}
	
	if (strcmp($shipping,"no") == 0){
	 	 $shippingText="+ Kargo Ücreti";
	 
	 }
	 else{
	 $shippingText="Ücretsiz Kargo";

	 }
	
	
	$productpopularlist.='
		<div id="product-box"><li class="ajax_block_product ">
						<a href="'.$url.'d?id='.$prdct_id.'" title="Cras quis nisl ac odio malesuada" class="product_image_carousel"><img  "style="border:#666 0px solid"  src="'.$url.'io_images/product_images/thumbs_xs/'.$prdct_id.'_xs.jpg" alt="'.$prdct_name_short.'" />
						
						<h3><a href="" title="Urun ismi 1">'.$prdct_name_short.'</a></h3>
						<p class="category_name">'.$brnd_name_text.'</p>
						<div class="star_content clearfix">
																							<img style="border:#666 0px solid"  src="'.$url.'io_images/design_images/star'.$star.'.png" alt="'.$prdct_name_short.'" />
						
						<div class="products_list_price">
						<span class="price">'.$prdct_unitPrice.',<sup style="vertical-align:super; font-size:10px;">00</sup> TL</span>
						
					
													     </div>
														  <div class="prdctBoxShipping"><span>'.$shippingText.' </span></div>
			
						
					</li></div>
	
	
	';
	}
	}
	}else
	
	{
	$productpopularlist="Şu  an stoklarımızda ürün bulunmamaktadır";	

	}





//$query=$this->db->query('SELECT * FROM sehirler');

return $productpopularlist;

}else{

$productpopularlist="We have no products listed in our store yet";	
return $productpopularlist;
}


}







}
?>