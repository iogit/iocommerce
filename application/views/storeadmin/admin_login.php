<?php 
if(!isset($_SESSION["manager"])){
	session_start();



	}else{
		redirect("intro");
exit();			
	}

?>
        
<?php
		
		
		if(isset($_POST["password"])&& isset($_POST["username"]))
		{ 
		
		
	    $manager = preg_replace('#[^A-Za-z0-9]#i','',$_POST["username"]);
	$password = preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]);
	
	
	//include "../storescripts/connect_to_mysql.php";
	
	$sql=mysql_query("SELECT admn_id FROM admn_tbl WHERE admn_usrName='$manager' AND admn_psswrd='$password' LIMIT 1");
	
	
	$existCount=mysql_num_rows($sql);
	
	if($existCount==1){
	
	while($row=mysql_fetch_array($sql)){
	$id=$row["admn_id"];
	}
	$_SESSION["id"]=$id;
	$_SESSION["manager"]=$manager;
	$_SESSION["password"]=$password;
	redirect("intro");
	exit();
	}else
	{
	$url=base_url();
		echo 'That information is incorrect, try again <a href="'.$url.'intro">Click here </a>';
		exit();
		
		}}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin yonetimi </title>


<link rel="stylesheet" type="text/css" media="screen" href="../style/style.css">
</head>

<body>


<div align="center" id="mainWrapper">

 

<?php include_once("site_header.php"); 
$url=base_url();

 ?>

   <div id="pageContent">Log in to manage storage</div>
  
    <div align="left" style="margin-left:25px;">
      <p>User name:</p>
      <form id="form1" name="form1" method="post" action="<?php echo $url;?>master">
        <p>
       
          <input type="text" name="username" id="username" size="40"/>
        </p>
        <p>Password</p>
        <p>
         
          <input type="text" name="password" id="password" size="40" />
        </p>
        <p>
          <input type="submit" name="button" id="button" value="Log in" />
        </p>
      </form>
      <p>&nbsp;</p>

     
 
  </div>
  <?php include_once("site_footer.php");  ?>
</div>
  
</body>
</html>