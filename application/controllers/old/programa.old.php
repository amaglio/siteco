<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programa extends CI_Controller {

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
		$this->load->model('Profesor_model');
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

		endif;

		//$this->output->enable_profiler(TRUE);
	}

	//public function index($carrera)
	public function index($c_identificacion,$c_programa,$c_orientacion, $n_fila_curso=-1, $mensaje=null)
	{	

		if( in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) || in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) ): // Si es coordinador

			 if( $this->Programas_model->permiso_ver_programa($c_identificacion,$c_programa,$c_orientacion) == 0 ):

				redirect(base_url()."index.php/home/");

			else:
								
				//$row_programa = $datos_programa->row();

				$this->data['vista_head'] = $this->load->view('estructura/head', $this->data , true);


			endif;

		elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))):
		 

				$this->data['vista_head'] = $this->load->view('estructura/head_tesoreria', $this->data , true);


		endif;

		if($mensaje)
				$this->data['mensaje'] = rawurldecode($mensaje);


		if($n_fila_curso)
				$this->data['n_fila_curso'] = $n_fila_curso;

		//$this->data['mensaje'] = "aaaaa";

		$this->data['datos_programa'] = $this->Programas_model->datos_programa($c_identificacion,$c_programa,$c_orientacion);	

		$this->load->view('programa',$this->data); 
	}

	/*
		Se llama desde los años 
	*/

	function informacion_anio($anio,$c_identificacion,$c_programa,$c_orientacion, $n_fila_curso = -1 )
	{
		// echo "Fila: ".$n_fila_curso;

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

		else:
			
			$data['cursos_asignados']=$this->Programas_model->cursos_asignados_programa(	$c_identificacion, 
																							$c_programa, 
																							$c_orientacion,
																							$anio
																						); 
		endif;




		$data['n_fila_curso'] = $n_fila_curso;


		$data['cantidad_cursos_confirmados']=$this->Programas_model->cursos_confirmados_programa(	
																									$c_identificacion, 
																									$c_programa, 
																									$c_orientacion,
																									$anio
																								); 

		$this->load->view('informacion_programa',$data);
	}

	function exportar_cursos_asignados_excel($anio,$c_identificacion,$c_programa,$c_orientacion)
	{

		if($c_identificacion==3):

			// Con clases !

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


	function confirmar_curso()
	{
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
	}

	function desconfirmar_curso()
	{
		chrome_log("Programa_model/desconfirmar_curso");

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
	}


	function procesa_agregar_comentario()
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


	/*
		Buscar profesores por ajax.
	*/
	// PONIENDO Ñ en el buscador aparecen, mirar que es por ahi el tema !

	function ajax_profesor()
	{	
		$id_direcctor = $this->session->userdata('id_persona');
		
		if($buscar = $this->input->get('term'))
		{
			$buscar = strtoupper($buscar);
			$buscar = str_replace(" ", "%", $buscar);
			$buscar = str_replace("ñ", "Ñ", $buscar);

			chrome_log("	SELECT P.N_ID_PERSONA AS id, P.D_APELLIDOS || ', ' || P.D_NOMBRES AS value
							FROM PERSONAS p, contratos c 
							WHERE 
									p.persona_type = 'Docente' AND  
									c.n_id_persona =p.n_id_persona AND
									c.f_hasta is null AND
									TRANSLATE(upper(P.d_apellidos),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '%$buscar%'
							ORDER by p.d_apellidos, p.d_nombres");

			$query=$this->db->query((utf8_decode("	SELECT P.N_ID_PERSONA AS id, P.D_APELLIDOS || ', ' || P.D_NOMBRES AS value
													FROM PERSONAS p, contratos c 
													WHERE 
															p.persona_type = 'Docente' AND  
															c.n_id_persona =p.n_id_persona AND
															c.f_hasta is null AND
															TRANSLATE(upper(P.d_apellidos),'ÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛÑñ','AEIOUAEIOUAEIOUAEIOUÑÑ') LIKE '%$buscar%'
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

	// Se cambio el importe default 

	function procesa_editar_importe_curso()
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


	
	// Genera la notificacion cuando se ingresa una notificacion
	function confirmar_cursos_secretario($c_identificacion, $c_programa, $c_orientacion)
	{
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

	function procesa_confirmar_cursos_check()
	{
		chrome_log("procesa_confirmar_cursos_check");


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

					//redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion");
			else:

				chrome_log("No chequeo ninguno");

				$c_identificacion = $_POST['c_identificacion'];
				$c_programa = $_POST['c_programa'];
				$c_orientacion = $_POST['c_orientacion'];
				
				$mensaje = rawurlencode("Error: No ha seleccionado ningun curso para confirmar.");
				redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/-1/$mensaje/");
				

			endif;
	}
	
	/*
		En la seccion a PAGAR cuando se confirma enviar las sugerencias a los IMPORTES de la BD
	*/

	function procesa_a_pagar()
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


	function cursos_modificados()
	{		
		$this->data['cursos_modificados'] = $this->Programas_model->cursos_cambiados();
		$this->data['vista_head'] = $this->load->view('estructura/head_tesoreria', $this->data , true);
		$this->load->view('cursos_modificados',$this->data);
	}


	function cursos_sin_confirmar_coordinador()
	{		
		$this->data['vista_head'] = $this->load->view('estructura/head_tesoreria', $this->data , true);
		$this->data['cursos_sin_confirmar_coordinador'] = $this->Programas_model->cursos_sin_confirmar_coordinador();
		$this->load->view('cursos_sin_confirmar_coordinador',$this->data);
	}

	function cursos_sin_importe_tesoreria()
	{		
		$this->data['cursos_sin_importe_tesoreria'] = $this->Programas_model->cursos_sin_importe_tesoreria();
		$this->data['vista_head'] = $this->load->view('estructura/head_tesoreria', $this->data , true);
		$this->load->view('cursos_sin_importe_tesoreria',$this->data);
	}

	// ________________________________________________________________________________________
	//
	// 						ARCHIVO RIACCO  
	// ____________________________________________________________________________________

	function riaco()
	{		
		$this->data['vista_head'] = $this->load->view('estructura/head_tesoreria', $this->data , true);
		$this->load->view('cargar_archivo_riaco',$this->data);
	}

	function procesa_archivo_riaco()
	{		
		chrome_log("procesa_archivo_riaco");
		$this->data['vista_head'] = $this->load->view('estructura/head_tesoreria', $this->data , true);

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
				$this->load->view('download_archivo_riaco',$this->data);
	        
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
	}
		
		/*
	function desconfirmar_curso($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $c_identificacion,$c_programa,$c_orientacion,$n_fila_curso)
	{
		$data['id_profesor'] = $id_profesor;
		$data['idUsuario'] = $id_profesor;
		$data['id_materia'] = $id_materia;
		$data['id_curso'] = $id_curso;
		$data['anio_lectivo'] = $anio_lectivo;
		$data['puntos'] = $puntos;
		$data['id_horario'] = $id_horario;
		$data['sueldo'] = $sueldo;
		$data['rol'] = rawurldecode($rol);

		$mensaje = rawurlencode("Curso desconfirmados correctamente");
		
		$this->Programas_model->desconfirmar_curso($data);
		redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje/");
	}
*/
	

	/*
	//function historial_curso($comentario,$id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo,$carrera)
	function historial_curso($comentario,$id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo,$c_identificacion,$c_programa,$c_orientacion)
	{
		$data['id_profesor'] = $id_profesor;
		$data['idUsuario'] = $id_profesor;
		$data['id_materia'] = $id_materia;
		$data['id_curso'] = $id_curso;
		$data['anio_lectivo'] = $anio_lectivo;
		$data['puntos'] = $puntos;
		$data['id_horario'] = $id_horario;
		$data['sueldo'] = $sueldo;

		$data['c_identificacion'] = $c_identificacion;
		$data['c_programa'] = $c_programa;
		$data['c_orientacion'] = $c_orientacion;

		$data['rol'] = rawurldecode($rol);
		$data['comentarios'] = rawurldecode($comentario); 

		$this->load->view('comentarios_cursos',$data);
	}*/
 
		/*	
	function editar_programa($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $c_identificacion,$c_programa,$c_orientacion)
	{
		//echo $id_materia."/".$id_profesor."/".$id_curso."/".$id_anio_lectivo."/".$puntos ;
		//echo "aa"; 
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

		$data['c_identificacion'] = $c_identificacion;
		$data['c_programa'] = $c_programa;
		$data['c_orientacion'] = $c_orientacion;
		
		$data['sueldo'] = $sueldo;

		// Buscar si tiene el precio cargado y si lo tiene, enviarlo.

		$this->load->view('editar_programa',$data); 
	}*/

	/*
	function confirmar_curso($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $c_identificacion,$c_programa,$c_orientacion,$n_fila_curso)
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

		$data['c_identificacion'] = $c_identificacion;
		$data['c_programa'] = $c_programa;
		$data['c_orientacion'] = $c_orientacion;

		$mensaje = rawurlencode("Curso confirmados correctamente");
		
		$this->Programas_model->curso_confirmado($data);
		redirect(base_url()."index.php/programa/index/$c_identificacion/$c_programa/$c_orientacion/$n_fila_curso/$mensaje/");
	}*/
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */