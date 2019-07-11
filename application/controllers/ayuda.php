<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ayuda extends CI_Controller {

	
public function __construct()
{
	parent::__construct();

	$this->load->helper('general_helper');
	$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
	$this->load->model('Programas_model');		
}

public function index()
{
	if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

		$data['carreras_dirigidas']=$this->Programas_model->programas_director_carrera();
		
	elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))):
		
		$data['programas_grado']=$this->Programas_model->programas_grados_dictados_en_un_anio(date('Y')); 
		$data['programas_posgrado']=$this->Programas_model->programas_posgrados_dictados_en_un_anio(date('Y')); 
		$data['programas_ejecutivos']=$this->Programas_model->programas_ejectivos_actualizacion_dictados_en_un_anio(date('Y')); 
		$this->data['notificacion_cursos_cambiados']=$this->Programas_model->cantidad_cursos_modificados();

	endif;	

	$data['vista_head'] = $this->load->view('estructura/head', $data , true);
	$this->load->view('ayuda/ayuda',$data);
}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
