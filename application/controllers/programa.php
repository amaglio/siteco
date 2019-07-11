<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programa extends CI_Controller {

var $data;


public function __construct()
{
	parent::__construct();
	$this->load->helper('general_helper');

	$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
	$this->load->model('Programas_model');
	$this->load->model('Profesor_model');
	$this->load->library('form_validation');

	
	if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

		$this->data['carreras_dirigidas']=$this->Programas_model->programas_director_carrera();

	elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))):
		
		$this->data['programas_grado']=$this->Programas_model->programas_grados_dictados_en_un_anio(date('Y')); 
		$this->data['programas_posgrado']=$this->Programas_model->programas_posgrados_dictados_en_un_anio(date('Y')); 
		$this->data['programas_ejecutivos']=$this->Programas_model->programas_ejectivos_actualizacion_dictados_en_un_anio(date('Y')); 
		$this->data['notificacion_cursos_cambiados']=$this->Programas_model->cantidad_cursos_modificados();


	endif;

	//$this->output->enable_profiler(TRUE);
}

public function index($c_identificacion,$c_programa,$c_orientacion, $n_fila_curso=-1, $mensaje=null)
{	

	if( in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

		if( $this->Programas_model->permiso_ver_programa($c_identificacion,$c_programa,$c_orientacion) == 0 ) // Puede ver el programa ?
			redirect(base_url()."index.php/home/");
	
	endif;

	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);

	if($mensaje)
		$this->data['mensaje'] = rawurldecode($mensaje);


	if($n_fila_curso)
		$this->data['n_fila_curso'] = $n_fila_curso;


	$this->data['datos_programa'] = $this->Programas_model->datos_programa($c_identificacion,$c_programa,$c_orientacion);	
	$this->load->view('programa/programa',$this->data); 
}


public function informacion_anio($anio,$c_identificacion,$c_programa,$c_orientacion, $n_fila_curso = -1 ) // Muestra un año | se llama desde view/programa/programa
{
	//  !$this->input->is_ajax_request() ||

	//$anio = 2016;

	if ( !isset($anio) || !isset($c_identificacion) || !isset($c_programa) || !isset($c_orientacion) )
   		redirect(base_url()."index.php/home/");
	

	$data['anio'] =	$anio;
	$data['c_identificacion'] = $c_identificacion;
	$data['c_programa'] = $c_programa;
	$data['c_orientacion'] = $c_orientacion;

	$data['datos_programa'] = $this->Programas_model->datos_programa($c_identificacion,$c_programa,$c_orientacion);	

	$data['anio_programa'] = $anio;
	
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

		$data['cantidad_cursos_confirmados']=$this->Programas_model->cursos_confirmados_programa_ejepac(	
																								$c_identificacion, 
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

		$data['cantidad_cursos_confirmados']=$this->Programas_model->cursos_confirmados_programa(	
																								$c_identificacion, 
																								$c_programa, 
																								$c_orientacion,
																								$anio
																							); 


	endif;

	$data['n_fila_curso'] = $n_fila_curso;
	$this->load->view('programa/informacion_programa',$data);
}


public function exportar_cursos_asignados_excel($anio,$c_identificacion,$c_programa,$c_orientacion)
{
	if ( !isset($anio) || !isset($c_identificacion) || !isset($c_programa) || !isset($c_orientacion) )
   		redirect(base_url()."index.php/home/");
	

	if($c_identificacion==3):


		$query=$this->Programas_model->cursos_asignados_programa_ejepac(	$c_identificacion, 
																						$c_programa, 
																						$c_orientacion,
																						$anio
																					); 

	else:
		
		$query=$this->Programas_model->cursos_asignados_programa(	$c_identificacion, 
																	$c_programa, 
																	$c_orientacion,
																	$anio
																); 
	endif;

	export_to_xls($query);
}

//-- Confirmar/Desconfirmar cursos 

public function confirmar_curso()
{
	
	if ($this->form_validation->run('confirmar_curso') == FALSE): 

		chrome_log("No Paso validacion");
		redirect('home');
	
	else:

		chrome_log("Paso validacion");
		chrome_log("Programa_model/confirmar_curso");

		$this->db->trans_start(); 

	    	$this->Programas_model->confirmar_curso($_POST);  

	    $this->db->trans_complete();
	    
	    if($this->db->trans_status() != FALSE )
	    { 
			$return["error"] = FALSE;
			$return["mensaje"] = "Se ha confirmado el curso exitosamente";
		}
		else
		{
			$return["error"] = TRUE;
			$return["mensaje"] = "No se pudo confirmar el curso, intente mas tarde";
			log_message('error', $return["mensaje"] );
		}

		print json_encode($return);


	endif;
}

public function desconfirmar_curso()
{
	if ($this->form_validation->run('confirmar_curso') == FALSE): 

		chrome_log("No Paso validacion");
		redirect('home');
	
	else:

		chrome_log("Paso validacion");

		$this->db->trans_start(); // INICIA UNA TRASACCION - Invita y crea la notificacion.

    		$this->Programas_model->desconfirmar_curso($_POST);  

	    $this->db->trans_complete();
	    
	    if($this->db->trans_status() != FALSE )
	    { 
			$return["error"] = FALSE;
			$return["mensaje"] = "Se ha desconfirmado el curso exitosamente";
		}
		else
		{
			$return["error"] = TRUE;
			$return["mensaje"] = "No se pudo confirmar el curso, intente mas tarde";
			log_message('error', $return["mensaje"] );
		}
		
		print json_encode($return);

	endif;	
}

public function procesa_confirmar_cursos_check() // Confirma los chequeados
{
	chrome_log("procesa_confirmar_cursos_check");
	//var_dump($_POST);
	 
	if ($this->form_validation->run('confimar_cursos_check') == FALSE): // INVALIDO

		chrome_log("No paso Validacion");
		//redirect(base_url()."index.php/home/");

	else:

		chrome_log("Paso Validacion ");
		 
		if(isset($_POST['check_confirma_coordinador'])):
			
			chrome_log("check");
			 
			foreach ($_POST['check_confirma_coordinador'] as $row):

				$row = str_replace("*", "\"", $row);
				$variables = json_decode($row);

				$n_fila_curso = $variables->{'n_fila_curso'};
				$datos['idUsuario'] = $variables->{'id_profesor'};
				$datos['id_materia'] = $variables->{'id_materia'};
				$datos['id_curso'] = $variables->{'id_curso'};
				$datos['anio_lectivo'] = $variables->{'anio_lectivo'};
				$datos['puntos'] = $variables->{'puntos'};
				$datos['id_horario'] = $variables->{'id_horario'};
				$datos['rol'] =  rawurldecode($variables->{'rol'});
				$datos['sueldo'] = $variables->{'sueldo'};

				$datos['c_identificacion'] = $variables->{'c_identificacion'};
				$datos['c_programa'] =  $variables->{'c_programa'};
				$datos['c_orientacion'] = $variables->{'c_orientacion'};

				if( !$this->Programas_model->confirmar_curso($datos) ):

					$mensaje = rawurlencode("Error: no se han confirmado todos lo cursos, intente mas tarde.");
					log_message('error', $mensaje );
					redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje/");

				endif;

				$mensaje = rawurlencode("Se han confirmado los cursos exitosamente.");

			endforeach;

				$c_identificacion = $datos['c_identificacion'];
				$c_programa = $datos['c_programa'];
				$c_orientacion = $datos['c_orientacion'];
				
				redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje/");

				//redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion") 
		else:

			chrome_log("No chequeo ninguno");

			$c_identificacion = $_POST['c_identificacion'];
			$c_programa = $_POST['c_programa'];
			$c_orientacion = $_POST['c_orientacion'];
			
			$mensaje = rawurlencode("Error: No ha seleccionado ningun curso para confirmar.");
			redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/-1/$mensaje/");
			
		endif; 

	endif; 
}

public function confirmar_cursos_secretario($c_identificacion, $c_programa, $c_orientacion)
{
	if ( !isset($c_identificacion) || !isset($c_programa) || !isset($c_orientacion) )
   			redirect(base_url()."index.php/home/");

	$usuarios = $this->Notificacion_model->traer_coordinador_carrera($c_identificacion, $c_programa, $c_orientacion);
	$usuarios_notificados = array("MESTHER", "MMEDINA");

	foreach ($usuarios->result() as $row) 
	{	
		//echo $row->USUARIO;
		array_push( $usuarios_notificados, $row->USUARIO );
	}

	 
	$datos['c_identificacion'] = $c_identificacion;
	$datos['c_programa'] = $c_programa;
	$datos['c_orientacion'] = $c_orientacion; 
	$mensaje = rawurlencode("Cursos confirmados correctamente");

	$texto_notificacion = "El secretario ".$this->session->userdata('usuario_tesoreria')." ha confirmado los cursos del programa el dia: ".date('Y-m-d');
	$this->Programas_model->ingresar_notificacion($datos, $usuarios_notificados, $texto_notificacion);

	redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/-1/$mensaje");		
}


// -- Comentarios 

public function procesa_agregar_comentario()
{

	if ($this->form_validation->run('ingresar_comentario') == FALSE): // INVALIDO

		chrome_log("No paso Validacion");

		$mensaje = 'ERROR: no paso la validacion al ingresar un comentario, faltan parametros o alguno es incorrecto. Intente mas tarde';
	    log_message('error', $mensaje );

		if( isset($_POST['c_identificacion']) && isset($_POST['c_programa']) && isset($_POST['c_programa']) )
		{
			$c_identificacion = $_POST['c_identificacion'];
			$c_programa = $_POST['c_programa'];
			$c_orientacion = $_POST['c_orientacion'];

		}
		else
		{
			$c_identificacion = 1;
			$c_programa = 1;
			$c_orientacion = 0;
		}

		redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/-1/".rawurlencode($mensaje));

	else: // VALIDO

		chrome_log("Paso Validacion");


		$c_identificacion = $_POST['c_identificacion'];
		$c_programa = $_POST['c_programa'];
		$c_orientacion = $_POST['c_orientacion'];

		if( $this->Programas_model->insertar_comentario($_POST) ): // INGRESO CORRECTAMENTE

			$mensaje = rawurlencode("Mensaje agregado correctamente");

		else: // NO INGRESO

			$mensaje = rawurlencode("ERROR: No se pudo editar el comentario del curso, intente mas tarde");
			log_message('error', $mensaje );

		endif;


		if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles'))): // Si es coordinador

		
				$this->load->library('user_agent');
				echo $this->agent->referrer();

				if(strpos($this->agent->referrer(),"informacion_profesor")):

					$id_profesor = $_POST['idUsuario'];
					redirect(base_url()."index.php/profesor/informacion_profesor/$id_profesor");

				else:
					
					$n_fila_curso = $_POST['n_fila_curso'];
					redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje");
				
				endif;


		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): // Si es tesoreria

				$this->load->library('user_agent');
				echo $this->agent->referrer();

				if(strpos($this->agent->referrer(),"informacion_profesor")):

					$id_profesor = $_POST['idUsuario'];
					redirect(base_url()."index.php/profesor/informacion_profesor/$id_profesor");

				else:

					$n_fila_curso = $_POST['n_fila_curso'];
					redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje");
				
				endif;

		endif;


	endif;
}

public function procesa_editar_importe_curso()
{	
	chrome_log("procesa_editar_importe_curso");


	if ($this->form_validation->run('editar_importe_profesor') == FALSE): // INVALIDO

		chrome_log("No paso Validacion");
	    $mensaje = 'ERROR: no paso la validacion al editar importe, faltan parametros o alguno es incorrecto. Intente mas tarde';
	    log_message('error', $mensaje );

		if( isset($_POST['c_identificacion']) && isset($_POST['c_programa']) && isset($_POST['c_programa']) )
		{
			$c_identificacion = $_POST['c_identificacion'];
			$c_programa = $_POST['c_programa'];
			$c_orientacion = $_POST['c_orientacion'];

		}
		else
		{
			$c_identificacion = 1;
			$c_programa = 1;
			$c_orientacion = 0;
		}

		redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/-1/".rawurlencode($mensaje));

	else: // VALIDO

		chrome_log("Paso Validacion ");

	 	$id_materia=$_POST['id_materia'];
		$id_curso=$_POST['id_curso'];
		$anio_lectivo=$_POST['anio_lectivo'];
		$idUsuario=$_POST['idUsuario'];
		$id_horario=$_POST['id_horario'];
		$c_identificacion = $_POST['c_identificacion'];
		$c_programa = $_POST['c_programa'];
		$c_orientacion = $_POST['c_orientacion'];
		$rol = rawurldecode($_POST['rol']);
		$n_fila_curso = $_POST['n_fila_curso'];

		$resultado = $this->Programas_model->modificar_importe_coordinador($_POST);

		if($resultado): //---- Modifico el importe --- //

			$mensaje = rawurlencode("Cursos editado correctamente");
			
			$usuarios_notificados = array("MESTHER", "MMEDINA"); // [HARCODEADO] MESTHER, MMEDINA
			
			$texto_notificacion = "El usuario ".$this->session->userdata('usuario_tesoreria')." ha modificado el importe del profesor a: $".$_POST['sueldo'].".";
			$this->Programas_model->ingresar_notificacion($_POST, $usuarios_notificados, $texto_notificacion); 


		else: // ---- No pudo modificar el importe ---- //

			$mensaje = rawurlencode("ERROR: No se pudo editar el curso, intente mas tarde");
			log_message('error', $mensaje );

		endif;

		redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje");
		 
	endif;
}

public function cursos_modificados()
{
	if( in_array('ROLE_TESORERIA',$this->session->userdata('roles')) ):

		$this->Programas_model->cambiar_cambios_a_vistos();
		$this->data['cursos_modificados'] = $this->Programas_model->cursos_cambiados();
		$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);
		$this->load->view('programa/cursos_modificados',$this->data);

	else:

		redirect('home');

	endif;
}

public function cursos_sin_confirmar_coordinador()
{
	if( in_array('ROLE_TESORERIA',$this->session->userdata('roles')) ):

		$this->data['mensaje'] = $this->session->flashdata('mensaje');
		$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);
		$this->data['cursos_sin_confirmar_coordinador'] = $this->Programas_model->cursos_sin_confirmar_coordinador();
		$this->load->view('programa/cursos_sin_confirmar_coordinador',$this->data);

	else:

		redirect('home');

	endif;
}

 

public function cursos_sin_importe_tesoreria()
{
	if( in_array('ROLE_TESORERIA',$this->session->userdata('roles')) ):

		$this->data['cursos_sin_importe_tesoreria'] = $this->Programas_model->cursos_sin_importe_tesoreria();
		$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);
		$this->load->view('programa/cursos_sin_importe_tesoreria',$this->data);

	else:

		redirect('home');

	endif;
}

public function resumen_coordinadores_secretarios()
{
	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);

	$this->data['programas_grado']=$this->Programas_model->programas_grados_dictados_en_un_anio(date('Y')); 
	$this->data['programas_posgrado']=$this->Programas_model->programas_posgrados_dictados_en_un_anio(date('Y')); 
	$this->data['programas_ejecutivos']=$this->Programas_model->programas_ejectivos_actualizacion_dictados_en_un_anio(date('Y')); 

	// Programas de Grado --------------

	$array_programas_grado = array();

	foreach ($this->data['programas_grado']->result() as $row) 
	{
		$datos['programa'] = $row->D_DESCRIP;
		$datos['coordinadores_programa'] = $this->Programas_model->traer_coordinadores_programas($row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION);
		$datos['secretarios_programa'] = $this->Programas_model->traer_secretarios_programas($row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION);

		array_push( $array_programas_grado, $datos );
	}

	$this->data['programas_grado'] = $array_programas_grado;

	// Programas de Posgrado --------------

	$array_programas_posgrado = array();

	foreach ($this->data['programas_posgrado']->result() as $row) 
	{
		$datos['programa'] = $row->D_DESCRIP;
		$datos['coordinadores_programa'] = $this->Programas_model->traer_coordinadores_programas($row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION);
		$datos['secretarios_programa'] = $this->Programas_model->traer_secretarios_programas($row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION);

		array_push( $array_programas_posgrado, $datos );
	}

	$this->data['programas_posgrado'] = $array_programas_posgrado;


	// Programas de PE Y PAC --------------

	$array_programas_ejecutivos = array();

	foreach ($this->data['programas_ejecutivos']->result() as $row) 
	{
		$datos['programa'] = $row->D_DESCRIP;
		$datos['coordinadores_programa'] = $this->Programas_model->traer_coordinadores_programas($row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION);
		$datos['secretarios_programa'] = $this->Programas_model->traer_secretarios_programas($row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION);

		array_push( $array_programas_ejecutivos, $datos );
	}

	$this->data['programas_ejecutivos'] = $array_programas_ejecutivos;

	 


	$this->load->view('programa/resumen_programas',$this->data);

}

public function enviar_email_cursos_sin_confirmar()
{
  	//var_dump($_POST);

  	if ($this->form_validation->run('enviar_email_cursos_sin_confirmar') == FALSE): // INVALIDO

		chrome_log("No paso Validacion");
		$this->session->set_flashdata('mensaje', "No paso validacion" );

	else:

		chrome_log("Pasó Validación");

		$cadena_cursos = $this->input->post('check_confirma_coordinador');
	  	$cadena_cursos = str_replace("&",  "\"", $cadena_cursos); 

	  	$array_coordinadores = array();
	  	$array_cursos = array();

	  	// Pongo todos los cursos JSON a un array y creo un array de coordinadores.

		 	foreach ($cadena_cursos as $row) 
		 	{	
		 		$cadena_json = json_decode($row);

		 		$datos_curso['id_profesor'] = $cadena_json->id_profesor;
		 		$datos_curso['id_materia'] = $cadena_json->id_materia;
		 		$datos_curso['c_indentificacion'] = $cadena_json->c_indentificacion;
		 		$datos_curso['c_programa'] = $cadena_json->c_programa;
		 		$datos_curso['c_orientacion'] = $cadena_json->c_orientacion;

		 		$coordinadores = explode("-", $cadena_json->id_coordinador);

		 		foreach ($coordinadores as $row2) 
		 		{
		 			$id_coordinador = $row2;

		 			if(!empty($row2))
		 			{
		 			  	$datos_curso['id_coordinador'] = $row2;

		 			  	if(!in_array($row2, $array_coordinadores)):
		 			  		array_push($array_coordinadores,$row2);
		 			  	endif;

		 			  	array_push($array_cursos,$datos_curso);
			 		}


		 		}	
		 		
		 	}

		 	//echo "<pre>";
		 		//print_r ($array_cursos);
		 	//echo "</pre>";
		 	
	 	// Recorro los coordinadores para buscar todos los cursos que le corresponden

	 
		 	$array_coordinador_cursos = array();

		 	foreach ($array_coordinadores as $row_coordinador) 
		 	{
		 		$array_cursos_profesor = array();

		 		$datos_curso_profesor['id_coordinador_final'] =  $row_coordinador;
		 		
		 		foreach ($array_cursos as $row4) 
		 		{
		 			if( $row4['id_coordinador'] == $row_coordinador ) // Si el curso es del coordinador
		 			{
		 				array_push($array_cursos_profesor, $row4);
		 			}
		 		}

		 		$datos_curso_profesor['cursos'] = $array_cursos_profesor;

		 		array_push($array_coordinador_cursos, $datos_curso_profesor);

		 	}

	  	// Recorro el array para enviar los emails por coordinador:

		 	//echo "<pre>";
		 	//print_r($array_coordinador_cursos );
		 	//echo "</pre>";

		 	$texto_mensaje = '';
		 	$resultado_email = '';
		 	 
		  	foreach ($array_coordinador_cursos as $row_final) 
		  	{	
		  		$nombre_coordinador = $this->Profesor_model->get_coordinador_nombre($row_final['id_coordinador_final']);
		  		$email_coordinador = $this->Profesor_model->get_coordinador_email($row_final['id_coordinador_final']);

		  		$texto_mensaje .= "Estimado ".$nombre_coordinador."(".$email_coordinador."):"."<br>";
		  		$texto_mensaje .= utf8_decode("Le informamos que estamos próximos a liquidar sueldos y como coordinador aún tiene cursos sin confirmar: <br><br>");

		  		foreach ($row_final['cursos'] as $row_cursos_final) 
		  		{
		  			$programa = $this->Programas_model->datos_programa( $row_cursos_final['c_indentificacion'], $row_cursos_final['c_programa'], $row_cursos_final['c_orientacion'] );
		  			$texto_mensaje .= "- Programa: ".$programa->row()->D_DESCRIP."<br>";
		  			$materia = $this->Programas_model->get_materia_nombre( $row_cursos_final['id_materia'] );
		  			$texto_mensaje .= "- Materia: ".$materia."<br>";
		  			$profesor = $this->Profesor_model->traer_datos_profesor( $row_cursos_final['id_profesor'] );
		  			$texto_mensaje .= "- Profesor: ".$profesor->D_APELLIDOS."<br><br>";

		  		}
		  		
		  		$texto_mensaje .= utf8_decode("<br> Por favor, confirmé los importes de los profesores: <a href=".base_url()."> SITECO </a><br>");
		  		$texto_mensaje .= utf8_decode("<br> Si los cursos son gestionados por otro profesor, tenga a bien reportar este email a quien corresponda o ignore el mensaje. <br>");
		  		$texto_mensaje .= "<br> Muchas gracias <br><br>";

		  		$resultado = enviar_email("adrian.magliola@gmail.com", "SITECO - Cursos sin confirmar",  $texto_mensaje);

		  		if( $resultado )
		  			$resultado_email .= "Email enviado exitosamente: ".$email_coordinador.".<br>";
		  		else
		  			$resultado_email .= "Error al enviar el email: ".$email_coordinador.".<br>";

		   	}  

		   	$this->session->set_flashdata('mensaje', $resultado_email);

		   	//redirect("/");
		   	redirect(base_url()."index.php/programa/cursos_sin_confirmar_coordinador");

	endif;
   	
}



// ________________________________________________________________________________________
//
// 						ARCHIVO RIACCO  
// ____________________________________________________________________________________

function riaco()
{		
	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);
	$this->load->view('riaco/cargar_archivo_riaco',$this->data);
}

function procesa_archivo_riaco()
{		
	chrome_log("procesa_archivo_riaco");
	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);

	if ($_FILES):
    	
        $name = 'assets/uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], "assets/uploads/riaco.old");

        if (($handle = fopen("assets/uploads/riaco.old","r")) !== FALSE):
        
        	$i=-1;
            while (!feof($handle)) // carga el archivo
            {
            	$i++;
            	$archivo[$i] = fgets($handle);
            }	            	
            fclose($handle);	
            
            $nuevoarchivo=$this->convertir($archivo,$i);
            file_put_contents ("assets/uploads/riaco.dat1",$nuevoarchivo[0],0770); 
            for ($n=1; $n<=$i; $n++)
            {
            	if (strlen (trim($nuevoarchivo[$n]))>100)// para que no tenga problema con el eof
            		file_put_contents ("assets/uploads/riaco.dat1",$nuevoarchivo[$n],FILE_APPEND);
            	 
            }
			shell_exec ("sed 's/$/\r/' assets/uploads/riaco.dat1 > assets/uploads/riaco.dat");//cambia los CRLF de unix a windows
			//$this->load->view('/tesoreria/download_riaco');
			$this->load->view('riaco/download_archivo_riaco',$this->data);
        
        endif;
            
    endif;
}

function convertir($archivo,$i)
{
	$mensaje="";
	for ($n=0; $n<=$i; $n++):

		$modificado=0;
		$estiloa0="";
		$estiloa1="";
		$estiloc0="";
		$estiloc1="";
		$estilod0="";
		$estilod1="";															
		$prea=substr($archivo[$n],0,45);
		$a=substr($archivo[$n],45,1);
		$posta=substr($archivo[$n],46,24);
		$b=substr($archivo[$n],70,8);
		$postb=substr($archivo[$n],78,170);
		$c=substr($archivo[$n],248,1);
		$postc=substr($archivo[$n],249,74);
		$d=substr($archivo[$n],323,2);
		$postd=substr($archivo[$n],325);

		if ($b=="00000000")
		{
			if ($a!="6")
			{
				$a="6";
				$modificado=1;
				$estiloa0="<strong>";
				$estiloa1="</strong>";
			}
		
			if ($c!="6")
			{
				$c="6";
				$modificado=1;
				$estiloc0="<strong>";
				$estiloc1="</strong>";
			}	
		
			if ($d!="00")
			{
				$d="00";
				$modificado=1;
				$estilod0="<strong>";
				$estilod1="</strong>";
			}			
		}	
		else 
		{
			if ($a!="1")
			{
				$a="1";
				$modificado=1;
				$estiloa0="<strong>";
				$estiloa1="</strong>";					
			}
			
			if ($c!="1")
			{
				$estiloc0="<strong>";
				$estiloc1="</strong>";					
				$c="1";
				$modificado=1;
			}	
			
			if ($d!="30")
			{
				$d="30";
				$modificado=1;
				$estilod0="<strong>";
				$estilod1="</strong>";
			}			

		}
		
		$nuevo[$n]=$prea.$a.$posta.$b.$postb.$c.$postc.$d.$postd;
		
		if ($modificado==1)
		{
			$mensaje .="<br>Original: ".$archivo[$n];
			$mensaje .= "<br>Modificado: ".$prea.$estiloa0.$a.$estiloa1.$posta.$b.$postb.$estiloc0.$c.$estiloc1.$postc.$estilod0.$d.$estilod1.$postd;
			$mensaje .="<br>";
			$mensaje .="<br>";
			
		}					
	
	endfor;
	
	file_put_contents ("assets/uploads/modificaciones.txt",$mensaje); 
	mail("ammagliola@cema.edu.ar", "Informa Archivo de Riaco", $mensaje);
	return $nuevo;
}

function borrar_archivo_riaco()
{
	if (isset($_POST['borrar']))
	{
		unlink('assets/uploads/riaco.dat');
		unlink('assets/uploads/riaco.old');
		unlink('assets/uploads/riaco.dat1');
		//shell_exec('rm -f /var/www/crmtest/riaco.dat');
	}

	redirect(base_url()."index.php/home");
}

}
?>