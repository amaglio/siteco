<?php

// [CAMBIAR]  
//--sacar el USUARIO ORACLE POR ID_PERSONA MGALLACHER

class Programas_model extends CI_Model {

function __construct()
{
	
	parent::__construct(); 	
}


public function datos_programa($c_identificacion,$c_programa,$c_orientacion) // SI
{
 
	chrome_log("model/datos_programa" );

	$sql = 	utf8_decode("	SELECT *
							FROM programas
							WHERE c_identificacion =  ? AND		
								  c_programa =  ? AND
								  c_orientacion =  ? ") ;

	$query = $this->db->query($sql, array( $c_identificacion, $c_programa, $c_orientacion ) );

	return $query; 
}

public function plan_estudio_total($c_identificacion,$c_programa,$c_orientacion, $anio) // SI
{
    	 
	chrome_log("model/plan_estudio_total" );

	$sql = 	utf8_decode("	SELECT distinct(m.n_id_materia) as id, pm.N_AÑO_CARRERA as anio, pm.n_periodo_carrera as periodo, m.d_descrip,pm.n_grupo, devuelve_programa(pm.c_identificacion, pm.c_programa, pm.c_orientacion) as prg
							FROM planes_materias pm, materias m
							WHERE 
									pm.c_plan =  ? ||'00' AND
									pm.c_identificacion = ? AND
									pm.c_programa = ? AND
									pm.c_orientacion = ? AND
									pm.n_id_materia = m.n_id_materia AND
									pm.n_grupo != 2
							ORDER BY prg, pm.N_AÑO_CARRERA, pm.n_periodo_carrera,m.d_descrip  ") ;

	$query = $this->db->query($sql, array( $anio, $c_identificacion, $c_programa, $c_orientacion ) );

	return $query; 
}

public function cursos_cambiados_programa($c_identificacion,$c_programa,$c_orientacion,$anio) // SI	 
{
	chrome_log("model/cursos_cambiados_programa" );

	$sql = 	utf8_decode("	SELECT cpc.f_alta, cpc.C_Usuarioalt, Cpc.C_Tipo_Clase, Cpc.C_Rol, cpc.C_Usuarioalt as usuario_alta, cpc.D_OBSERV,
								   P.D_Apellidos || ',' || P.D_Nombres as profesor, 
								   M.D_Descrip as materia

							FROM cursos_profesores_cambios cpc, cursos c, materias m, comisiones co, personas p
							WHERE Cpc.N_Curso = C.N_Curso
							AND 	C.N_Id_Comision = co.N_Id_Comision
							AND   	Cpc.C_Año_Lectivo = C.C_Año_Lectivo
							AND   	C.N_Id_Materia = M.N_Id_Materia	 
							AND 	Cpc.N_Id_Persona = p.N_Id_Persona
							AND   	co.c_identificacion = ?
							AND   	co.c_programa = ?
							AND   	co.c_orientacion = ?
							AND  	Cpc.C_Año_Lectivo = ?
							ORDER BY cpc.f_alta asc   ") ;

	$query = $this->db->query($sql, array($c_identificacion, $c_programa, $c_orientacion, $anio ) );

	return $query; 
}

//--- Traer cursos

public function cursos_asignados_programa($c_identificacion,$c_programa,$c_orientacion,$anio) // SI
{
	chrome_log("model/cursos_asignados_programa" );

	$sql = 	utf8_decode("	SELECT cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
										       cp.n_id_horario, cp.n_id_persona, cp.c_tipo_clase, cp.c_rol, cp.importe, cp.n_porcentaje, cp.f_pagado,cp.C_CONFIRMADO,cp.C_OBS,cp.N_IMPORTE_PROFESOR,
										       m.c_identificacion, m.c_programa, m.c_orientacion, m.d_descrip,
										       p.d_apellidos ||', '|| p.d_nombres as nombre, p.persona_type, 
										       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,
										       pm.N_AÑO_CARRERA as anio,
										       co.d_publica as comision, co.c_identificacion, co.c_programa,co.c_orientacion,
										       CURSO_HORARIO (cu.n_curso , cu.C_AÑO_LECTIVO, cp.n_id_persona ) as turnos
							FROM cursos cu, 
							     cursos_profesores cp, 
							     materias m, 
							     personas p, 
							     horarios ch,
							     planes_materias pm, 
							     comisiones co
							WHERE 
							   	co.c_año_lectivo = ? AND
							    cu.c_año_lectivo = ? AND
							    cp.c_año_lectivo= ? AND
							     
							    pm.c_plan = ? ||'00' AND
							    
							    cu.n_curso = cp.n_curso AND
							    cp.n_id_persona = p.n_id_persona AND
							    
							    cu.n_id_materia = m.n_id_materia AND
							    pm.n_id_materia = cu.n_id_materia AND
							    
							    ch.n_id_horario = cp.n_id_horario AND
							    
							    cu.n_id_comision = co.n_id_comision AND
							    										    
							    co.c_identificacion = pm.c_identificacion AND
							    co.c_programa = pm.c_programa AND
							    co.c_orientacion = pm.c_orientacion AND
							    
							    co.c_identificacion = $c_identificacion AND
							    co.c_programa = $c_programa  AND
							    co.c_orientacion = $c_orientacion  AND

							    -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			

							  	cp.n_id_horario = (Select min(n_id_horario) 
							                               from cursos_profesores cp2
							                               where cp2.c_año_lectivo = cp.c_año_lectivo and
							                                     cp2.n_curso = cp.n_curso and
							                                     cp2.n_id_persona = cp.n_id_persona and
							                                     cp2.c_tipo_clase = cp.c_tipo_clase and
							                                     cp2.c_rol = cp.c_rol)
	    
							ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC   ") ;

	$query = $this->db->query($sql, array($anio, $anio, $anio, $anio, $c_identificacion, $c_programa, $c_orientacion) );

	return $query; 
}
	
public function cursos_asignados_programa_ejepac($c_identificacion,$c_programa,$c_orientacion,$anio)
{
	// Devuelve los cursos asignados con toda su informacion, para PROGRAMAS EJECUTIVOS.	
	// Esto se hizo para ordenar los programas por "clase" (pedido por DAPENA) y para que no se 
	// repitan las clases se uso el MIN y seguir mantiendo la estructura de cursos_profesor.

	chrome_log("model/cursos_asignados_programa_ejepac" );

	$sql = 	utf8_decode("   SELECT min(cl.f_clase) as fecha_clase, 
							       res.anio_lectivo, res.n_curso, res.n_id_materia, res.f_inicio,res.f_fin, res.d_descrip,res.Horario, res.c_tipo_periodo, res.n_periodo,
							       res.n_id_horario, res.n_id_persona, res.c_tipo_clase, res.c_rol, res.importe, res.n_porcentaje, res.f_pagado,res.C_CONFIRMADO,res.C_OBS,res.N_IMPORTE_PROFESOR,
							       res.materia,
							       res.nombre, res.persona_type,
							       res.Horario,
							       res.anio,
							       res.comision, res.c_identificacion, res.c_programa,res.c_orientacion,
							       CURSO_HORARIO (res.n_curso , res.anio_lectivo, res.n_id_persona ) as turnos
							FROM clases cl,
								            (	SELECT  cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
								                     cp.n_id_horario, cp.n_id_persona, cp.c_tipo_clase, cp.c_rol, cp.importe, cp.n_porcentaje, cp.f_pagado,cp.C_CONFIRMADO,cp.C_OBS,cp.N_IMPORTE_PROFESOR,
								                     m.d_descrip as materia, --m.c_identificacion, m.c_programa, m.c_orientacion,
								                     p.d_apellidos ||', '|| p.d_nombres as nombre, p.persona_type,
								                     ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,
								                     pm.N_AÑO_CARRERA as anio,
								                     co.d_publica as comision, co.c_identificacion, co.c_programa,co.c_orientacion
								              	FROM 	cursos cu,
									                   cursos_profesores cp,
									                   materias m,
									                   personas p,
									                   horarios ch,
									                   planes_materias pm,
									                   comisiones co
								              	WHERE
												   	co.c_año_lectivo = ? AND
												    cu.c_año_lectivo = ? AND
												    cp.c_año_lectivo= ? AND
												     
												    pm.c_plan = ? ||'00' AND
									                cu.n_curso = cp.n_curso AND
									                cp.n_id_persona = p.n_id_persona AND
									                cu.n_id_materia = m.n_id_materia AND
									                pm.n_id_materia = cu.n_id_materia AND
									                ch.n_id_horario = cp.n_id_horario AND
									                cu.n_id_comision = co.n_id_comision AND
									                  --m.c_identificacion = pm.c_identificacion AND
									                  --m.c_programa = pm.c_programa AND
									                  --m.c_orientacion = pm.c_orientacion AND
									                co.c_identificacion = pm.c_identificacion AND
									                co.c_programa = pm.c_programa AND
									                co.c_orientacion = pm.c_orientacion AND
								                    co.c_identificacion = ? AND
					    							co.c_programa = ?  AND 
					    							co.c_orientacion = ?	  
					    							-- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			
					    							AND cp.n_id_horario = (		SELECT min(n_id_horario)
													                            FROM cursos_profesores cp2
													                            WHERE cp2.c_año_lectivo = cp.c_año_lectivo AND
													                                     cp2.n_curso = cp.n_curso AND
													                                     cp2.n_id_persona = cp.n_id_persona AND
													                                      cp2.c_tipo_clase = cp.c_tipo_clase AND
													                                      cp2.c_rol = cp.c_rol)
											) res
							WHERE res.n_curso = cl.n_curso
							AND res.n_id_persona = cl.n_id_persona
							AND res.anio_lectivo = cl.C_AÑO_LECTIVO

							AND res.c_tipo_clase = cl.c_tipo_clase
							AND cl.F_CANCELACION is  NULL
							GROUP BY 
							       res.anio_lectivo, res.n_curso, res.n_id_materia, res.f_inicio,res.f_fin, res.d_descrip,res.Horario, res.c_tipo_periodo, res.n_periodo,
							       res.n_id_horario, res.n_id_persona, res.c_tipo_clase, res.c_rol, res.importe, res.n_porcentaje, res.f_pagado,res.C_CONFIRMADO,res.C_OBS,res.N_IMPORTE_PROFESOR,
							       res.materia,
							       res.nombre, res.persona_type,
							       res.Horario,
							       res.anio,
							       res.comision, res.c_identificacion, res.c_programa,res.c_orientacion
							ORDER BY min(cl.f_clase) ASC ") ;

	
	$query = $this->db->query($sql, array($anio, $anio, $anio, $anio, $c_identificacion, $c_programa, $c_orientacion) );

	return $query; 
}

//--- Cantidad de cursos

public function cursos_confirmados_programa($c_identificacion,$c_programa,$c_orientacion,$anio)
{
	chrome_log("model/cursos_confirmados_programa" );

	$sql = 	utf8_decode("	SELECT cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
										       cp.n_id_horario, cp.n_id_persona, cp.c_tipo_clase, cp.c_rol, cp.importe, cp.n_porcentaje, cp.f_pagado,cp.C_CONFIRMADO,cp.C_OBS,cp.N_IMPORTE_PROFESOR,
										       m.c_identificacion, m.c_programa, m.c_orientacion, m.d_descrip,
										       p.d_apellidos ||', '|| p.d_nombres as nombre, p.persona_type, 
										       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,
										       pm.N_AÑO_CARRERA as anio,
										       co.d_publica as comision, co.c_identificacion, co.c_programa,co.c_orientacion
							FROM cursos cu, 
							     cursos_profesores cp, 
							     materias m, 
							     personas p, 
							     horarios ch,
							     planes_materias pm, 
							     comisiones co
							WHERE 
         						cp.c_confirmado = 1 AND
							   	co.c_año_lectivo = ? AND
							    cu.c_año_lectivo = ? AND
							    cp.c_año_lectivo= ? AND
							     
							    pm.c_plan = ? ||'00' AND
							    
							    cu.n_curso = cp.n_curso AND
							    cp.n_id_persona = p.n_id_persona AND
							    
							    cu.n_id_materia = m.n_id_materia AND
							    pm.n_id_materia = cu.n_id_materia AND
							    
							    ch.n_id_horario = cp.n_id_horario AND
							    
							    cu.n_id_comision = co.n_id_comision AND
							    							    
							    co.c_identificacion = pm.c_identificacion AND
							    co.c_programa = pm.c_programa AND
							    co.c_orientacion = pm.c_orientacion AND

							    co.c_identificacion = ? AND
							    co.c_programa = ? AND
							    co.c_orientacion = ?
							    
							ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC ") ;

	$query = $this->db->query($sql, array($anio, $anio, $anio, $anio, $c_identificacion, $c_programa, $c_orientacion) );

	return $query; 
}

public function cursos_confirmados_programa_ejepac($c_identificacion,$c_programa,$c_orientacion,$anio)
{
	chrome_log("model/cursos_confirmados_programa" );

	$sql = 	utf8_decode("	SELECT min(cl.f_clase), 
							       res.anio_lectivo, res.n_curso, res.n_id_materia, res.f_inicio,res.f_fin, res.d_descrip,res.Horario, res.c_tipo_periodo, res.n_periodo,
							       res.n_id_horario, res.n_id_persona, res.c_tipo_clase, res.c_rol, res.importe, res.n_porcentaje, res.f_pagado,res.C_CONFIRMADO,res.C_OBS,res.N_IMPORTE_PROFESOR,
							       res.materia,
							       res.nombre, res.persona_type,
							       res.Horario,
							       res.anio,
							       res.comision, res.c_identificacion, res.c_programa,res.c_orientacion,
							       CURSO_HORARIO (res.n_curso , res.anio_lectivo, res.n_id_persona ) as turnos
							FROM clases cl,
								            (	SELECT  cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
								                     cp.n_id_horario, cp.n_id_persona, cp.c_tipo_clase, cp.c_rol, cp.importe, cp.n_porcentaje, cp.f_pagado,cp.C_CONFIRMADO,cp.C_OBS,cp.N_IMPORTE_PROFESOR,
								                     m.d_descrip as materia, --m.c_identificacion, m.c_programa, m.c_orientacion,
								                     p.d_apellidos ||', '|| p.d_nombres as nombre, p.persona_type,
								                     ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,
								                     pm.N_AÑO_CARRERA as anio,
								                     co.d_publica as comision, co.c_identificacion, co.c_programa,co.c_orientacion
								              	FROM 	cursos cu,
									                   cursos_profesores cp,
									                   materias m,
									                   personas p,
									                   horarios ch,
									                   planes_materias pm,
									                   comisiones co
								              	WHERE
												   	co.c_año_lectivo = ? AND
												    cu.c_año_lectivo = ? AND
												    cp.c_año_lectivo= ? AND
												     
												    pm.c_plan = ? ||'00' AND
									                cu.n_curso = cp.n_curso AND
									                cp.n_id_persona = p.n_id_persona AND
									                cu.n_id_materia = m.n_id_materia AND
									                pm.n_id_materia = cu.n_id_materia AND
									                ch.n_id_horario = cp.n_id_horario AND
									                cu.n_id_comision = co.n_id_comision AND
									                cp.c_confirmado = 1 AND

									                co.c_identificacion = pm.c_identificacion AND
									                co.c_programa = pm.c_programa AND
									                co.c_orientacion = pm.c_orientacion AND
								                    co.c_identificacion = $c_identificacion AND
					    							co.c_programa = $c_programa  AND 
					    							co.c_orientacion = $c_orientacion 	  
					    							-- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			
					    							AND cp.n_id_horario = (	SELECT min(n_id_horario)
													                            FROM cursos_profesores cp2
													                            WHERE cp2.c_año_lectivo = cp.c_año_lectivo AND
													                                     cp2.n_curso = cp.n_curso AND
													                                     cp2.n_id_persona = cp.n_id_persona AND
													                                      cp2.c_tipo_clase = cp.c_tipo_clase AND
													                                      cp2.c_rol = cp.c_rol
													                        )
											) res
							WHERE res.n_curso = cl.n_curso
							AND res.n_id_persona = cl.n_id_persona
							AND res.anio_lectivo = cl.C_AÑO_LECTIVO

							AND res.c_tipo_clase = cl.c_tipo_clase
							AND cl.F_CANCELACION is  NULL
							GROUP BY 
							       res.anio_lectivo, res.n_curso, res.n_id_materia, res.f_inicio,res.f_fin, res.d_descrip,res.Horario, res.c_tipo_periodo, res.n_periodo,
							       res.n_id_horario, res.n_id_persona, res.c_tipo_clase, res.c_rol, res.importe, res.n_porcentaje, res.f_pagado,res.C_CONFIRMADO,res.C_OBS,res.N_IMPORTE_PROFESOR,
							       res.materia,
							       res.nombre, res.persona_type,
							       res.Horario,
							       res.anio,
							       res.comision, res.c_identificacion, res.c_programa,res.c_orientacion
							ORDER BY min(cl.f_clase) ASC ") ;

	$query = $this->db->query($sql, array($anio, $anio, $anio, $anio, $c_identificacion, $c_programa, $c_orientacion) );

	return $query; 
}

// -- Confirmar y desconfirmar 

public function confirmar_curso($data)
{
	$alias = $this->session->userdata('usuario_tesoreria');

	$observacion =  date('d-m-Y')." [".$alias."] - Confirmacion del curso. |";

	$comentario = $this->Programas_model->traer_comentarios_curso($data);

	if(isset($comentario))
		$observacion = $comentario.$observacion;

	$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
						SET C_CONFIRMADO = 1, C_OBS = ?
						WHERE 	N_CURSO = ? AND  
								C_AÑO_LECTIVO = ?	AND
								C_ROL = ?	AND
								N_ID_PERSONA = ? AND
								N_ID_HORARIO = ?");
	
	$query = $this->db->query($sql, array($observacion, $data['id_curso'], $data['anio_lectivo'], $data['rol'], $data['idUsuario'], $data['id_horario'] ));

	if($this->db->affected_rows() == 1)
   	  	return true;
   	else
   		return false;	       	
}

public function desconfirmar_curso($data)
{
		$alias = $this->session->userdata('usuario_tesoreria');

		$observacion =  date('d-m-Y')." [".$alias."] - Desconfirmo del curso. |";

		$comentario = $this->Programas_model->traer_comentarios_curso($data);

		if(isset($comentario))
			$observacion = $comentario.$observacion;

		$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
							SET C_CONFIRMADO = NULL, C_OBS = ?
							WHERE 	N_CURSO = ? AND  
									C_AÑO_LECTIVO = ?	AND
									C_ROL = ?	AND
									N_ID_PERSONA = ? AND
									N_ID_HORARIO = ?");
		
		$query = $this->db->query($sql, array($observacion, $data['id_curso'], $data['anio_lectivo'], $data['rol'], $data['idUsuario'], $data['id_horario'] ));
}

// -- Comentarios

public function insertar_comentario($data)
{
 	$alias = $this->session->userdata('usuario_tesoreria');

 	$observacion =  date('d-m-Y')." [".$alias."] - ".$data['comentario'].". |";

   	$comentario = $this->Programas_model->traer_comentarios_curso($data);

		if(isset($comentario))
			$observacion = $comentario.$observacion;

	$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
						SET C_OBS = ?
						WHERE 	N_CURSO = ? AND  
								C_AÑO_LECTIVO = ?	AND
								C_ROL = ?	AND
								N_ID_PERSONA = ? AND
								N_ID_HORARIO = ? ");


   	$query = $this->db->query($sql, array($observacion, $data['id_curso'], $data['anio_lectivo'], $data['rol'], $data['idUsuario'], $data['id_horario'] ));
	
	if($this->db->affected_rows() == 1)
   	  	return true;
   	else
   		return false;
}

// -- Modificar Importes

public function modificar_importe_coordinador($data)
{
     	$alias = $this->session->userdata('usuario_tesoreria');

     	$observacion =  date('d-m-Y')." [".$alias."] - Modifico el importe del coordinador: $".$data['sueldo'];

       	$comentario = $this->Programas_model->traer_comentarios_curso($data);
 
    		if(isset($comentario)): // Si ya hay un comentario 

    			$observacion = $comentario.$observacion;

    		endif;

    		if(isset($data['comentario']) && $data['comentario'] != "")
	    		$observacion = $observacion.". ".$data['comentario'];


	    $observacion .= " |";

		$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
							SET C_OBS = ? , N_IMPORTE_PROFESOR = ?
							WHERE 	N_CURSO = ? AND  
									C_AÑO_LECTIVO = ?	AND
									C_ROL = ?	AND
									N_ID_PERSONA = ? AND
									N_ID_HORARIO = ? ");


       $query = $this->db->query($sql, array($observacion, $data['sueldo'] , $data['id_curso'], $data['anio_lectivo'], $data['rol'], $data['idUsuario'] , $data['id_horario']  ));
	
       	if($this->db->affected_rows() == 1)
       	  	return true;
       	else
       		return false;
}	

public function ingresar_notificacion($datos, $usuarios_notificados, $texto)
{
	//$sql= " INSERT INTO NOTIFICACION (ID_NOTIFICACION, TEXTO) VALUES ( ID_NOTIFICACION.NEXTVAL, '$texto') ";

   	$sql_comienzo = " INSERT INTO NOTIFICACION (ID_NOTIFICACION, TEXTO  ";
   	$sql_final = "VALUES ( ID_NOTIFICACION.NEXTVAL, '$texto' ";

   	// ID DE CURSO
   	if( isset($datos['id_curso'] )):

   		$sql_comienzo .= ", N_CURSO  ";
   		$sql_final .= ", ".$datos['id_curso'];

   	endif;

   	// AÑO LECTIVO
   	if( isset($datos['anio_lectivo'] )):

   		$sql_comienzo .= ", C_ANIO_LECTIVO  ";
   		$sql_final .= ", ".$datos['anio_lectivo'];

   	endif;

   	// ID DEL PROFESOR 
   	if( isset($datos['idUsuario'] )):

   		$sql_comienzo .= ", N_ID_PROFESOR  ";
   		$sql_final .= ", ".$datos['idUsuario'];

   	endif;

   	// ID DE HORARIO 
		if( isset($datos['id_horario'] )):

   		$sql_comienzo .= ", N_ID_HORARIO  ";
   		$sql_final .= ", ".$datos['id_horario'];

   	endif;

   	if( isset($datos['c_identificacion'] )):

   		$sql_comienzo .= ", C_IDENTIFICACION  ";
   		$sql_final .= ", ".$datos['c_identificacion'];

   	endif;

   	if( isset($datos['c_programa'] )):

   		$sql_comienzo .= ", C_PROGRAMA  ";
   		$sql_final .= ", ".$datos['c_programa'];

   	endif;

   	if( isset($datos['c_orientacion']) ):

   		$sql_comienzo .= ", C_ORIENTACION  ";
   		$sql_final .= ", ".$datos['c_orientacion'];

   	endif;

   	$sql_concatenado = $sql_comienzo.")".$sql_final.")";
	
	$query = $this->db->query(utf8_encode($sql_concatenado));

	$id_notificacion =  $this->db->query(utf8_encode("  SELECT max(id_notificacion) as id_notificacion
														FROM NOTIFICACION " ))->row()->ID_NOTIFICACION;

	//echo $id_notificacion;

    foreach ($usuarios_notificados as $usuario) 
   	{
   			
		$sql = " INSERT INTO NOTIFICACION_USUARIO (ID_NOTIFICACION, USUARIO) 
				 	VALUES (?, ? )";

		$query = $this->db->query($sql, array($id_notificacion, $usuario ));

   	}
}	

public function programas_director_carrera()
{
	// Trae los programas que se encarga el director.
	// En realdiad puede ser que no sea el director y se encargue igual. 
	// Filtra por aquellos que tengan PLAN de este año, para no traer demas.

	$n_id_coordinador = $this->session->userdata('id_persona');
	chrome_log("model/programas_director_carrera" );

	$sql = 	utf8_decode("	SELECT distinct(s.carrera), s.c_identificacion, s.c_programa, s.c_orientacion, p.d_descinf
							FROM 
							        (
							        SELECT cc.*, devuelve_programa(cc.c_identificacion, cc.c_programa, cc.c_orientacion) as CARRERA
							        FROM crm_coordinador_programa cc, planes_materias pm
							        WHERE cc.n_id_persona = ? AND
							              cc.c_identificacion = pm.c_identificacion AND
							              cc.c_programa = pm.c_programa AND
							              cc.c_orientacion = pm.c_orientacion AND
							              pm.c_plan = (extract(YEAR FROM sysdate)) ||'00' ) s,
							        programas p
							WHERE p.c_identificacion =  s.c_identificacion
							AND p.c_programa =  s.c_programa
							AND p.c_orientacion =  s.c_orientacion
							ORDER BY s.c_identificacion, s.carrera ") ;

	$query = $this->db->query($sql, array( $n_id_coordinador ) );

	return $query;  
}


public function permiso_ver_programa($c_identificacion,$c_programa,$c_orientacion)
{
	chrome_log("model/permiso_ver_programa" );

	$n_id_coordinador = $this->session->userdata('id_persona');

	$sql = 	utf8_decode("	SELECT *
						 	FROM 	crm_coordinador_programa 
						 	WHERE 	n_id_persona = ?
						 	AND		c_identificacion = ?
						 	AND		c_programa = ?
						 	AND		c_orientacion = ?  ") ;

	$query = $this->db->query($sql, array( $n_id_coordinador , $c_identificacion, $c_programa, $c_orientacion ) );

	return $query->num_rows(); 
}


//--- Menu de Tesoreria -- 	 

public function programas_grados_dictados_en_un_anio($anio)
{
	return $this->db->query(utf8_decode("	SELECT *
											FROM programas p
											WHERE exists (
											                SELECT distinct pm.c_identificacion, pm.c_programa, pm.c_orientacion
											                FROM planes_materias pm
											                WHERE 
											                	trunc(pm.c_plan/100) = $anio
											                AND pm.c_identificacion = p.c_identificacion
											                AND pm.c_programa = p.c_programa
											                AND pm.c_orientacion = p.c_orientacion 
											             ) AND
											p.c_identificacion = 1
											ORDER BY p.c_identificacion, p.D_DESCRIP"));
}

public function programas_posgrados_dictados_en_un_anio($anio) // FALTA MADE Y MAF con el PLAN 01 y 02
{
	return $this->db->query(utf8_decode("	SELECT *
											FROM programas p
											WHERE exists (
											                SELECT distinct pm.c_identificacion, pm.c_programa, pm.c_orientacion
											                FROM planes_materias pm
											                WHERE trunc(pm.c_plan/100) = $anio
											                AND pm.c_identificacion = p.c_identificacion
											                AND pm.c_programa = p.c_programa
											                AND pm.c_orientacion = p.c_orientacion 
											             ) AND
											( p.c_identificacion = 2 OR p.c_identificacion = 4 )

											ORDER BY p.c_identificacion, p.D_DESCRIP"));
}

public function programas_ejectivos_actualizacion_dictados_en_un_anio($anio)  
{
	return $this->db->query(utf8_decode("	SELECT *
											FROM programas p
											WHERE exists (
											                SELECT distinct pm.c_identificacion, pm.c_programa, pm.c_orientacion
											                FROM planes_materias pm
											                WHERE trunc(pm.c_plan/100) = $anio
											                AND pm.c_identificacion = p.c_identificacion
											                AND pm.c_programa = p.c_programa
											                AND pm.c_orientacion = p.c_orientacion 
											             ) AND
											p.c_identificacion = 3
											ORDER BY p.c_identificacion, p.D_DESCRED"));
}
	
public function materia_curso_asignado($id_materia, $anio, $c_identificacion,$c_programa,$c_orientacion) // Para colorear el plan de estudio
{	
	chrome_log("model/materia_curso_asignado" );

	$sql = 	utf8_decode("	SELECT devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as Programa, c.n_id_materia, c.d_descrip
												FROM cursos c, comisiones co
												WHERE 
														c.c_año_lectivo = ? AND
														co.c_año_lectivo = ? AND
														c.n_id_comision = co.n_id_comision AND
														co.c_identificacion = ? AND 
														co.c_programa = ? AND
														co.c_orientacion = ? AND
														c.n_id_materia = ?
												ORDER BY n_id_materia   ") ;

	$query = $this->db->query( $sql, array( $anio, $anio, $c_identificacion, $c_programa, $c_orientacion, $id_materia ) );

	if($query->num_rows() > 0)
		return true;
	else
		return false; 
}

public function traer_comentarios_curso($data)
{
		chrome_log("traer_comentarios_curso");

		$sql = utf8_decode("SELECT C_OBS as COMENTARIOS
							FROM CURSOS_PROFESORES
							WHERE 	N_CURSO = ? AND  
									C_AÑO_LECTIVO = ?	AND
									C_ROL = ?	AND
									N_ID_PERSONA = ? ");

		$id_curso = $data['id_curso'] ;
		$anio = $data['anio_lectivo'] ;
		$rol = $data['rol'] ;
		$id_persona = $data['idUsuario'] ;
		
		$query = $this->db->query($sql, array($data['id_curso'], $data['anio_lectivo'], $data['rol'], $data['idUsuario'] ));
		return $query->row()->COMENTARIOS;
}

//--- Puntos, sueldos y clases -- // 
public function traer_importe_default($rol, $tipo_clase, $c_identificacion, $n_id_materia, $c_programa, $c_orientacion, $n_id_persona, $anio_programa, $id_curso, $id_horario)	
{	
	$sql = utf8_decode(" SELECT importe_profesor( ? , ? , ? , ? , ? , ? , ?, ?, ?, ? ) as IMPORTE
				    	 FROM  dual "    )	;
    
    $query = $this->db->query($sql, array( $rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa, $id_curso, $id_horario));

	$fila = $query->row();

	return $fila->IMPORTE; 
}

public function traer_clases_pejypac($c_identificacion, $id_curso , $n_id_persona, $anio_lectivo, $id_horario)
{	
    
    $sql = utf8_decode(" SELECT clases_PROFESOR( ? , ? , ?, ? ) as CLASES
				    	 FROM  dual "    )	;
    
    $query = $this->db->query($sql, array( $c_identificacion, $id_curso , $n_id_persona , $anio_lectivo));

	$fila = $query->row();

	return $fila->CLASES; 
}

	
public function cursos_cambiados() 	
{

	return $this->db->query(utf8_decode(" 	SELECT c.d_descrip, cpc.f_alta
											FROM cursos_profesores_cambios cpc, cursos c, materias m
											WHERE cpc.n_curso = c.n_curso
											AND   cpc.C_AÑO_LECTIVO = c.C_AÑO_LECTIVO
											AND   c.n_id_materia = m.n_id_materia	 
											AND   cpc.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))
												ORDER BY m.c_identificacion, m.c_programa, m.c_orientacion
											  "));
}

public function traer_importe_clase() // Valor de una clase
{
	return $this->db->query(utf8_decode(" 	SELECT VALOR_COLUMNA_NUM
											FROM DATOS_DEFAULT
											WHERE NOM_COLUMNA = 'PROGRAMA_EJECUTIVO' ")
							)->row()->VALOR_COLUMNA_NUM;

}
	
/*	
public function cursos_sin_confirmar_coordinador()	
{

	return $this->db->query(utf8_decode("  SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
									       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
									       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
									       m.d_descrip,
									       p.d_apellidos ||', '|| p.d_nombres as nombre, 
									       cu.f_inicio, 
									       cu.f_fin,
									       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
									       cp.c_rol,
									       cp.C_OBS,
									       cp.importe,
									       cp.N_IMPORTE_PROFESOR,
									       cp.C_CONFIRMADO
									       
									FROM cursos cu, 
									     cursos_profesores cp, 
									     materias m, 
									     personas p, 
									     horarios ch,
									     planes_materias pm, 
									     comisiones co
									WHERE 
									    co.c_año_lectivo = (extract(YEAR FROM sysdate))   AND
									    cu.c_año_lectivo = (extract(YEAR FROM sysdate))   AND
									    cp.c_año_lectivo= (extract(YEAR FROM sysdate))   AND
									    trunc(pm.c_plan/100) = (extract(YEAR FROM sysdate))   AND
									    
									    cu.n_curso = cp.n_curso AND
									    cp.n_id_persona = p.n_id_persona AND
									    
									    cu.n_id_materia = m.n_id_materia AND
									    pm.n_id_materia = cu.n_id_materia AND
									    
									    ch.n_id_horario = cp.n_id_horario AND
									    
									    cu.n_id_comision = co.n_id_comision AND
									    
									    m.c_identificacion = pm.c_identificacion AND
									    m.c_programa = pm.c_programa AND
									    m.c_orientacion = pm.c_orientacion AND
									    
									    ( cp.C_CONFIRMADO is null or cp.C_CONFIRMADO = 0 )

									ORDER BY   m.c_identificacion, m.c_programa, m.c_orientacion"));
} */

public function cursos_sin_confirmar_coordinador()	
{

	return $this->db->query(utf8_decode("  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO
											FROM cursos cu, 
											     cursos_profesores cp, 
											     materias m, 
											     personas p, 
											     horarios ch,
											     planes_materias pm, 
											     comisiones co
											WHERE 
											    co.c_año_lectivo = (extract(YEAR FROM sysdate)) AND  
											    cu.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
											    cp.c_año_lectivo= (extract(YEAR FROM sysdate)) AND
											     
											    pm.c_plan = (extract(YEAR FROM sysdate)) ||'00' AND
											    
											    cu.n_curso = cp.n_curso AND
											    cp.n_id_persona = p.n_id_persona AND
											    
											    cu.n_id_materia = m.n_id_materia AND
											    pm.n_id_materia = cu.n_id_materia AND
											    
											    ch.n_id_horario = cp.n_id_horario AND
											    
											    cu.n_id_comision = co.n_id_comision AND
											                            
											    co.c_identificacion = pm.c_identificacion AND
											    co.c_programa = pm.c_programa AND
											    co.c_orientacion = pm.c_orientacion AND
											    
											    cp.c_confirmado IS NULL AND

											    -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC "));
}

public function cursos_sin_importe_tesoreria()	 // Aun no hay un valor en el campo IMPORTE de la tabla cursos_profesores, que es de donde toma GEMINIS para la facturacion
{

	return $this->db->query(utf8_decode("  SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
									       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
									       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
									       m.d_descrip,
									       p.d_apellidos ||', '|| p.d_nombres as nombre, 
									       cu.f_inicio, 
									       cu.f_fin,
									       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
									       cp.c_rol,
									       cp.C_OBS,
									       cp.importe,
									       cp.N_IMPORTE_PROFESOR,
									       cp.C_CONFIRMADO
									       /*cu.d_descrip, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
									       cp.n_id_horario, cp.n_id_persona, cp.c_tipo_clase, cp.c_rol, cp.importe, cp.n_porcentaje, cp.f_pagado,
									       m.c_identificacion, m.c_programa, m.c_orientacion, m.d_descrip,
									       p.d_apellidos ||', '|| p.d_nombres as nombre, p.persona_type, 
									       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,
									       pm.N_AÑO_CARRERA as anio,
									       co.d_publica as comision,
									        cp.C_CONFIRMADO,
									       cp.C_OBS,
									       cp.N_IMPORTE_PROFESOR,*/
									       
									FROM cursos cu, 
									     cursos_profesores cp, 
									     materias m, 
									     personas p, 
									     horarios ch,
									     planes_materias pm, 
									     comisiones co
									WHERE 
									    co.c_año_lectivo = (extract(YEAR FROM sysdate))   AND
									    cu.c_año_lectivo = (extract(YEAR FROM sysdate))   AND
									    cp.c_año_lectivo= (extract(YEAR FROM sysdate))   AND
									    trunc(pm.c_plan/100) = (extract(YEAR FROM sysdate))   AND
									    
									    cu.n_curso = cp.n_curso AND
									    cp.n_id_persona = p.n_id_persona AND
									    
									    cu.n_id_materia = m.n_id_materia AND
									    pm.n_id_materia = cu.n_id_materia AND
									    
									    ch.n_id_horario = cp.n_id_horario AND
									    
									    cu.n_id_comision = co.n_id_comision AND
									    
									    m.c_identificacion = pm.c_identificacion AND
									    m.c_programa = pm.c_programa AND
									    m.c_orientacion = pm.c_orientacion AND
									    
									    ( cp.importe is null or cp.importe = '' )

									ORDER BY   m.c_identificacion, m.c_programa, m.c_orientacion"));
}

// HARCODEADO TRACY Y ADRIAN 
public function traer_coordinadores_programas($c_identificacion, $c_programa, $c_orientacion)
{

	chrome_log("model/traer_coordinadores_programas" );

	$sql = 	utf8_decode("	SELECT CCP.N_ID_PERSONA, CCP.C_IDENTIFICACION, CCP.C_PROGRAMA, CCP.C_ORIENTACION, 
							       ROL.GRANTEE, ROL.GRANTED_ROLE,
							       PR.D_DESCRED, PR.D_DESCRIP
							FROM CRM_COORDINADOR_PROGRAMA CCP, 
							     PERSONAS PE,
							     DBA_ROLE_PRIVS ROL,
							     PROGRAMAS PR
							WHERE
							      CCP.N_ID_PERSONA = PE.N_ID_PERSONA 
							AND   ROL.GRANTEE = PE.USER_ORACLE
							AND   ( ROL.GRANTED_ROLE = 'ROLE_COORDINADOR' )
							AND   CCP.C_IDENTIFICACION = PR.C_IDENTIFICACION
							AND   CCP.C_PROGRAMA = PR.C_PROGRAMA
							AND   CCP.C_ORIENTACION = PR.C_ORIENTACION

							AND   CCP.C_IDENTIFICACION = $c_identificacion
							AND   CCP.C_PROGRAMA = $c_programa
							AND   CCP.C_ORIENTACION = $c_orientacion

							AND   ROL.GRANTEE != 'TIM'
							AND   ROL.GRANTEE != 'AMMAGLIOLA'
							ORDER BY CCP.C_IDENTIFICACION, CCP.C_PROGRAMA, ROL.GRANTEE, ROL.GRANTED_ROLE ") ;

	$query = $this->db->query($sql);

	return $query; 

}

// HARCODEADO TRACY Y ADRIAN 
public function traer_secretarios_programas($c_identificacion, $c_programa, $c_orientacion)
{

	chrome_log("model/traer_coordinadores_programas" );

	$sql = 	utf8_decode("	SELECT CCP.N_ID_PERSONA, CCP.C_IDENTIFICACION, CCP.C_PROGRAMA, CCP.C_ORIENTACION, 
							       ROL.GRANTEE, ROL.GRANTED_ROLE,
							       PR.D_DESCRED, PR.D_DESCRIP
							FROM CRM_COORDINADOR_PROGRAMA CCP, 
							     PERSONAS PE,
							     DBA_ROLE_PRIVS ROL,
							     PROGRAMAS PR
							WHERE
							      CCP.N_ID_PERSONA = PE.N_ID_PERSONA 
							AND   ROL.GRANTEE = PE.USER_ORACLE
							AND   ROL.GRANTED_ROLE = 'ROLE_ASISTENTE_PROGRAMAS' 

							AND   CCP.C_IDENTIFICACION = PR.C_IDENTIFICACION
							AND   CCP.C_PROGRAMA = PR.C_PROGRAMA
							AND   CCP.C_ORIENTACION = PR.C_ORIENTACION

							AND   CCP.C_IDENTIFICACION = $c_identificacion
							AND   CCP.C_PROGRAMA = $c_programa
							AND   CCP.C_ORIENTACION = $c_orientacion

							AND   ROL.GRANTEE NOT IN (	select distinct GRANTEE
														from DBA_ROLE_PRIVS
														where GRANTED_ROLE = 'ROLE_COORDINADOR')

							AND   ROL.GRANTEE != 'TIM'
							AND   ROL.GRANTEE != 'AMMAGLIOLA'
							ORDER BY CCP.C_IDENTIFICACION, CCP.C_PROGRAMA, ROL.GRANTEE, ROL.GRANTED_ROLE ") ;

	$query = $this->db->query($sql);

	return $query; 

}

}
?>