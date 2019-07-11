<?php 

echo $vista_head;

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
     <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-12 col-lg-12 ">
                <h4>  <i class="fa fa-th-list"></i> - <strong> Cursos sin confirmar </h4>   
            </div>
     </div>  

     <div id="page-inner" style="padding:10px !important; ">                 
                        
        <div class="row" style="padding:10px;">
            
            <div class="col-md-12" >
 
                <div class="table-responsive" >
                    
                    <form  name="enviar_email_cursos_sin_confirmar" method="post" class="enviar_email_cursos_sin_confirmar" action="<?=base_url()?>index.php/programas/enviar_email_cursos_sin_confirmar/" >

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px">
                        <thead>
                            <tr style="padding:10px; background-color:#CEECF5;">
                                <th style="padding-right:15px;">Año</th>
                                <th style="width:20px">Prg</th>
                                <th style="width:20px">Prg<br>Comision</th>
                                <th style="width:100px">Materia</th>
                                <th style="width:50px">Profesor</th>
                                <th style="width:20px">Rol</th>
                                <th><i class="fa fa-calendar"></i> Inicio </th>
                                <th><i class="fa fa-calendar-o"></i> Fin </th>
                                <th>Clase</th>
                                <th style="width:50px">Obs</th>
                                <th><i class="fa fa-usd"></i></th>
                                <th><i class="fa fa-usd"></i></th>
                                <th>Enviar <input name="check_all_confirm" id="check_all_confirm" class="check_all_confirm" type="checkbox"></th>
                            </tr>
                        </thead>
                        <tbody style="font-size:12px">


                            <?php   foreach($cursos_sin_confirmar_coordinador->result() as $row ):  
                                            $cadena_curso = json_encode($row->D_DESCRIP);
                                            //var_dump($row);
                            ?>
                                            <tr>
                                                <td><?=$row->ANIO_LECTIVO?></td>
                                                <td><?=utf8_encode($row->PROGRAMA)?></td>
                                                <td><?=utf8_encode($row->PROGCOMISION)?></td>
                                                <td><?=utf8_encode($row->D_DESCRIP)?></td>
                                                <td><?=utf8_encode($row->NOMBRE)?></td>
                                                <td><?=$row->C_ROL?></td>
                                                <td><?=$row->F_INICIO?></td>
                                                <td><?=$row->F_FIN?></td>
                                                <td><? echo $this->Programas_model->traer_clases_pejypac($row->C_IDENTIFICACION , $row->N_CURSO, $row->ID_PROFESOR , $row->ANIO_LECTIVO,$row->N_ID_HORARIO);  ?></td>
                                                <td><?=utf8_encode($row->C_OBS)?></td>
                                                <td><?=$row->IMPORTE?></td>
                                                <td><?=$row->N_IMPORTE_PROFESOR?></td>
                                                <td><input class="check_confirma_coordinador" name="check_confirma_coordinador[]" type="checkbox" value="<?=$cadena_curso?>" ></td>
                                            </tr>
                            <?php   endforeach; ?>
                           
                          
                        </tbody>
                    </table>
                     </form>
                </div>
 

                
            </div>  
        </div>
        <div class="row" style="padding:10px;">

            <input class="btn btn-primary" type="submit" value="Enviar Email">            

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
                        "sSearch": " Buscar    ",
                        "oPaginate": {
                                        "sNext": "Proxima pagina",
                                        "sPrevious": "Pagina anterior"
                                      }
                    }
                } );
        });


       
</script>

<!-- CUSTOM SCRIPTS -->
    <script src="<?=base_url()?>assets/js/custom.js"></script> 

</body>
</html>