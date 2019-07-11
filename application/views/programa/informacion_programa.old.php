<?php 

$row_programa = $datos_programa->row();


if($n_fila_curso == -1)
    $posicion_body = "#page-wrapper";
else
    $posicion_body = "#curso_".$n_fila_curso;


?>

<style type="text/css"> 
label.error 
{
    font-size:small;
    width:0px;
    z-index: 20px;
    background-color: #F5A9A9;
    width: 90px;
} 
.container {
    width:100%;
    border:1px solid #d3d3d3;
}
.container div {
    width:100%;
}
.container .header {
    background-color:#d3d3d3;
    padding: 2px;
    font-weight: bold;
    cursor: pointer;
    font-weight: bold;
    float:right;
}
.container .content {
    display: none;
    padding : 5px;
}

.header {
    padding: 2px;
    font-weight: bold;
    cursor: pointer;
    font-weight: bold;
    float:right;

}
</style>

<div style="text-align:right"> <strong>Cursos confirmados:</strong> <span  class='label label-success'><?=$cantidad_cursos_confirmados->num_rows()?></span> / <span class='label label-primary'><?=$cursos_asignados->num_rows()?></span></div>
<div class="panel panel-default" style='margin-top:10px' id="cursos_todos" >
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li class="active" class="">
                <a href="#cursos_sigeu" data-toggle="tab"> <i class="fa fa-bars"></i>Cursos en SIGEU</a>
            </li>
            <li class="">
                <a href="#cursos_cambiados" data-toggle="tab"> <i class="fa fa-exchange"></i>Cursos Cambiados  </a>
            </li>
             <li class="">
                <a href="#plan_estudio" data-toggle="tab"> <i class="fa fa-list-ol"></i>Plan de Estudio  </a>
            </li>
             <li class="">
                <a href="<?=base_url()?>index.php/programa/exportar_cursos_asignados_excel/<?=$anio?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>"> <i class="fa fa-file">  Exportar ( xls )</i> </a>
            </li>
        </ul>
        
        <div class="tab-content" style='margin-top:20px'>                                     
            <!-- CURSOS DE SIGEU -->
            <div class="tab-pane fade active in" id="cursos_sigeu" style='margin-top:10px;'>
           
                <?php  if($row_programa->C_IDENTIFICACION == 1): // GRADO ?>
                        
                        <div class="col-md-12" style="padding:0px" > <!--1er semestre -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Primer semestre 
                                </div>
                                <div class="header"> _ |  </div>
                                <div class="panel-body">                                
                                    <?=mostrar_cursos($cursos_asignados,1,1)?>                               
                                </div>
                                 <div class="panel-footer">
                                    Cursos cargados al dia: <?=date('d-m-Y')?>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-12" style="padding:0px"> <!--2do semestre -->
                            <div class="panel panel-primary">

                                <div class="panel-heading">
                                    Segundo semestre
                                </div>

                                <div class="panel-body">         
                                    <?=mostrar_cursos($cursos_asignados,2,1)?>                                  
                                </div>
                                <div class="panel-footer">
                                    Cursos cargados al dia: <?=date('d-m-Y')?>
                                </div>
                               
                            </div>
                        </div>
                    
                <?php   elseif ($row_programa->C_IDENTIFICACION == 2 || $row_programa->C_IDENTIFICACION == 4 ): // POSGRADO ?>

                        <div class="col-md-12" style="padding:0px"> <!--1er Trimestre -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Primer Trimestre
                                </div>

                                <div class="panel-body">
                                    <?=mostrar_cursos($cursos_asignados,1,2)?>    
                                </div>
                            </div>
                        </div>

                         <div class="col-md-12" style="padding:0px"> <!--2do Trimestre -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Segundo Trimestre
                                </div>

                                <div class="panel-body">
                                   <?=mostrar_cursos($cursos_asignados,2,2)?>    
                                </div>
                            </div>
                        </div>

                         <div class="col-md-12" style="padding:0px"> <!--3er Trimestre -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Tercer Trimestre
                                </div>

                                <div class="panel-body">
                                    <?=mostrar_cursos($cursos_asignados,3,2)?>    
                                </div>
                            </div>
                        </div>


                <?php   elseif ($row_programa->C_IDENTIFICACION == 3): // PRG EJECUTIVOS ?>
                        
                        <div class="col-md-12" style="padding:0px"> <!--1er semestre -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Prg
                                </div>
                                <div class="panel-body">
                                      <?=mostrar_cursos($cursos_asignados,3,3)?>    
                                </div>
                            </div>
                        </div>
               
                <?php 
                    endif;     
                ?> 

                <?php   if( in_array('ROLE_ASISTENTE_PROGRAMAS',$this->session->userdata('roles')) && !in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) ): ?>

                    <div data-toggle="tooltip" data-placement="top" title="Confirmar los cursos del programa" style='width:auto; margin-bottom:5px; float:left;'><a style='width:auto;' class="btn btn-success btn-lg" href="<?=base_url()?>index.php/programa/confirmar_cursos_secretario/<?=$row_programa->C_IDENTIFICACION?>/<?=$row_programa->C_PROGRAMA?>/<?=$row_programa->C_ORIENTACION?>" >Confirmar cursos</a></div>    
                    
                <?php  endif;   ?>          

            </div> 
            

            <!-- CURSOS CAMBIADOS -->
            <div class="tab-pane fade" id="cursos_cambiados">
                
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Cursos modificados                            
                        </div>

                        <div class="panel-body">
                             <table class="table table-striped"> 
                                 <thead>
                                    <tr>
                                        <th>Fecha de cambio</th>
                                        <th>Materia</th>
                                        <th>Profesor</th>
                                        <th>Clase</th>
                                        <th>Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php   foreach ($cursos_cambiados->result() as $row): ?>
                                    <tr>
                                        <td> <?=$row->F_ALTA?> </td>
                                        <td> <?=utf8_encode($row->D_DESCRIP)?> </td>
                                        <td> <?=utf8_encode($row->PROFESOR)?> </td>
                                        <td> <?=utf8_encode($row->C_TIPO_CLASE)?> </td>
                                        <td> <?=utf8_encode($row->C_ROL)?> </td>
                                    </tr>    
                                <?php   endforeach; ?>
         
                                </tbody>
                            </table>
                              
                        </div>
                         <div class="panel-footer">
                            Cursos modificados al dia: <?=date('Y-m-d')?>
                        </div>
                       
                    </div>
                </div>       
            </div> 

            <!-- PLAN DE ESTUDIO -->
            <div class="tab-pane fade" id="plan_estudio">
                
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                              Plan de estudio: <?=date('Y')?> - <?=$plan_estudio_programa->num_rows() ?> materias.                         
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped"> 
                                 <thead>
                                    <tr>
                                        <th>Prg</th>
                                        <th>Año</th>
                                        <th>Materia</th>
                                        <th  style="text-align:center;">¿Tiene curso asignado?</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                            <?php   
                                $programa_anterior = '';
                                foreach($plan_estudio_programa->result() as $row):
                                    
                                    if($row->PRG!=$programa_anterior): ?>
                                        <tr >
                                            <td colspan="4" style="background:color:#000"></td>  
                                        </tr>
                                <?php   endif;

                                    if($this->Programas_model->materia_curso_asignado($row->ID, $anio_programa, $row_programa->C_IDENTIFICACION, $row_programa->C_PROGRAMA, $row_programa->C_ORIENTACION )):
                                        $clase = "class='success'";
                                        $icono = "<i class='fa fa-check'></i>";
                                    else:
                                        $clase = "class='danger'";  
                                        $icono = "<i class='fa fa-times'></i>"; 
                                    endif;
                                    ?> 

                                    

                                <tr <?=$clase?> >
                                    <td><?=utf8_encode($row->PRG)?></td>  
                                    <td><?=utf8_encode($row->ANIO)?></td>
                                    <td><?=utf8_encode($row->D_DESCRIP)?></td>
                                    <td  style="text-align:center;"><?=$icono?></td>
                                </tr>

                            <?php   
                                $programa_anterior = $row->PRG;
                                endforeach;   ?>

                            </table>
                              
                        </div>
                       
                    </div>
                </div>       
            </div> 
        </div>
    </div>
</div>


<!-- _________________ MODAL PARA MOSTRAR HISTORIAL ______________________  -->

<div class="modal fade" id="comentarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header" style=" background-color: #428BCA; color:#fff;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Comentarios anteriores</h4>
        </div>
        <div class="modal-body">
            <form id="form_comentarios" name="form_comentarios" method="post" action="<?=base_url()?>index.php/programa/procesa_agregar_comentario" >

                <input type='hidden' name='id_materia' id='id_materia' value=''/> 
                <input type='hidden' id='idUsuario' name='idUsuario' value=""/>
                <input type='hidden' name='id_curso' id='id_curso'  value=''/> 
                <input type='hidden' name='anio_lectivo' id='anio_lectivo'  value=''/>
                <input type='hidden' name='id_horario' id='id_horario'  value=''/>
                <input type='hidden' id='rol' name='rol' value=""/>

                <input type='hidden' id='c_identificacion' name='c_identificacion' value=""/>
                <input type='hidden' id='c_programa' name='c_programa' value=""/>
                <input type='hidden' id='c_orientacion' name='c_orientacion' value=""/>
                <input type='hidden' id='n_fila_curso' name='n_fila_curso' value=""/>

                
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" id="comentarios" rows="4" readonly="readonly"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="materia" class="control-label">Ingresar comentario</label>
                         <textarea name="comentario" name="comentario" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Agregar</button>
                    <a class="btn" data-dismiss="modal">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
  </div>
</div>

<!-- _________________ MODAL PARA EDITAR IMPORTE COORDINADOR ______________________  -->

<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header" style=" background-color: #428BCA; color:#fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Editar Curso</h4>
            </div>

            <form id="form_editar_curso" name="form_editar_curso" method="post" action="<?=base_url()?>index.php/programa/procesa_editar_importe_curso" >
            
            <div class="modal-body">
                <!--- hidden -->
                
                <input type='hidden' name='id_materia' id='id_materia' value=''/>
                <input type='hidden' name='id_curso' id='id_curso' value=''/>
                <input type='hidden' name='anio_lectivo' id='anio_lectivo'  value=''/>
                <input type='hidden' name='id_horario' id='id_horario'  value=''/>
                <input type='hidden' id='rol' name='rol' value="" />

                <input type='hidden' id='c_identificacion' name='c_identificacion' value=""/>
                <input type='hidden' id='c_programa' name='c_programa' value=""/>
                <input type='hidden' id='c_orientacion' name='c_orientacion' value=""/>
                <input type='hidden' id='n_fila_curso' name='n_fila_curso' value=""/>

                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Materia</label>

                    <input style="background-color:#F6CECE; border-color:#B40404;" class="form-control" name="materia" id="materia" type="text" placeholder="" disabled />
                </div>

                <div class="form-group">
                    <label for="profesor" class="control-label">Profesor</label>
                    <input style="background-color:#F6CECE; border-color:#B40404;" class="form-control" type='text' id='autocomplete' value="" name='autocomplete' disabled/>
                    <input type='hidden' id='idUsuario' name='idUsuario' value=""/>
                </div>

                <div class="form-group">
                    <label for="puntos" class="control-label" >Puntos</label>
                    <input style="background-color:#F6CECE; border-color:#B40404;" class="form-control" name="puntos" id="puntos" value="" disabled/>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    <label for="sueldo" class="control-label">Sueldos ($)</label>
                    <input style="background-color:#D8F6CE; border-color:#298A08;" class="form-control" name="sueldo" id="sueldo" value="" />
                    <div class="help-block with-errors"></div>
                </div> 

                <div class="form-group">
                    <label for="sueldo" class="control-label">Comentario</label>
                    <textarea style="background-color:#D8F6CE; border-color:#298A08;"  class="form-control" rows="3" name="comentario" id="comentario"></textarea>
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


<!-- VALIDAR COMENTARIOS -->

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.4.4.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui-1.8.10.custom.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script> 
<script>
        var q = jQuery.noConflict();
</script>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/validar_comentario_curso_importe.js" ></script> 
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/validar_confirmar_check_coordinador.js" ></script>


<script src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>
<script src="<?=base_url()?>assets/js/jquery.confirm.js"></script> 
<script src="<?=base_url()?>assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="<?=base_url()?>assets/js/morris/morris.js"></script>

    
 <!-- DATA TABLE SCRIPTS -->
<script src="<?=base_url()?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.js"></script>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/modal_informacion_programa.js" ></script> 
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/chequear_cursos_informacion_programa.js" ></script> 
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/confirmar_desconfirmar_curso.js" ></script> 


<script>

$(document).ready(function () {

    $(".header").click(function () {

    $header = $(this);
    //getting the next element
    $content = $header.next();

    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(500, function () {
        //execute this after slideToggle is done
        //change text of header based on visibility of content div
        $header.text(function () {
            //change text based on condition
            return $content.is(":visible") ? "- Minimizar" : '+ Maximizar';
        });
    });

});

<?php   if( in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) ):   ?>
    
    <?php   if($row_programa->C_IDENTIFICACION != 3): ?>

            $('.table.table-responsive.dataTables-example').dataTable({
                "paging":   false,
                "ordering": true,
                "info":     false,
                "bFilter": false,
                "aoColumnDefs": [
                                  { 'bSortable': false, 'aTargets': [ 1,6,7,8,9 ] }
                                ]

            });
 

    <?php   endif;  ?>  

<?php   endif;  ?>  

<?php   if( in_array('ROLE_TESORERIA',$this->session->userdata('roles')) ):   ?>
    
        <?php   if($row_programa->C_IDENTIFICACION != 3): ?>
        
            $('.table.table-responsive.dataTables-example').dataTable({
                "paging":   false,
                "ordering": true,
                "info":     false,
                "bFilter": false,
                "aoColumnDefs": [
                                  { 'bSortable': false, 'aTargets': [ 1,6,7,8,9,10 ] }
                                ]

            });

        <?php   endif; ?>
      
<?php   endif;  ?>  
 

});

    $('html, body').animate({
            scrollTop: $('<?=$posicion_body?>').offset().top
    }, 100);

</script>

<script>

$('[data-toggle="tooltip"]').tooltip();

</script>
<script src="<?=base_url()?>assets/js/custom.js"></script> 