<?php 
//script error Reporting
error_reporting(E_ALL);
ini_set('display_erros','1');
?>
<?php 
//chechk to see the URL variable is set and that it exists in the database
if(isset($prdct_id)) //if we can access this id
{  

	$id=preg_replace('#[^0-9]#i','',$_GET['id']); //TO PREVENT people put some character but numbers,people can type and change the URL variables
	//use this var to check to see if this ID exists, if yes then get the product
	//datails,if no then exit this script and give error message why
	
	$query=$this->db->query("SELECT * FROM prdcts_tbl  WHERE prdct_id='$prdct_id' LIMIT 1");
	$query_comment=mysql_query("SELECT * FROM cmmnts_tbl WHERE cmmnt_prdctID='$prdct_id' ORDER BY cmmnt_date DESC");
$commentCount=mysql_num_rows($query_comment);
	$payment="";
$commentList="";
$rate=0;
 //count output amount

$url=base_url();
	$productCount=$query->num_rows(); //count output amount
$dynamiclist='';
if($productCount>0)
{
  
	//while ($row=$query->row_array()){
	foreach ($query->result() as $row){
	
	$prdct_id=$row->prdct_id;
	$prdct_name=$row->prdct_name;
	$prdct_unitPrice=$row->prdct_unitPrice;
	$ctgry_id=$row->ctgry_id;
	$brnd_id=$row->brnd_id;
	$prdct_shortDesc=$row->prdct_shortDesc;
	$prdct_longDesc=$row->prdct_longDesc;
	$prdct_discount=$row->prdct_discount;
	$units_inStock=$row->units_inStock;
	$units_onOrder=$row->units_onOrder;
	$prdct_available=$row->prdct_available;
	$dscnt_available=$row->dscnt_available;
	$prdct_addDate=strftime("%b %d %Y %X",strtotime($row->prdct_addDate));
	
			
			
}



	}
	else
		{
		echo "that item does not exist.";
		exit();
		}




if($commentCount>0)
{
	while($row2=mysql_fetch_array($query_comment))
	{
	$cmmnt_usrID=$row2["cmmnt_usrID"];
	$cmmnt_prdctID=$row2["cmmnt_prdctID"];
	$cmmnt_title=$row2["cmmnt_title"];
	$cmmnt_liked=$row2["cmmnt_liked"];
	$cmmnt_comment=$row2["cmmnt_comment"];

	$cmmnt_date=strftime("%b %d, %Y | %X",strtotime($row2["cmmnt_date"]));
    	

	if (strcmp($cmmnt_liked,"yes") == 0){
	 $rate++;
	 $likeornot="like.png";
	 }else
	 {
	 $likeornot="dislike.png";
	 }
	
	
	$query_usr=mysql_query("SELECT * FROM usr_tbl WHERE usr_id='$cmmnt_usrID' LIMIT 1");
     $usrCount=mysql_num_rows($query_usr);
	
	
			if($usrCount==1){
				$usrrow=mysql_fetch_array($query_usr);
      
		
			 $usr_userName=$usrrow["usr_userName"];
	
	}
	$commentList.='
	
	
	
                <div class="commentBox">

				<div class="commentMain">
				
				
				
				
				
				
				<div class="commentTitle">
				
				<strong>'.$cmmnt_title.'</strong><p>
				</div>
				
				<div class="userInf">
				
				 <div class="textSmoothSmall">Kullanıcı adı  '.$usr_userName.'</div> 
				 '.$cmmnt_date.'
				 </div>
				<div class="commentComment">
				
				'.$cmmnt_comment.'<p>
				<div id="emptyDiv"></div>
			    
				
			
				</div>
				
				<div class="likeornotLogo">
				<img width="30px" height="30px" src="../images/design_images/'.$likeornot.'" width="185" height="185" alt="'.$prdct_name.'"/>
				</div>
				
				</div>
				
		         </div>
				

	';
	}
	
	}else
	
	{
	$commentList="Bu urune yorum yapilmamistir";	
		
		}

    if($commentCount!=0){ 
	
	$percent=($rate*100)/$commentCount;
	
	if($percent<=20){$bigstar="10.png";}
	elseif($percent<=30){$bigstar="15.png";}
	elseif($percent<=40){$bigstar="20.png";}
	elseif($percent<=50){$bigstar="25.png";}
	elseif($percent<=60){$bigstar="30.png";}
	elseif($percent<=70){$bigstar="35.png";}
	elseif($percent<=80){$bigstar="40.png";}
	elseif($percent<=90){$bigstar="45.png";}
	elseif($percent<=100){$bigstar="50.png";}
	}else
	{
	$bigstar="no.jpg";
	}


	
}
   else
		{
		echo "data to render this page is missing";
		exit();
		}
		
		
		if($units_onOrder==0)
	{
	$star="star50";
	}
	
		$queryCtgry=$this->db->query("SELECT * FROM ctgrs_tbl  WHERE ctgry_id='$ctgry_id' LIMIT 1");
		$queryBrnd=$this->db->query("SELECT * FROM brnd_tbl  WHERE brnd_id='$brnd_id' LIMIT 1");
	
	$ctgryCount = $queryCtgry->num_rows;
	$brndCount = $queryBrnd->num_rows;
	
		if($ctgryCount==1){
					foreach ($queryCtgry->result() as $rowCtgry){
					$ctgry_nameText=$rowCtgry->ctgry_nameText;
			 }	}	
			 
			if($brndCount==1){
					foreach ($queryBrnd->result() as $rowBrnd){
					$brnd_nameText=$rowBrnd->brnd_nameText;
			 }	}	
	
	        
	         
		    $payment.="<table border='0' id='tablePay'>";
		    $payment.="<tr><td>Kategori</td><td>:$ctgry_nameText</td></tr>";
			$payment.="<tr><td>Marka</td><td>:$units_inStock</td></tr> ";
			$payment.="<tr><td>Fiyat</td><td>:$prdct_available</td></tr>";
			$payment.="<tr><td>İndirimli</td><td>:$dscnt_available</td></tr>";
			$payment.="<tr><td>İndirimli</td><td>%&nbsp$prdct_discount </td></tr>";
	        $payment.="</table>";
	


mysql_close();

?>

<?php
if($units_inStock!=0)
{
$stockSit="Urun Stokda var";
}else{
$stockSit="Urun Stokda yok";
}

$url=base_url();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $prdct_name; ?> </title>


<link rel="stylesheet" type="text/css" media="screen" href="style/style.css">


</head>

<body>



  <div id="details"> 
  <div id="detMainTop">
  
   <div class="solidContainerTop"> 
  <div class="solidTop"> </div>  
   
   
   <div class="detProdSell">

	
<div id="detBrand">
<?php echo $prdct_name; ?>

</div>

<div class="detPrice">
	  <?php echo '<strong>$'.$prdct_unitPrice."</strong>"; ?>
</div>

<div class="addCart">
      <form id="form1" name="form1" method="post" action="<?php $url; ?>cart">
      <input type="hidden" name="pid" id="pid" value="<?php echo  $id; ?>"/>
      <input type="submit" name="button" id="button" value="Sepete Ekle"/>
      </form>
	  
      </div>
	
	  
	  

<div class="detShortDesc"><?php echo $prdct_shortDesc; ?>





</div>
<div id="emptyDiv"></div>
<div id='linkMore'><a href='#detMainBtm'>Devami</a></div>

  
	  <div class="detPicture">
   <img src="<?php echo base_url();?>images/product_images/<?php echo $id;?>.jpg" width="185" height="185" alt="<?php echo $prdct_name; ?>"/>
  <div class="detZoomPic"><a href="<?php echo base_url();?>images/product_images/<?php echo $id;?>.jpg">Resmi Büyüt</a></div>
  </div>



<div id="paymentInf">



</div>

 


  
   <div class="userReview">
   
   <div class="detBoxStars">
        <img  width="80" height="16"  src="../images/design_images/bigstars/<?php echo $bigstar;?>" alt="" />	
         <div class="userReviewCount"><a href="#detComment">Toplam Yorum Sayisi <?php echo $commentCount;?></a>  |  <a href="#detComment">Yorum Yaz</a> </div>		
		</div>
		
   
   </div>
   
  
   
   
    </div>
	<div class="solidBtm"> </div> 
	</div>
	
	
	
	<div id="detMainBtm">
		<div class="solidContainerBottom"> 
   
			<div class="solidTop"> </div> 
			
			<div class="detLongTitle">Ürün Bilgisi</div>
				<div class="detLongDetTop">
	  
					<p><?php echo $prdct_longDesc; ?></p>
				</div>
			<div class="solidBtm"> </div> 
		</div>
     </div>
	 
	 
	 <div id="detComment">
		<div class="solidContainerBottoms"> 
   
			
			
			<div class="detLongTitleComment">Ürün Puani & Yorumlari <p>
				 <div class="detBoxStars">
        <img  width="80" height="16"  src="../images/design_images/bigstars/<?php echo $bigstar;?>" alt="" />		
		</div>
			
			</div>
		
				<div class="detLongDet">
	  
					<p><?php echo $commentList; ?></p>
		
				</div>
		
		</div>
     </div>
  </div>
  
  
  

</body>
</html>