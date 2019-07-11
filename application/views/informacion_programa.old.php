    <?php 
    //echo $n_fila_curso;
    $row_programa = $datos_programa->row();


    if($n_fila_curso == -1)
        $posicion_body = "#page-wrapper";
    else
        $posicion_body = "#curso_".$n_fila_curso;

    //echo $posicion_body;

    //echo "aca: ".export_to_xls($cursos_asignados);
     
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
                    <a href="<?=base_url()?>index.php/programa/exportar_cursos_asignados_excel/<?=$anio?>/<?=$c_identificacion?>/<?=$c_programa?>/<?=$c_orientacion?>"> Exportar <i class="fa fa-file"> ( XLS )</i> </a>
                </li>
            </ul>
            
            <div class="tab-content" style='margin-top:20px'>                                     
                <!-- CURSOS DE SIGEU -->
                <div class="tab-pane fade active in" id="cursos_sigeu" style='margin-top:10px;'>
               
                    <?php  if($row_programa->C_IDENTIFICACION == 1): // GRADO ?>
                            
                            <div class="col-md-12"> <!--1er semestre -->
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Primer semestre
                                    </div>

                                    <div class="panel-body">                                
                                        <?=mostrar_cursos($cursos_asignados,1,1)?>                               
                                    </div>
                                     <div class="panel-footer">
                                        Cursos cargados al dia: <?=date('d-m-Y')?>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-md-12"> <!--2do semestre -->
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

                            <div class="col-md-12"> <!--1er Trimestre -->
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Primer Trimestre
                                    </div>

                                    <div class="panel-body">
                                        <?=mostrar_cursos($cursos_asignados,1,2)?>    
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-12"> <!--2do Trimestre -->
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Segundo Trimestre
                                    </div>

                                    <div class="panel-body">
                                       <?=mostrar_cursos($cursos_asignados,2,2)?>    
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-12"> <!--3er Trimestre -->
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
                            
                            <div class="col-md-12"> <!--1er semestre -->
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Año en curso
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

    <script language="javascript" type="text/javascript" >

        q(function(){

                q('#form_comentarios').validate({

                    rules :{

                            comentario : {
                                required : true
                            }
                    },
                    messages : {

                            comentario : {
                                required : "Debe ingresar un comentario."
                            }
                    }

                });    
        }); 

        q(function(){

            q('#form_editar_curso').validate({

                rules :{

                        autocomplete : {
                            required : true
                        },
                        puntos : {
                            required : true,
                            number: true
                        },
                        sueldo : {
                            required : true,
                            number: true
                        }
                },
                messages : {

                        autocomplete : {
                            required : "Debe ingresar el profesor."
                        },

                        puntos : {
                            required :  "Debe ingresar los puntos.",
                            number: "Debe ingresar un numero."
                        },
                        sueldo : {
                            required :  "Debe ingresar el sueldo.",
                            number: "Debe ingresar un numero."
                        }
                }

            });    
        }); 

      

        q(function(){

                q('#form_editar_importe').validate({

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

    <!-- VALIDAR CHECHKBOX -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.10.custom.min.js"></script>

    <script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
    <script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script> 

    <script>
        var jq = jQuery.noConflict();

        jq(function(){  

                        
                        jq('.btn.btn-danger.btn-xs.submit').click(function() {

                            buttonpressed = $(this).attr('name');
                            
                            //alert(buttonpressed);
                            
                            buttonpressed = '#'+buttonpressed;
                            error = '#error_'+buttonpressed;

                            jq(buttonpressed).validate({

                                    rules : {
                                            'check_confirma_coordinador[]' : {
                                                required : true 
                                            }                
                                    },
                                    messages : {
                                            'check_confirma_coordinador[]' : {
                                                required : "Debe Seleccionar algun curso"
                                            }
                                    },
                                    errorLabelContainer: error
                            }); 

                        }); 


                    });

    </script>


    <!-- JQUERY SCRIPTS -->
    <script src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>
    
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    
    <!-- METISMENU SCRIPTS -->
    <script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>

    <!-- CONFIRMA -->
    <script src="<?=base_url()?>assets/js/jquery.confirm.js"></script> 

    <!-- MORRIS CHART SCRIPTS -->
    <script src="<?=base_url()?>assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/js/morris/morris.js"></script>

        
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?=base_url()?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript">
  CI_ROOT = "<?=base_url() ?>";
</script>

    <?php 
    if(in_array('ROLE_TESORERIA',$this->session->userdata('roles')) || in_array('ROLE_COORDINADOR',$this->session->userdata('roles'))): ?>
    
        <script>
            $(document).ready(function () {
                
                $('.table.table-responsive.dataTables-example').dataTable({
                    "paging":   false,
                    "ordering": true,
                    "info":     false,
                    "bFilter": false,
                    "aoColumnDefs": [
                                      { 'bSortable': false, 'aTargets': [ 7,8,9 ] }
                                    ]

                });


                $('html, body').animate({
                        scrollTop: $('<?=$posicion_body?>').offset().top
                    }, 100);

            });
        </script>
    
<?php   else: ?>
        
        <script>
           $(document).ready(function () {
                $('.table.table-responsive.dataTables-example').dataTable({
                    "paging":   false,
                    "ordering": true,
                    "info":     false,
                    "bFilter": false
                });
            });
        </script>

<?php   endif; ?>


    <link   type="text/css" href="<?php echo base_url(); ?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 

       
    <script>

 


    $(document).ready(function() {

        $('.check_all_confirm').change(function(){
            var checkboxes = $(this).closest('form').find('.check_confirma_coordinador');
            if($(this).prop('checked')) {
              checkboxes.prop('checked', true);
            } else {
              checkboxes.prop('checked', false);
            }
        });

        $('.check_all_default_tesoreria').change(function(){
            var checkboxes = $(this).closest('form').find('.check_importe_default');
            if($(this).prop('checked')) {
              checkboxes.prop('checked', true);
            } else {
              checkboxes.prop('checked', false);
            }
        });

        $('.check_all_coordinador_tesoreria').change(function(){
            var checkboxes = $(this).closest('form').find('.check_importe_coordinador');
            if($(this).prop('checked')) {
              checkboxes.prop('checked', true);
            } else {
              checkboxes.prop('checked', false);
            }
        });
        
        /*
                MODAL PARA EDITAR CON AJAX.
        */

        // $('[data-toggle="ajaxModal"]').on('click',
        //       function(e) {
        //         $('#ajaxModal').remove();
        //         e.preventDefault();
        //         var $this = $(this)
        //           , $remote = $this.data('remote') || $this.attr('href')
        //           , $modal = $('<div class="modal fade" style="width:500px; margin-top: 30px;  margin-bottom: auto;  margin-left: auto;  margin-right: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  id="ajaxModal"><div class="modal-body"></div></div>');
        //         $('body').append($modal);
        //         $modal.modal({keyboard: false});
        //         $modal.load($remote);
        //       }
        // );
         
        // $('[data-toggle="ajaxModalHistorial"]').on('click',
        //       function(e) {
        //         $('#ajaxModalHistorial').remove();
        //         var myBookId = $(this).data('id');
        //         e.preventDefault();
        //         var $this = $(this)
        //           , $remote = $this.data('remote') || $this.attr('href')
        //           , $modal = $('<div class="modal fade" style="width:600px; margin-top:20px;  margin-left: auto;  margin-right: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  id="ajaxModal"><div class="modal-body"></div></div>');
        //         $('body').append($modal);
        //         $modal.modal({backdrop: 'static', keyboard: false});
        //         $modal.load($remote);
        //       }
        // );


        // MODAL PARA COMENTARIOS 

        $('#comentarioModal').on('show.bs.modal', function (event) {
        
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
            var n_fila_curso = array_json.n_fila_curso; 
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
            modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);

            comentarios_mod = comentarios.replace(/\|/g, " \n");
        
            modal.find('#comentarios').val(comentarios_mod);
        })

        // MODAL PARA EDITAR CURSOS

        $('#editarModal').on('show.bs.modal', function (event) {
        
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            console.dir(cadena_json_recibida);

            cadena_json_correcta = cadena_json_recibida.replace(/\*/g, "\"");
            cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);

            array_json = JSON.parse(cadena_json_correcta);

            var id_materia = array_json.id_materia;
            var nombre_materia = array_json.nombre_materia;
            var id_profesor = array_json.id_profesor; 
            var nombre_profesor = array_json.nombre_profesor;
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
            console.log(nombre_materia);
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
            modal.find('#materia').val(nombre_materia);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#puntos').val(puntos);
            modal.find('#sueldo').val(sueldo);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            modal.find('#autocomplete').val(nombre_profesor);
            
            modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);

            comentarios_mod = comentarios.replace(/\|/g, " \n");
        
            modal.find('#comentarios').val(comentarios_mod);
            
    
        })

        $('#importeTesoreriaModal').on('show.bs.modal', function (event) {
        
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            console.dir(cadena_json_recibida);

            cadena_json_correcta = cadena_json_recibida.replace(/\*/g, "\"");
            cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);

            array_json = JSON.parse(cadena_json_correcta);

            var id_materia = array_json.id_materia;
            var nombre_materia = array_json.nombre_materia;
            var id_profesor = array_json.id_profesor; 
            var nombre_profesor = array_json.nombre_profesor;
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
            console.log(nombre_materia);
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
            modal.find('#materia').val(nombre_materia);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#puntos').val(puntos);
            modal.find('#sueldo').val(sueldo);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            modal.find('#autocomplete').val(nombre_profesor);
            
            modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);

            comentarios_mod = comentarios.replace(/\|/g, " \n");
        
            modal.find('#comentarios').val(comentarios_mod);
            
    
        })

        
        /*    

        jq('#profesor').autocomplete({
                source:'<?php echo site_url('programa/ajax_profesor'); ?>',
                select: function(event, ui) {
                    //alert(ui.item ? "Selected: " + ui.item.id : "Nothing selected, input was " + this.value );
                    jq('input[name="idUsuario"]').val(ui.item.id);
                }
        });


        jq('#materia').autocomplete({
                source:'<?php echo site_url('programa/ajax_materia'); ?>'+'/'+jq('#c_identificacion').val()+'/'+jq('#c_programa').val()+'/'+jq('#c_orientacion').val()+'/programa',
                select: function(event, ui) {
                    //alert(ui.item ? "Selected: " + ui.item.id : "Nothing selected, input was " + this.value );
                    jq('input[name="idMateria"]').val(ui.item.id);
                }
        });


        jq('#form_nuevo_curso').validate({

                rules :{

                        materia : {
                            required : true
                        },
                        profesor : {
                            required : true
                        }
                },
                messages : {

                        materia : {
                            required : "Debe ingresar la materia."
                        },
                        profesor : {
                            required :  "Debe ingresar el profesor."
                        }
                }

            });    
        */
    
    });

    /*
    $(function(){
               

        $(".desconfirmar").confirm({
            text: "¿Seguro que desea desconfirmar el curso?",
            confirmButton: "Si",
            cancelButton: "No",
        });
    
    });*/

    function confirmarCurso(id_curso, anio_lectivo, id_horario, id_profesor ,rol, c_identificacion, c_programa, c_orientacion, n_fila_curso)
    {   
        $.ajax({
                    type: 'POST' ,
                    url: CI_ROOT+'index.php/programa/confirmar_curso',
                    data: { id_curso: id_curso, 
                            anio_lectivo: anio_lectivo, 
                            id_horario : id_horario, 
                            rol : rol, 
                            idUsuario : id_profesor
                          },
                    async: false,
                    dataType: 'JSON',
                    crossDomain: true,
                    success: function(data)
                    {
                        if(data.error == false)
                        {
                           window.location.replace(CI_ROOT+'index.php/programa/index/'+c_identificacion+'/'+c_programa+'/'+c_orientacion+'/'+n_fila_curso+'/'+data.mensaje);
                        }
                        else
                        {
                          alert(data.mensaje);
                        }
                      },
                      error: function(x, status, error){
                        alert("No se ejecuto la confirmacion");
                    } 
                
                });
    }

     function desconfirmarCurso(id_curso, anio_lectivo, id_horario, id_profesor ,rol, c_identificacion, c_programa, c_orientacion, n_fila_curso)
    {   
        
        $.ajax({
                    url: CI_ROOT+'index.php/programa/desconfirmar_curso',
                    data: { id_curso: id_curso, 
                            anio_lectivo: anio_lectivo, 
                            id_horario : id_horario, 
                            rol : rol, 
                            idUsuario : id_profesor
                          },
                    async: false,
                    type: 'POST' ,
                    dataType: 'JSON',
                    success: function(data)
                    {
                        if(data.error == false)
                        {
                           window.location.replace(CI_ROOT+'index.php/programa/index/'+c_identificacion+'/'+c_programa+'/'+c_orientacion+'/'+n_fila_curso+'/'+data.mensaje);
                        }
                        else
                        {
                          alert(data.mensaje);
                        }
                      },
                      error: function(x, status, error){
                        alert("No se ejecuto la confirmacion");
                    } 
                
                });
    }



    $('[data-toggle="tooltip"]').tooltip();
  
    </script>

    <!-- CUSTOM SCRIPTS -->
    <script src="<?=base_url()?>assets/js/custom.js"></script> 