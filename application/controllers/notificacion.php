<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificacion extends CI_Controller {

	var $data;

	/**
	 * Index Page for this controller.
	 **/
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('general_helper');


		$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
		$this->load->model('Programas_model');
		//$this->load->model('Notificacion_model');

		if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

			$this->data['carreras_dirigidas']=$this->Programas_model->programas_director_carrera();

		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))):
			
			$this->data['programas_grado']=$this->Programas_model->programas_grados_dictados_en_un_anio(date('Y')); 
			$this->data['programas_posgrado']=$this->Programas_model->programas_posgrados_dictados_en_un_anio(date('Y')); 
			$this->data['programas_ejecutivos']=$this->Programas_model->programas_ejectivos_actualizacion_dictados_en_un_anio(date('Y')); 
			$this->data['notificacion_cursos_cambiados']=$this->Programas_model->cantidad_cursos_modificados();


		endif;
			
	}

	public function index()
	{
		$this->data['notificaciones'] = $this->Notificacion_model->traer_notificaciones_usuario($this->session->userdata('usuario_tesoreria'));

		$this->Notificacion_model->actualizar_visto_notificaciones($this->session->userdata('usuario_tesoreria'));

		if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

			$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);
			$this->load->view('notificacion/notificacion',$this->data);

		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))):
			
			$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);
			$this->load->view('notificacion/notificacion',$this->data);

		endif;
		

	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
