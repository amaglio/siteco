<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programa extends CI_Controller {

	/**
	 * Index Page for this controller.
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('general_helper');
		//esta_logueado();

		$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
		$this->load->model('Programas_model');
		$this->load->library('form_validation');

	}

	public function index($carrera)
	{	

		$data['carreras_dirigidas']=$this->Programas_model->programas_director_carrera();
		$data['cantidad_profesores']=$this->Programas_model->cantidad_profesores_coordinados();
		$data['cantidad_cursos']=$this->Programas_model->cantidad_cursos_cargados_sigeu();
		$data['cantidad_cursos_confirmados']=$this->Programas_model->cantidad_cursos_confirmados();

		//$data['cantidad_cursos']=$this->Programas_model->cantidad_cursos_coordinadas();

		$datos_programa = $data['datos_programa'] = $this->Programas_model->datos_programa($carrera);
		
		$row_programa = $datos_programa->row();

		$data['vista_head'] = $this->load->view('estructura/head', $data , true);

		$data['cursos_asignados']=$this->Programas_model->cursos_asignados_programa(	$row_programa->C_IDENTIFICACION, 
																					  	$row_programa->C_PROGRAMA, 
																					  	$row_programa->C_ORIENTACION);

		$data['plan_estudio_total']=$this->Programas_model->plan_estudio_total(
																			  $row_programa->C_IDENTIFICACION, 
																			  $row_programa->C_PROGRAMA, 
																			  $row_programa->C_ORIENTACION);
		
		$data['plan_estudio_obligatorias']=$this->Programas_model->plan_estudio_obligatorias(
																			  $row_programa->C_IDENTIFICACION, 
																			  $row_programa->C_PROGRAMA, 
																			  $row_programa->C_ORIENTACION);

		$data['plan_estudio_opcionales']=$this->Programas_model->plan_estudio_opcionales($row_programa->C_IDENTIFICACION, 
																			  $row_programa->C_PROGRAMA, 
																			  $row_programa->C_ORIENTACION);


		$data['cursos_cambio_profesor'] = $this->Programas_model->cursos_cambio_profesor(	$row_programa->C_IDENTIFICACION, 
																					$row_programa->C_PROGRAMA, 
																					$row_programa->C_ORIENTACION);

		$data['cursos_cambio_horario'] = $this->Programas_model->cursos_cambio_horario(	$row_programa->C_IDENTIFICACION, 
																					$row_programa->C_PROGRAMA, 
																					$row_programa->C_ORIENTACION);

		$this->load->view('programa',$data);

	}


	function editar_programa($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $carrera)
	{
		//echo $id_materia."/".$id_profesor."/".$id_curso."/".$id_anio_lectivo."/".$puntos ;
		
		$materia = $this->Programas_model->traer_nombre_materia($id_materia);
		$persona = $this->Programas_model->traer_profesor($id_profesor);

		$data['id_profesor'] = $id_profesor;
		$data['id_materia'] = $id_materia;
		$data['materia'] = $materia;
		$data['apellido'] = utf8_encode($persona->D_APELLIDOS);
		$data['nombre'] = utf8_encode($persona->D_NOMBRES);
		$data['id_curso'] = $id_curso;
		$data['anio_lectivo'] = $anio_lectivo;
		$data['puntos'] = $puntos;
		$data['id_horario'] = $id_horario;
		$data['rol'] = rawurldecode($rol);
		$data['carrera'] = $carrera;
		$data['sueldo'] = $sueldo;

		// Buscar si tiene el precio cargado y si lo tiene, enviarlo.

		$this->load->view('editar_programa',$data);
	}


	function confirmar_curso($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $carrera )
	{
		//echo $id_materia."/".$id_profesor."/".$id_curso."/".$id_anio_lectivo."/".$puntos ;
		
		$data['id_profesor'] = $id_profesor;
		$data['idUsuario'] = $id_profesor;
		$data['id_materia'] = $id_materia;
		$data['id_curso'] = $id_curso;
		$data['anio_lectivo'] = $anio_lectivo;
		$data['puntos'] = $puntos;
		$data['id_horario'] = $id_horario;
		$data['sueldo'] = $sueldo;
		$data['rol'] = rawurldecode($rol);

		$resultado_programa = $this->Programas_model->datos_programa($carrera);
		$row_programa = $resultado_programa->row();

		$c_identificacion = $row_programa->C_IDENTIFICACION;
		$c_programa = $row_programa->C_PROGRAMA;
		$c_orientacion = $row_programa->C_ORIENTACION;

		
		$this->Programas_model->curso_confirmado($data, $c_identificacion, $c_programa, $c_orientacion);

		redirect(base_url()."index.php/programa/index/$carrera");

	}

	

	function procesa_editar_curso()
	{	

		$this->form_validation->set_rules('puntos', 'Puntos', 'required');

		if ( is_numeric($_POST['puntos']))
		{
			
			$id_materia=$_POST['id_materia'];
			$id_curso=$_POST['id_curso'];
			$anio_lectivo=$_POST['anio_lectivo'];
			$idUsuario=$_POST['idUsuario'];
			$id_horario=$_POST['id_horario'];
			$carrera=$_POST['carrera'];

			$resultado_programa = $this->Programas_model->datos_programa($carrera);
		    $row_programa = $resultado_programa->row();

		    $c_identificacion = $row_programa->C_IDENTIFICACION;
		    $c_programa = $row_programa->C_PROGRAMA;
		    $c_orientacion = $row_programa->C_ORIENTACION;

			$rol = rawurldecode($_POST['rol']);

			$comentario = '';

			if( $_POST['puntos'] != $_POST['puntos_anterior'] )
				$comentario .= "Se cambio de ".$_POST['puntos_anterior']." puntos a ".$_POST['puntos']." puntos.<br>";

			if( $_POST['sueldo_anterior'] != $_POST['sueldo'] )
				$comentario .= "Se cambio el importe, de  $".$_POST['sueldo_anterior']." a $".$_POST['sueldo'].".";


			if( $this->Programas_model->existe_registro_materia($id_curso, $anio_lectivo, $idUsuario, $id_horario, $rol ) )
			{
				$this->Programas_model->actualizar_registro_curso_cargado($_POST,$comentario);
			}
			else
			{
				$this->Programas_model->insertar_registro_curso_cargado($_POST,$comentario, $c_identificacion, $c_programa, $c_orientacion);
			}	
			
			redirect(base_url()."index.php/programa/index/".$carrera);	

		}
		else
		{
			echo "incorrecto";
		}

		
	}


	function procesa_nuevo_curso()
	{	

		$persona = $this->Programas_model->insertar_curso_manual($_POST);		
	}



	function historial_curso($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $carrera)
	{

		// Buscar si tiene el precio cargado y si lo tiene, enviarlo.
		$data['id_profesor'] = $id_profesor;
		$data['idUsuario'] = $id_profesor;
		$data['id_materia'] = $id_materia;
		$data['id_curso'] = $id_curso;
		$data['anio_lectivo'] = $anio_lectivo;
		$data['puntos'] = $puntos;
		$data['id_horario'] = $id_horario;
		$data['sueldo'] = $sueldo;
		$data['rol'] = rawurldecode($rol);
		$data['carrera'] = $carrera;
		$data['comentarios'] = $this->Programas_model->ver_cursos_comentarios($id_curso, $anio_lectivo, $id_profesor, $id_horario, rawurldecode($rol) );

		$this->load->view('comentarios_cursos',$data);
	}

	function desconfirmar_curso($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $carrera)
	{
		$this->Programas_model->desconfirmar_curso($id_curso, $anio_lectivo, $id_profesor, $id_horario, rawurldecode($rol));
		redirect(base_url()."index.php/programa/index/$carrera");
	}

	function procesa_agregar_comentario()
	{
		$this->Programas_model->insertar_comentario($_POST);
	}


	/*
		Buscar profesores por ajax.
	*/

	function ajax_profesor()
	{
		
		if($buscar = $this->input->get('term'))
		{
			$buscar = strtoupper($buscar);
			$buscar = str_replace(" ", "%", $buscar);
			
			$query=$this->db->query((utf8_decode("	SELECT P.N_ID_PERSONA AS id, P.D_APELLIDOS || ', ' || P.D_NOMBRES AS value
										FROM PERSONAS p, contratos c 
										WHERE 
												p.persona_type = 'Docente' AND  
												c.n_id_persona =p.n_id_persona AND
												c.f_hasta is null AND
												TRANSLATE(upper(P.d_apellidos),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛ','AEIOUAEIOUAEIOUAEIOU') LIKE '%$buscar%'
										ORDER by p.d_apellidos, p.d_nombres" )));
			
			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$result[]= array("id" => utf8_encode($row->ID) , "value" => utf8_encode($row->VALUE));
				}
			}
			
			echo json_encode($result);
		}
	}
	

	function ajax_materia()
	{	
		$c_identificacion = $this->uri->segment(3);
		$c_programa =$this->uri->segment(4);
		$c_orientacion =$this->uri->segment(5);
		$buscar = $this->input->get('term');
		chrome_log($buscar);

		
		if($buscar = $this->input->get('term'))
		{
			$buscar = strtoupper($buscar);
			
			$query=$this->db->query(utf8_decode("	SELECT m.d_descrip AS value, m.n_id_materia as id
													FROM planes_materias pm, materias m
													WHERE 
															trunc(pm.c_plan/100) = (extract(YEAR FROM sysdate)) AND
															pm.c_identificacion = $c_identificacion AND
															pm.c_programa = $c_programa AND
															pm.c_orientacion = $c_orientacion AND
															pm.n_id_materia = m.n_id_materia AND
															TRANSLATE(upper(m.d_descrip),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛ','AEIOUAEIOUAEIOUAEIOU') LIKE '%$buscar%'
													ORDER BY pm.N_AÑO_CARRERA, pm.n_periodo_carrera,m.d_descrip " ) );
			
			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$result[]= array("id" => utf8_encode($row->ID) , "value" => utf8_encode($row->VALUE));
				}
			}
			
			echo json_encode($result);
		}
	}



	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */