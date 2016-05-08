<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Product_details extends CI_model{

function getDetails($productDet){


$data["id"]=$productDet;
$this->load->view("product",$data);

}

?>