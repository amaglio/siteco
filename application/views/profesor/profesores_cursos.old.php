<?php 
echo $vista_head;
$puntos_trabajados = 0;
$clase_trabajadas = 0;
$pagar = 0;

$CI = &get_instance(); 

?>

<div id="page-wrapper" >

<?php   



?>  
    <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-1" style="color:#8BC53F; width:25px;">
                <h4>  <i class="fa fa-user"> </i> </h4>   
            </div>
            <div class="col-md-11" style="text-align:left;">
                 <h4> <strong> <p style=" line-height:20px">  <?=utf8_encode($datos_profesor->D_NOMBRES).", ".utf8_encode($datos_profesor->D_APELLIDOS);?> </strong>  </p>
            </div>
    </div>
     
    <!-- MENSAJE OPERACIONES --> 

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

            <div class="panel-heading" style="padding-bottom:0px"> <!--Datos profesor--> 

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

                <ul class="nav nav-pills"  style="margin-bottom:15px;"> <!--Menu PILLS--> 
                    
                    <li class="active">
                        <a href="#cursos" data-toggle="tab"> <i class="fa fa-bars"> Cursos</i> </a>
                    </li>

                    <li class="">
                        <a href="#extras" data-toggle="tab"><i class="fa fa-usd"> Extras</i> </a>
                    </li>
                    
                    <?php   if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>

                            <li class="">
                                <a href="#pagar" data-toggle="tab"><i class="fa fa-usd"> A pagar</i> </a>
                            </li>

                    <?php   endif;?>

                    <li style="float:right">
                        <?php   if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>
                            <a style="float:right" href="<?php echo base_url(); ?>index.php/profesor/exportar_pdf/<?php  echo $id_profesor; ?>" class="btn btn-danger btn-sm"><i class="fa fa-file"></i> Exportar PDF</a>
                        <?php   endif;?>
                        
                    </li>

                </ul>

                
                <div class="tab-content">
                                         
                    <div class="tab-pane fade active in" id="cursos"> <!--Cursos-->
                        
                        <?php   if($profesores_cursos->num_rows() > 0): ?>
                                
                                <div > 
                                
                                    <a id="button_imprimir_cursos" style="float:right; margin-right:5px; margin-bottom:10px;" onClick="imprSelec('cursos')" class="btn btn-success btn-sm"><i class="fa fa-print"> Imprimir cursos </i></a>
                                
                                </div>

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

                                                    <th style="vertical-align: middle;">Pts</th>
                                                    <th style="vertical-align: middle;">Cls</th>
                                                    <th style="vertical-align: middle; width:100px;"><i class="fa fa-calendar"></i> Cls </th>
                                                    <th style="vertical-align: middle; text-align:center;">($) Default <br /><input name="check_all_default" id="check_all_default" type="checkbox"> </th>
                                                    <th style="vertical-align: middle; text-align:center;">($) Coord   <br /><input name="check_all_coordinador" id="check_all_coordinador" type="checkbox"> </th>
                                                    <th style="vertical-align: middle;">($) Teso.</th>
                                                
                                                <?php  endif; ?>

                                                <th style="vertical-align: middle;">F. Inicio</th>
                                                <th style="vertical-align: middle;">F. Fin</th>
                                                <th class="celda_comentario" style="vertical-align: middle;">Comen.</th>
                                            </tr>
                                        </thead>  

                                        <tbody>

                                            <?php   foreach ( $profesores_cursos->result() as $row ):  

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

                                                    //--- SUELDO Y PUNTOS  --
                                                    
                                                    $sueldo =  $this->Programas_model->traer_importe_default($rol,$tipo_clase,$c_identificacion, $id_materia, $c_programa, $c_orientacion, $id_profesor, $anio_lectivo, $id_curso, $id_horario );
                                                    $vector_importe = explode("|", $sueldo);

                                                    if( isset($vector_importe[1]) &&  $vector_importe[1] != "" )
                                                        $puntos = $vector_importe[1]; 
                                                    else
                                                        $puntos = "0";

                                                    //--- COMENTARIOS  --

                                                    if(isset($row->C_OBS) && $row->C_OBS!= "")
                                                    {
                                                        $cantidad_comentarios = substr_count($row->C_OBS, '|'); 
                                                        $comentarios = rawurlencode($row->C_OBS);
                                                    }
                                                    else
                                                        $comentarios = rawurlencode("Sin comentarios");

                                                    $rol= rawurlencode($row->C_ROL);
                                                    
                                                    $clase ='';

                                                    if(  $row->C_CONFIRMADO )
                                                        $clase ='success';

                                                    ?>

                                                    <tr class="odd gradeX <?=$clase?>">

                                                        <td ><?php  echo utf8_encode($row->PROGRAMA2); ?></td>
                                                        <td><?php  echo utf8_encode($row->PRGCOMISION); ?></td>
                                                        <td><?php  echo utf8_encode($row->D_DESCRED); ?></td>
                                                        <td><?php  echo utf8_encode($row->C_TIPO_CLASE); ?></td>
                                                        <td><?php  echo utf8_encode($row->C_ROL); ?></td>
                                                        
                                                        <?php   //___________TESORERIA _____________________________// ?>

                                                        <?php  if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>
                                                                
                                                                <td style="text-align:center"> <!-- PUNTOS -->
                                                                    <?php   if($row->C_IDENTIFICACION !=3)
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

                                                                <!-- CLASES   -->                                 
                                                                <td style="text-align:center" style="font-size:7px;"> 
                                                                    <?php   if($row->C_IDENTIFICACION == 3 )
                                                                            echo $row->CLASES_FECHAS;
                                                                    ?>
                                                                </td>
                                                                
                                                                <td style="text-align:center;"> <!-- $ DEFAULT -->
                                                                    
                                                                    <?php   if( $vector_importe[0] != 0 ): // Check

                                                                            $datos_enviar = generar_json_profesor_importe_default($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $vector_importe[0], $row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION );
                                                                            
                                                                            echo round($vector_importe[0],3);   ?>  
                                                                            
                                                                            <?php   if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>

                                                                                     <input class="clase_importe_default" name="check_importe_default[]" id="check_importe_default" type="checkbox" value="<?php  echo $datos_enviar;  ?>"> 

                                                                            <?php   endif; ?>      

                                                                    <?php   endif; ?>

                                                                        
                                                                    <?php   if(!isset($row->IMPORTE) && $vector_importe[0]!=0 ):  // Boton

                                                                        $sueldo = $vector_importe[0];

                                                                        ?>  
                                                                           <br />
                                                                            
                                                                            <?php  if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>    

                                                                                <div data-toggle="tooltip" data-placement="top"  title="Confirma el importe default" style='width:70px; margin-bottom:5px; float:left;'>
                                                                                        <a style='width:70px;' id='confirmar[]' class="btn btn-info btn-xs" href="<?=base_url()?>index.php/profesor/confirmar_importe/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/" >Confirmar</a>
                                                                                </div>  

                                                                            <?php   endif; ?>  
                                                                        
                                                                    <?php   endif; ?>

                                                                </td> 

                                                                <td style="text-align:center;"> <!-- $ COORDINADOR -->
                                                                    
                                                                    <?php   if(isset($row->N_IMPORTE_PROFESOR)):  // Check
                                                                            
                                                                            $datos_enviar = generar_json_profesor_importe_coordinador($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $row->N_IMPORTE_PROFESOR );


                                                                            echo "$".$row->N_IMPORTE_PROFESOR; ?>

                                                                            <?php //  if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>  
                                                                            
                                                                                    <input class="clase_importe_coordinador" name="check_importe_coordinador[]" id="check_importe_coordinador" type="checkbox" value="<?php  echo $datos_enviar; ?>"> 
                                                                            
                                                                            <?php //  endif; ?>

                                                                    <?php   endif; ?>


                                                                    <?php   if(!isset($row->IMPORTE) && isset($row->N_IMPORTE_PROFESOR) ): // Boton
                                                                        
                                                                        $sueldo = $row->N_IMPORTE_PROFESOR;

                                                                        ?> 
                                                                           <br />
                                                                    
                                                                            <?php //  if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>    

                                                                                    <div data-toggle="tooltip" data-placement="top"  title="Confirma el importe del coordinador" style='width:70px; margin-bottom:5px; float:left;'><a style='width:70px;' id='confirmar[]' class="btn btn-info btn-xs" href="<?=base_url()?>index.php/profesor/confirmar_importe/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/" >Confirmar</a></div>  
                                                                            
                                                                            <?php //  endif; ?>
                                                                    
                                                                    <?php   endif; ?>

                                                                </td> 

                                                                <td class="info" style="text-align:center;"> <!-- $ TESORERIA -->
                                                                     
                                                                    <?php   if(isset($row->IMPORTE)):  ?>

                                                                            <span style="font-weight:bold; color:red;"> $<?php  echo utf8_encode($row->IMPORTE); ?></span><br>
                                                                     
                                                                    <?php   endif;   ?>

                                                                    <?php  // if( strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ):  ?>
                                                                            
                                                                        <?php   $datos_enviar = generar_json_profesor_importe_tesoreria($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $row->N_IMPORTE_PROFESOR, $row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION); ?>

                                                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" style='width:70px; margin-bottom:5px; float:left;' data-target="#importeTesoreriaModal" data-whatever="<?=$datos_enviar?>"> Editar </button>
                                                                    
                                                                    <?php //  endif;   ?>
                                                                </td>

                                                        <?php  endif; ?>

                                                        <td><?php  echo utf8_encode($row->FECHA_INI); ?></td>
                                                        
                                                        <td><?php  echo utf8_encode($row->FECHA_FIN); ?></td>                                                   

                                                        <td class="celda_comentario" style='width:60px; padding:5px; border-right:1px solid #9FC5CC;'>

                                                                <?php   $datos_enviar = generar_json_profesor_comentarios($id_materia, $id_profesor, $id_curso, $anio_lectivo, $puntos, $id_horario, $rol, $sueldo, $row->C_IDENTIFICACION, $row->C_PROGRAMA, $row->C_ORIENTACION, $comentarios );  ?>
                                                              
                                                                
                                                                <?php   if(isset($comentarios)&& $comentarios != " ") : ?>
                                                                
                                                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="<?=$datos_enviar?>"> <i  data-toggle="tooltip" data-placement="top" title="Ver comentarios" class="fa fa-comment fa-1x"></i>
                                                                   
                                                                            <?php  echo "(".$cantidad_comentarios.")";?>                                     
                                                                    
                                                                        </button>

                                                                <?php   endif;  ?>   
                                                        </td>

                                                    </tr>

                                            <?php   endforeach; ?>

                                            <!-- FILA FINAL CON CONFIRMAR POR COLUMNA -->

                                            <tr id="fila_confirmaciones" class="warning" style="color:#0B3B0B; vertical-align: text-top; border-top:1px solid #0B3B0B; border-bottom:1px solid #0B3B0B;  ">
                                                
                                                <th colspan="5" style="vertical-align: middle;"></th>

                                                 <?php  if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): ?>
                                                    
                                                    <th style="vertical-align: middle;"></th>
                                                    <th style="vertical-align: middle;"></th>
                                                    <th style="vertical-align: middle;"></th>


                                                    <th style="vertical-align: middle;"><button type="submit" value="confirmar_default" name="confirmar_default" class="btn btn-danger btn-sm">Confirmar <br /> Chequeados</button></th>
                                                    <th style="vertical-align: middle;"><button type="submit" value="confirmar_coordinadores" name="confirmar_coordinadores" class="btn btn-sm btn-danger ">Confirmar <br />Chequeados </button></th>
                                 
                                                    <th  style="vertical-align: middle;"></th>
                                                
                                                <?php  endif; ?>

                                                <th colspan="3" style="vertical-align: middle;"></th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                </form>

                                <div class="panel-footer" style='text-align:left;'>
                                </div>

                        <?php   else:   ?>

                                <div class="alert alert-danger">

                                    El profesor/a no tiene cursos asignado.

                                </div>

                         <?php   endif; ?>
                        
                    </div>

                  

                    <div class="tab-pane fade" id="extras"> <!--Extras-->
                            
                        <form id="form_cargar_extras" name="form_cargar_extras" method="post" action="<?=base_url()?>index.php/profesor/procesa_cargar_extras" >
                        
                            <input class="form-control" type="hidden" name="legajo" id="legajo" value="<?=$legajo->N_LEGAJO?>" />
                            <input class="form-control" type="hidden" name="idUsuario" id="idUsuario" value="<?=$id_profesor?>" />                          
                            
                            <div class="col-md-5 col-lg-5 ">
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

                        <div class="col-md-7 col-lg-7 ">
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
                                                            $datos_extras_cargados['id_profesor'] = $row->N_ID_PERSONA;
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

                    <!--A pagar -->
                <?php   if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): 

                    $total_default=0;
                    $total_coordinador=0;
                    $total_a_pagar=0;
                    $total_cursos_actual=0;
                    $total_pagado=0; // cursos que ya empezaron y no pueden modificarse
                    $extra_cursos=0; // Si se excede del contrato.
                    $total_contrato=$contrato_profesor->N_PUNTOS*$valor_punto; // Usado para ir decontando dinero
                    $a_pagar_extra=0;
                    $a_descontar=0; ?>
                    
                    <div class="tab-pane fade" id="pagar">
                        
                        <form id="a_pagar"  name="a_pagar" method="post" action="<?=base_url()?>index.php/profesor/procesa_a_pagar" > 

                            <input type="hidden" name="id_profesor" id="id_profesor" value="<?=$id_profesor?>" />

                            <div class="col-md-12 col-lg-12 "> <!-- Datos del contrato -->
                                 
                                <table id="dataTables-example" class="table table-hover table-striped" style="border-collapse: collapse;">
                                                        
                                    <?php   if($contrato_profesor->N_PUNTOS):?>
                                      
                                            <tr  style="background-color:#B40404; color:red;">
                                                <td> Valor de 1 Punto: </td> 
                                                <td style="font-weight:bold"> $<?=$valor_punto?> </td> 
                                                <td colspan="2"> &nbsp;  </td> 
                                            </tr>

                                            <tr class="success">
                                                <td> Pts contrato: </td> 
                                                <td style="font-weight:bold"> <?=$contrato_profesor->N_PUNTOS?> pts <span style="padding-left:100px"> => </span> </td> 
                                                <td> ($) Contrato: </td> 
                                                <td style="font-weight:bold"> $<?=$contrato_profesor->N_PUNTOS*$valor_punto?> </td> 
                                            </tr>

                                            <?php   if($contrato_profesor->N_CLASE_EJEC): 

                                                    $total_contrato+=$contrato_profesor->N_CLASE_EJEC*$CI->Programas_model->traer_importe_clase(); ?>
                                                    
                                                    <tr class="success">
                                                        <td> Pts PEJ: </td> 
                                                        <td style="font-weight:bold"> <?=$contrato_profesor->N_CLASE_EJEC?> cls <span style="padding-left:100px">=></span> </td> 
                                                        <td> ($) Contrato: </td> 
                                                        <td style="font-weight:bold"> $<?=$contrato_profesor->N_CLASE_EJEC*$CI->Programas_model->traer_importe_clase()?> </td> 
                                                    </tr>
                                                    
                                                    <tr class="success">
                                                        <td> Total contrato (Pts contrato + Pts PEJ) : </td> 
                                                        <td style="font-weight:bold"> $<?=($contrato_profesor->N_PUNTOS*$valor_punto)+($contrato_profesor->N_CLASE_EJEC*$CI->Programas_model->traer_importe_clase())?></td> 
                                                        <td> </td>
                                                        <td> </td>
                                                    </tr>

                                            <?php   endif; ?>
                                        
                                    <?php   else: ?>
                                            
                                            <tr class="danger">

                                                <td colspan="4" style="color:#8A0808"> <strong>El profesor no tiene puntos en el contrato.</strong> </td> 
                                            </tr>

                                    <?php   endif;?>
                                </table>
                            </div>

                            <div class="col-md-10 col-lg-10 ">

                                <table id="dataTables-example" class="table table-hover table-striped" ><!-- Cursos asignados --> 

                                    <thead>
                                        <tr  style="color:#B40404; border-top:1px solid #B40404;  ">
                                            <th > <i class="fa fa-clock-o"></i> </th>
                                            <th >Concepto </th>
                                            <th style="text-align:center; width:100px; ">($) Coord. </th>
                                            
                                            <?php   if($contrato_profesor->N_PUNTOS):   ?>
                                            
                                                    <th style="text-align:center;">($) Sug. </th>
                                            
                                            <?php   endif;  ?>

                                            <th style="text-align:center; width:100px;">($) Act. </th>
                                        </tr>
                                    </thead>
                                    <tbody>                                       
                                            
                                            <!-- CURSOS -->
                                            <?php  
                                            
                                            $periodos = array();
                                            $vector_datos_json = array(); // [MODIFICAR] creo que no sirve para nada// Son los datos para identificar a una fila/curso/materia
                                            $i=1;

                                            foreach ( $profesores_cursos->result() as $row ):   

                                                $desabilitar = '';

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

                                                $datos_enviar = generar_json_profesor_identificar_curso($id_materia, $id_profesor, $id_curso, $anio_lectivo, $id_horario, $rol, $c_identificacion, $c_programa, $c_orientacion);


                                                //--- SUELDO Y PUNTOS -- //
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
                                                    
                                                    <td > <!-- Periodo -->

                                                        <?=$row->N_PERIODO;?>
                                                    </td>

                                                    <td > <!-- Concepto -->

                                                        <?php  echo utf8_encode($row->D_DESCRIP); ?> 
                                                    </td>

                                                    <td style="text-align:center;" class="info" > <!-- $ Coordinador y flecha enviar -->

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


                                                        <?php   if($contrato_profesor->N_PUNTOS && strtotime(date('d-M-y')) < strtotime($row->FECHA_INI) ): ?>
                             
                                                                <span style="float:right; margin-left:10px"><i class="fa fa-arrow-right" onclick="pasar_valor(<?=$importe_profesor?>,<?=$i?>)"></i></span>
                                                        
                                                        <?php   endif;  ?>
                                                    </td>

                                                    <?php   if($contrato_profesor->N_PUNTOS):   ?> <!-- Pagado o Input Sugerencia -->

                                                        <?php   if( strtotime(date('d-M-y')) > strtotime($row->FECHA_INI) ): ?>

                                                                <td style="width:80px; text-align:center; color:red; font-size:10px; font-weight:bold;"> 
                                                                    PAGADO
                                                                </td>                                         

                                                        <?php   else: ?>
                                                            
                                                                <td style="width:80px"> 
                                                                    <input class="form-control sugerencia" style="text-align:center;"  name="sugerencia[]" value="0" type="number" id="materia_<?=$i?>">   
                                                                    <input style="text-align:center;" name="datos_sugerencia[]" type="hidden" id="datos_sugerencia" value="<?=$datos_enviar?>">  
                                                                </td>

                                                        <?php   endif;  ?>
                                                    
                                                    <?php   endif;  ?>


                                                    <?php   if(isset($row->IMPORTE)): ?> <!-- $ Tesoreria -->  

                                                        <?php   if( strtotime(date('d-M-y')) > strtotime($row->FECHA_INI) ):

                                                                $total_pagado += $row->IMPORTE;

                                                            endif;

                                                            $total_cursos_actual += $row->IMPORTE;  ?>
                                                    
                                                            <td class='warning' style="text-align:center;" > 

                                                                <?=$row->IMPORTE?>

                                                            </td>

                                                    <?php   endif;  ?>

                                                </tr>

                                                <?php  

                                                $i++;

                                            endforeach;

                                            if($total_contrato > $total_coordinador) 

                                                $valor = $total_coordinador - $total_contrato;      
                                            
                                            if($total_contrato < $total_coordinador)

                                                $valor = $total_coordinador - $total_contrato - $total_pagado;

                                            else
                                                
                                                $valor = 0;



                                            ?>
                                                 <!-- Filas con  Totales -->

                                                <tr style="font-weight:bold; text-align:left;" >  <!-- Total cursos --> 
                                                    
                                                    <td colspan="2">($) TOTAL: </td>
                                                    <td style="color:red; font-weight:bold">$ <?=$total_coordinador?> </td>
                                                    
                                                    <?php   if($contrato_profesor->N_PUNTOS): ?>
                                                            
                                                            <td> <button type='submit' value='confirmar_default' name='confirmar_default' value='confirmar_default' class='btn btn-danger submit'> Confirmar </button></td>

                                                    <?php   endif; ?>

                                                    <?php   if($total_cursos_actual != 0 ): ?>

                                                            <td class='warning'> $ <?=$total_cursos_actual?> </td>

                                                    <?php   endif; ?>
                                                </tr>
                    
                                                <tr>  <!-- Fila para separar totales-->

                                                    <td colspan="5"></td> 
                                                </tr>  

                                                <tr style="font-weight:bold; text-align:left; " class="info"> <!-- Paga por contrato-->
                                                    <td colspan="2">($) SE PAGA POR CONTRATO:</td>
                                                    <td  >$ <?=$total_contrato?></td>
                                                    <?php   if($contrato_profesor->N_PUNTOS) echo "<td></td>";   ?>
                                                    <td></td>
                                                </tr> 

                                                <tr style="font-weight:bold; text-align:left; " class="info"> <!-- Diferencia entre pagado y contratado -->

                                                    <td colspan="2">($) DIFERENCIA ENTRE LO TRABAJADO Y EL CONTRATO:</td>
                                                    <td  >$ <?=$total_coordinador-$total_contrato?></td>
                                                    <?php   if($contrato_profesor->N_PUNTOS) echo "<td></td>";   ?>
                                                    <td></td>
                                                </tr> 
                                                
                                                <tr> <!-- Fila para separar totales-->

                                                    <td colspan="5"></td>
                                                </tr>

                                                <tr style="font-weight:bold; text-align:left; " class="success"><!-- Ya pagado -->
                                                    <td colspan="2">($) YA PAGADO (POR CURSOS) A LA FECHA:</td>
                                                    <td  >$<?=$total_pagado?></td>
                                                    <?php   if($contrato_profesor->N_PUNTOS) echo "<td></td>";   ?>
                                                    <td></td>
                                                </tr> 

                                                <tr style="font-weight:bold; text-align:left;" class="danger"> <!--Falta Pagar-->
                                                        
                                                    <td colspan="2"> ($) FALTA PAGAR: </td>
                                                    <td> $ <?=$valor?> </td>
                                                    <td> &nbsp; </td>

                                                </tr>

                                        </tbody>
                             
                                </table> 
                                
                            </div>
                 
                        </form>
                    </div>
                    
                <?php   endif;  ?>
                    

                </div>
            
            </div>

        </div>

    </div>


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
                    <input class="form-control" name="liquidacion" id="liquidacion" type="text" value="" readonly="readonly" /><br />
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
                <input class="form-control" name="liquidacion" id="liquidacion" type="hidden" value="" readonly="readonly" /><br />
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

</script>

<script type="text/javascript" src="<?=base_url()?>assets/js/validar_profesores_cursos_y_fecha.js" ></script> 


<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.confirm.js"></script> 
<link   type="text/css" href="<?php echo base_url(); ?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 
<script type="text/javascript" src="<?=base_url()?>assets/js/morris/morris.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/custom.js"></script> 

<script type="text/javascript" src="<?=base_url()?>assets/js/modal_profesores_cursos.js"></script> 
<script type="text/javascript" src="<?=base_url()?>assets/js/profesores_cursos_funciones.js"></script> 

<script type="text/javascript">

function imprSelec(muestra)
{
    var url = CI_ROOT+'assets/css/print_url.css';

    var ficha=document.getElementById(muestra);
    var ventimp=window.open(' ','popimpr');
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.close();

    var css = ventimp.document.createElement("link");
    css.setAttribute("href", url );
    css.setAttribute("rel", "stylesheet");
    css.setAttribute("type", "text/css");
    ventimp.document.head.appendChild(css);

    //document.getElementById("myTable").deleteRow(0);
    //
    ventimp.print();
    //ventimp.close();
    

}
</script>
 

<!-- CUSTOM SCRIPTS -->
<script src="<?=base_url()?>assets/js/custom.js"></script> 