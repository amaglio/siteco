<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


public function __construct()
{

	parent::__construct();
}

public function index()
{
	if(!isset($_POST['iniciar'])):

		$this->load->view('login/login');


	else:

		if (!empty($_POST['usuario']) && !empty($_POST['clave'])):

			// --- Servidor de desarrollo ---//


			//$c['hostname'] = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=pluton.ucema.edu.ar)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=pdbpluton.ucema.edu.ar)))";
			//$c['hostname'] = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=11521))(CONNECT_DATA=(SID=CEMA)))";
			//$c['database'] = "cema";

 
 
			//----- Servidor de produccion ----//
			
			$c['hostname'] = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=neptuno.ucema.edu.ar)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=cema.ucema.edu.ar)))";
			//$c['hostname'] = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521))(CONNECT_DATA=(SID=CEMA)))";
			$c['database'] = "cema";
		
			$c['username'] = $_POST['usuario'];
			$c['password'] = $_POST['clave'];
			$c['dbdriver'] = "oci8";
			$c['dbprefix'] = "";
			$c['pconnect'] = FALSE;
			$c['db_debug'] = TRUE;
			$c['cache_on'] = FALSE;
			$c['cachedir'] = "";
			$c['char_set'] = "WE8ISO8859P1";
			$c['dbcollat'] = ""; 
			$active_record = TRUE;

			//  Conexion a la DB ------------------------------------------------------

			$this->session->set_userdata('DB',$c);
			$this->db = $this->load->database($c, TRUE, TRUE); 
			
			// ROLES --------------------------------------------------------------------

			$this->load->model('Login_model'); // Cargo el modelo
			$roles = $this->Login_model->traer_roles(strtoupper($_POST['usuario'])); // Busco los roles
		
			if( $roles->num_rows() > 0 )	// 
			{
				$usuario_oracle = strtoupper($_POST['usuario']);
				
				$persona = $this->Login_model->traer_id_persona($usuario_oracle);	
 				
 				echo "QUIEN".$persona;

				// Variables de session 
        		$this->session->set_userdata('usuario_tesoreria',$usuario_oracle);	
        		$this->session->set_userdata('id_persona', $persona->N_ID_PERSONA );
        		$array_roles = array();
				

        		foreach($roles->result() as $row):

        			array_push($array_roles, $row->ROL);

        		endforeach;

        		$this->session->set_userdata('roles', $array_roles );

        		sleep(2);

        		redirect(base_url()."index.php/home");
			}
			else
			{
			
				show_error("  No tiene permisos para ingresar al sistema. ",500);

				sleep(5);

			}

		else:

			sleep(5);
			echo "Debe ingresar usuario y contaseña";

		endif;

	endif;
}

public function logout()
{
	$this->session->unset_userdata('usuario_tesoreria');
	$this->session->unset_userdata('id_persona');
	$this->session->unset_userdata('DB');

	$this->db->close();
	session_destroy();
	redirect(base_url()."index.php/login");
}


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
