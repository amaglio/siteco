<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


	function traer_id_persona($usuario_oracle)
    {
   	
    	$resultado = $this->db->query("	SELECT p.n_id_persona
					    			FROM personas p
					    			WHERE p.user_oracle = '$usuario_oracle' " );

    	return $resultado->row();
    }

    function traer_roles($usuario) 
	{	
		// CAMBIAR agregar OR para los demas ROLES que van a usar el sistema

		$resultado = $this->db->query("		SELECT granted_role as ROL
											FROM dba_role_privs
											WHERE 	( 	granted_role = 'ROLE_COORDINADOR' 	OR
														granted_role = 'ROLE_TESORERIA' 	OR
														granted_role = 'ROLE_ASISTENTE_PROGRAMAS'
													)										AND
												  grantee = '$usuario'
										");											
		return $resultado;
	}


}

/* End of file  */
/* Location: ./application/models/ */