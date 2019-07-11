<?php 

echo $vista_head;
//

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

     <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-1" style="color:#8BC53F; width:25px;">
                <h4>  <i class="fa fa-th-list"></i></h4>   
            </div>
            <div class="col-md-11" style="text-align:left;">
                 <h4> <strong> <p style=" line-height:20px">   Cursos sin confirmar </strong>  </p>
            </div>
     </div>  

     <div id="page-inner" style="margin:0px; ">            

        <?  if($mensaje): ?>
                
                <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong> <?=$mensaje?> </strong>
                </div>

        <?  endif; ?>
                        
        <div class="row">
            
            <div class="col-md-12">
 
                <div class="table-responsive">

                    <form  name="enviar_email_cursos_sin_confirmar" id="enviar_email_cursos_sin_confirmar" method="post" class="enviar_email_cursos_sin_confirmar" action="<?=base_url()?>index.php/programa/enviar_email_cursos_sin_confirmar/" >
 
                    <input type="submit" class="btn btn-primary" value="Enviar email recordatorio" style="margin-bottom:20px;" id="boton_enviar">

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px,">
                        <thead>
                            <tr style="padding:10px; background-color:#CEECF5;">
                                <th style="padding-right:15px;">Año</th>
                                <!--<th style="width:20px">Prg</th>-->
                                <th style="width:20px">Prg<br>Comision</th>
                                <th style="width:100px">Materia</th>
                                <th style="width:50px">Profesor</th>
                                <th style="width:20px">Rol</th>
                                <th style="width:70px"> Inicia <br>Curso </th>
                                <th style="width:70px"> Clase </th>
                                <!--<th>Horario</th>-->
                                <th style="width:50px">Obs</th>
                                <th><i class="fa fa-usd"></i></th>
                                <th><i class="fa fa-usd"></i>(Coord)</th> 
                                <th> <input name="check_all_confirm" id="check_all_confirm" class="check_all_confirm" type="checkbox"></th>
                            </tr>
                        </thead>
                        <tbody style="font-size:11px">
                            <?php   foreach($cursos_sin_confirmar_coordinador->result() as $row ):  

                                    $cadena_curso = generar_json_enviar_email_cursos_sin_confirmar($row);
                 
                            ?>
                                <tr class="odd gradeX">
                                    <td><?=$row->ANIO_LECTIVO?></td>
                                    <!--<td><?=utf8_encode($row->PROGRAMA)?></td>-->
                                    <td><?=utf8_encode($row->PROGCOMISION)?></td>
                                    <td><?=utf8_encode($row->D_DESCRIP)?></td>
                                    <td><?=utf8_encode($row->NOMBRE)?></td>
                                    <td><?=$row->C_ROL?></td>
                                    <td><?php if($row->C_IDENTIFICACION != 3) echo $row->F_INICIO; ?></td>
                                    <td><?php 
                                            if($row->C_IDENTIFICACION == 3)
                                               echo  $this->Profesor_model->buscar_clases_profesor_curso($row->C_IDENTIFICACION,  $row->N_CURSO, $row->N_ID_PERSONA, $row->ANIO_LECTIVO );
                                        ?>
                                    </td>
                                    <!--<td><?=utf8_encode($row->HORARIO)?></td>-->
                                    <td><?=utf8_encode($row->C_OBS)?></td>
                                    <td><?=$row->IMPORTE?></td>
                                    <td><?=$row->N_IMPORTE_PROFESOR?></td> 
                                    <td style="text-align:center">
                                        <?=$row->ID_PERSONA_COORDINADOR?>
                                        <input class="check_confirma_coordinador" name="check_confirma_coordinador[]" type="checkbox" value="<?=$cadena_curso?>" >
                                    </td>
                                </tr>
                            <?php   endforeach; ?>
                           
                        </tbody>
                    </table>
                    </form>
                </div>
 

                
            </div>  
        </div>
    </div>
 <!-- /. PAGE WRAPPER  -->
</div>
 <!-- /. WRAPPER  -->




<!-- JQUERY SCRIPTS -->
<script src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>

<script type="text/javascript">
    
     $('.check_all_confirm').change(function(){
            var checkboxes = $(this).closest('form').find('.check_confirma_coordinador');
            

            if($(this).prop('checked')) {
              checkboxes.prop('checked', true);
            } else {
              checkboxes.prop('checked', false);
            }
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


<link type="text/css" href="<?php echo base_url(); ?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 

     <!-- TABLE STYLES-->
<link type="text/css" href="<?php echo base_url(); ?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="<?=base_url()?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable( {
                    "language": {
                        "lengthMenu": "Mostrando _MENU_ cursos por pagina.",
                        "zeroRecords": "Ningun curso fue encontrado.",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Ningun curso disponible",
                        "infoFiltered": "(Filtrado de _MAX_ cursos totales)",
                        "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ contactos",
                        "sSearch": " Buscar    ",
                        "oPaginate": {
                                        "sNext": "Proxima pagina",
                                        "sPrevious": "Pagina anterior"
                                      },
                       
                    },
                    "lengthMenu": [ [10, 50, 100, -1], [10, 50, 100, "All"] ],
                    'iDisplayLength': 100,
                    "aoColumnDefs": [
                                      { 'bSortable': false, 'aTargets': [ 10] }
                                    ]

                } );
        });
</script>

<!-- CUSTOM SCRIPTS -->
<script src="<?=base_url()?>assets/js/custom.js"></script> 

<!-- Validate -->

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.10.custom.min.js"></script>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script> 

<script>

var jq = jQuery.noConflict();

</script>

<script type="text/javascript">

    // Editar extra
    jq('#enviar_email_cursos_sin_confirmar').validate({


        rules :{

                "check_confirma_coordinador[]": {
                    required : true 
                }  
        },
        messages : {

                "check_confirma_coordinador[]" : {
                    required : "Seleccione un curso." 
                }  
        },
        errorPlacement: function(error, element) 
        {
            error.insertAfter("#boton_enviar");
            /*
            if (element.attr("name") == "tipo_postulacion")
            {
                error.insertAfter("div#last_radio");
            }
            else
            {
                error.insertAfter(element);
            }*/
        }
    }); 

</script>

</body>
</html>