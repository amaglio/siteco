<?php

// [CAMBIAR]  
//--sacar el USUARIO ORACLE POR ID_PERSONA MGALLACHER

class Curso_externo_model extends CI_Model {

function __construct()
{
	parent::__construct(); 	
}


function traer_cursos_externos()
{
	$sql = "SELECT *
			FROM CURSO_EXTERNO ce
			     LEFT JOIN empresas e ON ce.id_empresa = e.n_id_empresa";

	$query = $this->db->query($sql);

	return $query;

}

function traer_informacion_curso_externo($id_curso_externo)
{
	$sql = "SELECT ce.*, e.*, to_char(ce.FECHA, 'YYYY-MM-DD' ) as FECHA, to_char(ce.FECHA_COBRO, 'YYYY-MM-DD' ) as FECHA_COBRO
			FROM CURSO_EXTERNO ce
			     LEFT JOIN empresas e ON ce.id_empresa = e.n_id_empresa
			WHERE ce.id_curso_externo = $id_curso_externo";

	$query = $this->db->query($sql);

	return $query->row();

}

function traer_profesores_curso_externo($id_curso_externo)
{
	$sql = "SELECT  DECODE(p.d_apellidos, null, pce.apellido, p.d_apellidos) as apellido,
					DECODE(p.d_nombres, null, pce.nombre, p.d_nombres) as nombre,
					decode(pce.id_persona, null, 'no', 'si') as es_profesor_ucema,
					pce.PAGADO,
					to_char(pce.FECHA_PAGO, 'YYYY-MM-DD' ) as FECHA_PAGO,
					pce.importe_a_pagar,
					pce.ID_PROFESOR_CURSO
			FROM PROFESOR_CURSO_EXTERNO pce
			     	LEFT JOIN personas p ON pce.id_persona = p.n_id_persona
			WHERE pce.id_curso_externo = $id_curso_externo";

	$query = $this->db->query($sql);

	return $query;
}

function traer_informacion_profesor_curso($id_profesor_curso)
{
	$sql = "SELECT  DECODE(p.d_apellidos, null, pce.apellido, p.d_apellidos) as apellido,
					DECODE(p.d_nombres, null, pce.nombre, p.d_nombres) as nombre,
					decode(pce.id_persona, null, 'no', 'si') as es_profesor_ucema,
					pce.PAGADO,
					to_char(pce.FECHA_PAGO, 'YYYY-MM-DD' ) as FECHA_PAGO,
					pce.importe_a_pagar,
					pce.ID_PROFESOR_CURSO,
					pce.id_persona,
					pce.ID_CURSO_EXTERNO
			FROM PROFESOR_CURSO_EXTERNO pce
			     	LEFT JOIN personas p ON pce.id_persona = p.n_id_persona
			WHERE pce.ID_PROFESOR_CURSO = $id_profesor_curso";

	$query = $this->db->query($sql);

	return $query->row();
}



// ABM Curso externo

function agregar_curso_externo($array)
{

  	$this->db->set('ID_CURSO_EXTERNO', "ID_CURSO_EXTERNO.nextval", false);	

  	$array_curso_externo['ID_EMPRESA'] = utf8_decode($array['id_empresa']);
  	$array_curso_externo['COBRADO'] = utf8_decode($array['cobrado']);

  	if( isset($array['nombre_curso']) && !empty($array['nombre_curso']))
		$array_curso_externo['NOMBRE_CURSO'] = utf8_decode($array['nombre_curso']);

  	if( isset($array['concepto']) && !empty($array['concepto']))
		$array_curso_externo['CONCEPTO'] = utf8_decode($array['concepto']);

	if( isset($array['fecha_evento']) && !empty($array['fecha_evento'])):
		$fecha_evento= $array['fecha_evento'];
		$this->db->set('FECHA',"to_date('$fecha_evento','yyyy/mm/dd')",false);
	endif;


	if( $array['cobrado'] == 1 ):

		$array_curso_externo['COBRADO'] = utf8_decode(1);

		if( isset($array['fecha_cobro']) && !empty($array['fecha_cobro'])):
			$fecha_cobro= $array['fecha_cobro'];
			$this->db->set('FECHA_COBRO',"to_date('$fecha_cobro','yyyy/mm/dd')",false);
		endif;
		
		if( isset($array['importe']) && !empty($array['importe']))
			$array_curso_externo['IMPORTE_A_COBRAR'] = utf8_decode($array['importe']);

	endif;

	$this->db->insert('CURSO_EXTERNO',$array_curso_externo);

	if($this->db->affected_rows() > 0)
		return true;
	else
		return false;
 
}

function editar_curso_externo($array)
{
	$array_where = array(  'ID_CURSO_EXTERNO' => $array['id_curso_externo'] );

	$array_curso_externo =  array();

	$array_curso_externo['ID_EMPRESA'] = utf8_decode($array['id_empresa']);
  	$array_curso_externo['COBRADO'] = utf8_decode($array['cobrado']);

  	if( isset($array['nombre_curso']) && !empty($array['nombre_curso']))
		$array_curso_externo['NOMBRE_CURSO'] = utf8_decode($array['nombre_curso']);
	else
		$array_curso_externo['NOMBRE_CURSO'] = NULL;

  	if( isset($array['concepto']) && !empty($array['concepto']))
		$array_curso_externo['CONCEPTO'] = utf8_decode($array['concepto']);
	else
		$array_curso_externo['CONCEPTO'] = NULL;

	if( isset($array['fecha_evento']) && !empty($array['fecha_evento'])):
		$fecha_evento= $array['fecha_evento'];
		$this->db->set('FECHA',"to_date('$fecha_evento','yyyy/mm/dd')",false);
	else:
		$array_curso_externo['FECHA'] = NULL;
	endif;

	if( isset($array['fecha_cobro']) && !empty($array['fecha_cobro'])):
		$fecha_cobro= $array['fecha_cobro'];
		$this->db->set('FECHA_COBRO',"to_date('$fecha_cobro','yyyy/mm/dd')",false);
	else:
		$array_curso_externo['FECHA_COBRO'] = NULL;
	endif;
	
	if( isset($array['importe']) && !empty($array['importe'])):
		$array_curso_externo['IMPORTE_A_COBRAR'] = utf8_decode($array['importe']);
	else:
		$array_curso_externo['IMPORTE_A_COBRAR'] = NULL;
	endif;


	$this->db->where($array_where);
	$this->db->update('CURSO_EXTERNO', $array_curso_externo); 

	if($this->db->affected_rows() > 0)
		return true;
	else
		return false;
}



function cargar_profesor_curso($array)
{

  	$this->db->set('ID_PROFESOR_CURSO', "ID_PROFESOR_CURSO.nextval", false);	

  	$array_profesor_curso['ID_CURSO_EXTERNO'] = utf8_decode($array['id_curso_externo']);
  	
  	if( isset($array['id_profesor_ucema']) && !empty($array['id_profesor_ucema']))
		$array_profesor_curso['ID_PERSONA'] = utf8_decode($array['id_profesor_ucema']);

  	if( isset($array['nombre']) && !empty($array['nombre']))
		$array_profesor_curso['NOMBRE'] = utf8_decode($array['nombre']);

	if( isset($array['apellido']) && !empty($array['apellido']))
		$array_profesor_curso['APELLIDO'] = utf8_decode($array['apellido']);

	if( $array['pagado'] == 1 ):

		$array_profesor_curso['PAGADO'] = utf8_decode(1);

		if( isset($array['fecha_pago']) && !empty($array['fecha_pago'])):
			$fecha_pago= $array['fecha_pago'];
			$this->db->set('FECHA_PAGO',"to_date('$fecha_pago','yyyy/mm/dd')",false);
		endif;
		
		if( isset($array['importe_pago']) && !empty($array['importe_pago'])):
			$array_profesor_curso['IMPORTE_A_PAGAR'] = utf8_decode($array['importe_pago']);
		endif;

	else:

		$array_profesor_curso['FECHA_PAGO'] = NULL;
		$array_profesor_curso['IMPORTE_A_PAGAR'] = NULL;

	endif;

	$this->db->insert('PROFESOR_CURSO_EXTERNO',$array_profesor_curso);

	if($this->db->affected_rows() > 0)
		return true;
	else
		return false;
 
}




function editar_profesor_curso($array)
{
	$array_where = array(  'ID_PROFESOR_CURSO' => $array['id_profesor_curso'] );

	$array_profesor_curso =  array();

 	if( isset($array['id_profesor_ucema']) && !empty($array['id_profesor_ucema']))
		$array_profesor_curso['ID_PERSONA'] = utf8_decode($array['id_profesor_ucema']);
	else
		$array_profesor_curso['ID_PERSONA'] = NULL;

  	if( isset($array['nombre']) && !empty($array['nombre']))
		$array_profesor_curso['NOMBRE'] = utf8_decode($array['nombre']);
	else
		$array_profesor_curso['NOMBRE'] = NULL;
	

	if( isset($array['apellido']) && !empty($array['apellido']))
		$array_profesor_curso['APELLIDO'] = utf8_decode($array['apellido']);
	else
		$array_profesor_curso['APELLIDO'] = NULL;


	if( $array['pagado'] == 1 ):

		$array_profesor_curso['PAGADO'] = 1;

		if( isset($array['fecha_pago']) && !empty($array['fecha_pago'])):
			$fecha_pago= $array['fecha_pago'];
			$this->db->set('FECHA_PAGO',"to_date('$fecha_pago','yyyy/mm/dd')",false);
		else:
			$array_profesor_curso['FECHA_PAGO'] = NULL;
		endif;
		
		if( isset($array['importe_pago']) && !empty($array['importe_pago'])):
			$array_profesor_curso['IMPORTE_A_PAGAR'] = utf8_decode($array['importe_pago']);
		else:
			$array_profesor_curso['IMPORTE_A_PAGAR'] = NULL;
		endif;

	else:

		$array_profesor_curso['PAGADO'] = 0;
		$array_profesor_curso['FECHA_PAGO'] = NULL;
		$array_profesor_curso['IMPORTE_A_PAGAR'] = NULL;

	endif;



	$this->db->where($array_where);
	$this->db->update('PROFESOR_CURSO_EXTERNO', $array_profesor_curso); 

	if($this->db->affected_rows() > 0)
		return true;
	else
		return false;
}


function eliminar_curso_externo($array)
{
	$this->db->trans_start();

		// Elimino  los profesor del curso
		$this->db->where('ID_CURSO_EXTERNO', $array['id_curso_externo']);
		$this->db->delete('PROFESOR_CURSO_EXTERNO');

		// Elimino  el curso externo
		$this->db->where('ID_CURSO_EXTERNO', $array['id_curso_externo']);
		$this->db->delete('CURSO_EXTERNO');


	$this->db->trans_complete();

	if ($this->db->trans_status() == FALSE)
	{
	    return false;
	}
	else
	{
		 return true;
	}


}



function eliminar_profesor_curso($array)
{
	chrome_log("ID: ".$array['id_profesor_curso']);
  	$this->db->where('ID_PROFESOR_CURSO', $array['id_profesor_curso']);
	$this->db->delete('PROFESOR_CURSO_EXTERNO');

	if($this->db->affected_rows() > 0)
		return true;
	else
		return false;
 
}


	







}	
?>
