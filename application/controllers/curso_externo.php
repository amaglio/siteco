<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curso_externo extends CI_Controller {

var $data;

public function __construct()
{
	parent::__construct();

	$this->load->helper('general_helper');

	$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
	$this->load->model('Programas_model');
	$this->load->model('Curso_externo_model');

	//$this->output->enable_profiler(TRUE);

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
	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);

	$this->data['cursos_externos']=$this->Curso_externo_model->traer_cursos_externos();
	$this->data['mensaje'] = $this->session->flashdata('mensaje');

	$this->load->view('curso_externo/index',$this->data);
}

public function ver_curso($id_curso)
{
	if(!isset($id_curso))
		redirect(base_url()."index.php/home/");

	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);

	$this->data['mensaje'] = $this->session->flashdata('mensaje');

	$this->data['informacion_curso_externo']=$this->Curso_externo_model->traer_informacion_curso_externo($id_curso);
	$this->data['profesores_curso_externo']=$this->Curso_externo_model->traer_profesores_curso_externo($id_curso);

	$this->load->view('curso_externo/ver_curso',$this->data);
}

public function ver_profesor($id_profesor_curso)
{
	if(!isset($id_profesor_curso))
		redirect(base_url()."index.php/home/");

	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);

	$this->data['mensaje'] = $this->session->flashdata('mensaje');

	$this->data['informacion_profesor_curso']=$this->Curso_externo_model->traer_informacion_profesor_curso($id_profesor_curso);


	$this->load->view('curso_externo/ver_profesor_curso',$this->data);
}

public function cargar_curso_externo()
{

	if ($this->form_validation->run('cargar_curso_externo') == FALSE): // INVALIDO

		chrome_log("NO PASO VALIDACION");
		$this->session->set_flashdata('mensaje', 'No paso validacion');

	else: // VALIDO 

		chrome_log("PASO VALIDACION");

		if( $this->Curso_externo_model->agregar_curso_externo($this->input->post()) ): // INGRESO CORRECTAMENTE

			$this->session->set_flashdata('mensaje', 'Curso agregado exitosamente');
			chrome_log("curso_agregado");

		else:  

			$this->session->set_flashdata('mensaje', 'Erro al agregar el curso, intente mas tarde');
			chrome_log("curso no agregado");

		endif;


	endif;

	redirect('curso_externo/index','refresh');

}

public function editar_curso_externo()
{

	if ($this->form_validation->run('cargar_curso_externo') == FALSE): // INVALIDO

		chrome_log("NO PASO VALIDACION");
		$this->session->set_flashdata('mensaje', 'No paso validacion');

	else: // VALIDO 

		chrome_log("PASO VALIDACION");

		if( $this->Curso_externo_model->editar_curso_externo($this->input->post()) ): // INGRESO CORRECTAMENTE

			$this->session->set_flashdata('mensaje', 'Curso editado exitosamente');
			chrome_log("curso_agregado");

		else:  

			$this->session->set_flashdata('mensaje', 'Erro al editar el curso, intente mas tarde');
			chrome_log("curso no agregado");

		endif;


	endif;

	redirect('curso_externo/ver_curso/'.$this->input->post('id_curso_externo'),'refresh');

}


public function eliminar_curso_externo()
{

	if ($this->form_validation->run('eliminar_curso_externo') == FALSE): // INVALIDO

		chrome_log("NO PASO VALIDACION");
		$this->session->set_flashdata('mensaje', 'No paso validacion');
		$return['error'] = TRUE;

	else: // VALIDO 

		chrome_log("PASO VALIDACION");

	 
		if( $this->Curso_externo_model->eliminar_curso_externo($this->input->post()) ): // INGRESO CORRECTAMENTE

			$this->session->set_flashdata('mensaje', 'Curso eliminado exitosamente');
			$return['error'] = FALSE;

		else:  

			$this->session->set_flashdata('mensaje', 'Erro al eliminar el curso, intente mas tarde');
			$return['error'] = TRUE;

		endif; 


	endif;

	print json_encode($return);
}


public function cargar_profesor_curso()
{

	if ($this->form_validation->run('cargar_profesor_curso') == FALSE): // INVALIDO

		chrome_log("NO PASO VALIDACION");
		$this->session->set_flashdata('mensaje', 'No paso validacion');

	else: // VALIDO 

		chrome_log("PASO VALIDACION");

	 
		if( $this->Curso_externo_model->cargar_profesor_curso($this->input->post()) ): // INGRESO CORRECTAMENTE

			$this->session->set_flashdata('mensaje', 'Profesor agregado exitosamente');
			chrome_log("curso_agregado");

		else:  

			$this->session->set_flashdata('mensaje', 'Erro al agregar el Profesor, intente mas tarde');
			chrome_log("curso no agregado");

		endif; 


	endif;

	redirect('curso_externo/ver_curso/'.$this->input->post('id_curso_externo'),'refresh');

}


public function eliminar_profesor_curso()
{

	if ($this->form_validation->run('eliminar_profesor_curso') == FALSE): // INVALIDO

		chrome_log("NO PASO VALIDACION");
		$this->session->set_flashdata('mensaje', 'No paso validacion');
		$return['error'] = TRUE;

	else: // VALIDO 

		chrome_log("PASO VALIDACION");

	 
		if( $this->Curso_externo_model->eliminar_profesor_curso($this->input->post()) ): // INGRESO CORRECTAMENTE

			$this->session->set_flashdata('mensaje', 'Profesor eliminado exitosamente');
			$return['error'] = FALSE;

		else:  

			$this->session->set_flashdata('mensaje', 'Erro al agregar el Profesor, intente mas tarde');
			$return['error'] = TRUE;

		endif; 


	endif;

	print json_encode($return);
}


public function editar_profesor_curso()
{

	if ($this->form_validation->run('editar_profesor_curso') == FALSE): // INVALIDO

		chrome_log("NO PASO VALIDACION");
		$this->session->set_flashdata('mensaje', 'No paso validacion');

	else: // VALIDO 

		chrome_log("PASO VALIDACION");

	 
		if( $this->Curso_externo_model->editar_profesor_curso($this->input->post()) ): // INGRESO CORRECTAMENTE

			$this->session->set_flashdata('mensaje', 'Profesor editado exitosamente');
			chrome_log("profesor editado");

		else:  

			$this->session->set_flashdata('mensaje', 'Erro al editar el Profesor, intente mas tarde');
			chrome_log("profesor editado");

		endif; 


	endif;

	redirect('curso_externo/ver_profesor/'.$this->input->post('id_profesor_curso'),'refresh');

}


public function ajax_empresa()
{	
	$buscar = $this->input->get('term');

	if( isset($buscar) && strlen($buscar) > 2 )
	{
		$buscar = strtoupper($buscar);
		$buscar = str_replace(" ", "%", $buscar);
		$buscar = str_replace("ñ", "Ñ", $buscar);

		$query=$this->db->query((utf8_decode("	  SELECT emp.N_ID_EMPRESA as id,  emp.d_empresa as value
												  FROM 
												    empresas emp
												  WHERE
												    	( TRANSLATE(upper(emp.d_empresa),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '%$buscar%' OR  
												    	   TRANSLATE(upper(emp.D_DESC_COM),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '%$buscar%'
												    	)
												  ORDER BY emp.d_empresa ASC " )));

		

		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$result[]= array( "id" => utf8_encode($row->ID) , "value" => utf8_encode($row->VALUE) );
			}
		}
		
		echo json_encode($result);
	}
}

public function ajax_profesor()
{	
	$buscar = $this->input->get('term');

	if( isset($buscar) && strlen($buscar) > 2 )
	{
		$buscar = strtoupper($buscar);
		$buscar = str_replace(" ", "%", $buscar);
		$buscar = str_replace("ñ", "Ñ", $buscar);

		$query=$this->db->query((utf8_decode("	  	SELECT p.N_ID_PERSONA as id,  p.D_APELLIDOS || ',' || p.D_NOMBRES  as value
												  	FROM 
													    personas p
												  	WHERE
												    	(  TRANSLATE(upper(p.D_APELLIDOS),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '%$buscar%' OR  
												    	   TRANSLATE(upper(p.D_APELLIDOS),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '%$buscar%'
												    	)
													AND PERSONA_TYPE = 'Docente'
												  	ORDER BY p.D_APELLIDOS ASC " )));

		

		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$result[]= array( "id" => utf8_encode($row->ID) , "value" => utf8_encode($row->VALUE) );
			}
		}
		
		echo json_encode($result);
	}
}

		
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */