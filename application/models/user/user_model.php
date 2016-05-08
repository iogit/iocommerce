<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model{

 function __construct()  
    {  
        parent::__construct();  
       
    }
	

function register_user($usr_userName, $usr_name, $usr_lastName, $usr_password, $usr_email, $usr_activationCode)

{
$sha1_password=sha1($usr_password);
$query_str="INSERT INTO usr_tbl (usr_userName, usr_name, usr_lastName, usr_password , usr_email, usr_activationCode) VALUES (?,?,?,?,?,?)";

$this->db->query($query_str,array($usr_userName, $usr_name, $usr_lastName, $sha1_password, $usr_email, $usr_activationCode));


}

function confirm_registration($registration_code)

{
$query_str="SELECT usr_id FROM usr_tbl WHERE usr_activationCode=?";


$result=$this->db->query($query_str, $registration_code);
if($result->num_rows()==1){

$query_str="UPDATE usr_tbl SET usr_activated=1 WHERE usr_activationCode=?";
$this->db->query($query_str,$registration_code);
return true;

}else{}
return false;
}




function check_username_exist($usr_userName){

$query_str="SELECT usr_userName from usr_tbl where usr_userName = ?";
$result=$this->db->query($query_str,$usr_userName);

if($result->num_rows()>0){

//username exist in database
return true;
}else{
//username doesnt exist in database
return false;

}

}


function check_email_exist($email){

$query_str="SELECT usr_userName from usr_tbl where usr_email = ?";
$result=$this->db->query($query_str,$email);

if($result->num_rows()>0){

//username exist in database
return true;
}else{
//username doesnt exist in database
return false;

}

}




}


?>