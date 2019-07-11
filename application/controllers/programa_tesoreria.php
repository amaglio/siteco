<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programa_tesoreria extends CI_Controller {

	/**
	 * Index Page for this controller.
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('general_helper');
 
		$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
		$this->load->model('Programas_model');
		$this->load->library('form_validation');

		if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

			$this->data['carreras_dirigidas']=$this->Programas_model->programas_director_carrera();
			
			$this->data['cantidad_profesores']=$this->Programas_model->cantidad_profesores_coordinados();
			$this->data['cantidad_cursos_sigeu']=$this->Programas_model->cantidad_cursos_cargados_sigeu();
			$this->data['cantidad_cursos_confirmados']=$this->Programas_model->cantidad_cursos_confirmados(); 

		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))):
			
			$this->data['programas_grado']=$this->Programas_model->programas_grados_dictados_en_un_anio(date('Y')); 
			$this->data['programas_posgrado']=$this->Programas_model->programas_posgrados_dictados_en_un_anio(date('Y')); 
			$this->data['programas_ejecutivos']=$this->Programas_model->programas_ejectivos_actualizacion_dictados_en_un_anio(date('Y')); 
			$this->data['notificacion_cursos_cambiados']=$this->Programas_model->cantidad_cursos_modificados();


		endif;

		
	}

	//public function index($carrera)
	public function index($c_identificacion,$c_programa,$c_orientacion)
	{	
		//if( $this->Programas_model->permiso_ver_programa($c_identificacion,$c_programa,$c_orientacion) == 0):

			//redirect(base_url()."index.php/home/");

		//else:

			$data['carreras_dirigidas']=$this->Programas_model->programas_director_carrera();
			$data['cantidad_profesores']=$this->Programas_model->cantidad_profesores_coordinados();
			$data['cantidad_cursos']=$this->Programas_model->cantidad_cursos_cargados_sigeu();
			$data['cantidad_cursos_confirmados']=$this->Programas_model->cantidad_cursos_confirmados();

			
			$data['datos_programa'] = $this->Programas_model->datos_programa($c_identificacion,$c_programa,$c_orientacion);	
			
			//$row_programa = $datos_programa->row();

			$data['vista_head'] = $this->load->view('estructura/head', $data , true);
			

			$this->load->view('programa',$data);

		//endif;
		 
	}

	/*
		Se llama desde los años 
	*/

	function informacion_anio($anio,$c_identificacion,$c_programa,$c_orientacion)
	{
		
		$data['plan_estudio_programa']=$this->Programas_model->plan_estudio_total(	$c_identificacion, 
																					$c_programa, 
																					$c_orientacion,
																					$anio
																				); 

		$data['cursos_cambiados']=$this->Programas_model->cursos_cambiados_programa(	$c_identificacion, 
																						$c_programa, 
																						$c_orientacion,
																						$anio
																					); 


		if($c_identificacion==3):

			// Con clases !

			$data['cursos_asignados']=$this->Programas_model->cursos_asignados_programa_ejepac(	$c_identificacion, 
																							$c_programa, 
																							$c_orientacion,
																							$anio
																						); 

		else:

			$data['cursos_asignados']=$this->Programas_model->cursos_asignados_programa(	$c_identificacion, 
																							$c_programa, 
																							$c_orientacion,
																							$anio
																						); 
		endif;



		$data['cantidad_cursos_confirmados']=$this->Programas_model->cursos_confirmados_programa(	
																									$c_identificacion, 
																									$c_programa, 
																									$c_orientacion,
																									$anio
																								); 

		$this->load->view('informacion_programa',$data);


	}





	
}
