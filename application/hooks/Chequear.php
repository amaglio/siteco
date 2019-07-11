<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed'); 

class Chequear extends CI_Controller
{
	 	
	public function check_login()
	{	
		$CI =& get_instance();

		
		!$CI->load->library('session') ? $CI->load->library('session') : false;
		!$CI->load->helper('url') ? $CI->load->helper('url') : false;


		if($CI->uri->segment(1) == 'login' && $CI->session->userdata('usuario_tesoreria') == true)
        {
 
            //redirect(base_url('index.php/home'));
 
        }else if($CI->session->userdata('usuario_tesoreria') == false && $CI->uri->segment(1) != 'login')
        {
 
        	redirect(base_url('index.php/login'));
 
        }

	}
}
/*
/end hooks/home.php
*/