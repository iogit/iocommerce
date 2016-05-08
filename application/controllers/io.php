<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Io extends CI_Controller {

   function __construct()  
    {  
        parent::__construct(); 
        	$this->view_data["base_url"]=base_url();	
			
			/*Kills the session entirely includes backwarding the page*/
			$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			$this->output->set_header('Pragma: no-cache');
			$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

/*
First function for controller.It will run first anyway
*/
function thumb()
{


$newname=$this->input->get('thumb');

$config['image_library'] = 'gd2';
$config['source_image'] = './io_images/product_images/'.$newname.'.jpg';
$config['new_image'] = './io_images/product_images/thumbs_xs/'.$newname.'_xs.jpg';
$config['create_thumb'] = false;
$config['maintain_ratio'] = TRUE;
$config['width'] = 140;
$config['height'] = 140;

$this->load->library('image_lib', $config);

$this->image_lib->resize();
$this->inventory();
}
function index()
{
$this->home();

}

/*
Search function for main page
*/
public function s(){
$searchData = array(  
       'phrase_org'  => "",  
       'phrase'=> ""
      );  
$this->session->unset_userdata($searchData);
$this->search();
}


public function search()
{

$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}

$this->load->model("search_model");

$pn=$this->input->get('pn');


$phrase_org = $this->input->post('phrase');
$phrase_raw=$phrase_org;
if($phrase_org!=""){

$this->load->model("support");
$phrase=$this->support->replace_tr($phrase_org);

$searchData = array(  
       'phrase_org'  => $phrase_org,  
       'phrase'=> $phrase,
       'phrase_raw'=> $phrase_raw,
      );  
$this->session->set_userdata($searchData);  
}else{
$phrase_org=$this->session->userdata('phrase_org');
$phrase=$this->session->userdata('phrase');
$phrase_raw=$this->session->userdata('phrase_raw');


}


$brnd="";
$ctgry_name='';





if ($phrase==-1 || $phrase_org==-1){
	
	$this->load->model("support");
    $data["results"]=$this->support->searchErr(); 
	
}else{

$phrase=$this->cleantexttr($phrase_org);
$phrase_org=$this->cleantexteng($phrase_raw);
/*
echo $phrase_raw.'<p>';
echo $phrase.'<p>';
echo $phrase_org;
exit();*/

$phrasearray = explode("-", $phrase);




$dynamicSql=$this->db->query("SELECT * FROM prdcts_tbl WHERE prdct_name LIKE '%$phrase_org%' OR prdct_shortDesc LIKE '%$phrase%' OR brnd_id IN  (SELECT brnd_id FROM brnd_tbl WHERE brnd_name LIKE '%$phrase%') OR  ctgry_id IN (SELECT ctgry_id FROM ctgrs_tbl WHERE ctgry_name LIKE '%$phrase%') OR ctgry_id RLIKE '[1-1]' ORDER BY prdct_addDate DESC");


 
$check=$dynamicSql->num_rows();
if($check!=0){





//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$this->load->model("pagination"); 
$homeUrl='search?pn='; 
$paginated=$this->pagination->paginate($pn,$dynamicSql,$homeUrl,$ctgry_name,$brnd);
$paginated_sql=$this->pagination->paginate_search($pn,$dynamicSql,$phrase_org,$phrase);

//load the model_get.php file from the models
$this->load->model("get_products");
$titleLink="<div class='titleArrow'></div><div class='captionOne'>Arama Sonuçları </div><div class='titleArrow'></div><div class='captionOne'>".$check." sonuç bulundu </div>";
$data["results"]=$this->get_products->getAll($titleLink,$paginated,$paginated_sql); 
}
else{
$this->load->model("support");
$data["results"]=$this->support->noProducts(); 

}
}


$data['title']="Ana Sayfa | Orakli Eczanesi";
//$this->load->view("io_header",$data);
//$this->load->view("io_topmenu");
$this->load->view("io_cop/io_header",$data);

$data["bannerpicurl"]="childonebgmodels.jpg";
$this->load->view("io_cop/io_topmenu",$data);

$this->load->view("io_middle",$data);
//$this->load->view("io_caroufredsel",$data);
$this->load->view("io_productlist",$data);
$this->load->view("io_footer");	


//$data['results'] = $this->search_model->getSearchResults($phrase,$phrase_org);

//$data["deneme"]=$phrase; // ** for test the values
//$this->load->view('deneme', $data);  //** for test
	

}
/*
Search function for admin 
*/

public function search_inventory()
{
$this->load->model("search_model");

$phrase_org = $this->input->post('phrase');
$this->load->model("support");
$phrase=$this->support->replace_tr($phrase_org);

$data['product_list'] = $this->search_model->getSearchResultsInv($phrase,$phrase_org);


$this->load->view("storeadmin/inventory_list",$data);



//$data["deneme"]=$phrase; // ** for test the values
//$this->load->view('deneme', $data);  //** for test
	
}

function childone(){

$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}
$brnd="";
$ctgry_name='';
$dynamicSql=$this->db->query("SELECT * FROM prdcts_tbl ORDER BY prdct_addDate DESC");
$dynamicSqlView=$this->db->query("SELECT * FROM prdcts_tbl ORDER BY prdct_view DESC");
$pn=$this->input->get('pn');

//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$this->load->model("pagination"); 
$homeUrl='home?pn='; 
$paginated=$this->pagination->paginate($pn,$dynamicSql,$homeUrl,$ctgry_name,$brnd);
$paginated_sql=$this->pagination->paginate_sql($pn,$dynamicSql);

//load the model_get.php file from the models
$this->load->model("get_products");
$this->load->model("productnew");
$this->load->model("productpopular");

$titleLink="<div class='titleArrow'></div><div class='captionOne'>Tüm Ürünler</div>";
$data["results"]=$this->get_products->getAll($titleLink,$paginated,$paginated_sql); 
$data['productnew']=$this->productnew->productbanner($dynamicSql); 
$data['productpopular']=$this->productpopular->productbanner($dynamicSqlView); 
$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_cop/io_header",$data);

$data["bannerpicurl"]="childonebgeye.jpg";
$this->load->view("io_cop/io_topmenu",$data);
$this->load->view("io_middle",$data);

$this->load->view("io_productlist",$data);
$this->load->view("io_footer");	


}
/*
Home page function
*/
public function home(){

$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}
$brnd="";
$ctgry_name='';
$dynamicSql=$this->db->query("SELECT * FROM prdcts_tbl ORDER BY prdct_addDate DESC");
$dynamicSqlView=$this->db->query("SELECT * FROM prdcts_tbl ORDER BY prdct_view DESC");
$pn=$this->input->get('pn');

//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$this->load->model("pagination"); 
$homeUrl='home?pn='; 
$paginated=$this->pagination->paginate($pn,$dynamicSql,$homeUrl,$ctgry_name,$brnd);
$paginated_sql=$this->pagination->paginate_sql($pn,$dynamicSql);

//load the model_get.php file from the models
$this->load->model("get_products");
$this->load->model("productnew");
$this->load->model("productpopular");

$titleLink="<div class='titleArrow'></div><div class='captionOne'>Tüm Ürünler</div>";
$data["results"]=$this->get_products->getAll($titleLink,$paginated,$paginated_sql); 
$data['productnew']=$this->productnew->productbanner($dynamicSql); 
$data['productpopular']=$this->productpopular->productbanner($dynamicSqlView); 



$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_header",$data);
$this->load->view("io_topmenu");
$this->load->view("io_middle",$data);
$this->load->view("io_caroufredsel",$data);
$this->load->view("io_caroufredsel_brands",$data);
/*$this->load->view("io_productlist",$data);*/
$this->load->view("io_footer");	

}


/*
Search function for specific product group
function ctgrs()
*/
public function c(){

$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}

$this->load->model("support"); 
$pn=$this->input->get('pn');
$brnd_name="";
$ctgry_name=$this->input->get('c');

$ctgry_name=$this->cleanurl($ctgry_name);

$ctgrsUrl='c?pn='; 
$ctgry_ID=$this->support->ctgryID($ctgry_name); 
$dynamicSql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgry_ID'");

$ctgryName=$this->support->ctgryName($ctgry_ID);
//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$check=$dynamicSql->num_rows();
if($check!=0){
$this->load->model("pagination");  
$paginated=$this->pagination->paginate($pn,$dynamicSql,$ctgrsUrl,$ctgry_name,$brnd_name);
$paginated_sql=$this->pagination->paginate_sqlCtgrs($pn,$dynamicSql,$ctgry_ID);
$data["filtered_cab"]=$this->support->getAll_filtered_brands($dynamicSql,$ctgry_name);


//$result = array_unique($yazdir);
//print_r($result);
//exit();
//load the model_get.php file from the models
$this->load->model("get_products");





//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$titleLink="<div class='titleArrow'></div><div class='captionOne'>".$ctgryName."</div>";
$data["results"]=$this->get_products->getAll($titleLink,$paginated,$paginated_sql); 
}else{
$this->load->model("support");
$data["filtered_cab"]='';
$data["results"]=$this->support->noProducts(); 

}


$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_cop/io_header",$data);
$data["bannerpicurl"]=$this->support->getCategoryPicture($ctgry_ID);
$this->load->view("io_cop/io_topmenu",$data);
$this->load->view("io_middle",$data);
//$this->load->view("io_caroufredsel",$data);
$this->load->view("io_productlist_filter",$data);
$this->load->view("io_productlist",$data);
$this->load->view("io_footer");	

}

/*
Search function for specific brand
function brnd()
*/
public function b(){
	
$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}

$this->load->model("support"); 
$pn=$this->input->get('pn');
$ctgry_name="";
$brnd_name=$this->input->get('b');

$brnd_name=$this->cleanurl($brnd_name);

$brndUrl='b?pn='; 
$brnd_ID=$this->support->brndID($brnd_name); 
$dynamicSql=$this->db->query("SELECT * FROM prdcts_tbl WHERE brnd_id='$brnd_ID'");
$brndName=$this->support->brndName($brnd_ID);
//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]

$check=$dynamicSql->num_rows();
if($check!=0){
$this->load->model("pagination");  
$paginated=$this->pagination->paginate($pn,$dynamicSql,$brndUrl,$ctgry_name,$brnd_name);
$paginated_sql=$this->pagination->paginate_sqlBrnd($pn,$dynamicSql,$brnd_ID);
$data["filtered_cab"]=$this->support->getAll_filtered_categories($dynamicSql,$brnd_name);

//load the model_get.php file from the models
$this->load->model("get_products");





//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$titleLink="<div class='titleArrow'></div><div class='captionOne'>".$brndName."</div>";
$data["results"]=$this->get_products->getAll($titleLink,$paginated,$paginated_sql); 

}else{
$this->load->model("support");
$data["filtered_cab"]='';
$data["results"]=$this->support->noProducts(); 

}


$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_cop/io_header",$data);
$data["bannerpicurl"]="childonebg.jpg";
$this->load->view("io_cop/io_topmenu",$data);
$this->load->view("io_middle",$data);
//$this->load->view("io_caroufredsel",$data);
$this->load->view("io_productlist_filter",$data);
$this->load->view("io_productlist",$data);
$this->load->view("io_footer");	


}

/*
Search function for discount products
*/
public function dscnt(){

$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}

$this->load->model("support"); 
$pn=$this->input->get('pn');
$ctgry_name="";
$brnd_name="";
$dscntUrl='dscnt?pn='; 

$dynamicSql=$this->db->query("SELECT * FROM prdcts_tbl WHERE dscnt_available='yes' ORDER BY prdct_addDate DESC"); 

//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$check=$dynamicSql->num_rows();
if($check!=0){
$this->load->model("pagination");  
$paginated=$this->pagination->paginate($pn,$dynamicSql,$dscntUrl,$ctgry_name,$brnd_name);
$paginated_sql=$this->pagination->paginate_sqlCampaign($pn,$dynamicSql);

//load the model_get.php file from the models
$this->load->model("get_products");





//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$titleLink="<div class='titleArrow'></div><div class='captionOne'>Kampanyalı Ürünler</div>";
$data["results"]=$this->get_products->getAll($titleLink,$paginated,$paginated_sql); 

}else{

$data["results"]="Listelenecek urun bulunmamaktadir";

}

//$list_specific=$this->input->get('type');

//load the model_get.php file from the models


//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]




$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_header",$data);
$this->load->view("io_topmenu");
$this->load->view("io_middle",$data);
//$this->load->view("io_caroufredsel",$data);
$this->load->view("io_productlist",$data);
$this->load->view("io_footer");	

}
/*###################################Category & Brand Filter start##############################################################3*/

public function cb(){


$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}

$this->load->model("support"); 
$pn=$this->input->get('pn');
$brnd_name="";
$ctgry_name=$this->input->get('c');
$brnd_name=$this->input->get('b');
$ftype=$this->input->get('ftype');


$ctgry_name=$this->cleanurl($ctgry_name);
$brnd_name=$this->cleanurl($brnd_name);


$ctgrsUrl='cb?pn='; 
$ctgry_ID=$this->support->ctgryID($ctgry_name); 
$brnd_ID=$this->support->brndID($brnd_name); 
$dynamicSql=$this->db->query("SELECT * FROM prdcts_tbl WHERE ctgry_id='$ctgry_ID' AND brnd_id='$brnd_ID'");

$ctgryName=$this->support->ctgryName($ctgry_ID);
$brndName=$this->support->brndName($brnd_ID);
//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]

$check=$dynamicSql->num_rows();
if($check!=0){


$this->load->model("pagination");  
$paginated=$this->pagination->paginate($pn,$dynamicSql,$ctgrsUrl,$ctgry_name,$brnd_name);
$paginated_sql=$this->pagination->paginate_sqlBrndCtgrs($pn,$dynamicSql,$brnd_ID,$ctgry_ID);
if($ftype=='c'){
$data["filtered_cab"]=$this->support->getAll_filtered_categories($dynamicSql,$brnd_name);
}else{$data["filtered_cab"]=$this->support->getAll_filtered_brands($dynamicSql,$ctgry_name);
}

//$result = array_unique($yazdir);
//print_r($result);
//exit();
//load the model_get.php file from the models
$this->load->model("get_products");





//now model_get file run the function 'getData' function in it 
//send the ("home") value to this function 
//load the result to ["results"]
$titleLink="<div class='titleArrow'></div><div class='captionOne'>".$ctgryName."</div>";
$data["results"]=$this->get_products->getAll($titleLink,$paginated,$paginated_sql); 
}else{

$data["filtered_cab"]='';
$this->load->model("support");
$data["results"]=$this->support->noProducts(); 

}


$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_cop/io_header",$data);
$data["bannerpicurl"]="childonebgeye.jpg";
$this->load->view("io_cop/io_topmenu",$data);
$this->load->view("io_middle",$data);
//$this->load->view("io_caroufredsel",$data);
$this->load->view("io_productlist_filter",$data);
$this->load->view("io_productlist",$data);
$this->load->view("io_footer");	

}

/*###################################Category & Brand Filter stop##############################################################3*/


/*function detail*/
public function d()
{


        
   

$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}

//$data["prdct_id"]=$this->input->get('id');
$url_check_id=$this->input->get('id');
$det=$url_check_id;



$data["prdct_id"]=$this->cleanurl($url_check_id);
$det=$this->cleanurl($url_check_id);




$this->load->model("detail");
$data["results"]=$this->detail->det($det);

$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_cop/io_header",$data);

$data["bannerpicurl"]="childonebgeye.jpg";
$this->load->view("io_cop/io_topmenu",$data);
$this->load->view("io_middle",$data);
//$this->load->view("io_caroufredsel",$data);
$this->load->view("io_productlist",$data);
$this->load->view("io_footer");	



}
function cleanurl($str, $replace=array(), $delimiter='-')
{
setlocale(LC_ALL, 'en_US.UTF8');

	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;

}

public function cleantexteng($str, $replace=array(), $delimiter='-')
{
setlocale(LC_ALL, 'en_US.UTF8');


	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;

}

public function cleantexttr($str, $replace=array(), $delimiter='-')
{

  
	///( ! preg_match("/^[a-z\+ü+Ü+ğ+Ğ+ı+İ+ö+Ö+ç+Ç+ş+Ş.\s-]{2,}$/i", $str))
	 $clean = preg_replace('|[^a-z0-9çÇğĞıİöÖşŞüÜ \-@]|i', '', $str);
	 
	
	// $clean = strtolower(trim($clean, '-'));
	 
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
    $clean = strip_tags($clean);

	return $clean;

}






public function cart()
{
$data['username']=$this->session->userdata('user_name');
if($this->session->userdata('logged_in')){
$data["logout"]="Logout";
$data["login"]="";
}else
{
$data["username"]="Visitor";
$data["logout"]="";
$data["login"]="Login";
}
$this->load->view("io_header");
$this->load->view("io_nav",$data);
$this->load->view("cart",$data);

$this->load->view("io_footer");





}

public function intro(){

$this->load->view("storeadmin/index");

}




public function send_email(){

$this->load->library("form_validation");

$this->form_validation->set_rules("fullName","Full Name", "required|alpha|xss_clean");  //capital letter or lower case letter
$this->form_validation->set_rules("eMail","E-mail address", "required|valid_email|xss_clean");
$this->form_validation->set_rules("message","Message", "required|xss_clean");

if($this->form_validation->run() == FALSE){
$data["message"]="";
$this->load->view("io_header");
$this->load->view("io_nav");
$this->load->view("content_contact",$data);
$this->load->view("io_footer");

}

else{
/*
$config=array(

'protokol'=>'smtp',
'smtp_host'=>'ssl://smtp.googlemail.com',
'smtp_port'=>465,
'smtp_user'=>'sweedenibo@gmail.com',
'smtp_pass'=>'24952495',
);

*/

$data["message"]="The e-mail has been successfuly send";
$this->load->library("email");

$this->email->from(set_value("eMail"), set_value("fullName"));
$this->email->to("iorakli@hotmail.com");
$this->email->subject("Message from out form");
$this->email->message(set_value("Message"));
$this->email->send();


echo $this->email->print_debugger();

$this->load->view("io_header");
$this->load->view("io_nav");
$this->load->view("content_contact",$data);
$this->load->view("io_footer");

}




}


public function master(){

$this->load->view("storeadmin/admin_login");
}



public function inventory(){

$data["product_list"]="";
$this->load->view("storeadmin/inventory_list",$data);
}

public function inventory_edit(){

$this->load->view("storeadmin/inventory_edit");
}

public function test(){

$this->load->view("testurl");
}
/* This Section For user Registration Start */

public function order1()
{


$this->load->view("order/order_view1",$this->view_data);

}

function r()
{




$this->load->library('form_validation');

$this->form_validation->set_rules('username','Kullanıcı Adı','trim|required|alpha_numeric|min_length[6]|xss_clean|strtolower|callback_userNameNotExists');
$this->form_validation->set_rules('name','Ad','trim|required|callback_turkish_chars|min_length[2]|xss_clean');
$this->form_validation->set_rules('lastName','Soyad','trim|required|callback_turkish_chars|min_length[2]|xss_clean');
$this->form_validation->set_rules('email','E-posta','trim|required|min_length[6]|xss_clean|valid_email|callback_emailNotExists');
$this->form_validation->set_rules('password','Şifre','trim|required|alpha_numeric|min_length[6]|xss_clean');
$this->form_validation->set_rules('password_conf','Şifre(Tekrar)','trim|required|alpha_numeric|min_length[6]|matches[password]|xss_clean');
$this->form_validation->set_rules('captcha','Güvenlik kodu','trim|required|alpha_numeric|min_length[7]|xss_clean|callback_captcha_valid');
$this->form_validation->set_message('required', '%s bilginizi yazmayı unuttunuz.');
$this->form_validation->set_message('valid_email', 'Geçerli bir e-posta adresi giriniz.');
$this->form_validation->set_message('alpha_numeric', 'Türkçe karakter ve boşluk kullanmayınız !');
$this->form_validation->set_message('min_length','%s bilgisi en az %s karakterden oluşmalıdır.');
$this->form_validation->set_message('turkish_chars','Geçerli bir %s giriniz.');
$this->form_validation->set_message('matches','Şifreniz tekrarı ile uyuşmuyor.');
$this->form_validation->set_message('captcha_valid','Güvenlik kodunu hatalı girdiniz.');















if($this->form_validation->run()==FALSE)
{
$this->load->helper('captcha');
$randWord=$this->_random_string(6);
$captcha =array(
'word' => strtoupper($randWord),
'img_path' => './captcha/',
'img_url' => base_url().'captcha/',
'font_path' => './fonts/impact.ttf',
'img_width' => '160',
'img_height' => '50',
'expiration' => '180',
'time'=>time()
);
$this->session->set_userdata('captchaWord', $captcha['word']);



$img=create_captcha($captcha);
$data['image']=$img['image'];

$value=array(
'time'=>$captcha['time'],
'ip_address'=>$this->input->ip_address(),
'word'=>$captcha['word']
);
//insert the valuesin the captcha table
$this->db->insert('captcha_tbl',$value);

$expire=$captcha['time']- $captcha['expiration'];
//delete expired captchas
$this->db->where('time <',$expire);
$this->db->delete('captcha_tbl');



$data["captchaval"]=$captcha['word'];
$data["loginerror"]="";
$data["error_server_val"]="server_side_val";
$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("header/io-header-signin",$data);
$this->load->view('storeuser/view_register',$data);
$this->load->view("io_footer");
//hasnt been run or there are validation errors

}else{

//everything is good = process the form = write the data into the registration


$username=$this->input->post("username");
$name=$this->input->post("name");
$lastName=$this->input->post("lastName");
$email=$this->input->post("email");
$password=$this->input->post("password");

$activation_code=$this->_random_string(10);

$this->load->model('user/user_model');
$this->user_model->register_user($username, $name, $lastName, $password, $email, $activation_code);


//email confirmation 
$this->load->library('email');
$this->email->from('iorakli@hotmail.com','Al');
$this->email->to($email);
$this->email->subject("Registration Confirmation");
$this->email->message("Please click this link to activate your account".anchor('http://localhost/ecommerce/register_confirm/'.$activation_code.'confirmation'));

echo "Please click this link to activate your account".anchor('http://localhost/ecommerce/register_confirm/'.$activation_code)."confirmation";
//put conformation message

}
}



public function turkish_chars($str)
	{
		if ( ! preg_match("/^[a-z\+ü+Ü+ğ+Ğ+ı+İ+ö+Ö+ç+Ç+ş+Ş.\s-]{2,}$/i", $str))
		{
			
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
public function captcha_valid($code)
{

$captcha_org = $this->session->userdata('captchaWord');

if(strcmp(strtoupper($captcha_org),strtoupper($code)) == 0){

return TRUE;
}else
{

return FALSE;
}


}
	
function emailNotExists($email){

$this->load->model('user/user_model');
$this->form_validation->set_message('emailNotExists','<strong>"'.$email.'" </strong><br/>Bu E-posta adresi kullanılmaktadır veya üyelik kurallarına uymamaktadır. Lütfen E-posta adresinizi güncelleyiniz.');
if($this->user_model->check_email_exist($email))
{
return false;

}else{

return true;
}


}


function userNameNotExists($username){

$this->load->model('user/user_model');
$this->form_validation->set_message('userNameNotExists','<strong>"'.$username.'" </strong> kullanıcı adı kullanılmaktadır.');
if($this->user_model->check_username_exist($username))
{
return false;

}else{

return true;
}


}

function _random_string($length)
{
$len=$length;
$base='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$max=strlen($base)-1;
$activatecode='';
mt_srand((double)microtime()*1000000);
while(strlen($activatecode)<$len+1)
$activatecode.=$base{mt_rand(0,$max)};
return $activatecode;
}


function register_confirm()
{



$this->load->model('user/user_model');
$registration_code=$this->uri->segment(2);

if($registration_code=="")
{
echo "Error No Registration Code In URL";
exit();
}else{

$registration_confirmed=$this->user_model->confirm_registration($registration_code);

if($registration_confirmed){
echo "Success";
}else{
echo "Not Success";
}



}
}



/* This Section For user Registration End */




/* This Section For user Login Start */

function ul()

{
$this->session->set_flashdata('login_error',FALSE);

$data["loginerror"]="";
$data["messageusername"]="";
$data["messagepassword"]="";
$data["fieldcheckname"]='text';
$data["fieldcheckpass"]='text';

$data["wherefocus"]="#username";
$data["errorfieldusername"]='';
$data["errorfieldpassword"]='';
$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_header",$data);

$this->load->view('storeuser/view_usr_login',$data);
$this->load->view("io_footer");	



}

function l()

{
$this->form_validation->set_rules('username','Kullanıcı adı','required|trim|max_length[50]|xss_clean');
$this->form_validation->set_rules('password','Password','required|trim|max_length[200]|xss_clean');
$this->form_validation->set_message('required','Your custom message here');




if($this->form_validation->run()==FALSE){

$username=$this->input->post("username");
$password=$this->input->post("password");

if($username=="" && $password=="")
{
$data["fieldcheckname"]='err';
$data["fieldcheckpass"]='text';

$data["wherefocus"]="#username";
$data["errorfieldusername"]='error';
$data["errorfieldpassword"]='';
$data["messageusername"]="Lütfen kullanıcı adınızı veya e-posta adresinizi giriniz.";
$data["messagepassword"]="";

}elseif($username=="" && $password!=""){
$data["fieldcheckname"]='err';
$data["fieldcheckpass"]='text';
$data["wherefocus"]="#username";
$data["errorfieldusername"]='error';
$data["errorfieldpassword"]='';
$data["messageusername"]="Kullanici adi bos birakilamaz";
$data["messagepassword"]="";

}elseif($username!="" && $password==""){
$data["fieldcheckname"]='text';
$data["fieldcheckpass"]='err';
$data["wherefocus"]="#password";
$data["errorfieldusername"]='';
$data["errorfieldpassword"]='error';
$data["messageusername"]="";
$data["messagepassword"]='"Şifreniz" alanını boş bıraktınız.';

}
$data["loginerror"]="";
$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_header",$data);
$this->load->view('storeuser/view_usr_login',$data);
$this->load->view("io_footer");



}
else
{


$this->load->model('user/usr_login_model');

extract($_POST);
//echo 'username';
//echo 'password';
//this extract section is the same with below

//$username=$this->input->post('username');
//$password=$this->input->post('password');

$array_user=$this->usr_login_model->check_login($username,$password);

 $user_id=$array_user["usr_id"];
 $user_name=$array_user["usr_name"];
 $user_lastName=$array_user["usr_lastName"];
 $session_name=$user_name.' '.$user_lastName;
 
 $user_activated=$array_user["usr_activated"];


if(!$user_id){

//$this->session->set_flashdata('login_error',TRUE);
$data["fieldcheckname"]='error';
$data["fieldcheckpass"]='error';
$data["wherefocus"]="";
$data["errorfieldusername"]='';
$data["errorfieldpassword"]='error';
$data["messageusername"]="";
$data["messagepassword"]='';
$data["loginerror"]='Geçersiz Kullanıcı Adı ve/veya Şifre. Lütfen bilgilerinizi kontrol ediniz';

$data['title']="Ana Sayfa | Orakli Eczanesi";
$this->load->view("io_header",$data);
$this->load->view('storeuser/view_usr_login',$data);
$this->load->view("io_footer");

}else{
if($user_activated==0){

echo "activation error";
}
else{
$newdata = array(  
       'user_id'  => $user_id,  
       'user_name'=> $session_name,
       'logged_in' => TRUE  
      );  
$this->session->set_userdata($newdata);  


redirect('index');
}
}



}

}

function logout()
{

$this->session->unset_userdata('logged_in');
$data = array();
$this->session->set_userdata($data);
$this->session->sess_destroy(); 
$this->home();





}










/* This Section For user Login End */








}





























