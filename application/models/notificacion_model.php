<?php

// [CAMBIAR]  
//--sacar el USUARIO ORACLE POR ID_PERSONA MGALLACHER

class Notificacion_model extends CI_Model {

    function __construct()
    {
    	parent::__construct(); 	
    	//$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
    }

	function traer_notificaciones_usuario($usuario)
	{
		$sql = "SELECT  --DEVUELVE_PROGRAMA_CURSO(N.C_ANIO_LECTIVO,  N.N_CURSO ) AS PROGRAMA, 
						DEVUELVE_PROGRAMA(n.c_identificacion, n.c_programa, n.c_orientacion) AS PROGRAMA,
					    DEVUELVE_PERSONA(n.N_ID_PROFESOR) AS NOMBRE_PROFESOR,
					    DEVUELVE_MATERIA_CURSO(N.C_ANIO_LECTIVO,  N.N_CURSO ) AS MATERIA,
					    N.TEXTO, n.F_ALTA, n.C_USUARIOALT,
					    n.c_identificacion, n.c_programa, n.c_orientacion, N_ID_PROFESOR
				FROM NOTIFICACION n, NOTIFICACION_USUARIO nu
				WHERE 	n.id_notificacion = nu.id_notificacion
				AND		nu.usuario =  '$usuario'
				ORDER BY  n.F_ALTA  DESC";

		$query = $this->db->query($sql);

		return $query;

	}

	function cantidad_notificaciones_nuevas($usuario)
	{
		$sql = "SELECT count(*) as cantidad
				FROM NOTIFICACION n, NOTIFICACION_USUARIO nu
				WHERE 	n.id_notificacion = nu.id_notificacion
				AND		nu.usuario =  '$usuario'
				AND 	nu.visto = 0
				ORDER BY f_alta, visto, n.id_notificacion  asc";

		$query = $this->db->query($sql);

		return $query->row()->CANTIDAD;

	}

	function actualizar_visto_notificaciones($usuario)
	{
		$sql = "UPDATE  NOTIFICACION_USUARIO
				SET visto = 1
				WHERE 	usuario =  '$usuario'
				AND 	visto = 0	";

		$query = $this->db->query($sql);

	}

	
	function traer_coordinador_carrera($c_identificacion, $c_programa, $c_orientacion)
	{
		$resultado = $this->db->query("		SELECT P.USER_ORACLE as usuario
											FROM DBA_ROLE_PRIVS RP , CRM_COORDINADOR_PROGRAMA CCP, PERSONAS P
											WHERE RP.GRANTEE = P.USER_ORACLE
											AND CCP.N_ID_PERSONA = P.N_ID_PERSONA
											AND RP.GRANTED_ROLE = 'ROLE_COORDINADOR' 
											AND CCP.C_IDENTIFICACION = $c_identificacion
											AND CCP.C_PROGRAMA = $c_programa 
											AND CCP.C_ORIENTACION = $c_orientacion ");

		return $resultado;

	}


}	
?>
