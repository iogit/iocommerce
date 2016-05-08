<?php  //just be sure this session is for admin
session_start();
if(!isset($_SESSION["manager"])){
	
redirect("master");

exit();	
	}
		
		$managerID=preg_replace('#[^0-9]#i',"",$_SESSION["id"]);
	    $manager=preg_replace('#[^A-Za-z0-9]#i',"",$_SESSION["manager"]);
	    $password=preg_replace('#[^A-Za-z0-9]#i',"",$_SESSION["password"]);
	
	
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
//delete item question to admin 
$url=base_url();
if(isset($_GET['deleteid'])){

$message=''.$_GET['deleteid'].' Numarali Urunu Gercekten Silmek Istiyormusun ? <a href="'.$url.'inventory?yesdelete='.$_GET['deleteid'].'">Yes</a>|<a href="'.$url.'inventory">No</a>';

echo $message;

exit();

}
if(isset($_GET['yesdelete'])){
//remove item form system and delete its picture
//delete from database first
//delete from database first
$id_to_delete=$_GET['yesdelete'];
$id_to_delete_xs=$id_to_delete.'_xs';
$sql=mysql_query("DELETE FROM prdcts_tbl where prdct_id='$id_to_delete' LIMIT 1") or die(mysql_error);

//unlink the picture
$pictodelete=("io_images/product_images/$id_to_delete.jpg");
if(file_exists($pictodelete)){
	
	unlink($pictodelete);
	}
	
	$pictodeletexs=("io_images/product_images/thumbs_xs/$id_to_delete_xs.jpg");
	
if(file_exists($pictodeletexs)){
	
	unlink($pictodeletexs);
	}

  redirect("inventory");
exit();

}



?>



<?php 
//parse the from data and add inventory item to the system



if(isset($_POST['product_name'])){
	$product_name=mysql_real_escape_string($_POST['product_name']);
	$shortDesc=mysql_real_escape_string($_POST['textarea1']);
	$longDesc=mysql_real_escape_string($_POST['textarea2']);
	$unitPrice=mysql_real_escape_string($_POST['unitPrice']);
	$discount=mysql_real_escape_string($_POST['discount']);
	$discount_available=mysql_real_escape_string($_POST['campaign']);
	$shipping=mysql_real_escape_string($_POST['shipping']);
	$units_inStock=mysql_real_escape_string($_POST['unitStock']);
	
	$category=mysql_real_escape_string($_POST['category']);
	$brand=mysql_real_escape_string($_POST['brand']);
	

	$brndsql=mysql_query("SELECT brnd_id FROM brnd_tbl WHERE brnd_name='$brand' LIMIT 1");
	
		
		$brndCount=mysql_num_rows($brndsql);
		
		
		if($brndCount==1){
         $row=mysql_fetch_array($brndsql);
        
		
			$brnd_id=$row["brnd_id"];
			

		}else{
		echo 'Sorry an error occurred Error: X090x106ILP, <a href="'.$url.'inventory">   Click here </a>';
		exit();
			}
			
	$ctgrysql=mysql_query("SELECT ctgry_id FROM ctgrs_tbl WHERE ctgry_name='$category' LIMIT 1");
    $ctgryCount=mysql_num_rows($ctgrysql);
	
	if($ctgryCount==1){
	 $row=mysql_fetch_array($ctgrysql);
	  $ctgry_id=$row["ctgry_id"];
	}else{
	
	echo 'Sorry an error occurred Error: X108x118ILP, <a href="'.$url.'inventory">   Click here </a>';
		exit();
	}
	
	//see if that product name is an identical match to another product in the system
	
	
	$sql=mysql_query("SELECT prdct_id FROM prdct_tbl WHERE prdct_name='$product_name' LIMIT 1");
	
	$productMatch=mysql_num_rows($sql); //count the output amount
	$url=base_url();
	if($productMatch>0)
	{
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="'.$url.'inventory"> Click here </a>';
		exit();
		}
		
		
	if($units_inStock==0){
	
	$prdct_available="no";
	}else{
	$prdct_available="yes";
	
	}
		
	
	//add this product into the database

	$sql=mysql_query("INSERT INTO prdcts_tbl (prdct_name, ctgry_id, brnd_id, prdct_shortDesc, prdct_longDesc , prdct_unitPrice, prdct_discount, prdct_available, units_inStock, dscnt_available, prdct_shipping, prdct_addDate) VALUES('$product_name','$ctgry_id','$brnd_id','$shortDesc','$longDesc','$unitPrice','$discount','$prdct_available','$units_inStock','$discount_available', '$shipping', now())") or die(mysql_error());
	
	$pid=mysql_insert_id();
	$url=base_url();
	//place image in the folder
	$newname="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"io_images/product_images/$newname");
	
	redirect('thumb?thumb='.$pid.'');
	  redirect("inventory"); //to prevent to sending same data to database when the page refreshed.
	exit();
}

?>


<?php
//this block grabs the whole list for viewing
if($product_list==""){
$sql=mysql_query("SELECT * FROM prdcts_tbl ORDER BY prdct_addDate DESC");  //or ASC
$productCount=mysql_num_rows($sql); //count output amount
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
	$shipping=$row["prdct_shipping"];
	$prdct_addDate=strftime("%b %d %Y %X",strtotime($row["prdct_addDate"]));
	
	$product_list.='<tr>';
	$product_list.="<td bgcolor='#FFFFFF'> $prdct_id </td>"; 
	$product_list.="<td bgcolor='#d7e0ec'>$prdct_name</td>"; 
    $product_list.="<td bgcolor='#FFFFFF'>$$prdct_unitPrice</td>";
	//$product_list.="<td bgcolor='#d7e0ec'>$ctgry_id</td>"; 
	
	//$product_list.="<td bgcolor='#FFFFFF'>$brnd_id</td>";
	$product_list.="<td bgcolor='#d7e0ec'>$prdct_shortDesc</td>";
	
	$product_list.="
<td bgcolor='#FFFFFF'><div style='width: 490px; height:75px; overflow: auto; padding:4px;'>$prdct_longDesc</div></td>";
	$product_list.="<td bgcolor='#d7e0ec'>%&nbsp$prdct_discount </td>";
	$product_list.="<td bgcolor='#FFFFFF'>$units_inStock</td> ";
	$product_list.="<td bgcolor='#d7e0ec'>$prdct_available</td>";
	$product_list.="<td bgcolor='#FFFFFF'>$dscnt_available</td>";
	$product_list.="<td bgcolor='#d7e0ec'>$shipping</td>";
	$product_list.="<td bgcolor='#FFFFFF'>$prdct_addDate</td>";
	
	
	
	$product_list.="<td bgcolor='#FFFFFF'> <div id='admin_edit'><a href='".$url."inventory_edit?pid=$prdct_id'>Düzenle</a> </a>&nbsp; <div id='admin_delete'><a href='".$url."inventory?deleteid=$prdct_id'>Sil</a></div><br/></td>";
$product_list.='<tr>';
	}
	
	
	
	
		
	}else
	
	{
	$product_list="you have no products listed in your store yet";	
		
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
  
  
  
<div id="invList">
<div class="prodList">
   Ürünler Listesi
 </div>
<!-- Admin paneli Urun Listeleme Syfasi Urun Arama -->
	
 <form id="search_formInv" method="post" action="<?= site_url('search_inventory');?>">
	<div class="invNav">
        <label for="phrase"></label>
        <input type="text" name="phrase" id="phrase" />
		<input type="submit" value="Ara" id="search_button" />
		
	    <a href="<?php base_url();?>inventory"> &nbsp &nbsp&nbsp &nbsp &nbsp&nbsp+ Tüm Ürünleri Göster &nbsp &nbsp&nbsp</a>
		  <a href="#invAddForm">+ Yeni Ürün Ekle &nbsp</a>
		  <a href="<?php base_url();?>home">+ Ana Sayfa &nbsp</a>
	</div>
	   
    </form>
	
	
	
	
 <!--Urun Arama Bitis-->
 
 
 
 
      <table width="1500" border="0 solid" bgcolor="#FFFFFF" cellpadding="3">
       

	   <tr>
		
          <td width="10"><strong>Product ID</strong></td>
          <td width="200"><strong>Ürün Adı</strong></td>
		  <td width="100" ><strong>Birim Fiyat</strong></td>
        <!--  <td width="30" ><strong>Kategori ID</strong></td>
	      <td width="30"><strong>Marka ID</strong></td>-->         
		 <td width="300" ><strong>Urun Kisa Aciklama</strong></td>
          
          <td width="400" ><strong>Urun Uzun Aciklama</strong></td>
          <td width="50" ><strong>Indirim Miktari</strong></td>
          <td width="50" ><strong>Stok Adet</strong></td>
          
          <td width="30" ><strong>Urun Stokda</strong></td>
          <td width="30" ><strong>İndirim </strong></td>
          <td width="30" ><strong>Kargo </strong></td>
          <td width="100" ><strong>Eklenme Tarihi</strong></td>
        </tr>
		
		
		
		
		
		
         <?php echo $product_list; ?>
       <!-- <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr> -->
      </table>
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 
</div>
<a name="inventoryForm" id="inventoryForm"></a>

<?php $url=base_url();?>

<div id="invAddForm">
<form action="<?php $url; ?>inventory" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
<table width="800" border="0">
		<div class="newProductTitle">Yeni Ürün Ekle</div>

       <tr>
         <td width="174">Ürün Adı</td>
         <td width="1293"><label><input name="product_name" type="text" id="product_name" size="50"/> </label></td>
       </tr>
      
       <tr>
         <td>Urun katergori</td>
         <td><label>
         <select name="category" id="category">
         <option value=""</option>
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
         <select name="brand" id="brand" width="50px">
         <option value=""</option>
        
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
            <td><label><textarea name="textarea1" id="textarea1" size="64" rows="5"></textarea></label></td>
        </tr>
	   
	   
	   
	   
       <tr>
         <td>Ürün Detayı Uzun</td>
            <td><label><textarea name="textarea2" id="textarea2" size="64" rows="5"></textarea></label></td>
    </tr>
	   
	   
	   
	   
	    <tr>
         <td>Birim Fiyat</td>
         <td></label>$ <input name="unitPrice" type="text" id="unitPrice" size="12"/></label></td>
       </tr>
	   
	   <tr>
         <td>Stok Adedi</td>
         <td></label><input name="unitStock" type="text" id="unitStock" size="12"/></label></td>
       </tr>
	   
	   
	   <tr>
         <td width="174">Indirim miktari</td>
         <td width="1293"><label><input name="discount" type="text" id="discount" size="50"/> </label></td>
       </tr>
	   
	    <tr>
         <td>İndirimli Ürün</td>
         <td><label>
		  <input type="hidden" name="campaign" value="no"/> 
         <input type="checkbox" name="campaign" value="yes" /> 
          </label></td>
       </tr>
	   
	    <tr>
         <td>Ucretsiz Kargo</td>
         <td><label>
		  <input type="hidden" name="shipping" value="no"/> 
         <input type="checkbox" name="shipping" value="yes" /> 
          </label></td>
       </tr>
	   
	   
	   
	   
       <tr>
         <td>Ürün Resmi</td>
         <td><label><input type="file" name="fileField" id="fileField" /></label></td>
       </tr>
	   
	   
	   </tr>
	  <!-- 
           <tr>
         <td>Product Campaign</td>
         <td><label>
           <select name="campaign" id="campaign">
          <option value="no">No</option>
		 <option value="yes">Yes</option>
	
         </select>
          </label></td>
       </tr>
	   -->
	   
	   
	   

       <tr>
         <td>&nbsp;</td>
         <td><label><input type="submit" name="button" id="button" value="Add This Item"/></label></td>
       </tr>

  </table>
  </form>
  </div>
      <p>
  <?php include_once("site_footer.php"); ?>
</div>

</div>
</body>



</html>