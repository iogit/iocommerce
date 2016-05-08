<?php

class Get_products extends CI_model{

function getAll($titleLink,$paginated,$paginated_sql){

$dynamiclist="";
$dynamiclist.='<div id="pg">
<div id="pagination_top">

'.$paginated.'
</div>
</div>
<div id="title-bar">
<a href="'.base_url().'index"><div class="homeLogo"></div></a>
<a href="'.base_url().'index">'.$titleLink.'</div>
';

                
$sql=$paginated_sql;

if($sql!=''){

//$sql=$this->db->query("SELECT * FROM products ORDER BY prdct_addDate DESC");  //or ASC
$productCount=$sql->num_rows(); //count output amount
$url=base_url();



if($productCount>0)
{

	//while($row=mysql_fetch_array($sql))
		foreach ($sql->result_array() as $row)
	{
	
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
	if(25<strlen($prdct_name)){
	$prdct_name_short = substr($prdct_name, 0, 20);
	$prdct_name_short.="...";
	
	}else{
	
	$prdct_name_short =$prdct_name;
	}
	/*--------------------Brand name start-------------------------*/
	
	$brnd_name_sql=$this->db->query("SELECT * FROM brnd_tbl WHERE brnd_id='$brnd_id' LIMIT 1");
	$brndNameCount=$brnd_name_sql->num_rows();
	
	
			if($brndNameCount==1){
				//$brndrow=mysql_fetch_array($brnd_name_sql);
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
	
	
	$dynamiclist.='
	<div id="product-box">
	<ul id="carousel1" class="product-list">

													<li class="ajax_block_product ">
						<a href="'.$url.'d?id='.$prdct_id.'" title="Cras quis nisl ac odio malesuada" class="product_image"><img  "style="border:#666 0px solid"  src="'.$url.'io_images/product_images/thumbs_xs/'.$prdct_id.'_xs.jpg" alt="'.$prdct_name_short.'" /></a>
						
						<h3><a href="'.$url.'d?id='.$prdct_id.'">'.$prdct_name_short.'	</a></h3>
						<p class="category_name">'.$brnd_name_text.'</p>
						<div class="star_content clearfix">
																							<img style="border:#666 0px solid"  src="'.$url.'io_images/design_images/star'.$star.'.png" alt="'.$prdct_name_short.'" />	
						
						<div class="products_list_price">
						<span class="price">'.$prdct_unitPrice.',<sup style="vertical-align:super; font-size:10px;">00</sup> TL</span>
													     </div>
														  <div class="prdctBoxShipping"><span>'.$shippingText.' </span></div>
						
					</li>
										</ul><div class="cclearfix"></div>
	
	
	
	
	
	
	
	
	
	
	</div>';
	}
	
	}else
	
	{
	$dynamiclist="Sql sorugusunda bir hata var ";	
		
		}

$dynamiclist.='<div id="pg">
<div id="pagination_bottom">
'.$paginated.'
</div>
</div>
';



//$query=$this->db->query('SELECT * FROM sehirler');

return $dynamiclist;

}else{

$dynamiclist="We have no products listed in our store yet 1";	
return $dynamiclist;
}}


function noProducts()
{
$dynamiclist="";
$dynamiclist.='<div id="title-bar"></div>
	
		
	<div id="warningMessage">Ürün Bulunamadı gakko 2</div>
			
	';
	return $dynamiclist;
}







function get_ctgrs($ctgry_id, $paginated,$paginated_sql){

$dynamiclist="";
$dynamiclist.='<div id="pg">
<div id="pagination_top">

'.$paginated.'
</div>
</div>

';
$sql=$paginated_sql;
//$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgry_id' ORDER BY prdct_addDate DESC");  //or ASC
if($sql==""){
$productCount=0;
}else{
$productCount=$sql->num_rows(); //count output amount
}
$url=base_url();
if($productCount>0)
{
	while($row=mysql_fetch_array($sql))
	{
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
	$dscnt_available=$row["dscnt_available"];
	
	
	
	
	
	
	$prdct_addDate=strftime("%b %d, %y",strtotime($row["prdct_addDate"]));
	 if (strcmp($dscnt_available,"yes") == 0){
	 $banner_color="blue";
	 $discount="no.png";
	 }
	 else{
	 $banner_color="yellow";
	 $discount="disc.jpg";
	 }
	
	
	
	$dynamiclist.='
	
	<ul class="col price_list">
		<li class="col220">
			<div class="title '.$banner_color.'">
				<span> '.$prdct_name.' </span> 
				<strong>$ '.$prdct_unitPrice.'</strong>
			</div>
    <ul class="'.$banner_color.'">
	    
			<div class="ul_image">
		
				<a href="'.$url.'det?id='.$prdct_id.'">
					<img style="border:#666 0px solid"  src="'.$url.'io_images/product_images/'.$prdct_id.'.jpg" width="220" height="136" alt="$dynamictitle" /></a>
			</div>
		
		<li>
			<strong> Category </strong> <a href="'.$url.'home_specific_type?type='.$prdct_name.'">'.$prdct_name.'</a>
		</li>
		
        <li>
			<strong>5 GB</strong> monthly transfer
		</li>
        <li>
            <strong>2 MySQL</strong> databases
		</li>
		<li>
			<strong>5 domain</strong> + unlimited subdomains
		</li>
        <li>
			<strong>20</strong> emailboxes
	    </li>
	</ul>
			<div class="order">
				<a href="#">Order Now</a>
			</div>
		</li>
	</ul>

	';
	}
	
	}else
	
	{
	$dynamiclist="We have no products listed in our store yet 2";	
		
		}

$dynamiclist.='<div id="pg">
<div id="pagination_bottom">
'.$paginated.'
</div>
</div>
';

//$query=$this->db->query('SELECT * FROM sehirler');

return $dynamiclist;

}



function get_brnds($brnd_id, $paginated,$paginated_sql){

$dynamiclist="";
$dynamiclist.='<div id="pg">
<div id="pagination_top">

'.$paginated.'
</div>
</div>

';
$sql=$paginated_sql;
//$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgry_id' ORDER BY prdct_addDate DESC");  //or ASC
if($sql==""){
$productCount=0;
}else{
$productCount=$sql->num_rows(); //count output amount
}
$url=base_url();
if($productCount>0)
{
	while($row=mysql_fetch_array($sql))
	{
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
	$dscnt_available=$row["dscnt_available"];
	
	
	$prdct_addDate=strftime("%b %d, %y",strtotime($row["prdct_addDate"]));
	 if (strcmp($dscnt_available,"yes") == 0){
	 $banner_color="blue";
	 $discount="no.png";
	 }
	 else{
	 $banner_color="yellow";
	 $discount="disc.jpg";
	 }
	
	
	
	$dynamiclist.='
	
	<ul class="col price_list">
		<li class="col220">
			<div class="title '.$banner_color.'">
				<span> '.$prdct_name.' </span> 
				<strong>$ '.$prdct_unitPrice.'</strong>
			</div>
    <ul class="'.$banner_color.'">
	    
			<div class="ul_image">
		
				<a href="'.$url.'d?id='.$prdct_id.'">
					<img style="border:#666 0px solid"  src="'.$url.'io_images/product_images/'.$prdct_id.'.jpg" width="220" height="136" alt="$dynamictitle" /></a>
			</div>
		
		<li>
			<strong> Category </strong> <a href="'.$url.'home_specific_type?type='.$prdct_name.'">'.$prdct_name.'</a>
		</li>
        <li>
			<strong>5 GB</strong> monthly transfer
		</li>
        <li>
            <strong>2 MySQL</strong> databases
		</li>
		<li>
			<strong>5 domain</strong> + unlimited subdomains
		</li>
        <li>
			<strong>20</strong> emailboxes
	    </li>
	</ul>
			<div class="order">
				<a href="#">Order Now</a>
			</div>
		</li>
	</ul>

	';
	}
	
	}else
	
	{
	$dynamiclist="We have no products listed in our store yet 3";	
		
		}

$dynamiclist.='<div id="pg">
<div id="pagination_bottom">
'.$paginated.'
</div>
</div>
';

//$query=$this->db->query('SELECT * FROM sehirler');

return $dynamiclist;

}


function get_specific_campaign(){

$dynamiclist="";

$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE dscnt_available='yes' ORDER BY prdct_addDate DESC");  //or ASC
$productCount=$sql->num_rows(); //count output amount
$url=base_url();
if($productCount>0)
{
	//while($row=mysql_fetch_array($sql))
		foreach ($sql->result_array() as $row)
	{
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
	$dscnt_available=$row["dscnt_available"];
	
	
	$prdct_addDate=strftime("%b %d, %y",strtotime($row["prdct_addDate"]));
	$dynamiclist.='
        <div id="container_products">
		
          <a href="'.$url.'det?id='.$prdct_id.'">
		  <img style="border:#666 0px solid"  src="'.$url.'io_images/product_images/'.$prdct_id.'.jpg" width="250" height="166" alt="$dynamictitle" /></a>
		  
		  <div id="container_products_sub">
		 
		   <div id="container_products_subname">
		  
		 <IMG SRC="'.$url.'io_images/line.jpg" ALT="some text" WIDTH=200 HEIGHT=2>

		  <p>'.$prdct_name.'</p>
		  </div>
		  <div id="container_products_subprice">
            <p>$'.$prdct_unitPrice.'</p>
			</div>
			<div id="container_products_subdetails">
            <p><a href="'.$url.'det?id='.$prdct_id.'">view product Details</a></p>
			</div>
			</div>
		  </div>';
	}
	}else
	
	{
	$dynamiclist="We have no products listed in our store yet 4";	
		
		}





//$query=$this->db->query('SELECT * FROM sehirler');

return $dynamiclist;

}










}
?>