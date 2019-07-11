<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor_tesoreria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('general_helper');
		//esta_logueado();

		$this->db = $this->load->database($this->session->userdata('DB'),TRUE, TRUE);
		$this->load->model('Programas_model');
		$this->load->model('Profesor_model');

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
			
	}

	public function index()
	{
		$data['vista_head'] = $this->load->view('estructura/head_tesoreria', '' , true);
		$this->load->view('profesores_tesoreria',$data);
	}

	
	public function buscar_profesor_cursos()
	{
		chrome_log($_POST['idUsuario']);

		$datos['profesores_cursos'] = $this->Profesor_model->traer_cursos_profesor($_POST['idUsuario']);
		$datos['id_profesor'] = $_POST['idUsuario'];
		
		if( $this->Profesor_model->fulltime($_POST['idUsuario']) == 1 )
			$datos['tipo'] = "Full Time";	
		else
			$datos['tipo'] = "Part Time";

		$response['error'] = FALSE;
		
		$response['html_view'] = $this->load->view('profesores_cursos',$datos,true);
		
		print json_encode($response);

	}

    public function cargar_extras($id_profesor)
    {
        //echo $id_profesor;

        $datos['id_profesor'] = $id_profesor ;
        $datos['nombre_profesor']  = $this->Programas_model->traer_profesor($id_profesor);

        $this->load->view('cargar_extras', $datos );
        
    }



	public function exportar_pdf($id_profesor) 
	{

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
        $pdf->SetFont('Helvetica', '', 12, '', true);
 
    // Añadir una página
    // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
    //fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $html = "<style type=text/css>";
        $html .= "table{ padding:5px;  }";
        $html .= "th{color: white; height:25px; font-size:10px; vertical-align: middle; text-align:center; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #E6E6E6; border: solid 1px A4A4A4; padding-left:10px; vertical-align: middle;font-size:9px; height:20px; color: #000}";
        $html .= "</style>";

        // Informacion de los cursos del profesor
       
        $profesores_cursos = $this->Profesor_model->traer_cursos_profesor($id_profesor);
        $nombre_profesor = $this->Programas_model->traer_profesor($id_profesor);
        $contrato_profesor = $this->Profesor_model->traer_contrato_profesor($id_profesor);
        $valor_punto = $this->Profesor_model->traer_valor_punto();
        
        if( $this->Profesor_model->fulltime($id_profesor) == 1 )
            $tipo_profesor= "Full Time";   
        else
            $tipo_profesor = "Part Time";

       // $html .= "<div style='float:right;' ><h6 >Fecha: ".date('d/m/Y').".</h6></div>";
        $html .= "<h4>Profesor: ".utf8_encode($nombre_profesor->D_APELLIDOS).", ".utf8_encode($nombre_profesor->D_NOMBRES).".</h4>";
        $html .= "<h5>&#8226; Tipo de Profesor: ".$tipo_profesor.".<h5>";
        $html .= "<h5>&#8226; Cantidad de cursos: ".$profesores_cursos->num_rows().".<h5>";

        if($contrato_profesor->N_PUNTOS):

                 $html .= "<h5>&#8226; Pts. contrato: ".$contrato_profesor->N_PUNTOS.".<h5>";
                 $html .= "<h5>&#8226; Cursos contrato: $".$contrato_profesor->N_PUNTOS*$valor_punto.".<h5>";
        endif;

        $total_acordado_coordinador = 0;
        $total_a_pagar = 0;
        
        $html .= "<div class='table-responsive' >";  
        $html .= "<br><table  border='1' cellpadding='20'>";
        $html .= " 
                        <tr>
                            <th style='background-color:red;'>Programa</th>
                            <th>Materia</th>
                            <th width='50'>Rol</th>
                            <th>F. Inicio</th>
                            <th>Importe Acordado</th>
                            <th>Adicionales a pagar</th>
                        </tr>
                   ";          
                    
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
                            <td>'.utf8_encode($row->PROGRAMA).'</td>
                            <td>'.utf8_encode($row->D_DESCRIP).'</td>
                            <td>'.utf8_encode($row->C_ROL).'</td>
                            <td>'.utf8_encode($row->FECHA_INI).'</td>
                            <td>'.utf8_encode($importe_profesor).'</td>
                            <td>'.utf8_encode($row->IMPORTE).'</td>
                        </tr>
                        ';   


                        /*
                        $html .= " <tr class='odd gradeX' style='font-weight:bold; vertical-align:bottom'>";   
                            $html .= " <td padding='10' style='padding-left:50px>".utf8_encode($row->PROGRAMA)."</td>";
                            $html .= " <td>".utf8_encode($row->D_DESCRIP)."</td>";
                            $html .= " <td>".utf8_encode($row->C_ROL)."</td>";
                            $html .= " <td>".utf8_encode($row->FECHA_INI)."</td>";
                            $html .= " <td>$".utf8_encode($importe_profesor)."</td>";
                            $html .= " <td>$".utf8_encode($row->IMPORTE)."</td>";
                        $html .= " </tr>";*/

                    endforeach;

            $html .= '
                        <tr>
                            <td colspan="4">TOTAL CURSOS</td>
                            <td>$'.$total_acordado_coordinador.'</td>
                            <td></td>
                        </tr>
                   ';   
            $html .= '
                        <tr>
                            <td colspan="4">DIFERENCIA CON CONTRATO </td>
                            <td>$'.($total_acordado_coordinador-($contrato_profesor->N_PUNTOS*$valor_punto)).'</td>
                            <td></td>
                        </tr>
                   ';
               $html .= '
                        <tr>
                            <td colspan="4">ADICIONALES A PAGAR:</td>
                            <td></td>
                            <td>$'.$total_a_pagar.'</td>
                        </tr>
                   ';


    $html .= "      ";
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



}

/* End of file  */
/* Location: ./application/controllers/ */