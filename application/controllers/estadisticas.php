<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('general_helper');
		//esta_logueado();

		$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
		$this->load->model('Estadisticas_model');
		$this->load->library('form_validation');

	}

	public function index($carrera)
	{	
		$this->load->view('estadisticas',$data);
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */