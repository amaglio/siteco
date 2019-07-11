<?php

// [CAMBIAR]  
//--sacar el USUARIO ORACLE POR ID_PERSONA MGALLACHER

class Programas_model extends CI_Model {

    function __construct()
    {
    	parent::__construct(); 	
    	//$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
    }

	/*
		Trae los programas que se encarga el director.
		En realdiad puede ser que no sea el director y se encargue igual. 
		Filtra por aquellos que tengan PLAN de este año, para no traer demas.
	*/	
    function programas_director_carrera()
    {

    	$n_id_coordinador = $this->session->userdata('id_persona');

		return $this->db->query("	SELECT distinct(s.carrera), s.c_identificacion, s.c_programa, s.c_orientacion, p.d_descinf
								  FROM 
								        (
								        SELECT cc.*, devuelve_programa(cc.c_identificacion, cc.c_programa, cc.c_orientacion) as CARRERA
								        FROM crm_coordinador_programa cc, planes_materias pm
								        WHERE cc.n_id_persona = $n_id_coordinador AND
								              cc.c_identificacion = pm.c_identificacion AND
								              cc.c_programa = pm.c_programa AND
								              cc.c_orientacion = pm.c_orientacion AND
								              pm.c_plan = (extract(YEAR FROM sysdate)) ||'00' ) s,
								        programas p
								WHERE p.c_identificacion =  s.c_identificacion
								AND p.c_programa =  s.c_programa
								AND p.c_orientacion =  s.c_orientacion
								ORDER BY s.c_identificacion, s.carrera" );
    }


    /* Tiene permiso para ver el programa */

    function permiso_ver_programa($c_identificacion,$c_programa,$c_orientacion)
    {

    	$n_id_coordinador = $this->session->userdata('id_persona');

		$query = $this->db->query("	SELECT *
								 	FROM 	crm_coordinador_programa 
								 	WHERE 	n_id_persona = $n_id_coordinador
								 	AND		c_identificacion = $c_identificacion
								 	AND		c_programa = $c_programa
								 	AND		c_orientacion = $c_orientacion " );
		return $query->num_rows();
    }

    /*
		Trae todo los profesores de los cursos que tiene a cargo un director.
    */

    function profesores_director_carrera()
    {
    	$n_id_coordinador = $this->session->userdata('id_persona');

    	return $this->db->query("	SELECT *
									FROM cursos cu, cursos_profesores cp, materias m, crm_coordinador_programa ccp, personas p
									WHERE 
									cu.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
									cp.c_año_lectivo= (extract(YEAR FROM sysdate))  AND
									cu.n_curso = cp.n_curso AND
									cp.n_id_persona = p.n_id_persona AND
									cu.n_id_materia = m.n_id_materia AND
									m.c_identificacion = ccp.c_identificacion AND
									m.c_programa = ccp.c_programa AND
									m.c_orientacion = ccp.c_orientacion AND 
									ccp.n_id_persona = '$n_id_coordinador' " );
    }


    function cantidad_profesores_coordinados()
    {
    	$n_id_coordinador = $this->session->userdata('id_persona');

    	return $this->db->query(utf8_decode("	SELECT distinct(cp.n_id_persona)
												FROM cursos cu, cursos_profesores cp, materias m, crm_coordinador_programa ccp, personas p
												WHERE 
														cu.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
														cp.c_año_lectivo= (extract(YEAR FROM sysdate))  AND
														cu.n_curso = cp.n_curso AND
														cp.n_id_persona = p.n_id_persona AND
														cu.n_id_materia = m.n_id_materia AND
														m.c_identificacion = ccp.c_identificacion AND
														m.c_programa = ccp.c_programa AND
														m.c_orientacion = ccp.c_orientacion AND 
														ccp.n_id_persona = '$n_id_coordinador' " ) );
	}


	function cantidad_materias_coordinadas()
    {
    	$n_id_coordinador = $this->session->userdata('id_persona');

    	return $this->db->query(utf8_decode("	SELECT distinct(cu.n_id_materia)
												FROM cursos cu, cursos_profesores cp, materias m, crm_coordinador_programa ccp, personas p
												WHERE 
														cu.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
														cp.c_año_lectivo= (extract(YEAR FROM sysdate))  AND
														cu.n_curso = cp.n_curso AND
														cp.n_id_persona = p.n_id_persona AND
														cu.n_id_materia = m.n_id_materia AND
														m.c_identificacion = ccp.c_identificacion AND
														m.c_programa = ccp.c_programa AND
														m.c_orientacion = ccp.c_orientacion AND 
														ccp.n_id_persona = $n_id_coordinador " ) );
	}

	function cantidad_cursos_cargados_sigeu()
    {
    	$n_id_coordinador = $this->session->userdata('id_persona');

    	return $this->db->query(utf8_decode("	SELECT distinct(cu.n_curso)
												FROM cursos cu, cursos_profesores cp, materias m, crm_coordinador_programa ccp, personas p
												WHERE 
														cu.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
														cp.c_año_lectivo= (extract(YEAR FROM sysdate))  AND
														cu.n_curso = cp.n_curso AND
														cp.n_id_persona = p.n_id_persona AND
														cu.n_id_materia = m.n_id_materia AND
														m.c_identificacion = ccp.c_identificacion AND
														m.c_programa = ccp.c_programa AND
														m.c_orientacion = ccp.c_orientacion AND 
														ccp.n_id_persona = '$n_id_coordinador' " ) );
	}

		
	function cantidad_cursos_confirmados()
    {
    	$n_id_coordinador = $this->session->userdata('id_persona');
    	/*
    	return $this->db->query(utf8_decode("	SELECT distinct(cp.n_curso) 
												FROM crm_coordinador_programa ccp, cursos_profesores cp 
												WHERE cp.n_anio = (extract(YEAR FROM sysdate)) AND 
												cp.c_identificacion = ccp.c_identificacion AND 
												cp.c_programa = ccp.c_programa AND 
												cp.c_orientacion = ccp.c_orientacion AND 
												ccp.n_id_persona = '$n_id_coordinador' AND
												cp.b_confirmado = 1 " 
											) );*/

		return $this->db->query(utf8_decode("	SELECT distinct(cp.n_curso) 
												FROM crm_coordinador_programa ccp, cursos_profesores cp, cursos c, materias m
												WHERE
												m.c_identificacion = ccp.c_identificacion AND 
												m.c_programa = ccp.c_programa AND 
												m.c_orientacion = ccp.c_orientacion AND 
												ccp.n_id_persona = '$n_id_coordinador' AND 
												c.n_curso = cp.n_curso AND
												cp.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
												c.c_año_lectivo = cp.c_año_lectivo AND
												cp.c_confirmado = 1" 
																							) );	
	}


	function cantidad_cursos_confirmados_por_carrera($c_identificacion,$c_programa,$c_orientacion)
    {
    	$n_id_coordinador = $this->session->userdata('id_persona');

		return $this->db->query(utf8_decode("	SELECT distinct(cp.n_curso) 
												FROM crm_coordinador_programa ccp, cursos_profesores cp, cursos c, materias m
												WHERE
												m.c_identificacion = ccp.c_identificacion AND 
												m.c_programa = ccp.c_programa AND 
												m.c_orientacion = ccp.c_orientacion AND 
												$c_identificacion = ccp.c_identificacion AND 
												$c_programa = ccp.c_programa AND 
												$c_orientacion = ccp.c_orientacion AND 
												ccp.n_id_persona = '$n_id_coordinador' AND 
												c.n_curso = cp.n_curso AND
												cp.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
												c.c_año_lectivo = cp.c_año_lectivo AND
												cp.c_confirmado = 1" 
																							) );
	}

	/*
		Trae todos los programas de GRADO que tiene una PLAN para un año determinado.
	*/

	function programas_grados_dictados_en_un_anio($anio)
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

	/*
		Trae todos los programas de POSGRADO que tiene una PLAN para un año determinado.
	*/

	function programas_posgrados_dictados_en_un_anio($anio) // FALTA MADE Y MAF con el PLAN 01 y 02
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

	/*
		Trae todos los programas de POSGRADO que tiene una PLAN para un año determinado.
	*/

	function programas_ejectivos_actualizacion_dictados_en_un_anio($anio)  
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
												ORDER BY p.c_identificacion, p.D_DESCRIP"));
	}

	/*
	function plan_estudio_obligatorias($c_orientacion,$c_programa,$c_orientacion)
    {
    	return $this->db->query(utf8_decode("SELECT pm.N_AÑO_CARRERA as anio, pm.n_periodo_carrera as periodo, m.d_descrip,pm.n_grupo,m.n_id_materia as id
											 FROM planes_materias pm, materias m
											 WHERE 
													trunc(pm.c_plan/100) = (extract(YEAR FROM sysdate)) AND
													pm.c_identificacion = 1 AND
													pm.c_programa = 9 AND
													pm.n_id_materia = m.n_id_materia
													ORDER BY pm.N_AÑO_CARRERA, pm.n_periodo_carrera,m.d_descrip " ) );
	}

	/*
		Trae el plan de estudio para un determinado PRORGRAMA

	*/

	function plan_estudio_total($c_identificacion,$c_programa,$c_orientacion, $anio)
    {
    	 
    	chrome_log("------------ PLAN DE ESTUDIO ----------------");
    	/*
    	chrome_log("	SELECT distinct(m.n_id_materia) as id, pm.N_AÑO_CARRERA as anio, pm.n_periodo_carrera as periodo, m.d_descrip, pm.n_grupo, devuelve_programa(pm.c_identificacion, pm.c_programa, pm.c_orientacion) as prg
						FROM planes_materias pm, materias m
						WHERE 
								pm.c_plan =  $anio ||'00' AND
								pm.c_identificacion = $c_identificacion AND
								pm.c_programa = $c_programa AND
								pm.n_id_materia = m.n_id_materia AND
								pm.n_grupo != 2
								ORDER BY pm.N_AÑO_CARRERA, pm.n_periodo_carrera,m.d_descrip ");*/

    	return $this->db->query(utf8_decode("SELECT distinct(m.n_id_materia) as id, pm.N_AÑO_CARRERA as anio, pm.n_periodo_carrera as periodo, m.d_descrip,pm.n_grupo, devuelve_programa(pm.c_identificacion, pm.c_programa, pm.c_orientacion) as prg
											 FROM planes_materias pm, materias m
											 WHERE 
													pm.c_plan =  $anio ||'00' AND
													pm.c_identificacion = $c_identificacion AND
													pm.c_programa = $c_programa AND
													pm.c_orientacion = $c_orientacion AND
													pm.n_id_materia = m.n_id_materia AND
													pm.n_grupo != 2
													ORDER BY prg, pm.N_AÑO_CARRERA, pm.n_periodo_carrera,m.d_descrip " ) );
	}

	/*
	function plan_estudio_opcionales($c_orientacion,$c_programa,$c_orientacion)
    {
    	return $this->db->query(utf8_decode("SELECT pm.N_AÑO_CARRERA as anio, pm.n_periodo_carrera as periodo, m.d_descrip,pm.n_grupo,m.n_id_materia as id
											 FROM planes_materias pm, materias m
											 WHERE 
													trunc(pm.c_plan/100) = (extract(YEAR FROM sysdate)) AND
													pm.c_identificacion = 1 AND
													pm.c_programa = 9 AND
													pm.n_id_materia = m.n_id_materia AND
													pm.n_grupo = 2
													ORDER BY pm.N_AÑO_CARRERA, pm.n_periodo_carrera,m.d_descrip " ) );
	}*/

	function datos_programa($c_identificacion,$c_programa,$c_orientacion)
	{	
	 
		chrome_log("--------- datos_programa ----------" );

		//echo $sigla;

		$sql = 	utf8_decode("	SELECT *
								FROM programas
								WHERE c_identificacion = $c_identificacion AND		
									  c_programa = $c_programa AND
									  c_orientacion = $c_orientacion ") ;

		$query = $this->db->query($sql);

		return $query; 
	}

	/*
	function cursos_asignados()
	{
		return $this->db->query(utf8_decode("SELECT cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
											       cp.n_id_horario, cp.n_id_persona, cp.c_tipo_clase, cp.c_rol, cp.importe, cp.n_porcentaje, cp.f_pagado,
											       m.c_identificacion, m.c_programa, m.c_orientacion, m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, p.persona_type, 
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,
											       pm.N_AÑO_CARRERA as anio,
											       co.d_publica as comision
											FROM cursos cu, 
											     cursos_profesores cp, 
											     materias m, 
											     crm_coordinador_programa ccp, 
											     personas p, 
											     horarios ch,
											     planes_materias pm, 
											     comisiones co
											WHERE 
											    co.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
											    cu.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
											    cp.c_año_lectivo= (extract(YEAR FROM sysdate))  AND
											    trunc(pm.c_plan/100) = (extract(YEAR FROM sysdate)) AND
											    
											    cu.n_curso = cp.n_curso AND
											    cp.n_id_persona = p.n_id_persona AND
											    
											    cu.n_id_materia = m.n_id_materia AND
											    pm.n_id_materia = cu.n_id_materia AND
											    
											    ch.n_id_horario = cp.n_id_horario AND
											    
											    cu.n_id_comision = co.n_id_comision AND
											    
											    m.c_identificacion = ccp.c_identificacion AND
											    m.c_programa = ccp.c_programa AND
											    m.c_orientacion = ccp.c_orientacion AND
											    
											    pm.c_identificacion = ccp.c_identificacion AND
											    pm.c_programa = ccp.c_programa AND
											    pm.c_orientacion = ccp.c_orientacion AND 

											    ccp.user_oracle = 'AMARIN'
											    
											ORDER BY pm.N_AÑO_CARRERA, cu.n_curso"	));
	
	}*/

	/*
		Devuelve si una materia tiene un cursos asignado para un año
	*/
	function materia_curso_asignado($id_materia, $anio, $c_identificacion,$c_programa,$c_orientacion)
    {	

    	$consulta = $this->db->query(utf8_decode("	SELECT devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as Programa, c.n_id_materia, c.d_descrip
													FROM cursos c, comisiones co
													WHERE 
															c.c_año_lectivo = $anio AND
															co.c_año_lectivo = $anio AND
															c.n_id_comision = co.n_id_comision AND
															co.c_identificacion = $c_identificacion AND 
															co.c_programa = $c_programa AND
															co.c_orientacion = $c_orientacion AND
															c.n_id_materia = $id_materia
													ORDER BY n_id_materia " ) );


    	if($consulta->num_rows() > 0)
    		return true;
    	else
    		return false;
	}

	/*
		Devuelve los cursos asignados con toda su informacion, para GRADO Y POSGRADO, y a nivel comision
	*/
	function cursos_asignados_programa($c_identificacion,$c_programa,$c_orientacion,$anio)
	{
		  
		chrome_log("SELECT cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
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
											   	co.c_año_lectivo = $anio AND
											    cu.c_año_lectivo = $anio AND
											    cp.c_año_lectivo= $anio AND
											     
											    pm.c_plan = $anio ||'00' AND
											    
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
					    
											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC   ");  

		return $this->db->query(utf8_decode("SELECT cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
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
											   	co.c_año_lectivo = $anio AND
											    cu.c_año_lectivo = $anio AND
											    cp.c_año_lectivo= $anio AND
											     
											    pm.c_plan = $anio ||'00' AND
											    
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
					    
											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC   "	));
	}


	/*
		Devuelve los cursos asignados con toda su informacion, para PROGRAMAS EJECUTIVOS.	
		Esto se hizo para ordenar los programas por "clase" (pedido por dapena) y para que no se 
		repitan las clases se uso el MIN y seguir mantiendo la estructura de cursos_profesor.
	*/
	function cursos_asignados_programa_ejepac($c_identificacion,$c_programa,$c_orientacion,$anio)
	{
	 	/*chrome_log($c_identificacion);
		chrome_log("   SELECT min(cl.f_clase), 
												       res.anio_lectivo, res.n_curso, res.n_id_materia, res.f_inicio,res.f_fin, res.d_descrip,res.Horario, res.c_tipo_periodo, res.n_periodo,
												       res.n_id_horario, res.n_id_persona, res.c_tipo_clase, res.c_rol, res.importe, res.n_porcentaje, res.f_pagado,res.C_CONFIRMADO,res.C_OBS,res.N_IMPORTE_PROFESOR,
												       res.materia,
												       res.nombre, res.persona_type,
												       res.Horario,
												       res.anio,
												       res.comision, res.c_identificacion, res.c_programa,res.c_orientacion
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
																	   	co.c_año_lectivo = $anio AND
																	    cu.c_año_lectivo = $anio AND
																	    cp.c_año_lectivo= $anio AND
																	     
																	    pm.c_plan = $anio ||'00' AND
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
												                      co.c_identificacion = $c_identificacion AND
									    							  co.c_programa = $c_programa  AND 
									    							  co.c_orientacion = $c_orientacion 	  
									    							  -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			
									    							  AND cp.n_id_horario = (		Select min(n_id_horario)
																	                               from cursos_profesores cp2
																	                               where cp2.c_año_lectivo = cp.c_año_lectivo and
																	                                     cp2.n_curso = cp.n_curso and
																	                                     cp2.n_id_persona = cp.n_id_persona and
																	                                      cp2.c_tipo_clase = cp.c_tipo_clase and
																	                                      cp2.c_rol = cp.c_rol)
																) res
												WHERE res.n_curso = cl.n_curso
												AND res.n_id_persona = cl.n_id_persona
												AND res.anio_lectivo = cl.C_AÑO_LECTIVO
												--AND res.n_id_horario = cl.n_id_horario
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
												ORDER BY min(cl.f_clase) ASC");  */

		return $this->db->query(utf8_decode("   SELECT min(cl.f_clase), 
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
																	   	co.c_año_lectivo = $anio AND
																	    cu.c_año_lectivo = $anio AND
																	    cp.c_año_lectivo= $anio AND
																	     
																	    pm.c_plan = $anio ||'00' AND
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
												                      co.c_identificacion = $c_identificacion AND
									    							  co.c_programa = $c_programa  AND 
									    							  co.c_orientacion = $c_orientacion 	  
									    							  -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			
									    							  AND cp.n_id_horario = (		Select min(n_id_horario)
																	                               from cursos_profesores cp2
																	                               where cp2.c_año_lectivo = cp.c_año_lectivo and
																	                                     cp2.n_curso = cp.n_curso and
																	                                     cp2.n_id_persona = cp.n_id_persona and
																	                                      cp2.c_tipo_clase = cp.c_tipo_clase and
																	                                      cp2.c_rol = cp.c_rol)
																) res
												WHERE res.n_curso = cl.n_curso
												AND res.n_id_persona = cl.n_id_persona
												AND res.anio_lectivo = cl.C_AÑO_LECTIVO
												--AND res.n_id_horario = cl.n_id_horario
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
												ORDER BY min(cl.f_clase) ASC "));
	}

	function cursos_confirmados_programa($c_identificacion,$c_programa,$c_orientacion,$anio)
	{
		chrome_log("cursos_confirmados_programa");

		/*
		return $this->db->query(utf8_decode("SELECT cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
											       cp.n_id_horario, cp.n_id_persona, cp.c_tipo_clase, cp.c_rol, cp.importe, cp.n_porcentaje, cp.f_pagado,
											       m.c_identificacion, m.c_programa, m.c_orientacion, m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, p.persona_type, 
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,
											       pm.N_AÑO_CARRERA as anio,
											       co.d_publica as comision,
												   cp.C_CONFIRMADO,
											       cp.C_OBS
											FROM cursos cu, 
											     cursos_profesores cp, 
											     materias m, 
											     personas p, 
											     horarios ch,
											     planes_materias pm, 
											     comisiones co
											WHERE
												cp.c_confirmado = 1 AND 
											    co.c_año_lectivo = $anio AND
											    cu.c_año_lectivo = $anio AND
											    cp.c_año_lectivo= $anio AND

											    trunc(pm.c_plan/100) = $anio AND
											    
											    cu.n_curso = cp.n_curso AND
											    cp.n_id_persona = p.n_id_persona AND
											    
											    cu.n_id_materia = m.n_id_materia AND
											    pm.n_id_materia = cu.n_id_materia AND
											    
											    ch.n_id_horario = cp.n_id_horario AND
											    
											    cu.n_id_comision = co.n_id_comision AND
											    
											    m.c_identificacion = pm.c_identificacion AND
											    m.c_programa = pm.c_programa AND */

											    /*
											    --m.c_orientacion = pm.c_orientacion AND
											    
											    pm.c_identificacion = $c_identificacion AND
											    pm.c_programa = $c_programa --AND
											    --pm.c_orientacion = $c_orientacion 
											    
											    -- VER SI TENGO QUE PONER CO o PM --- /*

											    co.c_identificacion = $c_identificacion AND
											    co.c_programa = $c_programa  /*AND
											    co.c_orientacion = $c_orientacion 

											ORDER BY pm.N_AÑO_CARRERA, cu.n_curso"	));*/
		return $this->db->query(utf8_decode(" SELECT cu.C_AÑO_LECTIVO as anio_lectivo, cu.n_curso,cu.n_id_materia, cu.f_inicio, cu.f_fin, cu.d_descrip, cu.c_tipo_periodo, cu.n_periodo,
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
											   	co.c_año_lectivo = $anio AND
											    cu.c_año_lectivo = $anio AND
											    cp.c_año_lectivo= $anio AND
											     
											    pm.c_plan = $anio ||'00' AND
											    
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

											    co.c_identificacion = $c_identificacion AND
											    co.c_programa = $c_programa AND
											    co.c_orientacion = $c_orientacion
											    
											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC "));
	}

	/*
		Cursos con ID_CURSO, a los cuales les cambio:
			El profesor, entonces cambio el ID_PERSONA, entonces cambio el profesor		
	*/
	function cursos_cambio_profesor($c_identificacion,$c_programa,$c_orientacion)
	{
		return $this->db->query(utf8_decode("	SELECT count(*) as cantidad
												FROM crm_cursos_profesores ccp, cursos_profesores cp
												WHERE 
												 	ccp.n_anio = (extract(YEAR FROM sysdate)) AND 
													cp.c_año_lectivo = (extract(YEAR FROM sysdate)) AND 
													ccp.n_anio = cp.C_año_lectivo AND
													ccp.n_curso = ccp.n_curso AND 
													ccp.n_id_horario = ccp.n_id_horario AND 
													ccp.n_id_profesor != cp.n_id_persona AND 

												    ccp.c_identificacion = $c_identificacion AND
												    ccp.c_programa = $c_programa AND
												    ccp.c_orientacion = $c_orientacion "	));
	}


	function cursos_cambio_horario($c_identificacion,$c_programa,$c_orientacion)
	{
		return $this->db->query(utf8_decode("	SELECT count(*) as cantidad
												FROM crm_cursos_profesores ccp, cursos_profesores cp
												WHERE 
												    ccp.n_anio = (extract(YEAR FROM sysdate)) AND 
													cp.c_año_lectivo = (extract(YEAR FROM sysdate)) AND 
													ccp.n_anio = cp.C_año_lectivo AND
													ccp.n_curso = ccp.n_curso AND 
													ccp.n_id_profesor = cp.n_id_persona AND 

													ccp.n_id_horario != ccp.n_id_horario AND 

												    ccp.c_identificacion = $c_identificacion AND
												    ccp.c_programa = $c_programa AND
												    ccp.c_orientacion = $c_orientacion "	));
	}

	function profesor_fulltime ($n_id_persona)
	{
		//devuelve 1 si es fulltime 0 si no es 
		return $this->db->query(utf8_decode("	SELECT 
														count(*) as cuantos 
												FROM 
														contratos 
												WHERE 
														f_hasta is null and 
														c_dedicacion = 'Full - Time'and
														n_id_persona=$n_id_persona"))->row()->CUANTOS;;
	}


	function traer_nombre_materia($id_materia)
	{
		return $this->db->query(utf8_decode("	SELECT 
														m.d_descrip
												FROM 
														materias m
												WHERE 
														m.n_id_materia = $id_materia") )->row()->D_DESCRIP;
	}
	
	function traer_profesor($id_profesor)
	{
		return $this->db->query(utf8_decode("	SELECT 
														p.d_apellidos, p.d_nombres
												FROM 
														personas p
												WHERE 
														p.n_id_persona = $id_profesor") )->row();
	}
     

	function existe_registro_materia($id_curso, $anio_lectivo, $idUsuario, $id_horario,$rol )
	{

		$sql = "    SELECT  * 
                    FROM crm_cursos_profesores
                    WHERE N_CURSO = ? AND
                          N_ANIO = ?  AND
                          N_ID_HORARIO = ? AND
                          N_ID_PROFESOR = ?	AND
                          C_ROL = ? ";
                                        
        $query = $this->db->query($sql, array($id_curso, $anio_lectivo, $id_horario, $idUsuario, $rol ));
        
        if($query->row())
         	return true;
        else
         	return false;

	}

	/*
		Estas dos funciones sirve cuando ya se cargo el curso en CURSOS_PROFESORES y se editar el precio o los puntos,
		pero no es necesario poner el tipo de clase o el rol de profesor, ya que eso ya se cargo en la tabla.
	*/

	function insertar_registro_curso_cargado($_ARRAY , $comentario, $c_identificacion, $c_programa, $c_orientacion)
	{
		
		$sql = " INSERT INTO CRM_CURSOS_PROFESORES (n_curso, n_id_profesor, n_anio, n_importe, n_puntos, n_id_horario, c_rol, c_identificacion, c_programa, c_orientacion) 
				 VALUES ( ? , ? , ? , ? , ?, ?, ?, ? , ?, ?)";
        
        $query = $this->db->query($sql, array($_ARRAY['id_curso'],$_ARRAY['idUsuario'], $_ARRAY['anio_lectivo'], $_ARRAY['sueldo'] , $_ARRAY['puntos'],  $_ARRAY['id_horario'], $_ARRAY['rol'], $c_identificacion, $c_programa, $c_orientacion) );
	
        $sql = " INSERT INTO CRM_CURSOS_COMENTARIOS (n_id_comentario, n_curso, n_id_profesor, n_anio, n_id_horario, c_rol, comentario ) 
				 VALUES ( N_ID_COMENTARIO.NEXTVAL, ? , ? , ? , ? , ?, ?)";
        	
       	$query = $this->db->query($sql, array($_ARRAY['id_curso'],$_ARRAY['idUsuario'], $_ARRAY['anio_lectivo'],  $_ARRAY['id_horario'], $_ARRAY['rol'] , "Creo el registro en CRM:".$comentario ));

	}


	function actualizar_registro_curso_cargado($_ARRAY, $comentario)
	{
			$sql = "UPDATE CRM_CURSOS_PROFESORES 
					SET N_IMPORTE = ? , N_PUNTOS = ?
					WHERE 	N_CURSO = ? AND  
							N_ANIO = ?	AND
							C_ROL = ?	AND
							N_ID_PROFESOR = ? ";
			$query = $this->db->query($sql, array($_ARRAY['sueldo'],$_ARRAY['puntos'], $_ARRAY['id_curso'], $_ARRAY['anio_lectivo'], $_ARRAY['rol'], $_ARRAY['idUsuario'] ));
            

            $sql = " INSERT INTO CRM_CURSOS_COMENTARIOS (n_id_comentario, n_curso, n_id_profesor, n_anio, n_id_horario, c_rol, comentario ) 
				 	 VALUES ( N_ID_COMENTARIO.NEXTVAL, ? , ? , ? , ? , ?, ?)";
        	
       		$query = $this->db->query($sql, array( $_ARRAY['id_curso'],$_ARRAY['idUsuario'], $_ARRAY['anio_lectivo'],  $_ARRAY['id_horario'], $_ARRAY['rol'] , "Actualizo el registro CRM:".$comentario ));
			
			return $query;		    
   	}

    function traer_informacion_curso_crm($id_curso, $anio_lectivo, $id_profesor, $id_horario, $rol)
    {
    	$sql = "    SELECT  * 
                    FROM crm_cursos_profesores
                    WHERE N_CURSO = ? AND
                          N_ANIO = ?  AND
                          N_ID_HORARIO = ? AND
                          N_ID_PROFESOR = ?	AND
                          C_ROL = ?";

        $query = $this->db->query($sql, array($id_curso, $anio_lectivo, $id_horario, $id_profesor, $rol ));
        
        return $query->row();
    }

    function traer_programa_curso($anio_lectivo, $id_curso )
    {

    	$sql = "    SELECT DEVUELVE_PROGRAMA_CURSO($anio_lectivo,$id_curso) AS CARRERA
					FROM dual";

        $query = $this->db->query($sql);
        
        return $query->row()->CARRERA;

    }

    function traer_nombre( $id_persona )
    {

    	$sql = "    SELECT DEVUELVE_PERSONA($id_persona) AS NOMBRE
					FROM dual";

        $query = $this->db->query($sql);
        
        return $query->row()->NOMBRE;

    }


    

    function confirmar_curso($data)
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



    function desconfirmar_curso($data)
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

    /*
    function desconfirmar_curso($data)
	{
       	$alias = $this->session->userdata('usuario_tesoreria');

       	$observacion =  date('d-m-Y')." [".$alias."] - Se desconfirmo el curso. |";

       	
       	$comentario = $this->Programas_model->traer_comentarios_curso($data);

    		if(isset($comentario))
    			$observacion = $comentario.$observacion;

		$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
							SET C_CONFIRMADO = NULL, C_OBS = ?
							WHERE 	N_CURSO = ? AND  
									C_AÑO_LECTIVO = ?	AND
									C_ROL = ?	AND
									N_ID_PERSONA = ?  AND
									N_ID_HORARIO = ?");
		
		$query = $this->db->query($sql, array($observacion, $data['id_curso'], $data['anio_lectivo'], $data['rol'], $data['idUsuario'], $data['id_horario'] ));
		
		//return $affected_rows;
	}*/


	function traer_comentarios_curso($data)
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

    		chrome_log("SELECT C_OBS as COMENTARIOS
						FROM CURSOS_PROFESORES
						WHERE 	N_CURSO = $id_curso AND  
								C_AÑO_LECTIVO = $anio	AND
								C_ROL = $rol	AND
								N_ID_PERSONA = $id_persona " );
			
			$query = $this->db->query($sql, array($data['id_curso'], $data['anio_lectivo'], $data['rol'], $data['idUsuario'] ));
			return $query->row()->COMENTARIOS;

    }


    function insertar_comentario($data)
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

	
	function ingresar_notificacion($datos, $usuarios_notificados, $texto)
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


	function modificar_importe_coordinador($data)
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

	
	
	
	function traer_cursos_profesor($id_persona)	
	{
		return $this->db->query(utf8_decode("SELECT h.c_dia_semanal || ' de ' || h.c_hora_desde || ' a ' || h.c_hora_hasta as HORARIO, 
									   c.N_CURSO,  
									   cp.c_tipo_clase, 
									   cp.c_rol, 
									   c.f_inicio as FECHA_INI, 
									   c.f_fin as FECHA_FIN, 
									   m.D_DESCRED, 
									   cp.N_ID_HORARIO, 
									   cp.N_ID_PERSONA, 
									   p.d_apellidos || ',' || p.d_nombres as NOMBRE 
								FROM 
									cursos_profesores cp,
									materias m, 
									cursos c,
									personas p,
									horarios h
								WHERE 
								cp.n_id_horario = h.n_id_horario AND
								cp.n_id_persona = p.n_id_persona AND
								cp.n_curso = c.n_curso          AND
								c.n_id_materia = m.n_id_materia AND
								cp.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))         AND
								c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
								cp.n_id_persona = $id_persona "));
	}


	function traer_importe_default($rol, $tipo_clase, $c_identificacion, $n_id_materia, $c_programa, $c_orientacion, $n_id_persona, $anio_programa, $id_curso, $id_horario)	
	{	
		/*
		echo      " 	SELECT importe_profesor($rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa) as IMPORTE
					    	FROM  dual ";*/

		/*
		chrome_log("	SELECT importe_profesor( $rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa, $id_curso, $id_horario ) as IMPORTE
					   	FROM  dual ");
		
		$cadena = utf8_encode("  SELECT importe_profesor ( $rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa, $id_curso, $id_horario ) as IMPORTE
					   FROM  dual ");

		echo "-----------------------------------------------<br>";
		echo $cadena."<br>"; */
		/*
		echo utf8_decode(" SELECT importe_profesor( $rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa, $id_curso, $id_horario) as IMPORTE
					    	 FROM  dual ");*/
		
		$sql = utf8_decode(" SELECT importe_profesor( ? , ? , ? , ? , ? , ? , ?, ?, ?, ? ) as IMPORTE
					    	 FROM  dual "    )	;
        
        $query = $this->db->query($sql, array( $rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa, $id_curso, $id_horario));

		

		$fila = $query->row();
		
		 /*
		if( $fila->IMPORTE == "error2: ORA-01403: no data found")
			echo      " 	SELECT importe_profesor($rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa, $id_curso) as IMPORTE
					    	FROM  dual " ; */

		return $fila->IMPORTE; 
	}

	function traer_clases_pejypac($c_identificacion, $id_curso , $n_id_persona, $anio_lectivo, $id_horario)
	{	
		/*
		echo   utf8_decode(" SELECT clases_PROFESOR( $c_identificacion, $id_curso , $n_id_persona , $anio_lectivo) as CLASES
					    	 FROM  dual ");

		echo "<br>-----------------------------------------------";
		/*
		$sql = utf8_decode(" SELECT clases_PROFESOR( ? , ? , ?, ?, ? ) as CLASES
					    	 FROM  dual "    )	;
        
        $query = $this->db->query($sql, array( $c_identificacion, $id_curso , $n_id_persona , $anio_lectivo, $id_horario));*/
        
        $sql = utf8_decode(" SELECT clases_PROFESOR( ? , ? , ?, ? ) as CLASES
					    	 FROM  dual "    )	;
        
        $query = $this->db->query($sql, array( $c_identificacion, $id_curso , $n_id_persona , $anio_lectivo));

		//chrome_log($cadena);
		$fila = $query->row();
		
		/*
		if( $fila->IMPORTE == "error2: ORA-01403: no data found")
			echo      " 	SELECT importe_profesor($rol, $tipo_clase, $c_identificacion , $n_id_materia, $c_programa, $c_orientacion, $n_id_persona , $anio_programa) as IMPORTE
					    	FROM  dual " ;*/

		return $fila->CLASES; 
	}


	
	function cursos_cambiados()	
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

	function cursos_cambiados_programa($c_identificacion,$c_programa,$c_orientacion,$anio)	
	{

		chrome_log("------------ cursos_cambiados_programa ----------------");

		chrome_log(" 	SELECT cpc.f_alta, cpc.C_Usuarioalt, P.D_Apellidos, P.D_Nombres, M.D_Descrip, Cpc.C_Tipo_Clase, Cpc.C_Rol
						FROM cursos_profesores_cambios cpc, cursos c, materias m, comisiones co, personas p
						Where Cpc.N_Curso = C.N_Curso
						and C.N_Id_Comision = co.N_Id_Comision
						And   Cpc.C_Año_Lectivo = C.C_Año_Lectivo
						And   C.N_Id_Materia = M.N_Id_Materia	 
						and Cpc.N_Id_Persona = p.N_Id_Persona
						AND   co.c_identificacion = $c_identificacion
						AND   co.c_programa = $c_programa
						And   co.C_Orientacion = $c_orientacion 
						And   Cpc.C_Año_Lectivo = $anio 
						order by cpc.f_alta asc");

				return $this->db->query(utf8_decode(" 		SELECT cpc.f_alta, cpc.C_Usuarioalt, P.D_Apellidos || ',' || P.D_Nombres as profesor, M.D_Descrip, Cpc.C_Tipo_Clase, Cpc.C_Rol
															FROM cursos_profesores_cambios cpc, cursos c, materias m, comisiones co, personas p
															Where Cpc.N_Curso = C.N_Curso
															and C.N_Id_Comision = co.N_Id_Comision
															And   Cpc.C_Año_Lectivo = C.C_Año_Lectivo
															And   C.N_Id_Materia = M.N_Id_Materia	 
															and Cpc.N_Id_Persona = p.N_Id_Persona
															AND   co.c_identificacion = $c_identificacion
															AND   co.c_programa = $c_programa
															And   co.C_Orientacion = $c_orientacion 
															And   Cpc.C_Año_Lectivo = $anio 
															order by cpc.f_alta asc "));

			


	}


	/*
		El coordinador aun no los confirmo desde el programa
	*/
	function cursos_sin_confirmar_coordinador()	
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
										    
										    ( cp.C_CONFIRMADO is null or cp.C_CONFIRMADO = 0)

										ORDER BY   m.c_identificacion, m.c_programa, m.c_orientacion"));
	}


	/*
		Aun no hay un valor en el campo IMPORTE de la tabla cursos_profesores, que es de donde toma GEMINIS para la facturacion
	*/

	function cursos_sin_importe_tesoreria()	
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

}
?>
