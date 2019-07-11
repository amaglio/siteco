<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function traer_cursos_profesor($id_persona)	
	{	

		return $this->db->query(
									utf8_decode("SELECT h.c_dia_semanal || ' de ' || h.c_hora_desde || ' a ' || h.c_hora_hasta as HORARIO, 
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
												 c.n_periodo
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
											  cp.n_id_persona = '$id_persona'  AND

											  pr.c_identificacion = m.c_identificacion AND
											  pr.c_programa = m.c_programa AND
											  pr.c_orientacion= m.c_orientacion  AND

											  -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			

			    							  cp.n_id_horario = (  Select min(n_id_horario) 
									                               from cursos_profesores cp2
									                               where cp2.c_año_lectivo = cp.c_año_lectivo and
									                                     cp2.n_curso = cp.n_curso and
									                                     cp2.n_id_persona = cp.n_id_persona and
									                                      cp2.c_tipo_clase = cp.c_tipo_clase and
									                                      cp2.c_rol = cp.c_rol)


											ORDER BY c.n_periodo, pr.d_descinf ") 
								);
	}


	public function fulltime ($n_id_persona)
	{
	//devuelve 1 si es fulltime 0 si no es 
		$query = $this->db->query(utf8_decode(" SELECT 
													count(*) as cuantos 
												from 
													contratos 
												where 
													f_hasta is null and 
													c_dedicacion = 'Full - Time' AND
													n_id_persona=$n_id_persona") );
		return $query->row()->CUANTOS;
	}

	public function conceptos_extras()
	{
		$query = $this->db->query(utf8_decode("	SELECT cpto, rh.cpto_nombre 
												FROM liq_docente_conceptos c, rh_conceptos rh 
												WHERE c.c_tipo_concepto = 'ADICIONAL' 
												AND c.cpto = rh.cpto_codigo 
												AND cpto_nombre like 'Ad %' "));
		return $query;
	}


	public function traer_contrato_profesor($id_persona)	
	{		
		$consulta = $this->db->query(utf8_decode("	SELECT *
												FROM 
													contratos c
												WHERE 
													c.n_id_persona = $id_persona 
												ORDER BY N_ID_CONTRATO DESC "));
		return $consulta->row();
	}

	// UN PUNTO STANDART.
	public function traer_valor_punto()	
	{		
		$consulta = $this->db->query(utf8_decode("	SELECT Valor_Columna_Num as punto
													FROM Datos_Default
													WHERE Nom_Columna = 'TITULAR_TEORICA'
													 "));
		return $consulta->row()->PUNTO;
	}

	public function traer_legajo($id_persona)	
	{		
		$consulta = $this->db->query(utf8_decode("	SELECT n_legajo
													FROM docentes 
													WHERE n_id_persona = $id_persona "));
		return $consulta->row();
	}


	public function traer_extras($id_persona, $usuario_oracle=null)	
	{		
		
		if(isset($usuario_oracle)):

			$sql = utf8_decode("	SELECT lda.*, rh.CPTO_NOMBRE
									FROM liq_docente_adicionales lda, docentes d, personas p , rh_conceptos rh 
									WHERE lda.legajo = d.n_legajo
									AND p.n_id_persona = d.n_id_persona
									AND lda.cpto = rh.cpto_codigo 
									AND p.n_id_persona =  ?
									AND lda.liquidacion like '%'|| (extract(YEAR FROM sysdate))||'%'  
									AND lda.c_usuarioalt = '$usuario_oracle' ") ;

		else:
		
			$sql = utf8_decode("	SELECT lda.*, rh.CPTO_NOMBRE
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


	// Pregunta si existe un extra ya que no pueden haber dos extras para el mismo mes con el mismo concepto para el mismo legajo.
	function existe_extra($data)
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



	function insertar_extra($data)
	{
		$liquidacion = $data['liquidacion']; 
		$legajo = $data['legajo'];
		$concepto = $data['concepto'];
		$sueldo = $data['sueldo'];
		$comentarios = $data['comentarios'];
		
		$sql = utf8_decode("INSERT INTO liq_docente_adicionales 
							(liquidacion, legajo, cpto, importe, c_observaciones)
							VALUES 
							( ? , ? , ? , ?, ? ) " );


		//echo $sql;

		$query = $this->db->query($sql, array($liquidacion, $legajo, $concepto, $sueldo, $comentarios ));
		return $this->db->affected_rows();

	}

	function editar_extra($data)
	{
     	
		$sql = utf8_decode("UPDATE liq_docente_adicionales 
							SET IMPORTE = ? , c_observaciones = ? 
							WHERE 	liquidacion = ? AND  
									legajo = ?	AND
									cpto = ? ");


       	$query = $this->db->query($sql, array($data['importe'] , $data['comentarios'], $data['liquidacion'], $data['legajo'], $data['concepto']  ));
			
       	return $this->db->affected_rows();
	}	

	function eliminar_extra($data)
	{
     	
		$sql = utf8_decode("DELETE FROM liq_docente_adicionales 
							WHERE 	liquidacion = ? AND  
									legajo = ?	AND
									cpto = ? ");


       	$query = $this->db->query($sql, array($data['liquidacion'], $data['legajo'], $data['concepto']  ));
			
       	return $this->db->affected_rows();
	}	



	// La usa tanto el importe coordinador como el default
	function confirmar_importe($data)
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


	function procesa_editar_importe_tesoreria($data)
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

}

/* End of file  */
/* Location: ./application/models/ */