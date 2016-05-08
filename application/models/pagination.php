<?php

Class Pagination Extends CI_Model  
{  
  
    function __construct()  
    {  
        parent::__construct();  
       
    }
	
	
function paginate($pn, $dynamicSql,$function,$ctgry_name,$brnd_name){
	//echo $productCount=mysql_num_rows($dynamicSql);
//exit();
$sql=$dynamicSql;	
//$sql=$this->db->query("SELECT * FROM prdcts_tbl ORDER BY prdct_addDate DESC");  //or ASC
$productCount=$sql->num_rows();

$url=base_url();


if($pn!=""){

$pn=preg_replace('#[^0-9]#i','',$pn);
}else{

$pn=1;
}
$itemsPerPage=15;
$lastPage=ceil($productCount/$itemsPerPage);


if($pn<1){
$pn=1;

}elseif($pn>$lastPage){
$pn=$lastPage;
}

if($ctgry_name!=''){
$urlRest="&c=" .$ctgry_name;}
elseif($brnd_name!=''){
$urlRest="&b=".$brnd_name;
}else
{$urlRest="";}


$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' .$url . $function . $add1 .$urlRest.'">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $url .$function . $sub1 .$urlRest. '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $url. $function . $sub2 .$urlRest. '">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $url . $function . $sub1 .$urlRest. '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $url . $function . $add1 .$urlRest. '">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' .$url . $function . $add2 . $urlRest.'">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $url. $function . $sub1 .$urlRest. '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $url. $function . $add1 . $urlRest.'">' . $add1 . '</a> &nbsp;';
}
$paginationDisplay = ""; // Initialize the pagination output variable
if($lastPage=='1'){
$paginationDisplay .= '<div class="pagTotal"> Toplam  <strong>' . $productCount . '</strong> Ürün &nbsp;  &nbsp;  &nbsp; </div>';
    $paginationDisplay .= 'Toplam <strong> 1 </strong>sayfa içerisinde 1. sayfayı görmektesiniz. &nbsp;  &nbsp;  &nbsp; ';
}else{
$paginationDisplay = ""; // Replay Initialize the pagination output variable
}


// This code runs only if the last page variable is ot equal to 1, if it is only 1 page we require no paginated links to display
if ($lastPage != "1"){
    // This shows the user what page they are on, and the total number of pages
	$paginationDisplay .= '<div class="pagTotal"> Toplam  <strong>' . $productCount . '</strong> Ürün &nbsp;  &nbsp;  &nbsp; </div>';
    $paginationDisplay .= 'Toplam <strong>' . $lastPage. ' </strong>sayfa içerisinde ' . $pn. '. sayfayı görmektesiniz. &nbsp;  &nbsp;  &nbsp; ';
    // If we are not on page 1 we can place the Back button
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $url. $function .'1' .$urlRest. '">İlk Sayfa</a> ';
        $paginationDisplay .=  '&nbsp;  <a href="' . $url .$function . $previous .$urlRest.'"> <<  Geri</a> ';
    } 
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
		
        $paginationDisplay .=  '&nbsp;  <a href="' . $url . $function . $nextPage .$urlRest.'"> İleri  >> </a> ';
    } 
	
	$paginationDisplay .= ' &nbsp;<a href="' . $url . $function. $lastPage .$urlRest.'"> Son Sayfa</a> &nbsp;  &nbsp;  &nbsp; ';
}





return $paginationDisplay;	
	
	}
	
function paginate_sql($pn,$dynamicSql){
	
	
	$sql=$dynamicSql;
	//$sql=$this->db->query("SELECT * FROM prdcts_tbl ORDER BY prdct_addDate DESC");  //or ASC
    $productCount=$sql->num_rows();
    $url=base_url();


    if($pn!=""){

      $pn=preg_replace('#[^0-9]#i','',$pn);
		}else{

		$pn=1;
		}
		$itemsPerPage=15;
			$lastPage=ceil($productCount/$itemsPerPage);


			if($pn<1){
				$pn=1;

			}elseif($pn>$lastPage){
				$pn=$lastPage;
						}
	
	
	
				$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
				
			$sql2=$this->db->query("SELECT * FROM prdcts_tbl ORDER BY prdct_addDate DESC $limit");
                
				
				
				
	             
	return $sql2;

	}
	
	function paginate_sqlCtgrs($pn,$dynamicSql,$ctgryID){
	
	
	$sql=$dynamicSql;
	//$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgryID' ORDER BY prdct_addDate DESC");  //or ASC
    $productCount=$sql->num_rows();
    $url=base_url();


    if($pn!=""){

      $pn=preg_replace('#[^0-9]#i','',$pn);
		}else{

		$pn=1;
		}
		$itemsPerPage=15;
			$lastPage=ceil($productCount/$itemsPerPage);


			if($pn<1){
				$pn=1;

			}elseif($pn>$lastPage){
				$pn=$lastPage;
						}
	
	
	
				$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
				
			$sql2=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgryID' ORDER BY prdct_addDate DESC $limit");
                
				
				
				
	             
	return $sql2;

	}
	
	
		function paginate_sqlBrnd($pn,$dynamicSql,$brndID){
	
	
	$sql=$dynamicSql;
	//$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgryID' ORDER BY prdct_addDate DESC");  //or ASC
    $productCount=$sql->num_rows();
    $url=base_url();


    if($pn!=""){

      $pn=preg_replace('#[^0-9]#i','',$pn);
		}else{

		$pn=1;
		}
		$itemsPerPage=15;
			$lastPage=ceil($productCount/$itemsPerPage);


			if($pn<1){
				$pn=1;

			}elseif($pn>$lastPage){
				$pn=$lastPage;
						}
	
	
	
				$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
				
			$sql2=$this->db->query("SELECT * FROM prdcts_tbl WHERE brnd_id='$brndID' ORDER BY prdct_addDate DESC $limit");
                
				
				
				
	             
	return $sql2;

	}
	
	function paginate_sqlBrndCtgrs($pn,$dynamicSql,$brndID,$ctgryID){
	
	
	$sql=$dynamicSql;
	
	//$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgryID' ORDER BY prdct_addDate DESC");  //or ASC
    $productCount=$sql->num_rows();
    $url=base_url();


    if($pn!=""){

      $pn=preg_replace('#[^0-9]#i','',$pn);
		}else{

		$pn=1;
		}
		$itemsPerPage=15;
			$lastPage=ceil($productCount/$itemsPerPage);


			if($pn<1){
				$pn=1;

			}elseif($pn>$lastPage){
				$pn=$lastPage;
						}
	
	
	
				$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
				
				
				
			$sql2=$this->db->query("SELECT * FROM prdcts_tbl WHERE brnd_id='$brndID' AND ctgry_id='$ctgryID' ORDER BY prdct_addDate DESC $limit");
                
				
				
				
	             
	return $sql2;

	}
	
	
	function paginate_search($pn,$dynamicSql,$phrase_org,$phrase){
	
	
	$sql=$dynamicSql;
	//$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgryID' ORDER BY prdct_addDate DESC");  //or ASC
    $productCount=$sql->num_rows();
    $url=base_url();


    if($pn!=""){

      $pn=preg_replace('#[^0-9]#i','',$pn);
		}else{

		$pn=1;
		}
		$itemsPerPage=15;
			$lastPage=ceil($productCount/$itemsPerPage);


			if($pn<1){
				$pn=1;

			}elseif($pn>$lastPage){
				$pn=$lastPage;
						}
	
	
	
				$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
				
			
			$sql2=$this->db->query("SELECT * FROM prdcts_tbl WHERE prdct_name LIKE '%$phrase_org%' OR prdct_shortDesc LIKE '%$phrase%' OR brnd_id IN  (SELECT brnd_id FROM brnd_tbl WHERE brnd_name LIKE '%$phrase%') OR ctgry_id IN (SELECT ctgry_id FROM ctgrs_tbl WHERE ctgry_name LIKE '%$phrase%')  OR ctgry_id RLIKE '[1-1]' ORDER BY prdct_addDate DESC");
			
                
				
				
				
	             
	return $sql2;

	}
	
	
	function paginate_sqlCampaign($pn,$dynamicSql){
	
	
	$sql=$dynamicSql;
	//$sql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgryID' ORDER BY prdct_addDate DESC");  //or ASC
    $productCount=$sql->num_rows();
    $url=base_url();


    if($pn!=""){

      $pn=preg_replace('#[^0-9]#i','',$pn);
		}else{

		$pn=1;
		}
		$itemsPerPage=15;
			$lastPage=ceil($productCount/$itemsPerPage);


			if($pn<1){
				$pn=1;

			}elseif($pn>$lastPage){
				$pn=$lastPage;
						}
	
	
	
				$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
				
			$sql2=$this->db->query("SELECT * FROM prdcts_tbl WHERE dscnt_available='yes' ORDER BY prdct_addDate DESC $limit");
                
				
				
				
	             
	return $sql2;

	}
	
	
	
	
	
	
	}
	
	?>