<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Usr_login_model extends CI_Model{

 function __construct()  
    {  
        parent::__construct();  
       
    }
	

function check_login($username,$password)
{
$sha1_password=sha1($password);

$query_str='SELECT usr_id, usr_activated, usr_name, usr_lastName FROM usr_tbl WHERE (usr_userName=? OR usr_email=?) AND usr_password=?';
$result=$this->db->query($query_str, array($username, $username, $sha1_password));

if($result->num_rows()==1){


      
   return array('usr_id' =>$result->row(0)->usr_id, 'usr_activated' =>$result->row(0)->usr_activated,'usr_name' =>$result->row(0)->usr_name, 'usr_lastName' =>$result->row(0)->usr_lastName); 
   

                               }else{

return false;
}



}}
?>