<?php  //just be sure this session is for admin
session_start();
if(!isset($_SESSION["manager"])){
	
redirect("master");


exit();	
	}
		
		$managerID=preg_replace('#[^0-9]#i',"",$_SESSION["id"]);
	    $manager=preg_replace('#[^A-Za-z0-9]#i',"",$_SESSION["manager"]);
	    $password=preg_replace('#[^A-Za-z0-9]#i',"",$_SESSION["password"]);
	
	//connect to the mysql
	//include "../storescripts/connect_to_mysql.php";
	
	$sql=mysql_query("SELECT * FROM admn_tbl WHERE admn_id='$managerID' AND admn_usrName='$manager' AND admn_psswrd='$password' LIMIT 1");
	
	
	$existCount=mysql_num_rows($sql);
	
	if($existCount==0){
	//header("location:../index.php");
	echo "Your session couldnt be successfull !";
	exit();
	}
	
?>
<?php 
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');

?>







<?php 
//parse the from data and add inventory item to the system

if(isset($_POST['product_name'])){

	
	$url=base_url();
	$pid=mysql_real_escape_string($_POST['thisID']);
	$product_name=mysql_real_escape_string($_POST['product_name']);
	$shortDesc=mysql_real_escape_string($_POST['textarea1']);
	$longDesc=mysql_real_escape_string($_POST['textarea2']);
	$unitPrice=mysql_real_escape_string($_POST['unitPrice']);
	$discount=mysql_real_escape_string($_POST['discount']);
	$discount_available=mysql_real_escape_string($_POST['campaign']);
	$shipping=mysql_real_escape_string($_POST['shipping']);
	
	$units_inStock=mysql_real_escape_string($_POST['unitStock']);
	
    $url=base_url();
	$category=mysql_real_escape_string($_POST['category']);
	$brand=mysql_real_escape_string($_POST['brand']);
	
 $ctgrysql=mysql_query("SELECT * FROM ctgrs_tbl WHERE ctgry_name='$category' LIMIT 1");
	$ctgryCount=mysql_num_rows($ctgrysql);
	
	
			if($ctgryCount==1){
				$ctgryrow=mysql_fetch_array($ctgrysql);
      
		
			$ctgry_id=$ctgryrow["ctgry_id"];
			$ctgry_nameText=$ctgryrow["ctgry_nameText"];
			
	
		}else{
		echo 'Sorry an error occurred Error: X090x106ILP, <br> Category ID unreachable <a href="'.$url.'index">   Click here </a>';
		exit();
			}
	
	$brndsql=mysql_query("SELECT brnd_id FROM brnd_tbl WHERE brnd_name='$brand' LIMIT 1");
	$brndCount=mysql_num_rows($brndsql);
			if($brndCount==1){
				$brndrow=mysql_fetch_array($brndsql);
        
		
			$brnd_id=$brndrow["brnd_id"];
			

		}else{
		echo 'Sorry an error occurred Error: X090x106ILP,  <br> Brand ID unreachable <a href="'.$url.'index">     Click here </a>';
		exit();
			}
			
	
	if($units_inStock==0){
	
	$prdct_available="no";
	}else{
	$prdct_available="yes";
	
	}
	
    
	
	
	//see if that product name is an identical match to another product in the system
	
	
	$sql=mysql_query("UPDATE prdcts_tbl SET prdct_name='$product_name', ctgry_id='$ctgry_id', brnd_id='$brnd_id', prdct_shortDesc='$shortDesc', units_inStock='$units_inStock',prdct_available='$prdct_available' , prdct_longDesc='$longDesc', prdct_unitPrice='$unitPrice', prdct_discount='$discount'  ,dscnt_available='$discount_available', prdct_shipping='$shipping', prdct_addDate=now() where prdct_id='$pid'");

	if($_FILES['fileField']['tmp_name']!=""){
	
	//place image in the folder
	$newname="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"images/product_images/$newname");
   
	}
	 redirect("inventory");  //to prevent to sending same data to database when the page refreshed.
	
	exit();
}

?>

<?php 
//gather this product's full information for inserting automatically into the edit form below in page
if(isset($_GET['pid']))
{
	$targetID=$_GET['pid'];

	$sql=mysql_query("SELECT * FROM prdcts_tbl where prdct_id='$targetID' LIMIT 1");  //or ASC
	$productCount=mysql_num_rows($sql); //count output amount
	if($productCount>0)
	{
	while($row=mysql_fetch_array($sql))
	{
	
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
	$shipping=$row["prdct_shipping"];
	$prdct_addDate=strftime("%b %d, %y",strtotime($row["prdct_addDate"]));
	
				
	$ctgrysql=mysql_query("SELECT * FROM ctgrs_tbl WHERE ctgry_id='$ctgry_id' LIMIT 1");
    $ctgryCount=mysql_num_rows($ctgrysql);
	
	if($ctgryCount==1){
	 $ctgryrow=mysql_fetch_array($ctgrysql);
	  $ctgry_name=$ctgryrow["ctgry_name"];
	  $ctgry_nameText=$ctgryrow["ctgry_nameText"];
	}else{
	
	echo 'Sorry an error occurred Error: X144x153IEP, <br> Category ID unreachable <a href="'.$url.'index">    Click here </a>';
		exit();
	}
	
	$brndsql=mysql_query("SELECT * FROM brnd_tbl WHERE brnd_id='$brnd_id' LIMIT 1");
    $brndCount=mysql_num_rows($brndsql);
	
	if($brndCount==1){
	 $brndrow=mysql_fetch_array($brndsql);
	  $brnd_name=$brndrow["brnd_name"];
	  $brnd_nameText=$brndrow["brnd_nameText"];
	}else{
	
	echo 'Sorry an error occurred Error: X156x166IEP, <br> Brand ID unreachable <a href="'.$url.'index">    Click here </a>';
		exit();
	}
	
	
	}
	}
	else
	
	{
	echo "this Product doesnt exist";	
		exit();
	}
	}
?>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory list </title>


<link rel="stylesheet" type="text/css" media="screen" href="../style/style.css">
<style type="text/css">
#mainWrapper h3 {
	color: #666;
}
</style>
</head>

<body>

<div align="center" id="mainWrapper">
<?php include_once("site_header.php");  ?>
  <div id="pageContent"></div>
  
  
<div align="left" style="margin-left:25px; color: #666; font-family: 'Courier New', Courier, monospace;">
   
   
    
 
</div>
<a name="inventoryForm" id="inventoryForm"></a>

<div id="invAddForm">
<form action="<?php $url; ?>inventory_edit" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
<table width="800" border="0" >
<div class="navEditProd"><a href="<?php $url; ?>inventory">+ Ürün Listesi</a></div> 
      <div class="newProductTitle">Ürün Düzenle </div>
	  
	   
	   <tr>
         <td width="174">Ürün Adı</td>
         <td width="1293"><label><input name="product_name" type="text" id="product_name" size="64"  value="<?php echo $prdct_name; ?>"/> </label></td>
       </tr>
	  
	   
	   
	       <tr>
         <td>Urun katergori</td>
         <td><label>
         <select name="category" id="category">
         <option value="<?php echo $ctgry_name; ?>"><?php echo $ctgry_nameText; ?></option>
         <option value="agizvedis">Agız ve Diş</option>
         <option value="annevebebek">Anne ve Bebek Bakımı</option>
		 <option value="ciltbakimi">Cilt Bakımı</option>
         <option value="cinselsaglik">Cinsel Sağlık</option>
		 <option value="diyettakviye">Diyet Takviyeleri</option>
         <option value="elayaktirnak">El Ayak ve Tırnak Bakımı</option>
		 <option value="erkekbakim">Erkek Bakım Ürünleri</option>
         <option value="fitoterapi">Fito Terapi Ürünleri</option>
		 <option value="gunesurun">Güneş Ürünleri</option>
         <option value="kadinsaglik">Kadın Sağlığı Ürünleri</option>
		 <option value="makyajurun">Makyaj Ürünleri</option>
         <option value="medikalurun">Medikal Ürünler</option>
		 <option value="ortopediurun">Ortopedi Ürünleri</option>
         <option value="sacbakimi">Saç Bakımı</option>
		 <option value="vitamin">Vitamin ve Bitkisel Takviyeler</option>
         <option value="vucutbakimi">Vücut Bakımı</option>
         </select>
         
         </label></td>
       </tr>
	   
	   
	   
	   
	            <tr>
         <td>Marka</td>
         <td><label>
         <select name="brand" id="brand">
         <option value="<?php echo $brnd_name; ?>"><?php echo $brnd_nameText; ?></option>
        
	<option value="abcderm">Abcderm</option>
	<option value="avene">Avene</option>
	<option value="babe">Babe</option>
	<option value="bioderma">Bioderma</option>
	<option value="biorichi">Biorichi</option>
	<option value="bioxcin">Bioxcin</option>
	<option value="boswel">Boswel</option>
	<option value="caudalie">Caudalie</option>
	<option value="clinerience">Clinerience</option>
	<option value="coppertone">Coppertone</option>
	<option value="cumlaude">Cumlaude</option>
	<option value="ddf">DDF</option>
	<option value="dermalogica">Dermalogica</option>
	<option value="dermalute">Dermalute</option>
	<option value="ducray">Ducray</option>
	<option value="elancyl">Elancyl</option>
	<option value="filorga">Filorga</option>
	<option value="fuzzy">Fuzzy</option>
	<option value="hamilton">Hamilton</option>
	<option value="isis">Isis</option>
	<option value="jane">Jane</option>
	<option value="klorane">Klorane</option>
	<option value="lierac">Lierac</option>
	<option value="minoxil">Minoxil</option>
	<option value="mustela">Mustela</option>
	<option value="noviderm">Noviderm</option>
	<option value="neostrata">Neostrata</option>
	<option value="nuxe">Nuxe</option>
	<option value="organix">Organix</option>
	<option value="phyto">Phyto</option>
	<option value="revigen">Revigen</option>
	<option value="rocs">Rocs</option>
	<option value="seaderm">Seaderm</option>
	<option value="sebamed">Sebamed</option>
	<option value="sensodyn">Sensodyn</option>
	<option value="solgar">Solgar</option>
	<option value="synchroline">Synchroline</option>
	<option value="xls">XLS</option>
         </select>
         
         </label></td>
       </tr>
	   
	    <tr>
         <td>Ürün Kisa Detayı</td>
            <td><label><textarea name="textarea1" id="textarea1" size="64" rows="5" cols="30"><?php echo $prdct_shortDesc; ?></textarea></label></td>
       </tr>
	   <tr>
         <td>Ürün Uzun Detayı</td>
            <td><label><textarea name="textarea2" id="textarea2" size="64" rows="5" cols="30"><?php echo $prdct_longDesc; ?></textarea></label></td>
       </tr>
	   
	    <tr>
         <td>Birim Fiyat</td>
         <td></label>$ <input name="unitPrice" type="text" id="unitPrice" size="12" value="<?php echo $prdct_unitPrice; ?>"/></label></td>
       </tr>
	   
	    <tr>
         <td>Stok Adedini Degis</td>
         <td></label><input name="unitStock" type="text" id="unitStock" size="12" value="<?php echo $units_inStock; ?>"/></label></td>
       </tr>
	   
	   <tr>
         <td>Indirim Miktari</td>
         <td></label>% <input name="discount" type="text" id="discount" size="12" value="<?php echo $prdct_discount; ?>"/></label></td>
       </tr>
	   
	    <tr>
         <td>Indirimli Urun</td>
         <td><label>
		 <?php if ($dscnt_available=="yes"){?>
		 <input type="hidden" name="campaign" value="no" checked="checked"/> 
         <input type="checkbox" name="campaign" value="yes" checked="checked"/> 
         
		 <?php }else{ ?>
         <input type="hidden" name="campaign" value="no" /> 
         <input type="checkbox" name="campaign" value="yes"/> 
          <?php }?> 

		 
          </label></td>
       </tr>  


	   <tr>
         <td>Ucretsiz Kargo</td>
         <td><label>
		 <?php if ($shipping=="yes"){?>
		 <input type="hidden" name="shipping" value="no" checked="checked"/> 
         <input type="checkbox" name="shipping" value="yes" checked="checked"/> 
         
		 <?php }else{ ?>
         <input type="hidden" name="shipping" value="no" /> 
         <input type="checkbox" name="shipping" value="yes"/> 
          <?php }?> 

		 
          </label></td>
       </tr>
	   
	   
	   
       
     
       <tr>
         <td>Car Image</td>
         <td><label><input type="file" name="fileField" id="fileField" /></label></td>
       </tr>
	   
	 <!--
	   
	        <tr>
         <td>Product Campaign</td>
         <td><label>
           <select name="campaign" id="campaign">
         <option value="<?php //echo $product_campaign; ?>"><?php// echo $product_campaign; ?></option>
         <option value="yes">Yes</option>
         <option value="no">No</option>
        
         
         </select>
          </label></td>
       </tr>
	   
	   -->
	   
	   
	   
	   
	   
       <tr>
         <td>&nbsp;</td>
         <td>
         <input name="thisID" type="hidden" value="<?php echo $targetID; ?>"/>
         <label><input type="submit" name="button" id="button" value="Change This Item"/></label></td>
       </tr>

  </table>
  </form>
  
  
  
  </div>
      <p>
  <?php include_once("site_footer.php");  ?>
</div>

</div>
</body>
</html>