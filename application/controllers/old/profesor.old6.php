<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor extends CI_Controller {
 
var $data;

public function __construct()
{ 
	parent::__construct();
	
	$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
	$this->load->model('Programas_model');
	$this->load->model('Profesor_model');

	if( !in_array('ROLE_TESORERIA',$this->session->userdata('roles')) AND !(in_array('ROLE_COORDINADOR',$this->session->userdata('roles')))): // Si es coordinador

		redirect(base_url()."index.php/home/");

	endif;

	if( in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

		$this->data['carreras_dirigidas']=$this->Programas_model->programas_director_carrera();

	elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))):
		
		$this->data['programas_grado']=$this->Programas_model->programas_grados_dictados_en_un_anio(date('Y')); 
		$this->data['programas_posgrado']=$this->Programas_model->programas_posgrados_dictados_en_un_anio(date('Y')); 
		$this->data['programas_ejecutivos']=$this->Programas_model->programas_ejectivos_actualizacion_dictados_en_un_anio(date('Y')); 

	endif;
}

public function index()
{ 
	$this->load->helper('general_helper');
	$this->data['vista_head'] = $this->load->view('estructura/head', $this->data  , true);
	$this->load->view('profesor/profesores',$this->data);
}

public function informacion_profesor($id_profesor=NULL)
{ 
	//chrome_log("informacion_profesor");

	//$datos['vista_head'] = $this->load->view('estructura/head', $this->data , true);

	 
	$this->load->helper('general_helper');
	if(!isset($id_profesor) && !isset($_POST['idUsuario']))
		redirect(base_url()."index.php/home/");

	if(isset($id_profesor))
		$_POST['idUsuario'] = $id_profesor;

	if( $this->Profesor_model->fulltime($_POST['idUsuario']) == 1 )
		$datos['tipo'] = "Full Time";	
	else
		$datos['tipo'] = "Part Time";

	$datos['datos_profesor'] = $this->Profesor_model->traer_datos_profesor($_POST['idUsuario']);
	$datos['profesores_cursos'] = $this->Profesor_model->traer_cursos_profesor($_POST['idUsuario']);
	$datos['contrato_profesor'] = $this->Profesor_model->traer_contrato_profesor($_POST['idUsuario']);
	$datos['valor_punto'] = $this->Profesor_model->traer_valor_punto(); 
	$datos['legajo'] = $this->Profesor_model->traer_legajo($_POST['idUsuario']);
	$datos['conceptos_extras'] = $this->Profesor_model->conceptos_extras();
	$datos['id_profesor'] = $_POST['idUsuario'];		

	if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles'))): // Le envio el ID del director que esta logueado para que muestre solo las extras que EL cargo.

		$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['idUsuario'],$this->session->userdata('usuario_tesoreria'));

	elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): // Si es el de tesoreria ve TODAS las extras

		$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['idUsuario'] );

	endif;

	$datos['vista_head'] = $this->load->view('estructura/head', $this->data , true);
	$this->load->view('profesor/profesores_cursos',$datos);
}

public function importar_cursos_excel($id_profesor)
{ 
	$this->load->helper('general_helper');

	if(!isset($id_profesor) && !isset($_POST['idUsuario']))
		redirect(base_url()."index.php/home/");

	$query = $this->Profesor_model->traer_cursos_profesor($id_profesor);
	export_to_xls($query);
}

public function procesa_eliminar_extra_profesor()
{ 
	$this->load->helper('general_helper');
	if ($this->form_validation->run('eliminar_extra') == FALSE): // INVALIDO

		chrome_log("No Paso validacion");
		redirect('home');
	
	else:

		chrome_log("Paso validacion");

		$resultado = $this->Profesor_model->eliminar_extra($_POST);

		if( $resultado > 0 )	 
			$datos['mensaje_exito'] = "Se ha eliminado el extra exitosamente";
		else 
			$datos['mensaje_error'] = "No se ha eliminado el extra, intente nuevamente mas tarde.";

		$datos['vista_head'] = $this->load->view('estructura/head', $this->data , true);
	
		if( $this->Profesor_model->fulltime($_POST['n_id_profesor']) == 1 )
			$datos['tipo'] = "Full Time";	
		else
			$datos['tipo'] = "Part Time";

		$datos['datos_profesor'] = $this->Profesor_model->traer_datos_profesor($_POST['n_id_profesor']);
		$datos['valor_punto'] = $this->Profesor_model->traer_valor_punto(); // Punto standart
		$datos['profesores_cursos'] = $this->Profesor_model->traer_cursos_profesor($_POST['n_id_profesor']);
		$datos['contrato_profesor'] = $this->Profesor_model->traer_contrato_profesor($_POST['n_id_profesor']);
		$datos['legajo'] = $this->Profesor_model->traer_legajo($_POST['n_id_profesor']);

		$datos['conceptos_extras'] = $this->Profesor_model->conceptos_extras();

		if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles'))): // Traigo las del coordinador

			$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['n_id_profesor'],$this->session->userdata('usuario_tesoreria'));

		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): // Traigo todas las extras

			$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['n_id_profesor'] );

		endif;


		$_POST['idUsuario'] = $_POST['n_id_profesor'];	

		$usuarios_notificados = array("MESTHER", "MMEDINA");
		$texto_notificacion = "El coordinador ".$this->session->userdata('usuario_tesoreria')." ha editado un extra de ".$_POST['importe'].", en la fecha ".date('Y-m-d');
		
		$this->Programas_model->ingresar_notificacion($_POST, $usuarios_notificados, $texto_notificacion);

		$datos['id_profesor'] = $_POST['n_id_profesor'];
		$this->load->view('profesor/profesores_cursos',$datos);


	endif;	
}

public function procesa_editar_extra_profesor()
{ 
	$this->load->helper('general_helper');
	chrome_log("procesa_editar_extra_profesor");

	if ($this->form_validation->run('editar_extra') == FALSE):

		chrome_log("No Paso validacion");
		redirect('home');
	
	else:

		chrome_log("Paso validacion");

		$resultado = $this->Profesor_model->editar_extra($_POST);

		if( $resultado > 0 )
			$datos['mensaje_exito'] = "Se ha modificado el extra exitosamente";
		else
			$datos['mensaje_error'] = "No se ha modificado el extra, intente nuevamente mas tarde.";
		

		if( $this->Profesor_model->fulltime($_POST['n_id_profesor']) == 1 )
			$datos['tipo'] = "Full Time";	
		else
			$datos['tipo'] = "Part Time";

		$datos['datos_profesor'] = $this->Profesor_model->traer_datos_profesor($_POST['n_id_profesor']);
		$datos['valor_punto'] = $this->Profesor_model->traer_valor_punto(); // Punto standart
		$datos['profesores_cursos'] = $this->Profesor_model->traer_cursos_profesor($_POST['n_id_profesor']);
		$datos['contrato_profesor'] = $this->Profesor_model->traer_contrato_profesor($_POST['n_id_profesor']);
		$datos['legajo'] = $this->Profesor_model->traer_legajo($_POST['n_id_profesor']);

		$datos['conceptos_extras'] = $this->Profesor_model->conceptos_extras();

		if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles'))): // Si es coordinador, solo muestro las extras que él cargo.

			$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['n_id_profesor'],$this->session->userdata('usuario_tesoreria'));

		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): // Si es el de tesoreria ve TODAS las extras

			$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['n_id_profesor'] );

		endif;

		$_POST['idUsuario'] = $_POST['n_id_profesor'];
		
		$usuarios_notificados = array("MESTHER", "MMEDINA");
		$texto_notificacion = "El coordinador ".$this->session->userdata('usuario_tesoreria')." ha editado un extra de ".$_POST['importe'].", en la fecha ".date('Y-m-d');
		$this->Programas_model->ingresar_notificacion($_POST, $usuarios_notificados, $texto_notificacion);

		$datos['id_profesor'] = $_POST['n_id_profesor'];

		$datos['vista_head'] = $this->load->view('estructura/head', $this->data , true);
		$this->load->view('profesor/profesores_cursos',$datos);

	endif;
}

public function procesa_cargar_extras()
{ 
	$this->load->helper('general_helper');
	chrome_log("procesa_cargar_extras");
	
	
	if ($this->form_validation->run('cargar_extra') == FALSE): // INVALIDO

		chrome_log("No Paso validacion");
		$datos['mensaje_error'] = "No se ha cargado el extra por no tener N°liquidacion, N°legajo o Concepto de Extra";
		redirect('home');
	
	else:

		$existe_extra = $this->Profesor_model->existe_extra($_POST);

		if($existe_extra): // Existe un extra con ese concepto, persona y liquidacion.

			chrome_log("Extra ya existente");
			$datos['mensaje_error'] = "<strong>No se ha cargado el extra: </strong>ya existe una extra con el mismo concepto y la misma liquidacion para este profesor.";

		else:	// No existe el extra y la carga

			chrome_log("No existe el extra");

			chrome_log("Paso validacion");
			$resultado = $this->Profesor_model->insertar_extra($_POST);

			if( $resultado > 0 ): 

				$datos['mensaje_exito'] = "Se ha cargado el extra exitosamente";

			else: 

				$datos['mensaje_error'] = "No se ha cargado el extra, intente nuevamente mas tarde.";

			endif;

		endif;

		$datos['vista_head'] = $this->load->view('estructura/head', $this->data , true);

		if( $this->Profesor_model->fulltime($_POST['idUsuario']) == 1 )
			$datos['tipo'] = "Full Time";	
		else
			$datos['tipo'] = "Part Time";

	 	$datos['datos_profesor'] = $this->Profesor_model->traer_datos_profesor($_POST['idUsuario']);
		$datos['profesores_cursos'] = $this->Profesor_model->traer_cursos_profesor($_POST['idUsuario']);
		$datos['contrato_profesor'] = $this->Profesor_model->traer_contrato_profesor($_POST['idUsuario']);
		$datos['legajo'] = $this->Profesor_model->traer_legajo($_POST['idUsuario']);
		$datos['conceptos_extras'] = $this->Profesor_model->conceptos_extras();
		$datos['valor_punto'] = $this->Profesor_model->traer_valor_punto(); // Punto standart


		if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles'))): // Si es coordinador

			$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['idUsuario'],$this->session->userdata('usuario_tesoreria'));  // Le envio el ID del director que esta logueado para que muestre solo las extras que EL cargo.

		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): // Si es el de tesoreria ve TODAS las extras

			$datos['extras_profesor'] = $this->Profesor_model->traer_extras($_POST['idUsuario'] );

		endif;

		$usuarios_notificados = array("MESTHER", "MMEDINA");
		$texto_notificacion = "El coordinador ".$this->session->userdata('usuario_tesoreria')." ha ingresado un extra de ".$_POST['sueldo'].", en la fecha ".date('Y-m-d');
		$this->Programas_model->ingresar_notificacion($_POST, $usuarios_notificados, $texto_notificacion);

		$datos['id_profesor'] = $_POST['idUsuario'];
		$this->load->view('profesor/profesores_cursos',$datos);

	endif;
}

public function confirmar_importe( $id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo ) // Tesoreria confirma el importa puesto por el coordinador y lo pasa al campo IMPORTE (el campo que paga)
{
 
 	$this->load->helper('general_helper');
	if( isset($id_materia) && isset($id_profesor) && isset($id_curso) && isset($anio_lectivo) && isset($puntos) && isset($id_horario) && isset($rol) && isset($sueldo) ):

		chrome_log("Paso validacion");
		$datos['id_materia'] = $id_materia;
		$datos['idUsuario'] = $id_profesor;
		$datos['id_curso'] = $id_curso;
		$datos['anio_lectivo'] = $anio_lectivo;
		$datos['puntos'] = $puntos;
		$datos['id_horario'] = $id_horario;
		$datos['rol'] =  rawurldecode($rol);
		$datos['sueldo'] = $sueldo;

		var_dump($datos);

		$this->Profesor_model->confirmar_importe($datos);

		chrome_log("confirmar_importe");

		redirect(base_url()."index.php/profesor/informacion_profesor/".$id_profesor);

	else:

		chrome_log("No Paso validacion");
		redirect('home');

	endif; 
}

public function procesa_editar_importe_tesoreria() // Tesoreria confirma el importa puesto por el coordinador y lo pasa al campo IMPORTE (el campo que paga)
{
 
 $this->load->helper('general_helper');
	if ( $this->form_validation->run('editar_importe_profesor') == FALSE ): // INVALIDO

		chrome_log("No paso Validacion");
	    $mensaje = 'ERROR: no paso la validacion al editar importe de tesoreria, faltan parametros o alguno es incorrecto. Intente mas tarde';
	    log_message('error', $mensaje );

		$this->load->library('user_agent');
				
		if(strpos($this->agent->referrer(), 'informacion_profesor')): // Si lo edito desde el profesor

			redirect(base_url()."index.php/profesor/informacion_profesor/".$_POST['idUsuario']);	

		else: // Si lo edito desde el programa
			
			$c_identificacion = $_POST['c_identificacion'];
			$c_programa = $_POST['c_programa'];
			$c_orientacion = $_POST['c_orientacion'];
			$n_fila_curso = $_POST['n_fila_curso'];	

			redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/".rawurlencode($mensaje));			

		endif;
	
	else: // VALIDO

		chrome_log("Paso Validacion");

		if( $this->Profesor_model->procesa_editar_importe_tesoreria($_POST) ): // Actualizo el importe

			chrome_log("Actualizo el importe en la BD");

			$this->load->library('user_agent');
				
			if(strpos($this->agent->referrer(), 'informacion_profesor')):

				redirect(base_url()."index.php/profesor/informacion_profesor/".$_POST['idUsuario']);	

			else:
				
				$c_identificacion = $_POST['c_identificacion'];
				$c_programa = $_POST['c_programa'];
				$c_orientacion = $_POST['c_orientacion'];
				$n_fila_curso = $_POST['n_fila_curso'];

				$mensaje = rawurlencode("Importe actualizado exitosamente");

			endif;

		else: //  NO actualizo ingreso

			$mensaje = 'ERROR: no pudo actualizar el importe en la base de datos. Intente mas tarde';
	    	log_message('error', $mensaje );
			chrome_log($mensaje);
			$mensaje = rawurlencode($mensaje);

		endif;

		redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje");		

	endif; 
}

public function procesa_editar_importes_check()  // Procesa los chequeados
{ 
	$this->load->helper('general_helper');
	// Chequeo los confirmar default
	if(isset($_POST['confirmar_default'])):

		chrome_log("confirmar_default");
		
		if(isset($_POST['check_importe_default'])):

			chrome_log("check_importe_default");
			
			//echo count($_POST['check_importe_default']);
			foreach ($_POST['check_importe_default'] as $row):

				$row = str_replace("-", "\"", $row);
				$variables = json_decode($row);

				//echo $variables['id_materia']; 
				//echo $variables->{'id_profesor'};

				$datos['id_materia'] = $variables->{'id_materia'};
				$datos['idUsuario'] = $variables->{'id_profesor'};
				$datos['id_curso'] = $variables->{'id_curso'};
				$datos['anio_lectivo'] = $variables->{'anio_lectivo'};
				$datos['puntos'] = $variables->{'puntos'};
				$datos['id_horario'] = $variables->{'id_horario'};
				$datos['rol'] =  rawurldecode($variables->{'rol'});
				$datos['sueldo'] = $variables->{'sueldo'};
				$datos['c_identificacion'] = $variables->{'c_identificacion'};
				$datos['c_programa'] = $variables->{'c_programa'};
				$datos['c_orientacion'] = $variables->{'c_orientacion'};
				$datos['n_fila_curso'] = $variables->{'n_fila_curso'};

				//var_dump($datos);

				$this->Profesor_model->confirmar_importe($datos);
			
			endforeach;

			$this->load->library('user_agent');
			
			if(strpos($this->agent->referrer(), 'informacion_profesor')):
				redirect(base_url()."index.php/profesor/informacion_profesor/".$variables->{'id_profesor'});
			else:

				$c_identificacion = $datos['c_identificacion'];
				$c_programa = $datos['c_programa'];
				$c_orientacion = $datos['c_orientacion'];
				$n_fila_curso = $datos['n_fila_curso'];

				$mensaje = rawurlencode("Importes copiados exitosamente");

				redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje/");

				//redirect($this->agent->referrer());
			endif;

			
				
			//redirect(base_url()."index.php/profesor/informacion_profesor/".$variables->{'id_profesor'});
								//echo "aaaa";

		endif;

	endif;

	// Chequeo los coordinadores

	if(isset($_POST['confirmar_coordinadores'])):

		chrome_log("confirmar_coordinadores");

		if(isset($_POST['check_importe_coordinador'])):

			chrome_log("check_importe_coordinador");

			foreach ($_POST['check_importe_coordinador'] as $row):

				$row = str_replace("-", "\"", $row);
				$variables = json_decode($row);

				$datos['id_materia'] = $variables->{'id_materia'};
				$datos['idUsuario'] = $variables->{'id_profesor'};
				$datos['id_curso'] = $variables->{'id_curso'};
				$datos['anio_lectivo'] = $variables->{'anio_lectivo'};
				$datos['puntos'] = $variables->{'puntos'};
				$datos['id_horario'] = $variables->{'id_horario'};
				$datos['rol'] =  rawurldecode($variables->{'rol'});
				$datos['sueldo'] = $variables->{'sueldo'};

				$this->Profesor_model->confirmar_importe($datos);
			
			endforeach;
			
			$this->load->library('user_agent');

			if(strpos($this->agent->referrer(), 'informacion_profesor')):
				redirect(base_url()."index.php/profesor/informacion_profesor/".$variables->{'id_profesor'});
			else:
				redirect($this->agent->referrer());
			endif;
				//redirect($this->agent->referrer());
				//echo $this->agent->referrer();
			
		else:
			echo "No paso";
		endif;

	endif;

    $this->load->library('user_agent');
		redirect($this->agent->referrer());
}

public function exportar_pdf($id_profesor) 
{
	if(!isset($id_profesor) && !isset($_POST['idUsuario']))
		redirect(base_url()."index.php/home/");

	$this->load->library('Pdf');
	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Tesoreria');
	$pdf->SetTitle('Tesoreria - Cursos y profesores');
	$pdf->SetSubject('Tesoreria');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, array(141, 1, 43), array(141, 1, 43));
	$pdf->setFooterData($tc = array(141, 1, 43), $lc = array(141, 1, 43));
	// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	// se pueden modificar en el archivo tcpdf_config.php de libraries/config
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	// se pueden modificar en el archivo tcpdf_config.php de libraries/config
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	// se pueden modificar en el archivo tcpdf_config.php de libraries/config
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	//relación utilizada para ajustar la conversión de los píxeles
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// ---------------------------------------------------------
	// establecer el modo de fuente por defecto
	$pdf->setFontSubsetting(true);

	// Establecer el tipo de letra

	//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
	//  para reducir el tamaño del archivo.
	$pdf->SetFont('Helvetica', '', 10, '', true);

	// Añadir una página
	// Este método tiene varias opciones, consulta la documentación para más información.
	$pdf->AddPage();

	//fijar efecto de sombra en el texto
	//$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

	$html = "<style type=text/css>";
	$html .= "table{ padding:5px;  }";
	$html .= "th{color: white; height:25px; font-size:10px; vertical-align: middle; text-align:center; font-weight: bold; background-color: #222}";
	$html .= "td{background-color: #E6E6E6;  border: solid 1px A4A4A4; padding-left:10px; vertical-align: middle; font-size:9px; height:20px; color: #000}";

	$html .= "p{ color: red; font-size:7px; }";

	$html .= "p.total{ color: red; font-size:12px; }";

	$html .= "th.programa { width: 150px;}";
	$html .= "td.programa { width: 150px;}";

	$html .= "th.materia { width: 200px;}";
	$html .= "td.materia { width: 200px;}";

	$html .= "th.fecha_inicio { width: 70px;}";
	$html .= "td.fecha_inicio { width: 70px;  text-align:center;}";

	$html .= "th.rol { width: 90px;}";
	$html .= "td.rol { width: 90px; text-align:center;}";

	$html .= "th.importe { width: 60px;}";
	$html .= "td.importe { width: 60px; text-align:right; padding-right:10px}";

	$html .= "th.extra_contrato { width: 130px;}";
	$html .= "td.extra_contrato { width: 130px; text-align:right; padding-right:10px}";


	$html .= "th.total_extra_contrato { width: 130px; text-align:right; padding-right:10px}";        

	$html .= "th.concepto { width: 150px;}";
	$html .= "td.concepto { width: 150px;}";

	$html .= "th.observaciones { width: 360px;}";
	$html .= "td.observaciones { width: 360px;}";

	$html .= "th.liquidacion { width: 60px;}";
	$html .= "td.liquidacion { width: 60px; text-align:right; padding-right:10px}";

	$html .= "th.importe_de_extra { width: 130px;}";
	$html .= "td.importe_de_extra { width: 130px; text-align:right; padding-right:10px}";


	$html .= "th.totales_finales { width: 510px;}";


	$html .= "</style>";

	// Informacion de los cursos del profesor
	$profesores_cursos = $this->Profesor_model->traer_cursos_profesor($id_profesor);
	$nombre_profesor = $this->Profesor_model->traer_profesor($id_profesor);
	$contrato_profesor = $this->Profesor_model->traer_contrato_profesor($id_profesor);
	$extras_profesor = $this->Profesor_model->traer_extras($id_profesor);
	$valor_punto = $this->Profesor_model->traer_valor_punto();

	$total_contrato = $contrato_profesor->N_PUNTOS*$valor_punto;

	if($contrato_profesor->N_CLASE_EJEC):

	    $total_contrato += $contrato_profesor->N_CLASE_EJEC*$this->Programas_model->traer_importe_clase();

	endif;

	chrome_log("MODELOS");

	if( $this->Profesor_model->fulltime($id_profesor) == 1 )
	    $tipo_profesor= "Full Time";   
	else
	    $tipo_profesor = "Part Time";

	chrome_log("TIPO");

	// $html .= "<div style='float:right;' ><h6 >Fecha: ".date('d/m/Y').".</h6></div>";
	$html .= "<h4>Profesor: ".utf8_encode($nombre_profesor->D_APELLIDOS).", ".utf8_encode($nombre_profesor->D_NOMBRES).".</h4>";
	$html .= "<h5>&#8226; Tipo de Profesor: ".$tipo_profesor.".<h5>";
	$html .= "<h5>&#8226; Cantidad de cursos: ".$profesores_cursos->num_rows().".<h5>";

	if($contrato_profesor->N_PUNTOS):

	         $html .= "<h5>&#8226; Pts. contrato: ".$contrato_profesor->N_PUNTOS.".<h5>";
	         $html .= "<h5>&#8226; Cursos contrato: $".$contrato_profesor->N_PUNTOS*$valor_punto.".<h5>";
	endif;

	if($contrato_profesor->N_CLASE_EJEC):

	         $html .= "<h5>&#8226; Clases. PEJ: ".$contrato_profesor->N_CLASE_EJEC.".<h5>";
	         $html .= "<h5>&#8226; Clases contrato: $".$contrato_profesor->N_CLASE_EJEC*$this->Programas_model->traer_importe_clase().".<h5>";
	endif;


	$total_acordado_coordinador = 0;
	$total_a_pagar = 0;

	$html .= "<div class='table-responsive' >";  
	$html .= "<br><table  border='1' cellpadding='20'>";
	$html .= ' 
	                <tr>
	                    <th class="programa">Programa</th>
	                    <th class="materia"> Materia</th>
	                    <th class="rol">Rol</th>
	                    <th class="fecha_inicio"> Fecha <br> Inicio </th>
	                    <th class="importe">Importe<br>Cursos</th>
	                    <th class="extra_contrato">Extra Contrato<p>( Importe cursos - Cursos contrato )</p></th>
	                </tr>
	           ';          
	            
	            foreach ( $profesores_cursos->result() as $row ):

	                $id_materia = $row->N_ID_MATERIA;
	                $id_profesor = $row->N_ID_PERSONA;
	                $id_curso = $row->N_CURSO;
	                $anio_lectivo = $row->ANIO_LECTIVO;
	                $id_horario = $row->N_ID_HORARIO;
	                $rol = $row->C_ROL;
	                $tipo_clase =  $row->C_TIPO_CLASE;
	                $c_identificacion = $row->C_IDENTIFICACION;
	                $c_programa  = $row->C_PROGRAMA;
	                $c_orientacion  = $row->C_ORIENTACION;

	                $sueldo =  $this->Programas_model->traer_importe_default($rol,$tipo_clase,$c_identificacion, $id_materia, $c_programa, $c_orientacion, $id_profesor, $anio_lectivo, $id_curso, $id_horario );
	                $vector_importe = explode("|", $sueldo);
	                
	                if(isset($row->N_IMPORTE_PROFESOR)): 
	                                        
	                    $importe_profesor = $row->N_IMPORTE_PROFESOR;
	                    $total_acordado_coordinador += $row->N_IMPORTE_PROFESOR;
	                
	                else:
	                
	                    $importe_profesor =  $vector_importe[0];
	                    $total_acordado_coordinador += $vector_importe[0];

	                endif;

	                $total_a_pagar += $row->IMPORTE;
	                
	                $html .= '
	                <tr>
	                    <td class="programa"> '.utf8_encode($row->PROGRAMA).'</td>
	                    <td class="materia">'.utf8_encode($row->D_PUBLICA).'</td>
	                    <td class="rol">'.utf8_encode($row->C_ROL).'</td>
	                    <td class="fecha_inicio" >'.utf8_encode($row->FECHA_INI).'</td>
	                    <td class="importe">$ '.round(utf8_encode($importe_profesor),2).'</td>
	                    <td class="extra_contrato">$ '.utf8_encode($row->IMPORTE).'</td>
	                </tr>';   

	                // El extra contrato es para los FULL por si se le esta pagando y no es 0 por que no es del contrato..
	                // Por encima del contrato, sino estaria en 0.

	            endforeach;

	    $html .= '
	                <tr>
	                    <th colspan="4">TOTAL POR CURSOS</th>
	                    <th>$ '.round($total_acordado_coordinador,2).'</th>
	                    <th class="total_extra_contrato">$ '.round($total_a_pagar,2).'</th>
	                </tr>
	           ';   

	$html .= " <tr><td></td></tr>"; 

	$total_a_pagar_extras = 0;

	if( $extras_profesor->num_rows() > 0 ):

	$html .= ' 
	                <tr>
	                    <th class="concepto">Concepto</th>
	                    <th class="observaciones">Observaciones</th>
	                    <th class="liquidacion">Liquidacion</th>
	                    <th class="importe_de_extra">Importe</th>
	                </tr>
	           ';    

	foreach ( $extras_profesor->result() as $row ):

	    
	    $total_a_pagar_extras+=$row->IMPORTE;
	    
	     
	    $html .= "  <tr>
	                    <td class='concepto'>".utf8_encode($row->CPTO_NOMBRE)."</td>";
	    

	    if( $row->C_OBSERVACIONES ):
	        
	        $html .= '<td class="observaciones" >'.utf8_encode($row->C_OBSERVACIONES).'</td>'; 
	    
	    else:

	        $html .= '<td class="observaciones" > </td>';
	            
	    endif;  

	    $html .= '    <td class="liquidacion">'.$row->LIQUIDACION.'</td>
	                  <td class="importe_de_extra">$ '.round($row->IMPORTE,2).'</td>';
	    $html .="   </tr>";    
	    

	endforeach;


	endif;



	           // Extras x cursos         // Extra por extra              // Contrato 
	$total_final = round($total_a_pagar,2) + round($total_a_pagar_extras,2) + round($total_contrato,2);


	$html .= ' 
	                <tr>
	                    <th class="totales_finales"> TOTAL POR EXTRAS:</th>
	                    <th class="liquidacion"> </th>
	                    <th  class="importe_de_extra">$ '.round($total_a_pagar_extras,2).'</th>
	                </tr>
	            '; 

	$subtotal_extras = $total_a_pagar_extras + $total_a_pagar;

	$html .= ' 
	                <tr>
	                    <th class="totales_finales"> SUBTOTAL EXTRA CONTRATO + EXTRAS:</th>
	                    <th class="liquidacion"> </th>
	                    <th  class="importe_de_extra">$ '.round($subtotal_extras,2).'</th>
	                </tr>
	            '; 
 

	$html .= ' 
	                <tr>
	                    <th class="totales_finales"> TOTAL POR CONTRATO:</th>
	                    <th class="liquidacion"> </th>
	                    <th  class="importe_de_extra">$ '.round($total_contrato,2).'</th>
	                </tr>
	            '; 

	$pago_de_mas = 0;

	//if( $total_acordado_coordinador < $total_contrato ): // Trabajo menos que lo acordado por contrato

	$pago_de_mas = $total_acordado_coordinador - $total_contrato;

	$html .= ' 
                <tr>
                    <th class="totales_finales"> DIFERENCIA ENTRE TRABAJADO Y CONTRATO:</th>
                    <th class="liquidacion"> </th>
                    <th class="importe_de_mas">$ '.round( $pago_de_mas  , 2 ).'</th>
                </tr>
            '; 


	//endif;


	$total = $pago_de_mas + $total_contrato + $total_a_pagar_extras ;

	$html .= ' 
	                <tr>
	                    <th class="totales_finales"> TOTAL GENERAL (CURSOS EXTRA CONTRATO + EXTRAS + CONTRATO):</th>
	                    <th class="liquidacion">$ '.round(($total_acordado_coordinador+$total_a_pagar_extras),2).'</th>
	                    <th class="importe_de_extra"><p class="total">$ '.$total.'</p></th>
	                </tr>
	            '; 


	$html .= "   </table>";
	$html .= " </div>"; 



	// Imprimimos el texto con writeHTMLCell()
	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

	// ---------------------------------------------------------
	// Cerrar el documento PDF y preparamos la salida
	// Este método tiene varias opciones, consulte la documentación para más información.
	$nombre_archivo = utf8_decode("cursos_profesor.pdf");
	$pdf->Output($nombre_archivo, 'I');
}

public function exportar_cursos_xls($id_profesor) 
{
	$this->load->helper('general_helper');

	$query=$this->Profesor_model->cursos_asignados_profesor_exportar( $id_profesor );  

	export_to_xls($query);	

}

public function ajax_profesor()
{	
	$id_direcctor = $this->session->userdata('id_persona');

	chrome_log("relacion: ".$this->input->get('relacion'));
	
	$relacion = ' ';
	$sin_curso = ' ';

	// Busca profesores con alguna relacion 
	if( $this->input->get('relacion') != 'sin_curso'):

	 		if( $this->input->get('relacion') == 'Autonomos' || $this->input->get('relacion') == 'dependencia' ):
	 		
	 			$relacion = 'AND c.M_RELACION LIKE \'%'.$this->input->get('relacion').'%\'';

	 		endif;


	else:  // Busca profesores sin curso
 	
			$sin_curso = ' AND  p.N_ID_PERSONA NOT IN ( 	SELECT distinct(cp.n_id_persona)
															FROM cursos_profesores cp
															WHERE cp.c_año_lectivo = (extract(YEAR FROM sysdate)) 
													 	)';
 	endif;

	
	if($buscar = $this->input->get('term'))
	{
		$buscar = strtoupper($buscar);
		$buscar = str_replace(" ", "%", $buscar);
		$buscar = str_replace("ñ", "Ñ", $buscar);

		$query=$this->db->query((utf8_decode("	SELECT P.N_ID_PERSONA AS id, P.D_APELLIDOS || ', ' || P.D_NOMBRES AS value, c.M_RELACION
												FROM PERSONAS p, contratos c 
												WHERE 
														p.persona_type = 'Docente' AND  
														c.n_id_persona =p.n_id_persona AND
														c.f_hasta is null AND
														TRANSLATE(upper(P.d_apellidos),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '$buscar%'
														$relacion
														$sin_curso
												ORDER by p.d_apellidos, p.d_nombres" )));

		chrome_log("	SELECT P.N_ID_PERSONA AS id, P.D_APELLIDOS || ', ' || P.D_NOMBRES AS value, c.M_RELACION
												FROM PERSONAS p, contratos c 
												WHERE 
														p.persona_type = 'Docente' AND  
														c.n_id_persona =p.n_id_persona AND
														c.f_hasta is null AND
														TRANSLATE(upper(P.d_apellidos),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '$buscar%'
														$relacion
														$sin_curso
												ORDER by p.d_apellidos, p.d_nombres");

		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$result[]= array("id" => utf8_encode($row->ID) , "value" => utf8_encode($row->VALUE) , "relacion_dependencia" => utf8_encode($row->M_RELACION));
			}
		}
		
		echo json_encode($result);
	}
}

public function procesa_a_pagar()
{	
	if ($this->form_validation->run('a_pagar') == FALSE): // INVALIDO

		chrome_log("NO PASO VALIDACION");
		redirect(base_url()."index.php/profesor/informacion_profesor/".$_POST['id_profesor']);

	else: // VALIDO 

		$sugerencia = $this->input->post('sugerencia');
		$datos_fila = $this->input->post('datos_sugerencia');

		for($i=0; $i < count($sugerencia); $i++  ):

			//echo $sugerencia[$i]." - ";
			//echo $datos_fila[$i]."<br>";

			$row = str_replace("-", "\"", $datos_fila[$i]);
			$variables = json_decode($row);


			$datos['idUsuario'] = $variables->{'id_profesor'};
			$datos['id_materia'] = $variables->{'id_materia'};
			$datos['id_curso'] = $variables->{'id_curso'};
			$datos['anio_lectivo'] = $variables->{'anio_lectivo'};
			$datos['puntos'] = $variables->{'puntos'};
			$datos['id_horario'] = $variables->{'id_horario'};
			$datos['rol'] =  rawurldecode($variables->{'rol'});
			$datos['sueldo'] = $sugerencia[$i];

			$datos['c_identificacion'] = $variables->{'c_identificacion'};
			$datos['c_programa'] =  $variables->{'c_programa'};
			$datos['c_orientacion'] = $variables->{'c_orientacion'};

			$this->Profesor_model->confirmar_importe($datos);	

		endfor;

 
		redirect(base_url()."index.php/profesor/informacion_profesor/".$variables->{'id_profesor'}); 

	endif;
}

}

/* End of file  */
/* Location: ./application/controllers/ */