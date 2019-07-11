<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('calcular_puntos'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function calcular_puntos($c_identificacion, $c_tipo_clase, $rol, $profesor_full, $c_orientacion )
    {
 		$puntos=0;
    	$punto=16950;

        if ( $c_identificacion == 1 )
    	{
    		if ( utf8_encode ($c_tipo_clase) == "Teórica" )
    		{
    			$puntos = 1.5; // grado teorica	
    		}
    		else
    		{
    			if ($profesor_full)
    			{
    				$puntos = 0.5; // grado practica
    			}
    			else
    			{
    				$puntos = 0.439; // grado practica
    			}	
    		}
    	}
    	else
    	{
    		// Iden = 4 , es por el MEP que se da en conjunto con el ITBA

    		if ( $c_identificacion == 2 or $c_identificacion == 4 )
			{
                 if($rol== "Ayudante") 
   				{
					$puntos = 0.2017; 
				}
    			elseif ($rol== "Profesor Titular")
				{
					$puntos = 1; 
				}
			}
    		
    		//MAF
    		if ( $c_identificacion == 2 and $c_orientacion == 3 )
    		{
    			$puntos =0.5;
    		}	
    	}

		$redondeado= round($puntos*$punto/10);
		$puntos=$redondeado*10/$punto;
		return $puntos;	

		// Los PE y PAC estan en tesoreria, pero se cambiaron por clases.
    		
    }
}


//si no existe la función invierte_date_time la creamos
if(!function_exists('esta_logueado'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function esta_logueado()
    {
        $CI =& get_instance();

        if(!$CI->session->userdata('usuario_tesoreria'))
            redirect(base_url()."index.php/login/logout");
            
    }
}

if(!function_exists('mostrar_cursos'))
{
    
    function mostrar_cursos($cursos_asignados,$periodo,$c_identificacion)
    {
        $anio_anterior = 0;
        get_instance()->load->helper('general_helper');
        $CI = get_instance();
        $CI->load->model('Programas_model');
        $total_sueldo_periodo = 0;
        $total_sueldo_anio = 0; 
        $total_default_anio = 0; 
        $contador_formularios = 0;
        $nombre_formulario = "";
        $n_cantidad = 1; // Usada para posicionar el body luego de recargar.

        foreach ($cursos_asignados->result() as $curso) : 

            if($curso->N_PERIODO == $periodo || $c_identificacion == 3 ): // Trimestre, Semestre  O SI ES PROGRAMA EJ. O PAC

                // Si es PE o PAC muestro la descripcion, sino la sigla
                if($c_identificacion == 3)      
                    $materia=utf8_encode($curso->MATERIA);
                else
                    $materia=utf8_encode($curso->D_DESCRIP);

                $id_materia = $curso->N_ID_MATERIA;
                $id_profesor = $curso->N_ID_PERSONA;
                $id_curso = $curso->N_CURSO;

                $anio_lectivo = $curso->ANIO_LECTIVO;
                $id_horario = $curso->N_ID_HORARIO;
                $rol = $curso->C_ROL;
                $tipo_clase =  $curso->C_TIPO_CLASE;
                $puntos = 0;
                $cantidad_comentarios = 0;
                $confirmado = 0;
                $clase_sueldo_cambiado = '';

                $c_identificacion = $curso->C_IDENTIFICACION;
                $c_programa  = $curso->C_PROGRAMA;
                $c_orientacion  = $curso->C_ORIENTACION;
                
                // Traigo los puntos y el sueldo default               
                $sueldo =  $CI->Programas_model->traer_importe_default($rol,$tipo_clase,$c_identificacion, $id_materia, $c_programa, $c_orientacion, $id_profesor, $anio_lectivo, $id_curso, $id_horario );
                
                // Si es PAC o PE traigo las clases
                if($c_identificacion == 3)
                    $clases =  $CI->Programas_model->traer_clases_pejypac($c_identificacion , $id_curso , $id_profesor, $anio_lectivo, $id_horario);  


                $vector_importe = explode("|", $sueldo);
                $total_default_anio = $vector_importe[0]; // Almaceno el acumulado DEFAULT

                if($c_identificacion != 3): // Calcula los puntos 
                    
                    if( isset($vector_importe[1]) &&  $vector_importe[1] != "" )
                        $puntos = $vector_importe[1]; 
                    else
                        $puntos = "0";

                endif;
         
                if(isset($curso->N_IMPORTE_PROFESOR) && $curso->N_IMPORTE_PROFESOR!= ""): // TIENE EL IMPORTE DEL PROFESOR
                    
                    $sueldo = $curso->N_IMPORTE_PROFESOR;
                    $clase_sueldo_cambiado =  'color:red;';
                     
                else:   // NO TIENE EL IMPORTE DEL PROFESOR
                    
                    $sueldo = $vector_importe[0];
                    /*
                    if($c_identificacion == 3):
                        $sueldo = $vector_importe[0];// * $clases;
                    else:
                        $sueldo = $vector_importe[0];
                    endif;*/
               
                endif;

                $total_sueldo_anio +=  $sueldo; // Acumulado del año.
                $total_sueldo_periodo +=  $sueldo; // Acumulado del periodo.

                
                if(isset($curso->C_OBS) && $curso->C_OBS!= "")
                {
                    $cantidad_comentarios = substr_count($curso->C_OBS, '|'); 
                    $comentarios = rawurlencode($curso->C_OBS);
                }
                else
                    $comentarios = rawurlencode("Sin comentarios"); 

                $fulltime = $CI->Programas_model->profesor_fulltime($curso->N_ID_PERSONA);

                $rol = rawurlencode($curso->C_ROL);
                $nombre=utf8_encode($curso->NOMBRE);
                
                if($curso->ANIO != $anio_anterior ): // Cambia de Año ?>
                    
                    <?php  if($anio_anterior!=0): ?>
                    
                                </tbody>
                                
                                <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles')) || in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                                
                                        <tfoot >
                                            <tr style="background-color:#E6E6E6; border:1px solid #BDBDBD;">
                                                <td> <strong>Totales:</strong> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <?php if(in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                                                        <strong>$<?=$total_sueldo_anio-$sueldo?></strong>                                                    
                                                    <?php endif;?>

                                                    <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                                                        <button type="submit" value="confirmar_default" name="confirmar_default" value="confirmar_default" class="btn btn-danger btn-xs submit">
                                                                Confirmar
                                                        </button>                                              
                                                    <?php endif;?>
                                                </td>   
                                                <td>
                                                     <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                                                        <button type="submit" value="confirmar_coordinadores" name="confirmar_coordinadores" value="confirmar_coordinadores" class="btn btn-danger btn-xs submit">
                                                                Confirmar
                                                        </button>                                              
                                                    <?php endif;?>

                                                </td>
                                                <td>
                                                    <?php if(in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                                                        <button type="submit" value="submit_confirmar_cursos" name="<?=$nombre_formulario?>" value="confirmar_cursos_chequeados" class="btn btn-danger btn-xs submit">
                                                                Confirmar
                                                        </button>
                                                    <?php endif;?>
                                                </td>

                                                <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                                                    <td></td>
                                                    <td></td>                                        
                                                <?php endif;?>

                                            </tr>
                                        </tfoot> 
                                <?php endif;?>
 
                        </table> <!-- Cierro tabla anterior -->
                        </form>

                    <?php   $total_sueldo_anio = $sueldo; // Reinicio el anio 

                       endif;?>

                     <div class='label label-default' style='margin:5px; float:left; background-color:#0080FF'> Año: <?=$curso->ANIO?> </div>
                     
                    
                    <?php 
                        $nombre_formulario = "confirmar_cursos_".$periodo."_".$contador_formularios;
                        $nombre_error = "error_".$nombre_formulario;
                        $contador_formularios++;
                    ?>
                        
                    
                    <!-- FORMULARIO DEL COORDINADOR -->
                    <?php  if(in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                        <form id="<?=$nombre_formulario?>"  name="<?=$nombre_formulario?>" method="post" class="form_confirmar_coordinador" action="<?=base_url()?>index.php/programa/procesa_confirmar_cursos_check" >
                    <?php  endif; ?>

                    <!-- FORMULARIO DE TESORERIA -->
                    <?php  if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                        <form id="<?=$nombre_formulario?>"  name="<?=$nombre_formulario?>" method="post" class="form_confirmar_coordinador" action="<?=base_url()?>index.php/profesor/procesa_editar_importes_check/" >
                    <?php  endif; ?>

                        <input type="hidden" name="c_identificacion" id="c_identificacion" value="<?=$c_identificacion?>">
                        <input type="hidden" name="c_programa" id="c_programa" value="<?=$c_programa?>">
                        <input type="hidden" name="c_orientacion" id="c_orientacion" value="<?=$c_orientacion?>">

                    <table style='font-size:12px' class="table table-responsive dataTables-example">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Comision</th>
                                <th>Horario</th>
                                <th>Profesor</th>
                                <th>Rol</th>
                                <th>Clase</th>

                                <?php  if(in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>

                                    <?php if($c_identificacion == 3):?>
                                        <th>Clases</th>    
                                    <?php else:?>
                                        <th>Puntos</th>    
                                    <?php endif;?>
                                    
                                    <th>Importe</th>
                                    <th>Comentarios</th>                                
                                    <th>Acciones <input name="check_all_confirm" id="check_all_confirm" class="check_all_confirm" type="checkbox"> </th>
                                <?php  endif; ?>

                                <?php  if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                                    
                                    <?php if($c_identificacion == 3):?>
                                        <th>Cls</th>    
                                    <?php else:?>
                                        <th>Pts</th>    
                                    <?php endif;?>

                                    <th>($) Defa. <input name="check_all_default_tesoreria" id="check_all_default_tesoreria" class="check_all_default_tesoreria" type="checkbox"></th> 
                                    <th>($) Coord. <input name="check_all_coordinador_tesoreria" id="check_all_coordinador_tesoreria" class="check_all_coordinador_tesoreria" type="checkbox"></th> </th> 
                                    <th>($) Teso.</th> 
                                    <th>Comen.</th>                                
                                    <th>F.Inicio</th>                                

                                <?php  endif; ?>


                            </tr>
                        </thead>
                        <tbody>

                <?php      
                endif; 
                
                $anio_anterior = $curso->ANIO ;  

                if($curso->C_CONFIRMADO)
                    $tr_panel = 'success';
                else
                    $tr_panel = 'info';

                ?>
                    <tr id="curso_<?=$n_cantidad?>" class="<?=$tr_panel?>">
                        <?php 
                           //if( strlen($curso->TURNOS)-2 == strripos($curso->TURNOS,"y") )
                           $horario = $curso->TURNOS;

                           if( $horario[strlen($horario)-2] == 'y')
                                $horario = str_replace("y", " ", $horario );

                            //echo $horario[strlen($horario)-2];

                        ?>
                        <td style='width:190px; padding:5px; border-right:1px solid #9FC5CC;'><?=$materia." - ".$curso->N_CURSO;?> </td> <?php  //[MODIFICAR]: quitar id curso ?>
                        <td style='width: 50px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->COMISION);?></td>
                        <td style='width: 70px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode(str_replace("y", " ", $horario ));?></td>
                        <td style='width:150px; padding:5px; border-right:1px solid #9FC5CC;'><?=$nombre." - ".$id_profesor?></td> <?php  //[MODIFICAR]: quitar id profesor ?>
                        <td style='width:70px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->C_ROL);?></td>
                        <td style='width:70px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->C_TIPO_CLASE);?></td>

                     
                     <!-- PUNTOS, SUELDO , COMENTARIOS Y EDITAR DEL COORDINADOR -->

                    <?php   if(in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>

                            <?php if($c_identificacion == 3):?>
                                <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC;' ><?=$clases?> <span class="label label-default">clases</span> </td>    
                            <?php endif;?>
                             
                            <?php if($c_identificacion != 3):?>   
                                <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC;' > <?=$puntos?> <br><span class="label label-default">puntos</span></td>
                            <?php endif;?>
                            
                            <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC; <?=$clase_sueldo_cambiado?> ' ><?='$'.$sueldo?></td>

                            <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC;'>

                                    <?php   
                                        $datos_modal_comentarios =  array();

                                        $datos_modal_comentarios['id_materia'] = $id_materia;
                                        $datos_modal_comentarios['id_profesor'] = $id_profesor;
                                        $datos_modal_comentarios['id_curso'] = $id_curso;
                                        $datos_modal_comentarios['anio_lectivo'] = $anio_lectivo;
                                        $datos_modal_comentarios['puntos'] = $puntos;
                                        $datos_modal_comentarios['id_horario'] = $id_horario;
                                        $datos_modal_comentarios['rol'] = urldecode($rol);
                                        $datos_modal_comentarios['sueldo'] =$sueldo;
                                        $datos_modal_comentarios['c_identificacion'] = $c_identificacion;
                                        $datos_modal_comentarios['c_programa'] = $c_programa;
                                        $datos_modal_comentarios['c_orientacion'] = $c_orientacion;
                                        $datos_modal_comentarios['n_fila_curso'] = $n_cantidad; 
                                        
                                        $comentarios_modificados = rawurldecode($comentarios);
                                        $comentarios_modificados = str_replace("\"", "*", $comentarios_modificados);
                                        $comentarios_modificados = str_replace("-", "%", $comentarios_modificados);

                                        $datos_modal_comentarios['comentarios'] = $comentarios_modificados;

                                        $datos_comentarios_enviar = json_encode($datos_modal_comentarios);
                                        $datos_comentarios_enviar = str_replace("\"", "-", $datos_comentarios_enviar);
                                        
                                    ?>
                                  
                                    
                                    <?php   if(isset($comentarios)&& $comentarios != " ") : ?>
                                    
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#comentarioModal" data-whatever="<?=$datos_comentarios_enviar?>"> <i  data-toggle="tooltip" data-placement="top" title="Ver comentarios" class="fa fa-comment fa-2x"></i>
                                   
                                         <?php  echo "(".$cantidad_comentarios.")";?>                                     
                                        
                                        </button>

                               <?php   endif;  ?>   

                                <?php /* // Aca se enviaba la informacion por GET y se cambio por falta de portabilidad 
                                            
                                    if(isset($comentarios)&& $comentarios != " ") : ?>
                                    
                                    <a style="width:70px;"  data-toggle="ajaxModalHistorial" href="<?=base_url()?>index.php/programa/historial_curso/<?=$comentarios?>/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>" ><i  data-toggle="tooltip" data-placement="top" title="Ver comentarios" class="fa fa-comment fa-2x"></i>

                                         <?php  echo "(".$cantidad_comentarios.")";?>                                     
                                    </a>
                               <?php   endif; */ ?>                                                                                                                    
                            </td>
                            <td style='width:70px; padding:5px; '>  <!-- EDITAR, CONFIRMAR o CONFIRMADO -->
                                
                                <?php   if($curso->C_CONFIRMADO): ?>

                                        <i   data-toggle="tooltip" data-placement="left" title="Curso confirmado" class="fa fa-check-square-o fa-2x"></i> 
                                        <!-- <a id='desconfirmar[]' class="desconfirmar" data-toggle="tooltip" data-toggle="tooltip" data-placement="right" title="Desconfirmar el curso"  href="<?=base_url()?>index.php/programa/desconfirmar_curso/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>/<?=$n_cantidad?>" ><i class="fa fa-undo fa-2x"  style="margin-left:5px; color:#FA5858;"></i></a> -->
                                        <a href="#" data-toggle="tooltip" data-toggle="tooltip" data-placement="right" title="Desconfirmar el curso" ><i onclick="desconfirmarCurso(<?=$id_curso?>,<?=$anio_lectivo?>,<?=$id_horario?>,<?=$id_profesor?>,'<?=urldecode($rol)?>',<?=$c_identificacion?>,<?=$c_programa?>,<?=$c_orientacion?>,<?=$n_cantidad?> )" class="fa fa-undo fa-2x"  style="margin-left:5px; color:#FA5858;"></i></a>
                                        

                               <?php    else: 
                                        $row_datos_coordinador['id_materia'] = $id_materia;
                                        $row_datos_coordinador['nombre_materia'] = $materia;
                                        $row_datos_coordinador['id_profesor'] = $id_profesor;
                                        $row_datos_coordinador['nombre_profesor'] = $nombre;
                                        $row_datos_coordinador['id_curso'] = $id_curso;
                                        $row_datos_coordinador['anio_lectivo'] = $anio_lectivo;
                                        $row_datos_coordinador['puntos'] = $puntos;
                                        $row_datos_coordinador['id_horario'] = $id_horario;
                                        $row_datos_coordinador['rol'] = urldecode($rol);
                                        $row_datos_coordinador['sueldo'] =$sueldo;
                                        $row_datos_coordinador['c_identificacion'] = $c_identificacion;
                                        $row_datos_coordinador['c_programa'] = $c_programa;
                                        $row_datos_coordinador['c_orientacion'] = $c_orientacion;
                                        $row_datos_coordinador['n_fila_curso'] = $n_cantidad;

                                        $datos_enviar_coordinador = $datos_enviar_coordinador2  = json_encode($row_datos_coordinador);
                                        $datos_enviar_coordinador = str_replace("\"", "*", $datos_enviar_coordinador);

                               ?>
                                        <input class="check_confirma_coordinador" name="check_confirma_coordinador[]" id="check_confirma_coordinador" type="checkbox" value="<?php  echo $datos_enviar_coordinador; ?>"> 
                                        

                                        <!--- // Se enviaba por GET y se cambio por portabilidad 
                                            <div data-toggle="tooltip" data-placement="top" title="Confirmar informacion del curso" style='width:70px; margin-bottom:5px; float:left;'><a style='width:70px;' id='confirmar[]' class="btn btn-success btn-xs" href="<?=base_url()?>index.php/programa/confirmar_curso/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>/<?=$n_cantidad?>" >Confirmar</a></div>                -->
                                        
<!--                                         <button type="button" class="btn btn-sucess btn-xs" onclick="confirmarCurso(<?=$id_curso?>,<?=$anio_lectivo?>,<?=$puntos?>,<?=$id_horario?>,<?=urldecode($rol)?>,<?=$sueldo?>,<?=$c_identificacion?>,<?=$c_programa?>,<?=$c_orientacion?>,<?=$n_cantidad?>)" > Confirmar </button>
 -->                                     
                                        <div data-toggle="tooltip" data-placement="top" title="Confirmar informacion del curso" style='width:70px; margin-bottom:5px; float:left;'>   
                                            <button type="button" class="btn btn-success btn-xs" onclick="confirmarCurso(<?=$id_curso?>,<?=$anio_lectivo?>,<?=$id_horario?>,<?=$id_profesor?>,'<?=urldecode($rol)?>',<?=$c_identificacion?>,<?=$c_programa?>,<?=$c_orientacion?>,<?=$n_cantidad?> )" > Confirmar 2</button>
                                        </div>
                                        
                                        <div data-toggle="tooltip" data-placement="bottom" title="Editar el importe" style='width:70px; float:left;'>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" style='width:70px; margin-bottom:5px; float:left;' data-target="#editarModal" data-whatever="<?=$datos_enviar_coordinador?>"> Editar </button>
                                        </div>
                                        
                                        
                                        <!-- // Se enviaba por GET y se cambio por portabilidad 
                                            <div data-toggle="tooltip" data-placement="bottom" title="Editar el importe" style='width:70px; float:left;'><a style="width:70px;" class="btn btn-primary btn-xs" data-toggle="ajaxModal"  href="<?=base_url()?>index.php/programa/editar_programa/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>" >Editar</a></div>    
                                        -->

                                <?php   endif; ?>
                                   
                            </td>       

                    <?php  endif; ?>
                    
                     <!-- PUNTOS DEFAULT $coord, $tesoreria -->

                    <?php   if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                        
                            <?php if($c_identificacion == 3):?>
                                <td style='padding:5px; border-right:1px solid #9FC5CC;' ><?=$clases?></td>
                            <?php else:?>
                                <td style='padding:5px; border-right:1px solid #9FC5CC;' ><?=round($puntos, 2);?></td>   
                            <?php endif;?>
                            

                            <?php 
                                $row_datos_coordinador['id_materia'] = $id_materia;
                                $row_datos_coordinador['id_profesor'] = $id_profesor;
                                $row_datos_coordinador['id_curso'] = $id_curso;
                                $row_datos_coordinador['anio_lectivo'] = $anio_lectivo;
                                $row_datos_coordinador['puntos'] = $puntos;
                                $row_datos_coordinador['id_horario'] = $id_horario;
                                $row_datos_coordinador['rol'] = $rol;
                                $row_datos_coordinador['c_identificacion'] = $c_identificacion;
                                $row_datos_coordinador['c_programa'] = $c_programa;
                                $row_datos_coordinador['c_orientacion'] = $c_orientacion;
                                $row_datos_coordinador['n_fila_curso'] = $n_cantidad;

                            ?>

                            <td style='padding:5px; border-right:1px solid #9FC5CC;  text-align:center'> <!-- MUESTRO EL DEFAULT -->
                            <?php   

                                    if($c_identificacion == 3):
                                        $row_datos_coordinador['sueldo'] = $vector_importe[0];// * $clases;
                                    else:
                                        $row_datos_coordinador['sueldo'] = $vector_importe[0];
                                    endif;

                               
                                $datos_enviar_coordinador = json_encode($row_datos_coordinador);
                                $datos_enviar_coordinador = str_replace("\"", "-", $datos_enviar_coordinador);


                                echo round($row_datos_coordinador['sueldo'],1);

                            ?>
                                <?php   if( strtotime(date('d-M-y')) < strtotime($curso->F_INICIO) ): ?>
                                
                                    <input class="check_importe_default" name="check_importe_default[]" id="check_importe_default" type="checkbox" value="<?php  echo $datos_enviar_coordinador; ?>" > 
                                
                                <?php  endif; ?>

                            </td>
                                

                            <td style='padding:5px; border-right:1px solid #9FC5CC;  text-align:center'>
                            <?php    
                                $row_datos_tesoreria['id_materia'] = $id_materia;
                                $row_datos_tesoreria['nombre_materia'] = $materia;
                                $row_datos_tesoreria['id_profesor'] = $id_profesor;
                                $row_datos_tesoreria['nombre_profesor'] = $nombre;
                                $row_datos_tesoreria['id_curso'] = $id_curso;
                                $row_datos_tesoreria['anio_lectivo'] = $anio_lectivo;
                                $row_datos_tesoreria['puntos'] = $puntos;
                                $row_datos_tesoreria['id_horario'] = $id_horario;
                                $row_datos_tesoreria['rol'] = urldecode($rol);
                                $row_datos_tesoreria['sueldo'] =$sueldo;
                                $row_datos_tesoreria['c_identificacion'] = $c_identificacion;
                                $row_datos_tesoreria['c_programa'] = $c_programa;
                                $row_datos_tesoreria['c_orientacion'] = $c_orientacion;
                                $row_datos_tesoreria['n_fila_curso'] = $n_cantidad;

                                $datos_enviar_tesoreria = $datos_enviar_coordinador2  = json_encode($row_datos_tesoreria);
                                $datos_enviar_tesoreria = str_replace("\"", "*", $datos_enviar_tesoreria); ?>

                                <div data-toggle="tooltip" data-placement="bottom" title="Editar el importe del coordinador" style='width:70px; float:left;'>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" style='width:70px; margin-bottom:5px; float:left;' data-target="#editarModal" data-whatever="<?=$datos_enviar_tesoreria?>"> Editar </button>
                                </div>
        
                               <!-- <div data-toggle="tooltip" data-placement="bottom" title="Editar el importe" style='width:70px; float:left;'><a style="width:70px;" class="btn btn-warning btn-xs" data-toggle="ajaxModal"  href="<?=base_url()?>index.php/programa/editar_programa/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>" >Editar</a></div>    -->
                            
                            <?php 
                                $row_datos_coordinador['sueldo'] = $curso->N_IMPORTE_PROFESOR;
                                $datos_enviar_coordinador = json_encode($row_datos_coordinador);
                                $datos_enviar_coordinador = str_replace("\"", "-", $datos_enviar_coordinador);

                                // Si aun no comenzo el curso y tiene seteado el IMPORTE PROFESOR
                                if($curso->N_IMPORTE_PROFESOR && strtotime(date('d-M-y')) < strtotime($curso->F_INICIO)     ):  ?>
    
                                    <input class="check_importe_coordinador" name="check_importe_coordinador[]" id="check_importe_coordinador" type="checkbox" value="<?php  echo $datos_enviar_coordinador; ?>" > 
                                    
                            <?php   endif;


                                echo $curso->N_IMPORTE_PROFESOR;
                            ?>
                                
                            </td>
                            <td style='padding:5px; border-right:1px solid #9FC5CC; color:red; background-color:#E6E6E6; font-weight:bold; text-align:center' class="danger">
                                    <?=$curso->IMPORTE?>

                                    <?php   if( strtotime(date('d-M-y')) < strtotime($curso->F_INICIO) ): 
                                            $row_datos_coordinador['sueldo'] = $curso->IMPORTE;
                                            $datos_enviar_coordinador = json_encode($row_datos_coordinador);
                                            $datos_enviar_coordinador = str_replace("\"", "-", $datos_enviar_coordinador);

                                        ?>
                                            
                                            <div data-toggle="tooltip" data-placement="bottom" title="Editar el importe a PAGAR " style='width:70px; float:left;'>
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" style='width:70px; margin-bottom:5px; float:left;' data-target="#importeTesoreriaModal" data-whatever="<?=$datos_enviar_tesoreria?>"> Editar </button>
                                            </div>
                                            <!-- <div data-toggle="tooltip" data-placement="bottom" title="Editar el importe" style='width:70px; padding-top:10px; float:left;'><a style="width:70px;" class="btn btn-primary btn-xs" data-toggle="ajaxModal"  href="<?=base_url()?>index.php/profesor/editar_importe_tesoreria/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/" >Editar</a></div>    -->
                                    
                                    <?php   endif; ?>
                            </td>


                            <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC;'>

                                    <?php   
                                        $datos_modal_comentarios =  array();

                                        $datos_modal_comentarios['id_materia'] = $id_materia;
                                        $datos_modal_comentarios['id_profesor'] = $id_profesor;
                                        $datos_modal_comentarios['id_curso'] = $id_curso;
                                        $datos_modal_comentarios['anio_lectivo'] = $anio_lectivo;
                                        $datos_modal_comentarios['puntos'] = $puntos;
                                        $datos_modal_comentarios['id_horario'] = $id_horario;
                                        $datos_modal_comentarios['rol'] = urldecode($rol);
                                        $datos_modal_comentarios['sueldo'] =$sueldo;
                                        $datos_modal_comentarios['c_identificacion'] = $c_identificacion;
                                        $datos_modal_comentarios['c_programa'] = $c_programa;
                                        $datos_modal_comentarios['c_orientacion'] = $c_orientacion;
                                        $datos_modal_comentarios['n_fila_curso'] = $n_cantidad; 
                                        
                                        $comentarios_modificados = rawurldecode($comentarios);
                                        $comentarios_modificados = str_replace("\"", "*", $comentarios_modificados);
                                        $comentarios_modificados = str_replace("-", "%", $comentarios_modificados);

                                        $datos_modal_comentarios['comentarios'] = $comentarios_modificados;

                                        $datos_comentarios_enviar = json_encode($datos_modal_comentarios);
                                        $datos_comentarios_enviar = str_replace("\"", "-", $datos_comentarios_enviar);
                                        
                                    ?>
                                  
                                    
                                    <?php   if(isset($comentarios)&& $comentarios != " ") : ?>
                                    
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#comentarioModal" data-whatever="<?=$datos_comentarios_enviar?>"> <i  data-toggle="tooltip" data-placement="top" title="Ver comentarios" class="fa fa-comment fa-2x"></i>
                                   
                                         <?php  echo "(".$cantidad_comentarios.")";?>                                     
                                        
                                        </button>

                               <?php   endif;  ?>   

                                <?php /* // Aca se enviaba la informacion por GET y se cambio por falta de portabilidad 
                                            
                                    if(isset($comentarios)&& $comentarios != " ") : ?>
                                    
                                    <a style="width:70px;"  data-toggle="ajaxModalHistorial" href="<?=base_url()?>index.php/programa/historial_curso/<?=$comentarios?>/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>" ><i  data-toggle="tooltip" data-placement="top" title="Ver comentarios" class="fa fa-comment fa-2x"></i>

                                         <?php  echo "(".$cantidad_comentarios.")";?>                                     
                                    </a>
                               <?php   endif; */ ?>                                                                                                                    
                            </td>      


                            <td style='padding:5px; border-right:1px solid #9FC5CC;'><?=$curso->F_INICIO?></td>       

                    <?php  endif; ?>   
                       
                </tr>

                <?php  

            endif;

            $n_cantidad++;

        endforeach; ?>
                    

        <?php if($anio_anterior):?>
            <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles')) || in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                </tbody>
                       <tfoot >
                        <tr style="background-color:#E6E6E6; border:1px solid #BDBDBD;">
                            <td> <strong>Totales:</strong> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <?php if(in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                                    <strong>$<?=$total_sueldo_anio?></strong>                                                    
                                <?php endif;?>

                                <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                                    <button type="submit" value="confirmar_default" name="confirmar_default" value="confirmar_default" class="btn btn-danger btn-xs submit">
                                            Confirmar
                                    </button>                                              
                                <?php endif;?>
                            </td>   
                            <td>

                                 <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                                    <button type="submit" value="confirmar_coordinadores" name="confirmar_coordinadores" value="confirmar_coordinadores" class="btn btn-danger btn-xs submit">
                                            Confirmar
                                    </button>                                              
                                <?php endif;?>

                            </td>
                            <td>
                                <?php if(in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                                    <button type="submit" value="submit_confirmar_cursos" name="<?=$nombre_formulario?>" value="confirmar_cursos_chequeados" class="btn btn-danger btn-xs submit">
                                            Confirmar
                                    </button>
                                <?php endif;?>
                            </td>

                            <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles'))): ?>
                                <td></td>
                                <td></td>                                        
                            <?php endif;?>

                        </tr>
                    </tfoot> 
                </table>
                </form>
            <?php endif;?>
        <?php endif;?>
        
        <table>
                <tr class="danger">
                    <?php if(in_array('ROLE_TESORERIA',$CI->session->userdata('roles')) || in_array('ROLE_COORDINADOR',$CI->session->userdata('roles'))): ?>
                        <td colspan="1"> <strong>Totales:</strong> </td>
                        <td colspan="5"> &nbsp; </td>
                        <td>  </td>
                        <td> <strong>$<?=$total_sueldo_periodo;?></strong> </td>
                        <td>  </td>
                    <?php endif;?>
                </tr>
        </table> 

        

    <?php 
    }
}


if(!function_exists('export_to_xls'))
{ 

    function export_to_xls($query, $file = 'export')
    {

        $headers = ''; // just creating the var for field headers to append to below
        $data = ''; // just creating the var for field data to append to below

        $fields = $query->field_data();
        #var_dump($fields);
        if ($query->num_rows() == 0) 
        {
            echo '<p>La tabla al parecer no contiene datos.</p>';
        }
        else 
        {
            foreach ($fields as $field) 
            {
                $headers .= $field->name . "\t";
            }

            foreach ($query->result() as $row) 
            {
                $line = '';
                foreach($row as $value) 
                {
                    if ((!isset($value)) OR ($value == "")) 
                    {
                        $value = "\t";
                    } 
                    else 
                    {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                        $line .= $value;
                }

                $data .= trim($line)."\n";
            }

            $data = str_replace("\r","",$data);

            header("Content-type: application/x-msdownload");
            header("Content-Disposition: attachment; filename=$file.xls");
            echo "$headers\n$data";
        }

    }
}