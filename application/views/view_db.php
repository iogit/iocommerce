<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> <?php echo $title; ?> </title>


</head>
<body>
<div>

<h1>dataBase</h1>


<a href="view_db">Home</a>
<a href="about">About</a>

<a href="getValue">DataBase</a>
<br/>

<?php

foreach($getinf1 as $row)
{
echo $row->id;
echo  "-";

echo $row->ad;
echo "<br/>";


}

?>

</div>

</body>
</html>