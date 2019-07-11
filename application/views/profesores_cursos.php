<?php 
echo $vista_head;
$puntos_trabajados = 0;
$clase_trabajadas = 0;
$pagar = 0;
//if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))) echo "Tesoreria";
$CI = &get_instance(); 

?>

<div id="page-wrapper" >

<?php 
if($profesores_cursos->num_rows() > 0):     
    //var_dump($this->session->userdata('roles'));
    ?>
    <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-12 col-lg-12 ">
                <h4>  <i class="fa fa-user"></i>  - <strong> <?=utf8_encode($profesores_cursos->row()->NOMBRE);?> </strong></h4>   
            </div>
    </div>  

    <?php   if(isset($mensaje_exito)): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check"></i> <?=$mensaje_exito?>
            </div>
    <?php       unset($mensaje_exito);
        endif;   ?>

    <?php   if(isset($mensaje_error)): ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-times"></i> <?=$mensaje_error?>
            </div>
    <?php       unset($mensaje_error);
        endif;   ?>

    <div id="page-inner" style="margin:0px; ">
            
        <div class="panel panel-info" >
            <div class="panel-heading" style="padding-bottom:0px">
                    <table class="table table-striped" style="border:none; margin-bottom:0px">
                        <tr>
                            <td><strong>&#8226; Dedicacion:</strong>  <?=utf8_encode($tipo)?>.  </td> 
                            <td> <strong>&#8226; Relacion:</strong>  <?=utf8_encode($contrato_profesor->M_RELACION)?>.</td>
                            <td><strong>&#8226; Legajo N°:</strong>  <?=$legajo->N_LEGAJO?>.  </td>

                        </tr>    
                        <tr>
                            
                            <td><strong>&#8226; Fecha Desde:</strong>  <?=utf8_encode($contrato_profesor->F_DESDE)?>.  </td>
 
                        </tr>     
                    </table>
 
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills"  style="margin-bottom:15px;">
                    <li class="active">
                        <a href="#cursos" data-toggle="tab"> <i class="fa fa-bars"> Cursos</i> </a>
                    </li>
                    <li class="">
                        <a href="#extras" data-toggle="tab"><i class="fa fa-usd"> Extras</i> </a>
                    </li>
                    
                    <?php  if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>

                     <li class="">
                        <a href="#pagar" data-toggle="tab"><i class="fa fa-usd"> A pagar</i> </a>
                    </li>

                    <?php   endif;?>

                    <li style="float:right">
                        <a style="float:right" href="<?php echo base_url(); ?>index.php/profesor_tesoreria/exportar_pdf/<?php  echo $id_profesor; ?>" class="btn btn-danger btn-sm"><i class="fa fa-file"></i> Exportar PDF</a>
                        <a style="float:right; margin-right:5px; margin-bottom:10px;" href="#" class="btn btn-primary btn-sm"><i class="fa fa-print"> Imprimir </i></a>
                    </li>

                </ul>

                
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="cursos">
                          
                            <form name="confirmar" id="confirmar" method="post" action="<?=base_url()?>index.php/profesor/procesa_editar_importes_check/">
                            <div class="table-responsive"  style="margin-top:10px;"> 
                              <table style="font-size:12px" id="dataTables-example" class="table table-hover table-striped" data-toggle="table" data-url="data2.json" data-show-columns="true" data-search="true" data-show-refresh="true" data-show-toggle="true" data-show-export="true" data-pagination="true" data-height="299">
                
                                    <thead>
                                        <tr style=" background-color:#428BCA; color:#fff; vertical-align: text-top; border-top:1px solid #428BCA; border-bottom:1px solid #0B3B0B;  ">
                                            <th style="vertical-align: middle;">Prg</th>
                                            <th>Prg.<br>Comision</th>
                                            <th style="vertical-align: middle;">Materia</th>
                                            <th style="vertical-align: middle;">Clase</th>
                                            <th style="vertical-align: middle;">Rol</th>

                                             <?php  if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>
                                                
                                                <!-- <th style="vertical-align: middle;">¿Conf.?</th> -->
                                                <th style="vertical-align: middle;">Puntos</th>
                                                <th style="vertical-align: middle;">Clases</th>
                                                <th style="vertical-align: middle; text-align:center;">($) Default. <input name="check_all_default" id="check_all_default" type="checkbox"> </th>
                                                <th style="vertical-align: middle; text-align:center;">($) Coord.   <input name="check_all_coordinador" id="check_all_coordinador" type="checkbox"> </th>
                                                <th style="vertical-align: middle;">($) Teso.</th>
                                            
                                            <?php  endif; ?>

                                            <th style="vertical-align: middle;">F. Inicio</th>
                                            <th style="vertical-align: middle;">F. Fin</th>
                                            <th style="vertical-align: middle;">Comen.</th>
                                        </tr>
                                    </thead>    
                                    <tbody>
                                        <?php   
                                            foreach ( $profesores_cursos->result() as $row ):  

                                                $cantidad_comentarios = 0;
                                                $id_materia = $row->N_ID_MATERIA;
                                                $id_profesor = $row->N_ID_PERSONA;
                                                $id_curso = $row->N_CURSO;
                                                $anio_lectivo = $row->ANIO_LECTIVO;
                                                $id_horario = $row->N_ID_HORARIO;
                                                $rol = $row->C_ROL;
                                                $c_programa  = $row->C_PROGRAMA;
                                                $tipo_clase =  $row->C_TIPO_CLASE;

                                                $c_identificacion = $row->C_IDENTIFICACION;
                                                $c_programa  = $row->C_PROGRAMA;
                                                $c_orientacion  = $row->C_ORIENTACION;

                                                //echo $row->C_IDENTIFICACION." - ".$row->C_IDENTIFICACION." - ".$row->C_ORIENTACION."<br>";

                                                $sueldo =  $this->Programas_model->traer_importe_default($rol,$tipo_clase,$c_identificacion, $id_materia, $c_programa, $c_orientacion, $id_profesor, $anio_lectivo, $id_curso, $id_horario );

                                                //echo $sueldo;

                                                if(isset($row->C_OBS) && $row->C_OBS!= "")
                                                {
                                                    $cantidad_comentarios = substr_count($row->C_OBS, '|'); 
                                                    $comentarios = rawurlencode($row->C_OBS);
                                                }
                                                else
                                                    $comentarios = rawurlencode("Sin comentarios");

                                                $rol= rawurlencode($row->C_ROL);
                                                
                                                                
                                                $vector_importe = explode("|", $sueldo);

                                                //echo $vector_importe[0];

                                                if( isset($vector_importe[1]) &&  $vector_importe[1] != "" )
                                                    $puntos = $vector_importe[1]; 
                                                else
                                                    $puntos = "0";

                                                $clase ='';

                                                if(  $row->C_CONFIRMADO )
                                                    $clase ='success';



                                             ?>
                                            <tr class="odd gradeX <?=$clase?>">
                                                <td><?php  echo utf8_encode($row->PROGRAMA2); ?></td>
                                                <td><?php  echo utf8_encode($row->PRGCOMISION); ?></td>
                                                <td><?php  echo utf8_encode($row->D_DESCRED); ?></td>
                                                <td><?php  echo utf8_encode($row->C_TIPO_CLASE); ?></td>
                                                <td><?php  echo utf8_encode($row->C_ROL); ?></td>
                                                
                                                <?php   //___________TESORERIA _____________________________// ?>

                                                <?php  if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>
                                                        
                                                        <td style="text-align:center"> <!-- PUNTOS -->
                                                        <?php 

                                                            if($row->C_IDENTIFICACION !=3)
                                                                echo round($puntos,2);

                                                            $puntos_trabajados += $puntos;

                                                        ?>
                                                        </td>

                                                        <td style="text-align:center"> <!-- CLASES -->
                                                            <?php      
                                                                
                                                                    $resultado = strpos($row->PROGRAMA, "PEj");

                                                                    if($resultado !== FALSE)
                                                                    {
                                                                        $clase = $this->Programas_model->traer_clases_pejypac($row->C_IDENTIFICACION , $id_curso , $id_profesor, $anio_lectivo, $id_horario);
                                                                        echo $clase;
                                                                        $clase_trabajadas += $clase;
                                                                    }

                                                            ?>
                                                        
                                                        </td>
                                                        
                                                        <td style="text-align:center;"> <!-- $ DEFAULT -->
                                                            
                                                            <?php   
                                                                //echo "Defa: ".$vector_importe[0]."<br>";

                                                                if( $vector_importe[0] != 0 ):
                                                                    
                                                                    $row_datos['id_materia'] = $id_materia;
                                                                    $row_datos['id_profesor'] = $id_profesor;
                                                                    $row_datos['id_curso'] = $id_curso;
                                                                    $row_datos['anio_lectivo'] = $anio_lectivo;
                                                                    $row_datos['puntos'] = $puntos;
                                                                    $row_datos['id_horario'] = $id_horario;
                                                                    $row_datos['rol'] = $rol;
                                                                    
                                                                    $row_datos['sueldo'] = $vector_importe[0];
        
                                                                    $datos_enviar = json_encode($row_datos);
                                                                    $datos_enviar = str_replace("\"", "-", $datos_enviar);

                                                                    echo round($row_datos['sueldo'],3);

                                                            ?>  
                                                                    
                                                                    <?php  if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>                   
        
                                                                             <input class="clase_importe_default" name="check_importe_default[]" id="check_importe_default" type="checkbox" value="<?php  echo $datos_enviar;  ?>"> 
                                                                    
                                                                    <?php   endif; ?>      

                                                            
    
                                                            <?php   endif; ?>

                                                                
                                                            <?php   if(!isset($row->IMPORTE) && $vector_importe[0]!=0 ): 

                                                                $sueldo = $vector_importe[0];

                                                                ?> <!-- CONFIRMAR DEFAULT -->
                                                                    <br>
                                                                    <!-- <div data-toggle="tooltip" data-placement="bottom" title="Confirma el importe default" style='width:70px; margin-bottom:3px; float:left;'><a style="width:70px;" class="btn btn-info btn-xs" data-toggle="ajaxModal"  href="<?=base_url()?>index.php/profesor/editar_importe_tesoreria/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=rawurlencode($rol)?>/<?=$sueldo?>"  >Confirmar</a></div>  -->
                                                                    <?php  if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>    

                                                                        <div data-toggle="tooltip" data-placement="top"  title="Confirma el importe default" style='width:70px; margin-bottom:5px; float:left;'>
                                                                                <a style='width:70px;' id='confirmar[]' class="btn btn-info btn-xs" href="<?=base_url()?>index.php/profesor/confirmar_importe/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/" >Confirmar</a>
                                                                        </div>  

                                                                    <?php   endif; ?>  
                                                                
                                                            <?php   endif; ?>

                                                        </td> 

                                                        <td style="text-align:center;"> <!-- $ default -->
                                                            
                                                            <?php   if(isset($row->N_IMPORTE_PROFESOR)):
                                                                      
                                                                    $row_datos_coordinador['id_materia'] = $id_materia;
                                                                    $row_datos_coordinador['id_profesor'] = $id_profesor;
                                                                    $row_datos_coordinador['id_curso'] = $id_curso;
                                                                    $row_datos_coordinador['anio_lectivo'] = $anio_lectivo;
                                                                    $row_datos_coordinador['puntos'] = $puntos;
                                                                    $row_datos_coordinador['id_horario'] = $id_horario;
                                                                    $row_datos_coordinador['rol'] = $rol;
                                                                    $row_datos_coordinador['sueldo'] = $row->N_IMPORTE_PROFESOR;

                                                                    $datos_enviar_coordinador = json_encode($row_datos_coordinador);
                                                                    $datos_enviar_coordinador = str_replace("\"", "-", $datos_enviar_coordinador);

                                                                    //echo $datos_enviar_coordinador;

                                                                    echo "$".$row->N_IMPORTE_PROFESOR; ?>

                                                                    <?php  if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>  
                                                                    
                                                                            <input class="clase_importe_coordinador" name="check_importe_coordinador[]" id="check_importe_coordinador" type="checkbox" value="<?php  echo $datos_enviar_coordinador; ?>"> 
                                                                    
                                                                    <?php   endif; ?>

                                                            <?php   endif; ?>


                                                            <?php   if(!isset($row->IMPORTE) && isset($row->N_IMPORTE_PROFESOR) ): 
                                                                $sueldo = $row->N_IMPORTE_PROFESOR;

                                                                ?> <!-- CONFIRMAR DEFAULT -->
                                                                    <br>
                                                            
                                                                    <?php  if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>    
                                                                    <!-- <div data-toggle="tooltip" data-placement="bottom" title="Confirma el importe del coordinador" style='width:70px; margin-bottom:3px; float:left;'><a style="width:70px;" class="btn btn-info btn-xs" data-toggle="ajaxModal"  href="<?=base_url()?>index.php/profesor/editar_importe_tesoreria/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=rawurlencode($rol)?>/<?=$sueldo?>"  >Confirmar</a></div>  -->
                                                                        
                                                                        <div data-toggle="tooltip" data-placement="top"  title="Confirma el importe del coordinador" style='width:70px; margin-bottom:5px; float:left;'><a style='width:70px;' id='confirmar[]' class="btn btn-info btn-xs" href="<?=base_url()?>index.php/profesor/confirmar_importe/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/" >Confirmar</a></div>  
                                                                    
                                                                    <?php   endif; ?>
                                                            
                                                            <?php   endif; ?>

                                                        </td> 

                                                        <td class="info" style="text-align:center;">   
                                                             <?php   if(isset($row->IMPORTE)):  // IMPORTE SETEADO POR TESORERIA  ?>

                                                            <span style="font-weight:bold; color:red;"> $<?php  echo utf8_encode($row->IMPORTE); ?></span><br>
                                                             
                                                             <?php   endif;   ?>
        
                                                            <?php  //if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ):   
                                                                    
                                                                    $row_datos_coordinador['id_materia'] = $id_materia;
                                                                    $row_datos_coordinador['id_profesor'] = $id_profesor;
                                                                    $row_datos_coordinador['id_curso'] = $id_curso;
                                                                    $row_datos_coordinador['anio_lectivo'] = $anio_lectivo;
                                                                    $row_datos_coordinador['puntos'] = $puntos;
                                                                    $row_datos_coordinador['id_horario'] = $id_horario;
                                                                    $row_datos_coordinador['rol'] = $rol;
                                                                    $row_datos_coordinador['sueldo'] = $row->N_IMPORTE_PROFESOR;
                                                                    $row_datos_coordinador['c_identificacion'] = $row->C_IDENTIFICACION;
                                                                    $row_datos_coordinador['c_programa'] = $row->C_PROGRAMA;
                                                                    $row_datos_coordinador['c_orientacion'] = $row->C_ORIENTACION;
                                                                    $row_datos_coordinador['n_fila_curso'] = 0;

                                                                    $datos_enviar_tesoreria = json_encode($row_datos_coordinador);
                                                                    $datos_enviar_tesoreria = str_replace("\"", "-", $datos_enviar_tesoreria);?>

                                                                    <!-- <div data-toggle="tooltip" data-placement="bottom" title="Editar el importe" style='width:70px; float:center;'><a style="width:70px;" class="btn btn-primary btn-xs" data-toggle="ajaxModal"  href="<?=base_url()?>index.php/profesor/editar_importe_tesoreria/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/" >Editar</a></div>    -->
                                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" style='width:70px; margin-bottom:5px; float:left;' data-target="#importeTesoreriaModal" data-whatever="<?=$datos_enviar_tesoreria?>"> Editar </button>
                                                            
                                                            <?php  //endif;   ?>

                                                        </td>

                                                <?php  endif; ?>

                                                <td><?php  echo utf8_encode($row->FECHA_INI); ?></td>
                                                
                                                <td><?php  echo utf8_encode($row->FECHA_FIN); ?></td>                                                   

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
                                                            $datos_modal_comentarios['n_fila_curso'] = 0; 
                                                            
                                                            $comentarios_modificados = rawurldecode($comentarios);
                                                            $comentarios_modificados = str_replace("\"", "*", $comentarios_modificados);
                                                            $comentarios_modificados = str_replace("-", "%", $comentarios_modificados);

                                                            $datos_modal_comentarios['comentarios'] = $comentarios_modificados;

                                                            $datos_comentarios_enviar = json_encode($datos_modal_comentarios);
                                                            $datos_comentarios_enviar = str_replace("\"", "-", $datos_comentarios_enviar);
                                                            
                                                        ?>
                                                      
                                                        
                                                        <?php   if(isset($comentarios)&& $comentarios != " ") : ?>
                                                        
                                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="<?=$datos_comentarios_enviar?>"> <i  data-toggle="tooltip" data-placement="top" title="Ver comentarios" class="fa fa-comment fa-2x"></i>
                                                       
                                                             <?php  echo "(".$cantidad_comentarios.")";?>                                     
                                                            
                                                            </button>

                                                   <?php   endif;  ?>   
                                                                                                                
                                                </td>     

                                                    <?php /*  if(isset($comentarios)&& $comentarios != " ") : 

                                                            // Esta harcodeado por que lo pide la funcion, pero el SUELDO NO SE USA.
                                                            // [CAMBIAR]
                                                            $sueldo = 0;
                                                    ?>
                                                            <a style="width:70px;"  data-toggle="ajaxModalHistorial" href="<?=base_url()?>index.php/programa/historial_curso/<?=$comentarios?>/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>" ><i  data-toggle="tooltip" data-placement="top" title="Ver comentarios" class="fa fa-comment fa-2x"></i>
                                                            <?php  echo "(".$cantidad_comentarios.")";?>
                                                                

                                                              </a>
                                                    <?php   endif; */?>                                                                                                                    
                                                </td>
                                            </tr>
                                        <?php   endforeach; ?>

                                        <!-- FILA FINAL CON CONFIRMAR POR COLUMNA -->
                                        <tr class="warning" style="color:#0B3B0B; vertical-align: text-top; border-top:1px solid #0B3B0B; border-bottom:1px solid #0B3B0B;  ">
                                            

                                            <!--th style="vertical-align: middle;"></th><th></th><th style="vertical-align: middle;"></th> <th style="vertical-align: middle;"></th><th style="vertical-align: middle;"></th>-->
                                            
                                            <th colspan="5" style="vertical-align: middle;"></th>

                                             <?php  if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>
                                                
                                                <th style="vertical-align: middle;"></th>
                                                <th style="vertical-align: middle;"></th>

                                                <th style="vertical-align: middle;"><button type="submit" value="confirmar_default" name="confirmar_default" class="btn btn-danger">Confirmar</button></th>
                                                <th style="vertical-align: middle;"><button type="submit" value="confirmar_coordinadores" name="confirmar_coordinadores" class="btn btn-danger">Confirmar</button></th>
                                                    
                                                <!-- <th style="vertical-align: middle;"><a style='width:70px;' id='confirmar[]' class="btn btn-danger btn-xs">Confirmar</a></th>
                                                <th style="vertical-align: middle;"><a style='width:70px;' id='confirmar[]' class="btn btn-danger btn-xs">Confirmar</a></th>
                                                        -->
                                                <th  style="vertical-align: middle;"></th>
                                            
                                            <?php  endif; ?>

                                            <th colspan="3" style="vertical-align: middle;"></th><th style="vertical-align: middle;">
                                        </tr>
                                   </tbody>
                                </table>
                            </div>
                            </form>


                            <div class="panel-footer" style='text-align:left;'>

                                
                            </div>
                    </div>

                    <div class="tab-pane fade" id="extras">
                            
                        <form id="form_cargar_extras" name="form_cargar_extras" method="post" action="<?=base_url()?>index.php/profesor/procesa_cargar_extras" >
                        
                        <input class="form-control" type="hidden" name="legajo" id="legajo" value="<?=$legajo->N_LEGAJO?>" />
                        <input class="form-control" type="hidden" name="idUsuario" id="idUsuario" value="<?=$id_profesor?>" />                          
                        
                        <div class="col-md-6 col-lg-6 ">
                            <div class="panel panel-success"  style="margin-top:10px;">
                                
                                <div class="panel-heading">
                                    <h6><strong>CARGAR EXTRAS (<i class="fa fa-usd"> </i>)</strong></h6>
                                </div>
                                <div class="panel-body">

                                        <div class="form-group">
                                            <label for="Importe" class="control-label">Importe ($)</label>
                                            <input class="form-control" name="sueldo" id="sueldo" placeholder="Importe" />
                                            <div class="help-block with-errors"></div>
                                        </div> 

                                        <div class="form-group">
                                            <label for="concepto" class="control-label">Concepto</label>
                                                    <select class="form-control" name="concepto" id="concepto">
                                                    <option value="" selected disabled>Elegir un concepto</option>
                                                    <?php  
                                                        foreach($conceptos_extras->result() as $row): ?>
                                                      
                                                            <option value="<?=$row->CPTO?>"><?=$row->CPTO_NOMBRE?></option>

                                                    <?php   endforeach;      ?>
                                                    </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                                <label for="liquidacion" class="control-label">Fecha (Año|Mes) </label>
                                                <input  class="form-control" id="liquidacion" name="liquidacion" placeholder="Liquidacion">
                                        </div>
                                        <div class="form-group">
                                            <label>Comentarios</label>
                                            <textarea class="form-control" id="comentarios" name="comentarios"  rows="3"></textarea>
                                        </div>

                                </div>
                                                                         
                                <div class="panel-footer" style='text-align:center;'>
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Cargar</button>
                                        </div>
                                </div>
                               
                            </div>
                                
                        </div>

                        </form> 

                        <div class="col-md-6 col-lg-6 ">
                            <div class="panel panel-success"  style="margin-top:10px;">
                                
                                <div class="panel-heading">
                                    <h6><strong>EXTRAS CARGADOS</strong></h6>
                                </div>
                                <div class="panel-body">
                                <?php 
                                    if($extras_profesor->num_rows() > 0 ): ?>
                                        
                                        <table class="table table-striped">
                                            
                                    <?php   foreach ($extras_profesor->result() as $row) 
                                        { ?>
                                            <tr>
                                                 <td><?=$row->LIQUIDACION?></td>
                                                 <td><?=utf8_encode($row->CPTO_NOMBRE)?></td>
                                                 <td>$<?=$row->IMPORTE?></td>
                                                 <td>
                                                        <?php 
                                                            $datos_extras_cargados =  array();

                                                            $datos_extras_cargados['liquidacion'] = $row->LIQUIDACION;
                                                            $datos_extras_cargados['cpto'] = $row->CPTO;
                                                            $datos_extras_cargados['importe'] = $row->IMPORTE;
                                                            $datos_extras_cargados['legajo'] = $row->LEGAJO;
                                                            $datos_extras_cargados['id_profesor'] = $profesores_cursos->row()->N_ID_PERSONA;
                                                            $datos_extras_cargados['observaciones'] = utf8_decode($row->C_OBSERVACIONES);

                                                            $datos_extras_enviar = json_encode($datos_extras_cargados);
                                                            $datos_extras_enviar = str_replace("\"", "&", $datos_extras_enviar);

                                                        ?>

                                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editarExtraModal" data-whatever="<?=$datos_extras_enviar ?>"> 
                                                                Editar
                                                        </button>

                                                        <button type="button" style="margin-top:5px" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarExtraModal" data-whatever="<?=$datos_extras_enviar ?>"> 
                                                                Eliminar
                                                        </button>

                                                        <!-- <div data-toggle="tooltip" data-placement="top" title="Editar el importe" style='width:70px; margin-bottom:5px; float:left;'><a style='width:70px;' data-toggle="ajaxModal"  class="btn btn-success btn-xs" href="<?=base_url()?>index.php/profesor/editar_extra_profesor/<?=$row->LIQUIDACION?>/<?=$row->CPTO?>/<?=$row->IMPORTE?>/<?=$row->LEGAJO?>/<?=$profesores_cursos->row()->N_ID_PERSONA?>/<?=rawurlencode($row->C_OBSERVACIONES)?>/"  >Editar </a></div>                -->
                                                        <!-- <div data-toggle="tooltip" data-placement="top" title="Eliminar el extra" style='width:70px; margin-bottom:5px; float:left;'><a style='width:70px;' class="btn btn-danger btn-xs" href="<?=base_url()?>index.php/profesor/eliminar_extra_profesor/<?=$row->LIQUIDACION?>/<?=$row->CPTO?>/<?=$row->IMPORTE?>/<?=$row->LEGAJO?>/<?=$profesores_cursos->row()->N_ID_PERSONA?>/"  >Eliminar </a></div>               -->
                                                        
                                                 </td>
                                                 <td style="font-size:11px">
                                                    <span  >Alta:</span> <span style="font-weight:bold;"><?=$row->C_USUARIOALT?> </span><br>
                                                    <span   >Actualizacion:</span>  <span style="font-weight:bold;"><?=$row->C_USUARIOACT?></span><br>
                                                 </td>

                                            </tr> 

                                    <?php  } ?>
                                        
                                            
                                        </table>

                                <?php   else: ?>

                                        <div class="alert alert-danger" role="alert">Usted no le ha cargado extras</div>

                                <?php   endif;  ?>
                                </div>
                                                                         
                                <div class="panel-footer" style='text-align:right; font-size:10px'>
                                     Cargados al <?=date('Y-m-d')?>
                                </div>
                               
                            </div>
                        </div>                        
                    </div>
                    
                     <?php  if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): 

                        $total_default=0;
                        $total_coordinador=0;
                        $total_a_pagar=0;
                        $total_cursos_actual=0;
                        $total_pagado=0;// cursos que ya empezaron y no pueden modificarse
                        $extra_cursos=0; // Si se excede del contrato.
                        $total_contrato=$contrato_profesor->N_PUNTOS*$valor_punto; // Usado para ir decontando dinero
                        $a_pagar_extra=0;
                        $a_descontar=0;

                     ?>

                    <div class="tab-pane fade" id="pagar">
                    
                        <form id="a_pagar"  name="a_pagar" method="post" action="<?=base_url()?>index.php/programa/procesa_a_pagar" > 

                        <input type="hidden" name="id_profesor" id="id_profesor" value="<?=$id_profesor?>">

                        <div class="col-md-12 col-lg-12 ">
                             
                            <table id="dataTables-example" class="table table-hover table-striped" style="border-collapse: collapse;">
                                    
                                  <?php if($contrato_profesor->N_PUNTOS):?>
                                  
                                        <tr  style="background-color:#B40404;">
                                            <td> Pto: </td> 
                                            <td style="font-weight:bold"> $<?=$valor_punto?> </td> 
                                            <td>  </td> 
                                            <td>  </td> 
                                        </tr>
                                        <tr class="warning">
                                            <td> Pts contrato: </td> 
                                            <td style="font-weight:bold"> <?=$contrato_profesor->N_PUNTOS?> pts <span style="padding-left:100px">=></span> </td> 
                                            <td> ($) Contrato: </td> 
                                            <td style="font-weight:bold"> $<?=$contrato_profesor->N_PUNTOS*$valor_punto?> </td> 
                                        </tr>

                                        <?php  if($contrato_profesor->N_CLASE_EJEC): 

                                            $total_contrato+=$contrato_profesor->N_CLASE_EJEC*$CI->Programas_model->traer_importe_clase();
                                        ?>
                                            <tr class="warning">
                                                <td> Pts PEJ: </td> 
                                                <td style="font-weight:bold"> <?=$contrato_profesor->N_CLASE_EJEC?> cls <span style="padding-left:100px">=></span> </td> 
                                                <td> ($) Contrato: </td> 
                                                <td style="font-weight:bold"> $<?=$contrato_profesor->N_CLASE_EJEC*$CI->Programas_model->traer_importe_clase()?> </td> 
                                            </tr>
                                             <tr class="warning">
                                                <td> Total contrato (Pts contrato + Pts PEJ) : </td> 
                                                <td style="font-weight:bold"> $<?=($contrato_profesor->N_PUNTOS*$valor_punto)+($contrato_profesor->N_CLASE_EJEC*$CI->Programas_model->traer_importe_clase())?></td> 
                                            </tr>

                                        <?php  endif; ?>
                                    
                                <?php   else: ?>
                                        

                                        <tr class="danger">
                                            <td colspan="4" style="color:#8A0808"> <strong>El profesor no tiene puntos en el contrato.</strong> </td> 
                                        </tr>

                                    <?php endif;?>
        
                            </table>

                        </div>

                        <div class="col-md-10 col-lg-10 ">
        
                            
                            <table id="dataTables-example" class="table table-hover table-striped" >
            
                                <thead>
                                    <tr  style="color:#B40404; border-top:1px solid #B40404;  ">
                                        <th ><i class="fa fa-clock-o"></i></th>
                                        <th >Concepto</th>
                                        <th style="text-align:center; width:100px; ">($) Coord. </th>
                                        
                                        <?php   if($contrato_profesor->N_PUNTOS):   ?>
                                        
                                        
                                        <th style="text-align:center;">($) Sug. </th>
                                        
                                        <?php   endif;  ?>
                                        <th style="text-align:center; width:100px;">($) Act. </th>
                                    </tr>
                                </thead>
                                <tbody>                                       

                                        <!-- <input class="check_confirma_coordinador" name="check_confirma_coordinador[]" id="check_confirma_coordinador" type="checkbox" value="<?php  echo $datos_enviar_coordinador; ?>">                                 -->
                        
                                    <!-- CURSOS -->
                                 <?php  
                                    $periodos = array();
                                    $vector_datos_json = array(); // Son los datos para identificar a una fila/curso/materia
                                    $i=1;


                                    foreach ( $profesores_cursos->result() as $row ):   

                                        $desabilitar = '';

                                        $row_datos_coordinador['id_materia'] = $id_materia = $row->N_ID_MATERIA;
                                        $row_datos_coordinador['id_profesor'] = $id_profesor = $row->N_ID_PERSONA;
                                        $row_datos_coordinador['id_curso'] = $id_curso = $row->N_CURSO;
                                        $row_datos_coordinador['anio_lectivo'] = $anio_lectivo = $row->ANIO_LECTIVO;
                                        $row_datos_coordinador['id_horario'] = $id_horario = $row->N_ID_HORARIO;
                                        $row_datos_coordinador['rol'] = $rol = $row->C_ROL;
                                        $tipo_clase =  $row->C_TIPO_CLASE;

                                        $row_datos_coordinador['c_identificacion'] = $c_identificacion = $row->C_IDENTIFICACION;
                                        $row_datos_coordinador['c_programa'] = $c_programa  = $row->C_PROGRAMA;
                                        $row_datos_coordinador['c_orientacion'] = $c_orientacion  = $row->C_ORIENTACION;

                                        $row_datos_coordinador['puntos'] = 0 ; // HARDCODEADO

                                        // [MODIFICAR]  $row_datos_coordinador['sueldo'] =$sueldo;
                                        $datos_enviar_coordinador = json_encode($row_datos_coordinador);
                                        $datos_enviar_coordinador = str_replace("\"", "-", $datos_enviar_coordinador);
                                        //array_push($vector_datos_json,$datos_enviar_coordinador);
                                        

                                        //echo $datos_enviar_coordinador;

                                        // Sueldo standart
                                        $sueldo =  $this->Programas_model->traer_importe_default($rol,$tipo_clase,$c_identificacion, $id_materia, $c_programa, $c_orientacion, $id_profesor, $anio_lectivo, $id_curso, $id_horario );

                                        $vector_importe = explode("|", $sueldo);

                                        if( isset($vector_importe[1]) &&  $vector_importe[1] != "" )
                                            $puntos = $vector_importe[1]; 
                                        else
                                            $puntos = "0";

                                        $total_default += $vector_importe[0];
                                        $total_a_pagar += $row->IMPORTE;

                                        array_push($periodos,$row->N_PERIODO);
                                        
                                        $clase ='';

                                            if(  $row->C_CONFIRMADO )
                                                $clase ='success';                                   
                                        ?>
    
                                        <tr class="<?=$clase?>">
                                            <td ><?=$row->N_PERIODO;?></td>
                                            <td ><?php  echo utf8_encode($row->D_DESCRIP); ?></td>
                                            <!-- <td style="text-align:center;" class="success" >$<?php  echo utf8_encode($vector_importe[0]);?></td> -->
                                            <td style="text-align:center;" class="info" >

                                            <?php   if(isset($row->N_IMPORTE_PROFESOR)): 
                                                
                                                    $importe_profesor = $row->N_IMPORTE_PROFESOR;
                                                    $total_coordinador += $row->N_IMPORTE_PROFESOR;
                                                    $style = 'style="color:red;"';
                                                
                                                else:
                                                
                                                    $importe_profesor =  $vector_importe[0];
                                                    $total_coordinador += $vector_importe[0];
                                                    $style = '';

                                                endif;

                                            ?>
                                                <span <?=$style?> > <?=$importe_profesor?> </span>


                                            <?php  if($contrato_profesor->N_PUNTOS && strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>
                 
                                                <span style="float:right; margin-left:10px"><i class="fa fa-arrow-right" onclick="pasar_valor(<?=$importe_profesor?>,<?=$i?>)"></i></a></span>
                                            
                                            <?php   endif;  ?>

                                            </td>

                                        <?php   if($contrato_profesor->N_PUNTOS):   ?>

                                            <?php   if( strtotime(date('d-M-y')) > strtotime($row->FECHA_INI) ): ?>

                                                   <td style="width:80px; text-align:center; color:red; font-size:10px; font-weight:bold;"> 
                                                       PAGADO
                                                    </td>                                         

                                            <?php   else: ?>
                                                
                                                    <td style="width:80px"> 
                                                        <input class="form-control sugerencia" style="text-align:center;"  name="sugerencia[]" value="0" type="number" id="materia_<?=$i?>">   
                                                        <input style="text-align:center;" name="datos_sugerencia[]" type="hidden" id="datos_sugerencia" value="<?=$datos_enviar_coordinador?>">  
                                                    </td>

                                            <?php   endif;  ?>
                                        
                                        <?php   endif;  ?>


                                         <?php   if(isset($row->IMPORTE)):   

                                                if( strtotime(date('d-M-y')) > strtotime($row->FECHA_INI) ):

                                                    $total_pagado += $row->IMPORTE;
                                                    //echo $total_pagado;

                                                endif;




                                                $total_cursos_actual += $row->IMPORTE;
                                                ?>
                                                <td class='warning' style="text-align:center;" > 
                                                    <?=$row->IMPORTE?>
                                                </td>
                                        <?php   endif;  ?>

                                        </tr>

                                 <?php  
                                        $i++;
                                    endforeach; 

                                        /*
                                        if($total_contrato > $total_coordinador)
                                           $a_descontar = $total_coordinador - $total_contrato;
                                        elseif($total_contrato < $total_coordinador)
                                           $a_pagar_extra = $total_coordinador - $total_contrato;
                                        else
                                           $a_pagar_extra = 0; */
                                    ?>
                                    
                                        <tr style="font-weight:bold; text-align:left; " >
                                            <td colspan="2">($) TOTAL:</td>
                                            <td style="color:red; font-weight:bold">$ <?=$total_coordinador?></td>
                                            <?php   if($contrato_profesor->N_PUNTOS) echo "<td><button type='submit' value='confirmar_default' name='confirmar_default' value='confirmar_default' class='btn btn-danger submit'> Confirmar </button></td>";   ?>
                                            <?php   if($total_cursos_actual != 0 ) echo "<td class='warning'>$ $total_cursos_actual</td>"?>
                                                
                                        </tr> 
                                        <tr> 
                                            <td colspan="5"></td>
                                        </tr>  
                                        <tr style="font-weight:bold; text-align:left; " class="info">
                                            <td colspan="2">($) SE PAGA POR CONTRATO:</td>
                                            <td  >$ <?=$total_contrato?></td>
                                            <?php   if($contrato_profesor->N_PUNTOS) echo "<td></td>";   ?>
                                            <td></td>
                                        </tr> 

                                        <tr style="font-weight:bold; text-align:left; " class="info">
                                            <td colspan="2">($) DIFERENCIA ENTRE LO TRABAJADO Y EL CONTRATO:</td>
                                            <td  >$ <?=$total_coordinador-$total_contrato?></td>
                                            <?php   if($contrato_profesor->N_PUNTOS) echo "<td></td>";   ?>
                                            <td></td>
                                        </tr> 
                                        <tr> 
                                            <td colspan="5"></td>
                                        </tr> 
                                        <tr style="font-weight:bold; text-align:left; " class="success">
                                            <td colspan="2">($) YA PAGADO (POR CURSOS) A LA FECHA:</td>
                                            <td  >$<?=$total_pagado?></td>
                                            <?php   if($contrato_profesor->N_PUNTOS) echo "<td></td>";   ?>
                                            <td></td>
                                        </tr> 
                                                    
                                         <tr style="font-weight:bold; text-align:left;" class="danger">
                                                
                                                <td colspan="2">($) FALTA PAGAR:</td>

                                                <!-- DIFERENCIA CON LA PLATA DEL COORDINADOR -->
                                                  
                                                    <?php   if($total_contrato > $total_coordinador): //    Estoy pagando de mas

                                                            $a_descontar = $total_coordinador - $total_contrato;
                                                    ?>
                                                            <td class="danger">$ <?=$a_descontar?> </td>
    
                                                    <?php   elseif($total_contrato < $total_coordinador): // Le debo al profesor

                                                            $a_pagar_extra = $total_coordinador - $total_contrato - $total_pagado;
                                                    ?>
                                                            <td class="success">$ <?=$a_pagar_extra?> </td> 

                                                    <?php   else:  // Se le paga justo  ?>
                                                            
                                                            <td class="success">$ 0 </td>

                                                    <?php   endif; ?>
                        
                                               

                                                <?php   if($contrato_profesor->N_PUNTOS) echo "<td></td>";   ?>


        
                                                <?php   if($total_cursos_actual!=0): // Si hay plata asignada ?> 


                                                        <td> </td>


                                                    <?php /*  if($total_cursos_actual == $a_pagar_extra): // Estoy pagando de mas

                                                            $a_descontar_actual = $total_coordinador - $total_cursos_actual;
                                                    ?>
                                                            <td  style="color:#0B6121; background-color:#CEF6CE"> 0 </td>
    
                                                    <?php   elseif($total_cursos_actual < $a_pagar_extra): // Le debo al profesor

                                                            $a_pagar_extra_actual = $a_pagar_extra - $total_cursos_actual;
                                                    ?>
                                                            <td class="danger"> <?=$a_pagar_extra_actual?> </td> 

                                                    <?php   else:  // Se le paga justo  ?>
                                                            
                                                            <td class="success"> <?php echo ($a_pagar_extra - $total_cursos_actual);?> </td>

                                                    <?php   endif; */?>
                                                
                                                <?php   else: ?>

                                                        <td></td>

                                                <?php   endif; ?>
                                        </tr>


                                </tbody>
                            </table>                
                        </div>

                        <?php 

                        $cantidad_periodos = array_count_values($periodos);


                            foreach ($cantidad_periodos as $valor):
                                
                                $clave = array_search($valor, $cantidad_periodos); ?>

                                <input type="hidden" id="cantidad_periodo_<?=$clave?>" value="<?=$valor?>">
                                 
                                <?php    

                            endforeach;
                        ?>

                        <input type="hidden" id="cantidad_total_materias" value="<?=$profesores_cursos->num_rows()?>">
                        <input type="hidden" id="cantidad_periodos" value="<?=count($cantidad_periodos)?>">
                        <input type="hidden" id="extra_a_pagar" value="<?=$a_pagar_extra?>">
                        <input type="hidden" id="a_descontar" value="<?=$a_descontar?>">
                        <input type="hidden" id="valores_fila" name="valores_fila" value="<?=json_encode($vector_datos_json)?>">
    
                    <?php if(  $contrato_profesor->N_PUNTOS && $total_coordinador > $contrato_profesor->N_PUNTOS*$valor_punto):?>

                           <!--  <div class="col-md-2 col-lg-2 ">
                                <label for="amount">Balanceardor de Pagos extras</label>
                                <input type="text" id="amount" readonly style="border:0; font-weight:bold;" data-slider-orientation="vertical">
                                
                                    <div id="slider-range-max"></div>
                                
                                <?php if(count($cantidad_periodos) >= 1):?>
                                    <label>1°</label>
                                    <input class="form-control" type="text" id="periodo1" name="periodo1" > <br>
                                <?php endif;?>

                                <?php if(count($cantidad_periodos) >= 2):?>
                                    <label>2°</label>
                                    <input class="form-control" type="text" id="periodo2" name="periodo2" > <br>
                                <?php endif;?>

                                <?php if(count($cantidad_periodos) >= 3):?>
                                    <label>3°</label>
                                    <input class="form-control" type="text" id="periodo3" name="periodo3" >
                                <?php endif;?>
                            </div> -->
                            
                             <div class="col-md-2 col-lg-2 ">
                                     <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Total a repartir</label>
                                            <input readonly type="text" class="form-control" id="222" value="<?=$a_pagar_extra?>">
                                        </div>

                                     <div class="form-group has-error">
                                            <label class="control-label" for="inputError">Falta repartir</label>
                                            <input readonly type="text" class="form-control" id="saldo_a_pagar">
                                    </div>
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Total repartido</label>
                                            <input readonly type="text" class="form-control" id="total_repartido">
                                    </div>
                               
                            </div>
                        


                    <?php   endif; ?>
                    </form>
                    </div>
                    
                    <?php   endif;?>
                </div>
            </div>
        </div>
 
    
   <!--  <a class="btn btn-success btn-sm" data-toggle="ajaxExtras" href="<?=base_url()?>index.php/profesor_tesoreria/cargar_extras/<?php  echo $id_profesor; ?>" ><i class="fa fa-usd"> Cargar extras </i></a> -->
   
    <?php  else: ?>

    <div class="alert alert-danger">
        El profesor/a no tiene cursos asignado.
    </div>

    <?php  endif; ?>

   
    </div>
 <!-- /. PAGE WRAPPER  -->
</div>

    <!-- _________________ MODAL PARA MOSTRAR HISTORIAL ______________________  -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style=" background-color: #428BCA; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Editar extra profesor</h4>
            </div>

            
            <form id="form_comentarios" name="form_comentarios" method="post" action="<?=base_url()?>index.php/programa/procesa_agregar_comentario" >
                
                <div class="modal-body">
                    

                        <input type='hidden' name='id_materia' id='id_materia' value=''/> 
                        <input type='hidden' id='idUsuario' name='idUsuario' value=""/>
                        <input type='hidden' name='id_curso' id='id_curso'  value=''/> 
                        <input type='hidden' name='anio_lectivo' id='anio_lectivo'  value=''/>
                        <input type='hidden' name='id_horario' id='id_horario'  value=''/>
                        <input type='hidden' id='rol' name='rol' value=""/>

                        <input type='hidden' id='c_identificacion' name='c_identificacion' value=""/>
                        <input type='hidden' id='c_programa' name='c_programa' value=""/>
                        <input type='hidden' id='c_orientacion' name='c_orientacion' value=""/>

                        
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea class="form-control" id="comentarios" rows="4" readonly="readonly"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="materia" class="control-label">Ingresar comentario</label>
                                 <textarea name="comentario" name="comentario" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Agregar</button>
                    <a class="btn" data-dismiss="modal">Cerrar</a>
                </div>

            </form>


        </div>
      </div>
    </div>

     <!-- _________________ MODAL PARA EDITAR IMPORTE ______________________  -->

    <div class="modal fade" id="editarExtraModal" tabindex="-1" role="dialog" aria-labelledby="editarExtraModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header" style=" background-color: #428BCA; color:#fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Editar Extra</h4>
            </div>

            <form id="form_editar_extra" name="form_editar_extra" method="post" action="<?=base_url()?>index.php/profesor/procesa_editar_extra_profesor" >
            
                <div class="modal-body">              
                
                    <input class="form-control" name="legajo" id="legajo" value="" type="hidden"  />
                    <input class="form-control" name="concepto" id="concepto" value="" type="hidden" />
                    <input class="form-control" name="n_id_profesor" id="n_id_profesor" value="" type="hidden" />
                    
                    <div class="form-group">
                        <label for="liquidacion" class="control-label">Liquidacion</label>
                        <input class="form-control" name="liquidacion" id="liquidacion" type="text" value="" readonly="readonly" /> <br>
                        <label for="importe" class="control-label">Extra</label>
                        <input class="form-control" name="importe" id="importe" type="text"  value="" />
                        <label>Comentarios</label>
                        <textarea class="form-control" id="comentarios" name="comentarios"  rows="3"></textarea>
                    </div>           
 
                </div>
                

                <div class="panel-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <a class="btn" data-dismiss="modal">Close</a>
                    </div>
                </div>

            </form>

        </div>
      </div>
    </div>

    <!-- _________________ MODAL PARA ELIMINAR IMPORTE ______________________  -->

    <div class="modal fade" id="eliminarExtraModal" tabindex="-1" role="dialog" aria-labelledby="editarExtraModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header" style=" background-color: #428BCA; color:#fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">¿ Realmente desea eliminar el extra?</h4>
            </div>

            <form id="form_editar_extra" name="form_editar_extra" method="post" action="<?=base_url()?>index.php/profesor/procesa_eliminar_extra_profesor" >
            
                <div class="modal-body">              
                
                    <input class="form-control" name="legajo" id="legajo" value="" type="hidden"  readonly="readonly"/>
                    <input class="form-control" name="concepto" id="concepto" value="" type="hidden" readonly="readonly"/>
                    <input class="form-control" name="n_id_profesor" id="n_id_profesor" value="" type="hidden" readonly="readonly"/>
                    <input class="form-control" name="liquidacion" id="liquidacion" type="hidden" value="" readonly="readonly" /> <br>
                    <input class="form-control" name="importe" id="importe" type="hidden"  value="" readonly="readonly"/>
 
                </div>
                

                <div class="panel-footer">

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                        <a class="btn" data-dismiss="modal">Cerrar</a>
                    </div>

                </div>

            </form>

        </div>
      </div>
    </div>
    
    <!-- _________________ MODAL PARA EDITAR IMPORTE TESORERIA ______________________  -->

    <div class="modal fade" id="importeTesoreriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <div class="modal-header" style=" background-color: #428BCA; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Editar Importe Curso</h4>
                </div>

                <form id="form_editar_importe" name="form_editar_importe" method="post" action="<?=base_url()?>index.php/profesor/procesa_editar_importe_tesoreria" >
                
                <div class="modal-body">
                    <!--- hidden -->

                    <input type='hidden' name='id_materia' id='id_materia' value=''/>
                    <input type='hidden' name='id_curso' id='id_curso' value=''/>
                    <input type='hidden' name='anio_lectivo' id='anio_lectivo'  value=''/>
                    <input type='hidden' name='id_horario' id='id_horario'  value=''/>
                    <input type='hidden' id='rol' name='rol' value="" />
                    <input type='hidden' id='idUsuario' name='idUsuario' value=""/>

                    <?php /*<!-- <input type='hidden' id='carrera' name='carrera' value="<?=$carrera?>"/> -->*/?>

                    <input type='hidden' id='c_identificacion' name='c_identificacion' value=""/>
                    <input type='hidden' id='c_programa' name='c_programa' value=""/>
                    <input type='hidden' id='c_orientacion' name='c_orientacion' value=""/>
                    <input type='hidden' id='n_fila_curso' name='n_fila_curso' value=""/>

                    <div class="form-group">
                        <label for="sueldo" class="control-label">Sueldo ($)</label>
                        <input class="form-control" name="sueldo" id="sueldo" />
                        <div class="help-block with-errors"></div>
                    </div> 

                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn" data-dismiss="modal">Cancelar</a>
                </div>


                </form>


          </div>
        </div>
    </div>


    
<!-- /. WRAPPER  -->


<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.10.custom.min.js"></script>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script> 

<script>
var jq = jQuery.noConflict();

    jq(function(){

            jq('#form_editar_importe').validate({

                rules :{
                        sueldo : {
                            required : true,
                            number: true
                        }
                },
                messages : {
                        sueldo : {
                            required :  "Debe ingresar el sueldo.",
                            number: "Debe ingresar un numero."
                        }
                }

            });    
    });  


</script>


<!-- JQUERY SCRIPTS -->
<script src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>

<!-- BOOTSTRAP SCRIPTS -->
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>-->

<!-- METISMENU SCRIPTS -->
<script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>

<!-- CONFIRMA -->
<script src="<?=base_url()?>assets/js/jquery.confirm.js"></script> 

<!-- MORRIS CHART SCRIPTS -->
<script src="<?=base_url()?>assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="<?=base_url()?>assets/js/morris/morris.js"></script>


<link   type="text/css" href="<?php echo base_url(); ?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 

<!-- CUSTOM SCRIPTS -->
<script src="<?=base_url()?>assets/js/custom.js"></script> 

<script type="text/javascript">
        CI_ROOT = "<?=base_url() ?>";
</script>

<script>




    jq(document).ready(function () {

        if( $('#a_descontar').val() < 0 )
        {

            var cantidad_materias = $('#cantidad_total_materias').val();

            for(var i=0; i <= cantidad_materias; i++)
            {
                $("#materia_"+i).val(0);
            }
            
            //alert($('#cantidad_total_materias').val());    
        }

        $('#exampleModal').on('show.bs.modal', function (event) {


        
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/-/g, "\"");
            cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);

            array_json = JSON.parse(cadena_json_correcta);

            var id_materia = array_json.id_materia;
            var id_profesor = array_json.id_profesor; 
            var id_curso = array_json.id_curso;
            var anio_lectivo = array_json.anio_lectivo;
            var puntos = array_json.puntos;
            var id_horario = array_json.id_horario;
            var rol = array_json.rol;
            var comentarios = array_json.comentarios;
            //var n_fila_curso = array_json.n_fila_curso; 
            var c_identificacion = array_json.c_identificacion;
            var c_programa = array_json.c_programa;
            var c_orientacion = array_json.c_orientacion;

            console.log(id_materia);
            console.log(id_profesor);
            console.log(id_curso);
            console.log(id_materia);
            console.log(anio_lectivo);
            console.log(puntos);
            console.log(id_horario);
            console.log(rol);
            console.log(comentarios);

            console.log(c_identificacion);
            console.log(c_programa);
            console.log(c_orientacion);
            

            // -----------------------------------------------------------
            var modal = $(this)

            modal.find('#id_materia').val(id_materia);
            modal.find('#idUsuario').val(id_profesor);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#puntos').val(puntos);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            //modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);

            comentarios_mod = comentarios.replace(/\|/g, " \n");

            //comentarios_mod = utf8_encode(comentarios_mod);
        
            modal.find('#comentarios').val(comentarios_mod);
        });
 

        $('#editarExtraModal').on('show.bs.modal', function (event) {
             
            //alert("aa");
            
           
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");
            //cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);
           
            array_json = JSON.parse(cadena_json_correcta);

            var liquidacion = array_json.liquidacion;
            var cpto = array_json.cpto; 
            var importe = array_json.importe;
            var legajo = array_json.legajo;
            var id_profesor = array_json.id_profesor;
            var observaciones = array_json.observaciones;
            //var rol = array_json.rol;
            //var comentarios = array_json.comentarios;
            //var n_fila_curso = array_json.n_fila_curso; 
            /*
            var c_identificacion = array_json.c_identificacion;
            var c_programa = array_json.c_programa;
            var c_orientacion = array_json.c_orientacion;*/
            
            console.log(liquidacion);
            console.log(cpto);
            console.log(importe);
            console.log(legajo);
            console.log(id_profesor);
            console.log(observaciones);

             var modal = $(this)

            modal.find('#liquidacion').val(liquidacion);
            modal.find('#concepto').val(cpto);
            modal.find('#importe').val(importe);
            modal.find('#legajo').val(legajo);
            modal.find('#n_id_profesor').val(id_profesor);
            modal.find('#comentarios').val(observaciones);

            /*
            console.log(id_horario);
            console.log(rol);
            console.log(comentarios);

            console.log(c_identificacion);
            console.log(c_programa);
            console.log(c_orientacion);
            

            // -----------------------------------------------------------
            var modal = $(this)

            modal.find('#id_materia').val(id_materia);
            modal.find('#idUsuario').val(id_profesor);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#puntos').val(puntos);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            //modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);

            comentarios_mod = comentarios.replace(/\|/g, " \n");
        
            modal.find('#comentarios').val(comentarios_mod);
            */  
        });

        
        $('#eliminarExtraModal').on('show.bs.modal', function (event) {
          
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");
            //cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);
           
            array_json = JSON.parse(cadena_json_correcta);

            var liquidacion = array_json.liquidacion;
            var cpto = array_json.cpto; 
            var importe = array_json.importe;
            var legajo = array_json.legajo;
            var id_profesor = array_json.id_profesor;
            var observaciones = array_json.observaciones;
             
            console.log(liquidacion);
            console.log(cpto);
            console.log(importe);
            console.log(legajo);
            console.log(id_profesor);
            console.log(observaciones);

             var modal = $(this)

            modal.find('#liquidacion').val(liquidacion);
            modal.find('#concepto').val(cpto);
            modal.find('#importe').val(importe);
            modal.find('#legajo').val(legajo);
            modal.find('#n_id_profesor').val(id_profesor);
            modal.find('#comentarios').val(observaciones);   
        });



        $('#importeTesoreriaModal').on('show.bs.modal', function (event) {
        
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            console.dir(cadena_json_recibida);

            cadena_json_correcta = cadena_json_recibida.replace(/-/g, "\"");

            console.dir(cadena_json_correcta);

            array_json = JSON.parse(cadena_json_correcta);
            
            var id_materia = array_json.id_materia;
            var nombre_materia = array_json.nombre_materia;
            var id_profesor = array_json.id_profesor; 
            var id_curso = array_json.id_curso;
            var anio_lectivo = array_json.anio_lectivo;
            var puntos = array_json.puntos;
            var sueldo = array_json.sueldo;
            var id_horario = array_json.id_horario;
            var rol = array_json.rol;
            var comentarios = array_json.comentarios;
            var n_fila_curso = array_json.n_fila_curso; 
            var c_identificacion = array_json.c_identificacion;
            var c_programa = array_json.c_programa;
            var c_orientacion = array_json.c_orientacion;

           
            console.log(id_materia);
            console.log(id_profesor);
            console.log(id_curso);
            console.log(anio_lectivo);
            console.log(puntos);
            console.log(id_horario);
            console.log(rol);
            console.log(c_identificacion);
            console.log(c_programa);
            console.log(c_orientacion);
            console.log(n_fila_curso);

            // -----------------------------------------------------------

            
            var modal = $(this)

            modal.find('#id_materia').val(id_materia);
            modal.find('#idUsuario').val(id_profesor);
            modal.find('#materia').val(nombre_materia);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#puntos').val(puntos);
            modal.find('#sueldo').val(sueldo);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            
            modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);   
        })
       
        //var a = $('#valores_fila').val();

        //alert(a);


        // With JQuery

        // Chequea los check de importe default
        $('#check_all_default').change(function(){
            var checkboxes = $(this).closest('form').find('.clase_importe_default');
            if($(this).prop('checked')) {
              checkboxes.prop('checked', true);
            } else {
              checkboxes.prop('checked', false);
            }
        });

        // Chequea los check de importe coordinador
        $('#check_all_coordinador').change(function(){
            var checkboxes = $(this).closest('form').find('.clase_importe_coordinador');
            if($(this).prop('checked')) {
              checkboxes.prop('checked', true);
            } else {
              checkboxes.prop('checked', false);
            }
        });

        $('[data-toggle="ajaxModalHistorial"]').on('click',
              function(e) {
                $('#ajaxModalHistorial').remove();
                e.preventDefault();
                var $this = $(this)
                  , $remote = $this.data('remote') || $this.attr('href')
                  , $modal = $('<div class="modal fade" style="width:600px; margin-top:20px;  margin-left: auto;  margin-right: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  id="ajaxModal"><div class="modal-body"></div></div>');
                $('body').append($modal);
                $modal.modal({backdrop: 'static', keyboard: false});
                $modal.load($remote);
              }
        );


        /*
            MODAL PARA EDITAR CON AJAX.
        */
        $('[data-toggle="ajaxModal"]').on('click',
          function(e) {
            $('#ajaxModal').remove();
            e.preventDefault();
            var $this = $(this)
              , $remote = $this.data('remote') || $this.attr('href')
              , $modal = $('<div class="modal fade" style="width:500px; margin-top: 30px;  margin-bottom: auto;  margin-left: auto;  margin-right: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  id="ajaxModal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal({keyboard: false});
            $modal.load($remote);
          }
        );

         jq.datepicker.regional['es'] = {
         closeText: 'Cerrar',
         prevText: '<Ant',
         nextText: 'Sig>',
         currentText: 'Hoy',
         monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
         monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
         dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
         dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
         dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
         weekHeader: 'Sm',
         dateFormat: 'dd/mm/yy',
         firstDay: 1,
         isRTL: false,
         showMonthAfterYear: false,
         yearSuffix: ''
         };

        jq.datepicker.setDefaults(jq.datepicker.regional['es']);
        jq('#liquidacion').datepicker({
                changeMonth: true,
                changeYear: true,
                changeDay: false,
                dateFormat: 'yymm'
        });

        jq('#form_cargar_extras').validate({

            rules :{

                    sueldo : {
                        required : true,
                        digits: true,
                        maxlength: 8
                    },
                    liquidacion : {
                        required : true
                    },
                    concepto :{
                        required : true
                    }
            },
            messages : {

                    sueldo : {
                        required : "Debe ingresar el importe.",
                        digits: "El importe debe ser un numero positivo.",
                        maxlength: "El importe no puede tener mas de 8 digitos."
                    },
                    liquidacion : {
                        required : "Debe ingresar la fecha."
                    },
                    concepto : {
                        required : "Debe elegir un concepto."
                    }
            }
        });    

        /*
        $(".btn.btn-danger.btn-xs").confirm({
            text: "¿Seguro que desea eliminar el extra?",
            confirmButton: "Si",
            cancelButton: "No",
        });  */        

    }); 

    $('[data-toggle="tooltip"]').tooltip();

    function pasar_valor(valor,fila)
    {
        jq("#materia_"+fila).val(valor);
        actualizar_parciales();
    }

    $( ".form-control.sugerencia" ).change(function() {

        id = $(this).attr('id');
        //alert(id);

        if(!$.isNumeric($('.form-control.sugerencia').val())) 
        {
            alert("Solo ingrese numeros");
            $("#"+id).val(0);
        }

         actualizar_parciales();
    });


    function actualizar_parciales()
    {
        var extra_a_pagar = parseInt(jq("#extra_a_pagar").val());
        var cantidad_materias = parseInt(jq("#cantidad_total_materias").val());
        var i=1; 
        var parcial_sugerido = 0;
        var saldo = 0;

        //alert(extra_a_pagar);
        //alert(cantidad_materias);
        //alert(typeof(i));
        //alert(typeof(parcial_sugerido));

        while( i < cantidad_materias )
        {
            if(jq("#materia_"+i).val())
            {
                //  alert(i+':'+jq("#materia_"+i).val());
                parcial_sugerido = parseInt(jq("#materia_"+i).val()) + parcial_sugerido;
            }
            i++;

            //parcial_sugerido = parseInt(jq("#materia_"+i).val()) + parcial_sugerido;

            //alert(i+':'+jq("#materia_"+i).val())
            //i++;
        }
        //alert(parcial_sugerido);

        saldo = extra_a_pagar - parcial_sugerido;
        //alert(saldo);
        jq("#saldo_a_pagar").val(saldo);
        jq("#total_repartido").val(parcial_sugerido);
    }

    

    // Balanceador automatico
    /*
    jq(function() {

        jq( "#slider-range-max" ).slider({
          range: "max",
          min: 0,
          max: 100,
          value: 20,
          orientation: "vertical",
          slide: function( event, ui ) {

            var i=1; 
            jq( "#amount" ).val( "%"+ui.value );
            
            var primer_sem, segundo_sem;

            var cantidad_periodos = jq( "#cantidad_periodos" ).val();

            //alert(cantidad_periodos);

            if(cantidad_periodos == 1)
            {
                jq("#materia_"+i).val(jq( "#extra_a_pagar" ).val());
                //primer_sem = jq( "#extra_a_pagar" ).val();
                //jq( "#semestre_1" ).val(primer_sem);
                var cantidad_materias_p1 = jq( "#cantidad_periodo_1" ).val();

                while( i<cantidad_materias_p1 )
                {
                    i++;
                    jq("#materia_"+i).val(0);
                }
            }
            else
            {   
                // Puede ser 1 y 2, 1 y 3 o 2 y 3.
                if(cantidad_periodos == 2 )
                {
                    
                   primer_sem = jq( "#extra_a_pagar" ).val() * ui.value / 100;
                   segundo_sem = jq( "#extra_a_pagar" ).val() - primer_sem;

                   jq("#periodo1").val(primer_sem);
                   jq("#periodo2").val(segundo_sem);

                   var cantidad_materias_p1 = jq( "#cantidad_periodo_1" ).val();
                   var cantidad_materias_p2 = jq( "#cantidad_periodo_2" ).val();
                   var cantidad_materias_p3 = jq( "#cantidad_periodo_3" ).val();
                
                   if(jq( "#cantidad_periodo_1" ).val()) // Si hay periodo 1
                   {
                        jq("#materia_"+i).val(primer_sem);
                        
                        while( i<cantidad_materias_p1 )
                        {
                            i++;
                            jq("#materia_"+i).val(0);
                        }
                   }

                   if(jq( "#cantidad_periodo_2" ).val()) // Si hay periodo 2
                   {
                        var cantidad = jq( "#cantidad_periodo_2" ).val();

                        if(jq( "#cantidad_periodo_1" ).val())
                        {
                            cantidad +=  jq( "#cantidad_periodo_1" ).val();                           
                        }
                        
                        i++;
                        jq("#materia_"+i).val(segundo_sem);
                        
                        while( i<=cantidad)
                        {
                               i++;
                               jq("#materia_"+i).val(0);
                        }
                   }

                   if(jq( "#cantidad_periodo_3" ).val()) // Si hay periodo 2
                   {
                         var cantidad = jq( "#cantidad_periodo_3" ).val();

                        if(jq( "#cantidad_periodo_1" ).val())
                        {
                            cantidad += jq( "#cantidad_periodo_1" ).val();                           
                        }   

                        if(jq( "#cantidad_periodo_2" ).val())
                        {
                            cantidad += jq( "#cantidad_periodo_2" ).val();                           
                        } 

                        i++;
                        jq("#materia_"+i).val(segundo_sem);
                        
                        while( i<=cantidad)
                        {
                               i++;
                               jq("#materia_"+i).val(0);
                        }
                    }
                }


                if(cantidad_periodos == 3 )
                {
                   var porcentaje_1 = ui.value;
                   var porcentaje_2 = (100-ui.value)/2;
                   var porcentaje_3 = (100-ui.value)/2;

                   
                   primer_sem = jq( "#extra_a_pagar" ).val() * porcentaje_1 / 100;
                   segundo_sem = jq( "#extra_a_pagar" ).val() * porcentaje_2 / 100;
                   tercer_sem = jq( "#extra_a_pagar" ).val() * porcentaje_3 / 100;

                   jq("#periodo1").val(primer_sem);
                   jq("#periodo2").val(segundo_sem);
                   jq("#periodo3").val(tercer_sem);

                   var cantidad_materias_p1 = jq( "#cantidad_periodo_1" ).val();
                   var cantidad_materias_p2 = jq( "#cantidad_periodo_2" ).val();
                   var cantidad_materias_p3 = jq( "#cantidad_periodo_3" ).val();
                    
 
                   if(jq( "#cantidad_periodo_1" ).val()) // Si hay periodo 1
                   {
                        jq("#materia_"+i).val(primer_sem);
                        
                        while( i<cantidad_materias_p1 )
                        {
                            i++;
                            jq("#materia_"+i).val(0);
                        }
                   }

                   if(jq( "#cantidad_periodo_2" ).val()) // Si hay periodo 2
                   {
                        var cantidad = parseInt(jq( "#cantidad_periodo_2" ).val()) + i;

                        i++;
                        jq("#materia_"+i).val(segundo_sem);
                        
                        while( i<cantidad)
                        {
                               i++;
                               jq("#materia_"+i).val(0);
                        }
                   }

                   if(jq( "#cantidad_periodo_3" ).val()) // Si hay periodo 2
                   {
                        var cantidad = jq( "#cantidad_periodo_3" ).val() + i;

                        i++;
                        jq("#materia_"+i).val(tercer_sem);
                        
                        while( i<cantidad)
                        {
                               i++;
                               jq("#materia_"+i).val(0);
                        }
                    }
                }

            }

          }
        });

        jq( "#amount" ).val( jq( "#slider-range-max" ).slider( "value" ) );
    }); */

   

    /*
    $( ".form-control.sugerencia" ).keypress(function() {

        id = $(this).attr('id');

        if(!$.isNumeric($("#"+id).val())) 
        {
            alert("Solo ingrese numeros");
            $("#"+id).val(0);
        }

         actualizar_parciales();
    });*/

   


</script>

<!-- CUSTOM SCRIPTS -->
<script src="<?=base_url()?>assets/js/custom.js"></script> 