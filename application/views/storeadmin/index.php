<?php 
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
	//redirect("intro");
	echo "Your session couldnt be successfull !";
	exit();
	}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Admin Area </title>


<link rel="stylesheet" type="text/css" media="screen" href="../style/style.css">
</head>

<body>

<div align="center" id="mainWrapper">
<?php include_once("site_header.php");  ?>
  <div id="pageContent">Admin Area Index Page</div>
  
  <div id="pageFooter">
    <div align="left" style="margin-left:25px;">
      <p>Admin Panel Manipulation Area</p>
      <p><a href="<?php echo base_url();?>inventory">Manage inventory</a></p>
      <p><a href="#">Manage Something</a></p>
    </div>
  </div>
  <?php include_once("site_footer.php");  ?>
</div>
</body>
</html>