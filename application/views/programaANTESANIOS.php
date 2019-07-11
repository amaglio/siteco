<?php 
    $row_carrera = $datos_programa->row();
    $programa = $this->uri->segment(3);
    $programa = $row_carrera->D_DESCRED;

    $resultado_programa = $this->Programas_model->datos_programa($row_carrera->D_DESCRED);

    $row_programa = $resultado_programa->row();

    echo $vista_head;

    ?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >

             <div id="page-inner" style="margin:0px; ">

                <div class="row">
                    <div class="col-md-12" >
                        <h3><strong> <?=" [ ".utf8_encode($row_carrera->D_DESCRED)." ] - ".utf8_encode($row_carrera->D_DESCRIP)?></p></strong></h3>   
                    </div>
                </div>  
                                
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="nav nav-pills">
                                    <li class="active" class="">
                                        <a href="#home-obliga" data-toggle="tab"> Cursos en SIGEU</a>
                                    </li>
                                    <li class="">
                                        <a href="#profile-pills" data-toggle="tab"> Cargar Cursos  </a>
                                    </li>
                                    <li class="">
                                        <a href="#cursos_cambiados" data-toggle="tab"> Cursos Cambiados  </a>
                                    </li>
                                </ul>

                                <div class="tab-content" style='margin-top:20px'>                                     
                                    <!-- CURSOS DE SIGEU -->
                                    <div class="tab-pane fade active in" id="home-obliga" style='margin-top:10px;'>


                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    Primer semestre
                                                </div>

                                                <div class="panel-body">
                                                      
                                                    <?php        
                                                        $anio_anterior = 0;
                                                        get_instance()->load->helper('general_helper');

                                                        foreach ($cursos_asignados->result() as $curso) : 

                                                            $materia=utf8_encode($curso->D_DESCRIP);

                                                            $id_materia = $curso->N_ID_MATERIA;
                                                            $id_profesor = $curso->N_ID_PERSONA;
                                                            $id_curso = $curso->N_CURSO;
                                                            $anio_lectivo = $curso->ANIO_LECTIVO;
                                                            $id_horario = $curso->N_ID_HORARIO;
                                                            $rol = $curso->C_ROL;
                                                            $confirmado = 0;
                                                            $clase_modificacion = '';

                                                            if($this->Programas_model->existe_registro_materia($id_curso, $anio_lectivo, $id_profesor, $id_horario, $rol))
                                                            {
                                                                $curso_crm = $this->Programas_model->traer_informacion_curso_crm($id_curso, $anio_lectivo, $id_profesor, $id_horario, $rol);
                                                                $puntos = $curso_crm->N_PUNTOS;
                                                                $confirmado = $curso_crm->B_CONFIRMADO;
                                                                $sueldo = $curso_crm->N_IMPORTE;
                                                                $clase_modificacion = 'text-align:center; color:red; color-weight:bold; width:50px; padding:5px; border-right:1px solid #9FC5CC;';
                                                            }
                                                            else
                                                            {  
                                                                $fulltime = $this->Programas_model->profesor_fulltime($curso->N_ID_PERSONA);
                                                                $puntos = substr(calcular_puntos($curso->C_IDENTIFICACION, $curso->C_TIPO_CLASE, $curso->C_ROL, $fulltime, $curso->C_ORIENTACION ),0,6);
                                                                $sueldo = ceil($puntos*16950);
                                                                $clase_modificacion = 'text-align:center; width:50px; padding:5px; border-right:1px solid #9FC5CC;';
                                                            }

                                                            $rol = rawurlencode($curso->C_ROL);
                                                            
                                                            $nombre=utf8_encode($curso->NOMBRE);

                                                            if($curso->N_PERIODO == 1 ): // Primer Trimestre
                                                                
                                                                if($curso->ANIO != $anio_anterior ): // Cambia de Año ?>
                                                                    <div class='label label-default' style='margin:10px; float:left; '> Año: <?=$curso->ANIO?> </div>
                                                            <?php   endif; 
                                                                
                                                                $anio_anterior = $curso->ANIO ;  

                                                                if($confirmado)
                                                                    $class_panel = 'panel panel-success';
                                                                else
                                                                    $class_panel = 'panel panel-info';
                                                                ?>


                                                               
                                                                <div class="col-md-12" >
                                                                     <div class="<?=$class_panel?>" style='margin-bottom:2px; width:100%'>
                                                                        <div class="panel-heading" >
                                                                            <table style='font-size:12px'>
                                                                                <tr>
                                                                                    <td style=' width:190px; padding:5px; border-right:1px solid #9FC5CC;'><?=$materia?><td>
                                                                                    <td style='width: 50px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->COMISION);?><td>
                                                                                    <td style='width: 70px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->HORARIO);?><td>
                                                                                    <td style='width:150px; padding:5px; border-right:1px solid #9FC5CC;'><?=$nombre?><td>
                                                                                    <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->C_ROL);?><td>
                                                                                    <td style='<?=$clase_modificacion?>' ><?=$puntos?><td>
                                                                                    <td style='<?=$clase_modificacion?>' ><?='$'.$sueldo?><td>
                                                                                    <td style='width:120px; padding:5px; border-right:1px solid #9FC5CC;'>
                                                                                                                <a style="width:70px;"  data-toggle="ajaxModalHistorial" href="<?=base_url()?>index.php/programa/historial_curso/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$programa?>" ><i class="fa fa-comment fa-2x"></i> </a>  
                                                                                                                <?php  
                                                                                                                    $comentarios = $this->Programas_model->ver_cursos_comentarios($id_curso, $anio_lectivo, $id_profesor, $id_horario, rawurldecode($rol)); 
                                                                                                                    echo "(".$comentarios->num_rows().")";
                                                                                                                ?>                                                                                                                        
                                                                                    <td>
                                                                                    <td style='width:70px; padding:5px; '> 
                                                                                        
                                                                                        <?php   if($confirmado): ?>

                                                                                                <i class="fa fa-check-square-o fa-2x"></i> 
                                                                                                <a id='desconfirmar[]' class="desconfirmar"  href="<?=base_url()?>index.php/programa/desconfirmar_curso/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$programa?>" ><i class="fa fa-undo fa-2x"  style="margin-left:5px; color:#FA5858;"></i></a>

                                                                                        
                                                                                       <?php    else: ?>
                                                                                        
                                                                                                <div style='width:70px; margin-bottom:5px; float:left;'><a style='width:70px;' id='confirmar[]' class="btn btn-success btn-xs" href="<?=base_url()?>index.php/programa/confirmar_curso/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$programa?>" >Confirmar</a></div>               
                                                                                                <div style='width:70px; float:left;'><a style="width:70px;" class="btn btn-primary btn-xs" data-toggle="ajaxModal"  href="<?=base_url()?>index.php/programa/editar_programa/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$programa?>" >Editar</a></div>   

                                                                                        <?php   endif; ?>
                                                                                           
                                                                                    <td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                            endif;
                                                        
                                                        endforeach;  
                                                    ?> 



                                                </div>
                                                 <div class="panel-footer">
                                                    Cursos cargados al dia: 16/10/2014
                                                </div>
                                               
                                            </div>
                                        </div>

                                      
                                
                       
                                        <!-- SEGUNDO CUATRIMESTRE  -->
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    Segundo semestre
                                                </div>

                                                <div class="panel-body">
                                                      
                                                    <?php        
                                                        $anio_anterior = 0;
                                                        get_instance()->load->helper('general_helper');

                                                        foreach ($cursos_asignados->result() as $curso) : 

                                                            $materia=utf8_encode($curso->D_DESCRIP);

                                                            $id_materia = $curso->N_ID_MATERIA;
                                                            $id_profesor = $curso->N_ID_PERSONA;
                                                            $id_curso = $curso->N_CURSO;
                                                            $anio_lectivo = $curso->ANIO_LECTIVO;
                                                            $id_horario = $curso->N_ID_HORARIO;
                                                            $rol = $curso->C_ROL;
                                                            $confirmado = 0;

                                                            if($this->Programas_model->existe_registro_materia($id_curso, $anio_lectivo, $id_profesor, $id_horario, $rol))
                                                            {
                                                                $curso_crm = $this->Programas_model->traer_informacion_curso_crm($id_curso, $anio_lectivo, $id_profesor, $id_horario, $rol);
                                                                $puntos = $curso_crm->N_PUNTOS;
                                                                $confirmado = $curso_crm->B_CONFIRMADO;
                                                                $sueldo = $curso_crm->N_IMPORTE;
                                                            }
                                                            else
                                                            {  
                                                                $fulltime = $this->Programas_model->profesor_fulltime($curso->N_ID_PERSONA);
                                                                $puntos = substr(calcular_puntos($curso->C_IDENTIFICACION, $curso->C_TIPO_CLASE, $curso->C_ROL, $fulltime, $curso->C_ORIENTACION ),0,6);
                                                                $sueldo = ceil($puntos*16950);
                                                            }

                                                            $rol = rawurlencode($curso->C_ROL);
                                                            
                                                            $nombre=utf8_encode($curso->NOMBRE);

                                                            if($curso->N_PERIODO == 2 ): // Primer Trimestre
                                                                
                                                                if($curso->ANIO != $anio_anterior ): // Cambia de Año ?>
                                                                    <div class='label label-default' style='margin:10px; float:left; '> Año: <?=$curso->ANIO?> </div>
                                                            <?php   endif; 
                                                                
                                                                $anio_anterior = $curso->ANIO ;  

                                                                if($confirmado)
                                                                    $class_panel = 'panel panel-success';
                                                                else
                                                                    $class_panel = 'panel panel-info';
                                                                ?>


                                                               
                                                                <div class="col-md-12" >
                                                                     <div class="<?=$class_panel?>" style='margin-bottom:2px; width:100%'>
                                                                        <div class="panel-heading" >
                                                                            <table style='font-size:12px'>
                                                                                <tr>
                                                                                    <td style=' width:190px; padding:5px; border-right:1px solid #9FC5CC;'><?=$materia?><td>
                                                                                    <td style='width: 50px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->COMISION);?><td>
                                                                                    <td style='width: 70px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->HORARIO);?><td>
                                                                                    <td style='width:150px; padding:5px; border-right:1px solid #9FC5CC;'><?=$nombre?><td>
                                                                                    <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC;'><?=utf8_encode($curso->C_ROL);?><td>
                                                                                    <td style='width:50px; padding:5px; border-right:1px solid #9FC5CC;'><?=$puntos?><td>
                                                                                    <td style='width:60px; padding:5px; border-right:1px solid #9FC5CC;'><?='$'.$sueldo?><td>
                                                                                    <td style='width:120px; padding:5px; border-right:1px solid #9FC5CC;'> <a style="width:70px;"  data-toggle="ajaxModalHistorial" href="<?=base_url()?>index.php/programa/historial_curso/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$programa?>" ><i class="fa fa-comment fa-2x"></i> </a>  <td>
                                                                                    <td style='width:70px; padding:5px; '> 
                                                                                        
                                                                                        <?php   if($confirmado): ?>

                                                                                                <i class="fa fa-check-square-o fa-2x"></i>
                                                                                        
                                                                                       <?php    else: ?>
                                                                                        
                                                                                                <div style='width:70px; margin-bottom:5px; float:left;'><a style='width:70px;' id='confirmar[]' class="btn btn-success btn-xs" href="<?=base_url()?>index.php/programa/confirmar_curso/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$programa?>" >Confirmar</a></div>               
                                                                                                <div style='width:70px; float:left;'><a style="width:70px;" class="btn btn-primary btn-xs" data-toggle="ajaxModal" href="<?=base_url()?>index.php/programa/editar_programa/<?=$id_materia?>/<?=$id_profesor?>/<?=$id_curso?>/<?=$anio_lectivo?>/<?=$puntos?>/<?=$id_horario?>/<?=$rol?>/<?=$sueldo?>/<?=$programa?>" >Editar</a></div>          
                                                                                        
                                                                                        <?php   endif; ?>
                                                                                           
                                                                                    <td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                            endif;
                                                        
                                                        endforeach;  
                                                    ?> 



                                                </div>
                                                 <div class="panel-footer">
                                                    Cursos cargados al dia: 16/10/2014
                                                </div>
                                               
                                            </div>
                                        </div>

                                    </div>

                                    <!-- CARGAR CURSOS -->
                                    <div class="tab-pane fade" id="profile-pills">
                                        
                                        <div class="col-md-6">
                                                    
                                                <form id="form_nuevo_curso" name="form_nuevo_curso" method="post" action="<?=base_url()?>index.php/programa/procesa_nuevo_curso" >
                                                    
                                                    <input type='hidden' id='c_identificacion' name='c_identificacion' value="<?=$row_programa->C_IDENTIFICACION?>"/>
                                                    <input type='hidden' id='c_orientacion' name='c_orientacion' value="<?=$row_programa->C_ORIENTACION?>"/>
                                                    <input type='hidden' id='c_programa' name='c_programa' value="<?=$row_programa->C_PROGRAMA?>"/>

                                                    <label>Semestre</label>
                                                    <select class="form-control" id='semestre' name="semestre">
                                                        <option value="1">1er semestre</option>
                                                        <option value="2">2do semestre</option>
                                                    </select></br>

                                                    <label>Año</label>
                                                    <select class="form-control" id='anio' name="anio">
                                                        <option value="<?=date('Y')?>"><?=date('Y')?></option>
                                                        <option value="<?=date('Y')+1?>" selected=""><?=date('Y')+1?></option>
                                                    </select></br>

                                                    <label for='materia'>Materia: </label>
                                                    <input class="form-control" type='text' id='materia' name="materia"></br>
                                                    <input type='hidden' id='idMateria' name='idMateria'/>
                                                   
                                                    <label>Tipo de Clase</label>
                                                    <select class="form-control" id="tipo_clases" name="tipo_clases">
                                                        <option value="Teorica">Teorica</option>
                                                        <option value="Practica">Practica</option>
                                                        <option value=" Consulta y Repaso">Consulta y Repaso</option>
                                                    </select></br>

                                                    <label for='profesor'>Profesor: </label><input   class="form-control" type='text' id='profesor' name="profesor"></p>
                                                    <input type='hidden' id='idUsuario' name='idUsuario'/>

                                                    <label>Tipo de Profesor</label>
                                                    <select class="form-control" id="tipo_profesor" name="tipo_profesor">
                                                        <option>Titular</option>
                                                        <option>Ayudante</option>
                                                    </select></br>
                                                    
                                                    <label for="sueldo" class="control-label">Valor ($)</label>
                                                    <input class="form-control" name="sueldo" id="sueldo" type="text" placeholder="Valor" /></br>

                                                    <button type="submit" class="btn btn-primary">Cargar</button>
                                                                                           
                                                </form> 

                                        </div>


                                    </div>

                                    <!-- CARGAR CAMBIADOS -->
                                    <div class="tab-pane fade" id="cursos_cambiados">
                                        
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    Cursos que cambiaron el PROFESOR
                                                </div>

                                                <div class="panel-body">
                                                      

                                                </div>
                                                 <div class="panel-footer">
                                                    Cursos cargados al dia: 16/10/2014
                                                </div>
                                               
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    Cursos que cambiaron el HORARIO
                                                </div>

                                                <div class="panel-body">
                                                      

                                                </div>
                                                 <div class="panel-footer">
                                                    Cursos cargados al dia: 16/10/2014
                                                </div>
                                               
                                            </div>
                                        </div>
                                
                                </div>

                            </div>
                        </div>
                    </div>
                </div>  
             </div>
        </div>
         <!-- /. PAGE WRAPPER  -->
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

       
    <script>

    $(document).ready(function() {
        
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

       
    
    });

        $(function(){
                   

            $(".btn.btn-success.btn-xs").confirm({
                text: "¿Seguro que desea confirmar el curso?",
                confirmButton: "Si",
                cancelButton: "No",
            });

            $(".desconfirmar").confirm({
                text: "¿Seguro que desea desconfirmar el curso?",
                confirmButton: "Si",
                cancelButton: "No",
            });
        
        });

  
    </script>

    <!-- CUSTOM SCRIPTS -->
    <script src="<?=base_url()?>assets/js/custom.js"></script> 

</body>
</html>