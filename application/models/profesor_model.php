<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor_model extends CI_Model {

public $variable;

public function __construct()
{
	
	parent::__construct();	
}

public function traer_cursos_profesor($id_persona)	
{	
	chrome_log("SELECT 	h.c_dia_semanal || ' de ' || h.c_hora_desde || ' a ' || h.c_hora_hasta as HORARIO, 
								    c.N_CURSO,  
								    cp.c_tipo_clase, 
								    cp.c_rol, 
								    c.f_inicio as FECHA_INI, 
								    c.f_fin as FECHA_FIN, 
								    m.D_DESCRED, 
								    m.D_PUBLICA,
								    m.D_DESCRIP, 
								    m.n_id_materia,
								    cp.N_ID_HORARIO, 
								    cp.N_ID_PERSONA, 
								    cp.C_AÑO_LECTIVO as anio_lectivo,
								    p.d_apellidos || ', ' || p.d_nombres as NOMBRE,
								    pr.d_descinf as PROGRAMA,
								    pr.D_DESCRED as PROGRAMA2,
								    devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PRGCOMISION,
									co.c_identificacion,
									co.c_programa,
									co.c_orientacion,
									cp.n_importe_profesor ,
									cp.importe,
									cp.n_importe_profesor,
									cp.c_confirmado,
									cp.C_OBS,
									to_char(cp.f_pagado, 'YYYY-MM-DD' ) as F_PAGADO,
									C_FACTURA_PROF,
									c.n_periodo,
									c.C_TIPO_PERIODO,
									BUSCAR_CLASES_PROFE_CURSO(co.c_identificacion, c.N_CURSO, cp.N_ID_PERSONA, cp.C_AÑO_LECTIVO ) as CLASES_FECHAS
							FROM 
									cursos_profesores cp,
									materias m, 
									cursos c,
									personas p,
									horarios h,
									programas pr,
									comisiones co
							WHERE 
									cp.n_id_horario = h.n_id_horario AND
									cp.n_id_persona = p.n_id_persona AND
									cp.n_curso = c.n_curso          AND
									c.n_id_materia = m.n_id_materia AND
									c.n_id_comision = co.n_id_comision AND

									cp.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))         AND
									c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
									c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
									cp.n_id_persona = $id_persona  AND

									pr.c_identificacion = m.c_identificacion AND
									pr.c_programa = m.c_programa AND
									pr.c_orientacion= m.c_orientacion  AND

									cp.n_id_horario = 	(  	SELECT min(n_id_horario) 
									                   		FROM cursos_profesores cp2
									                   		WHERE 	cp2.c_año_lectivo = cp.c_año_lectivo 
									                   		AND		cp2.n_curso = cp.n_curso 
									                   		AND		cp2.n_id_persona = cp.n_id_persona
									                        AND		cp2.c_tipo_clase = cp.c_tipo_clase
									                        AND		cp2.c_rol = cp.c_rol
									                    )

							ORDER BY c.n_periodo, pr.d_descinf");

	$sql =  utf8_decode("	SELECT 	h.c_dia_semanal || ' de ' || h.c_hora_desde || ' a ' || h.c_hora_hasta as HORARIO, 
								    c.N_CURSO,  
								    cp.c_tipo_clase, 
								    cp.c_rol, 
								    c.f_inicio as FECHA_INI, 
								    c.f_fin as FECHA_FIN, 
								    m.D_DESCRED, 
								    m.D_PUBLICA,
								    m.D_DESCRIP, 
								    m.n_id_materia,
								    cp.N_ID_HORARIO, 
								    cp.N_ID_PERSONA, 
								    cp.C_AÑO_LECTIVO as anio_lectivo,
								    p.d_apellidos || ', ' || p.d_nombres as NOMBRE,
								    pr.d_descinf as PROGRAMA,
								    pr.D_DESCRED as PROGRAMA2,
								    devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PRGCOMISION,
									co.c_identificacion,
									co.c_programa,
									co.c_orientacion,
									cp.n_importe_profesor ,
									cp.importe,
									cp.n_importe_profesor,
									cp.c_confirmado,
									cp.C_OBS,
									to_char(cp.f_pagado, 'YYYY-MM-DD' ) as F_PAGADO,
									C_FACTURA_PROF,
									c.n_periodo,
									c.C_TIPO_PERIODO,
									BUSCAR_CLASES_PROFE_CURSO(co.c_identificacion, c.N_CURSO, cp.N_ID_PERSONA, cp.C_AÑO_LECTIVO ) as CLASES_FECHAS
							FROM 
									cursos_profesores cp,
									materias m, 
									cursos c,
									personas p,
									horarios h,
									programas pr,
									comisiones co
							WHERE 
									cp.n_id_horario = h.n_id_horario AND
									cp.n_id_persona = p.n_id_persona AND
									cp.n_curso = c.n_curso          AND
									c.n_id_materia = m.n_id_materia AND
									c.n_id_comision = co.n_id_comision AND

									cp.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))         AND
									c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
									c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
									cp.n_id_persona = $id_persona  AND

									pr.c_identificacion = m.c_identificacion AND
									pr.c_programa = m.c_programa AND
									pr.c_orientacion= m.c_orientacion  AND

									cp.n_id_horario = 	(  	SELECT min(n_id_horario) 
									                   		FROM cursos_profesores cp2
									                   		WHERE 	cp2.c_año_lectivo = cp.c_año_lectivo 
									                   		AND		cp2.n_curso = cp.n_curso 
									                   		AND		cp2.n_id_persona = cp.n_id_persona
									                        AND		cp2.c_tipo_clase = cp.c_tipo_clase
									                        AND		cp2.c_rol = cp.c_rol
									                    )

							ORDER BY c.n_periodo, pr.d_descinf ");
                    
    return $this->db->query($sql, array( $id_persona )); 
}

public function fulltime ($n_id_persona) //devuelve 1 si es fulltime 0 si no es 
{
	$sql =  utf8_decode("	SELECT 
								count(*) as cuantos 
							FROM contratos 
							WHERE 	f_hasta is null 
							AND 	c_dedicacion = 'Full - Time' 
							AND		n_id_persona= ? ");

	$query = $this->db->query($sql, array( $n_id_persona )); 

	return $query->row()->CUANTOS;
}

public function conceptos_extras()
{
	/*
	// Son los conceptos Extras que definio tracy en un momenot, eran solo 5

	$query = $this->db->query(utf8_decode("	SELECT cpto, rh.cpto_nombre 
											FROM liq_docente_conceptos c, rh_conceptos rh 
											WHERE c.c_tipo_concepto = 'ADICIONAL' 
											AND c.cpto = rh.cpto_codigo 
											AND cpto_nombre like 'Ad %' "));
	return $query;*/

	$query = $this->db->query(utf8_decode("	SELECT cpto, rh.cpto_nombre 
											FROM liq_docente_conceptos c, rh_conceptos rh 
											WHERE c.c_tipo_concepto = 'ADICIONAL' 
											AND c.cpto = rh.cpto_codigo  
											order by cpto_nombre "));
	return $query;
}

public function traer_contrato_profesor($id_persona)	
{
	chrome_log("traer_contrato_profesor");

	chrome_log("	SELECT *
							FROM	contratos c
							WHERE	c.n_id_persona =  $id_persona 
							AND	c.f_hasta IS NULL
							ORDER BY N_ID_CONTRATO DESC " );

	$sql =  utf8_decode("	SELECT *
							FROM	contratos c
							WHERE	c.n_id_persona = ? 
							AND	c.f_hasta IS NULL
							ORDER BY N_ID_CONTRATO DESC " );

	$query = $this->db->query($sql, array( $id_persona )); 

	return $query->row();
}

public function traer_valor_punto()	
{
	$consulta = $this->db->query(utf8_decode("	SELECT Valor_Columna_Num as punto
												FROM Datos_Default
												WHERE Nom_Columna = 'TITULAR_TEORICA'
											")
								);

	return $consulta->row()->PUNTO;
}

public function traer_legajo($id_persona)	
{
	$sql =  utf8_decode("	SELECT n_legajo
							FROM docentes 
							WHERE n_id_persona = ? ");

	$query = $this->db->query($sql, array( $id_persona )); 

	return $query->row();
}

public function traer_extras($id_persona, $usuario_oracle=null)	
{
	
	if(isset($usuario_oracle)):

		$sql = utf8_decode("	SELECT lda.*, rh.CPTO_NOMBRE, p.n_id_persona
								FROM liq_docente_adicionales lda, docentes d, personas p , rh_conceptos rh 
								WHERE lda.legajo = d.n_legajo
								AND p.n_id_persona = d.n_id_persona
								AND lda.cpto = rh.cpto_codigo 
								AND p.n_id_persona =  ?
								AND lda.liquidacion like '%'|| (extract(YEAR FROM sysdate))||'%'  
								AND lda.c_usuarioalt = '$usuario_oracle' ") ;

	else:
	
		$sql = utf8_decode("	SELECT lda.*, rh.CPTO_NOMBRE, p.n_id_persona
								FROM liq_docente_adicionales lda, docentes d, personas p , rh_conceptos rh 
								WHERE lda.legajo = d.n_legajo
								AND p.n_id_persona = d.n_id_persona
								AND lda.cpto = rh.cpto_codigo 
								AND p.n_id_persona =  ?
								AND lda.liquidacion like '%'|| (extract(YEAR FROM sysdate))||'%'   ") ;

	endif;
	 
	
	$query = $this->db->query($sql, array($id_persona));

	chrome_log($query->num_rows()); 

    return $query;
}

public function traer_all_extras()	
{
 
 
	$sql = utf8_decode("	SELECT to_char(lda.f_alta, 'yyyy-mm-dd hh24:mi:ss') as f_alta   , lda.legajo, p.d_apellidos, p.d_nombres, lda.liquidacion, lda.importe, Lda.C_Observaciones 
							FROM liq_docente_adicionales lda, docentes d, personas p , rh_conceptos rh 
							WHERE lda.legajo = d.n_legajo
							AND p.n_id_persona = d.n_id_persona
							AND lda.cpto = rh.cpto_codigo  
							AND lda.liquidacion like '%'|| (extract(YEAR FROM sysdate))||'%'

							UNION

							SELECT ea.f_alta  , NULL as legajo, pe.D_APELLIDOS, pe.D_NOMBRES, NULL as LIQUIDACION, ea.IMPORTE, Ea.Comentario as C_OBSERVACIONES
							FROM EXTRAS_AUTONOMOS ea, personas pe
							WHERE  fecha like '%'|| (extract(YEAR FROM sysdate))||'%'
							AND ea.id_persona = pe.n_id_persona  ") ;

	
	$query = $this->db->query($sql, array());

    return $query;
}


public function traer_extras_autonomo($id_persona )	
{
	chrome_log("traer_extras_autonomo");

	chrome_log("	SELECT *
					FROM EXTRAS_AUTONOMOS 
					WHERE  id_persona = $id_persona 
					AND fecha like '%'|| (extract(YEAR FROM sysdate))||'%'");


	$sql = utf8_decode("	SELECT *
							FROM EXTRAS_AUTONOMOS 
							WHERE  id_persona = ? 
							AND fecha like '%'|| (extract(YEAR FROM sysdate))||'%'  ") ;


	$query = $this->db->query($sql, array($id_persona));

	return $query;
}

public function existe_extra($data)
{
	$liquidacion = $data['liquidacion'];
	$legajo = $data['legajo'];
	$concepto = $data['concepto'];
	
	$sql = utf8_decode("SELECT *
						FROM liq_docente_adicionales 
						WHERE liquidacion = ? 
						AND	  legajo = ?
						AND   cpto = ? " );

	$query = $this->db->query($sql, array($liquidacion, $legajo, $concepto ));

	if($query->num_rows() > 0):
		return true;			// ya existe una extra
	else:
		return false;			// no existe otra extra
	endif;
}

public function insertar_extra($data)
{
	$liquidacion = $data['liquidacion']; 
	$legajo = $data['legajo'];
	$concepto = $data['concepto'];
	$sueldo = $data['sueldo'];
	$comentarios = utf8_decode($data['comentarios']);	
	
	$sql = utf8_decode("INSERT INTO liq_docente_adicionales 
						(liquidacion, legajo, cpto, importe, c_observaciones)
						VALUES 
						( ? , ? , ? , $sueldo , ? ) " );

	$query = $this->db->query($sql, array($liquidacion, $legajo, $concepto, $sueldo, $comentarios ));
	return $this->db->affected_rows();
}

public function insertar_extra_autonomo($data)
{
	$this->db->set('ID_EXTRA_AUTONOMO', "ID_EXTRA_AUTONOMO.nextval", false);

	$array_extra_autonomo = array(  
                'ID_PERSONA' => $data['idUsuario'],
                'FECHA' => $data['liquidacion'],
                'IMPORTE' => $data['sueldo']
    );

	if($data['comentarios'])
	    $array_extra_autonomo['COMENTARIO'] = utf8_decode($data['comentarios']);

	$this->db->insert('EXTRAS_AUTONOMOS',$array_extra_autonomo);
 

	return $this->db->affected_rows();
}

public function editar_extra_autonomo($data)
{
 	
	$sql = utf8_decode("UPDATE EXTRAS_AUTONOMOS 
						SET IMPORTE = ? , COMENTARIO = ? 
						WHERE 	ID_EXTRA_AUTONOMO = ? 	  ");

   	$query = $this->db->query($sql, array($data['importe'] , utf8_decode($data['comentarios']) , $data['id_extra_autonomo'] ));
		
   	return $this->db->affected_rows();
}	

public function editar_extra($data)
{
 	
	$sql = utf8_decode("UPDATE liq_docente_adicionales 
						SET IMPORTE = ? , c_observaciones = ? 
						WHERE 	liquidacion = ? AND  
								legajo = ?	AND
								cpto = ? ");


   	$query = $this->db->query($sql, array($data['importe'] , utf8_decode($data['comentarios']) , $data['liquidacion'], $data['legajo'], $data['concepto']  ));
		
   	return $this->db->affected_rows();
}	

public function eliminar_extra($data)
{
 	
	$sql = utf8_decode("DELETE FROM liq_docente_adicionales 
						WHERE 	liquidacion = ? AND  
								legajo = ?	AND
								cpto = ? ");


   	$query = $this->db->query($sql, array($data['liquidacion'], $data['legajo'], $data['concepto']  ));
		
   	return $this->db->affected_rows();
}	

public function eliminar_extra_autonomo($data)
{
 	
	$sql = utf8_decode("DELETE FROM EXTRAS_AUTONOMOS 
						WHERE 	ID_EXTRA_AUTONOMO = ? ");


   	$query = $this->db->query($sql, array($data['id_extra_autonomo']));
		
   	return $this->db->affected_rows();
}
public function confirmar_importe($data)
{
 	
	$usuario_oracle = $this->session->userdata('usuario_tesoreria');

 	$observacion =  date('d-m-Y')." [".$usuario_oracle."] - Se confirmo el importe del coordinador por tesoreria: $".$data['sueldo']." |";

   	$comentario = $this->Programas_model->traer_comentarios_curso($data);

	if(isset($comentario))
		$observacion = $comentario.$observacion;

	$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
						SET C_OBS = ? , IMPORTE = ?
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

public function procesa_editar_importe_tesoreria($data)
{
 	

 	$observacion =  date('d-m-Y')." [A] - Se edito el importe por tesoreria: $".$data['sueldo']." |";

   	$comentario = $this->Programas_model->traer_comentarios_curso($data);

	if(isset($comentario))
		$observacion = $comentario.$observacion;

	$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
						SET C_OBS = ? , IMPORTE = ?
						WHERE 	N_CURSO = ? AND  
								C_AÑO_LECTIVO = ?	AND
								C_ROL = ?	AND
								N_ID_PERSONA = ? AND
								N_ID_HORARIO = ? ");


   $query = $this->db->query($sql, array($observacion, $data['sueldo'] , $data['id_curso'], $data['anio_lectivo'], rawurldecode($data['rol']), $data['idUsuario'] , $data['id_horario']  ));
	
	if($this->db->affected_rows() == 1)
   	  	return true;
   	else
   		return false;		
}	

public function traer_profesor($id_profesor) // Nombre
{
	return $this->db->query(utf8_decode("	SELECT 
													p.d_apellidos, p.d_nombres
											FROM 
													personas p
											WHERE 
													p.n_id_persona = $id_profesor") )->row();
}

public function traer_datos_profesor($id_profesor) // Nombre
{
	return $this->db->query(utf8_decode("	SELECT 
													*
											FROM 
													personas p
											WHERE 
													p.n_id_persona = $id_profesor") )->row();
}

public function profesor_fulltime ($n_id_persona)
{
	chrome_log("model/profesor_fulltime" );

	$sql = 	utf8_decode("	SELECT 
									count(*) as cuantos 
							FROM 
									contratos 
							WHERE 
									f_hasta is null and 
									c_dedicacion = 'Full - Time'and
									n_id_persona= ? " ) ;

	$query = $this->db->query($sql, array( $n_id_persona ) );

	return $query->row()->CUANTOS; 
}

public function cursos_asignados_profesor_exportar($id_persona)	
{
	$sql =  utf8_decode("	SELECT   m.D_PUBLICA,
							      cp.c_tipo_clase, 
							      cp.c_rol,
							      m.D_DESCRIP, 
							      cp.C_AÑO_LECTIVO as anio_lectivo,
							      p.d_apellidos || ', ' || p.d_nombres as NOMBRE, 
							      devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PRGCOMISION,
							      SUBSTRB(importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ), 0 , INSTR( importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ),'|')-1  ) as importe,
							      DECODE(co.c_identificacion, 3,'',SUBSTRB(importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ), INSTR( importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ),'|') +1 ,5)) as punto,
                    			  DECODE(co.c_identificacion, 3, REPLACE(BUSCAR_CLASES_PROFE_CURSO(co.c_identificacion, c.N_CURSO, cp.N_ID_PERSONA, cp.C_AÑO_LECTIVO ), '<br>' )   , '') as CLASES_FECHAS,
							      cp.n_importe_profesor as importe_coordinador,
							      cp.c_confirmado,
							      cp.C_OBS 
							FROM 
							    cursos_profesores cp,
							    materias m, 
							    cursos c,
							    personas p,
							    horarios h,
							    programas pr,
							    comisiones co
							WHERE 
							    cp.n_id_horario = h.n_id_horario AND
							    cp.n_id_persona = p.n_id_persona AND
							    cp.n_curso = c.n_curso          AND
							    c.n_id_materia = m.n_id_materia AND
							    c.n_id_comision = co.n_id_comision AND

							    cp.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))         AND
							    c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
							    c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
							    cp.n_id_persona = $id_persona  AND

							    pr.c_identificacion = m.c_identificacion AND
							    pr.c_programa = m.c_programa AND
							    pr.c_orientacion= m.c_orientacion  AND

							    cp.n_id_horario = 	(  	SELECT min(n_id_horario) 
								                        FROM cursos_profesores cp2
								                        WHERE 	cp2.c_año_lectivo = cp.c_año_lectivo 
								                        AND		cp2.n_curso = cp.n_curso 
								                        AND		cp2.n_id_persona = cp.n_id_persona
							                            AND		cp2.c_tipo_clase = cp.c_tipo_clase
							                            AND		cp2.c_rol = cp.c_rol
							                        )

							ORDER BY c.n_periodo, pr.d_descinf");

	//var_dump($this->db->query($sql));

    return $this->db->query($sql, array( $id_persona )); 
}

public function todos_cursos_asignados()	
{	

	$sql =  utf8_decode("SELECT   m.D_PUBLICA,
						        cp.c_tipo_clase, 
						        cp.c_rol,
						        m.D_DESCRIP, 
						        cp.C_AÑO_LECTIVO as anio_lectivo,
						        p.d_apellidos || ', ' || p.d_nombres as NOMBRE, 
						        devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PRGCOMISION,
						        SUBSTRB(importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ), 0 , INSTR( importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ),'|')-1  ) as importe,
						        DECODE(co.c_identificacion, 3,'',SUBSTRB(importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ), INSTR( importe_profesor( cp.c_rol , cp.c_tipo_clase , co.c_identificacion , m.n_id_materia ,  co.c_programa, co.c_orientacion , p.n_id_persona, cp.C_AÑO_LECTIVO, c.N_CURSO ,  cp.N_ID_HORARIO ),'|') +1 ,5)) as punto,
						                DECODE(co.c_identificacion, 3, REPLACE(BUSCAR_CLASES_PROFE_CURSO(co.c_identificacion, c.N_CURSO, cp.N_ID_PERSONA, cp.C_AÑO_LECTIVO ), '<br>' )   , '') as CLASES_FECHAS,
						        cp.n_importe_profesor as importe_coordinador,
						        cp.c_confirmado,
						        cp.C_OBS,
						        co.c_identificacion,
						        co.c_programa,
						        co.c_orientacion,
						        c.n_periodo,
						        c.C_TIPO_PERIODO
						  FROM 
						      cursos_profesores cp,
						      materias m, 
						      cursos c,
						      personas p,
						      horarios h,
						      programas pr,
						      comisiones co
						  WHERE 
						      cp.n_id_horario = h.n_id_horario AND
						      cp.n_id_persona = p.n_id_persona AND
						      cp.n_curso = c.n_curso          AND
						      c.n_id_materia = m.n_id_materia AND
						      c.n_id_comision = co.n_id_comision AND
						      cp.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))         AND
						      c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
						      c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND 
						      pr.c_identificacion = m.c_identificacion AND
						      pr.c_programa = m.c_programa AND
						      pr.c_orientacion= m.c_orientacion  AND
						      cp.n_id_horario = 	(  	SELECT min(n_id_horario) 
						                            FROM cursos_profesores cp2
						                            WHERE 	cp2.c_año_lectivo = cp.c_año_lectivo 
						                            AND		cp2.n_curso = cp.n_curso 
						                            AND		cp2.n_id_persona = cp.n_id_persona
						                              AND		cp2.c_tipo_clase = cp.c_tipo_clase
						                              AND		cp2.c_rol = cp.c_rol
						                          )

						  ORDER BY c.n_periodo, pr.d_descinf ");
    
    //var_dump($this->db->query($sql));

    return $this->db->query($sql); 
}

public function traer_deuda_profesor($id_profesor)
{
	chrome_log("profesor/deuda_profesor" );

	$sql = 	utf8_decode("	SELECT 
									*
							FROM 
									profesor_deuda 
							WHERE 
									id_profesor = ? " ) ;

	$query = $this->db->query($sql, array( $id_profesor ) );

	return $query;
}


public function agregar_deuda_profesor($array)
{
	chrome_log("profesor/agregar_deuda_profesor" );

	$sql = 	utf8_decode("	INSERT INTO  profesor_deuda (ID_PROFESOR, C_ANIO_LECTIVO, IMPORTE_ADEUDADO, COMENTARIO )
							VALUES ( ?, ? , ? ,? )   " ) ;

	$query = $this->db->query($sql, array( $array['id_profesor'], $array['anio'], $array['importe'], $array['comentarios']  ) );

	if( $this->db->affected_rows())
		return true;
	else
		return false;
}

public function editar_deuda_profesor($array)
{
	chrome_log("profesor/editar_deuda_profesor" );

	$sql = 	utf8_decode("	UPDATE  profesor_deuda
							SET	IMPORTE_ADEUDADO = ? , COMENTARIO = ?
							WHERE 	ID_PROFESOR = ? 
							AND		C_ANIO_LECTIVO = ?	   	" ) ;

	$query = $this->db->query($sql, array( $array['importe'], $array['comentarios'],  $array['id_profesor'], $array['anio'] ) );

	if( $this->db->affected_rows())
		return true;
	else
		return false;
}

public function eliminar_deuda_profesor($id_profesor, $anio_lectivo)
{
	chrome_log("profesor/eliminar_deuda_profesor" );

	$sql = 	utf8_decode("	DELETE FROM  profesor_deuda
							WHERE 	ID_PROFESOR = ? 
							AND		C_ANIO_LECTIVO = ?	   	" ) ;

	$query = $this->db->query($sql, array( $id_profesor, $anio_lectivo ) );

	if( $this->db->affected_rows())
		return true;
	else
		return false;
}

public function editar_fecha_factura($data)
{
	chrome_log("profesor/editar_fecha_factura" );

	$fecha_factura = $data['fecha_factura'];
	$fecha = "to_date('$fecha_factura','yyyy/mm/dd')";

	if( isset($data['numero_factura']) )
		$numero_factura = ", C_FACTURA_PROF = '".$data['numero_factura']."'";
	else
		$numero_factura = "";
 
	$sql = utf8_decode("UPDATE CURSOS_PROFESORES 
						SET  F_PAGADO = to_date('$fecha_factura','yyyy/mm/dd') $numero_factura
						WHERE 	N_CURSO = ? AND  
								C_AÑO_LECTIVO = ?	AND
								C_ROL = ?	AND
								N_ID_PERSONA = ? AND
								N_ID_HORARIO = ? ");

   $query = $this->db->query($sql, array( $data['id_curso'], $data['anio_lectivo'], rawurldecode($data['rol']), $data['idUsuario'] , $data['id_horario']  ));
 

	if( $this->db->affected_rows())
		return true;
	else
		return false;
}


public function buscar_clases_profesor_curso($c_identificacion, $id_curso, $id_persona, $anio)
{
	chrome_log("profesor/deuda_profesor" );

	$sql = 	utf8_decode("	SELECT  BUSCAR_CLASES_PROFE_CURSO(?,?,?,?) as fecha
							FROM    dual " ) ;

	$query = $this->db->query($sql, array( $c_identificacion, $id_curso, $id_persona, $anio ) );

	return $query->row()->FECHA;
}

// Datos


public function get_coordinador_nombre($id_persona)
{
	chrome_log("profesor/get_coordinador_nombre" );

	$sql = 	utf8_decode("	SELECT  D_NOMBRES 
							FROM    personas
							WHERE n_id_persona = ? " ) ;

	$query = $this->db->query($sql, array( $id_persona ) );

	return $query->row()->D_NOMBRES;
}

public function get_coordinador_email($id_persona)
{
	chrome_log("profesor/get_coordinador_email" );

	$sql = 	utf8_decode("	SELECT  C_EMAIL 
							FROM    correos
							WHERE n_id_persona = ? 
							AND   c_CORREO = 'E-Mail Interno' " ) ;

	$query = $this->db->query($sql, array( $id_persona ) );

	return $query->row()->C_EMAIL;
}

}