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
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px">
                        <thead>
                            <tr style="padding:10px; background-color:#CEECF5;">
                                <th style="padding-right:15px;">Año</th>
                                <th style="width:20px">Prg</th>
                                <th style="width:20px">Prg<br>Comision</th>
                                <th style="width:100px">Materia</th>
                                <th style="width:50px">Profesor</th>
                                <th style="width:20px">Rol</th>
                                <th><i class="fa fa-calendar"></i> </th>
                                <th><i class="fa fa-calendar-o"></i> </th>
                                <th>Horario</th>
                                <th style="width:50px">Obs</th>
                                <th><i class="fa fa-usd"></i></th>
                                <th><i class="fa fa-usd"></i>(Coord)</th>
                                <th>Conf</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:11px">
                            <?php   foreach($cursos_sin_confirmar_coordinador->result() as $row ):  ?>
                                <tr class="odd gradeX">
                                    <td><?=$row->ANIO_LECTIVO?></td>
                                    <td><?=utf8_encode($row->PROGRAMA)?></td>
                                    <td><?=utf8_encode($row->PROGCOMISION)?></td>
                                    <td><?=utf8_encode($row->D_DESCRIP)?></td>
                                    <td><?=utf8_encode($row->NOMBRE)?></td>
                                    <td><?=$row->C_ROL?></td>
                                    <td><?=$row->F_INICIO?></td>
                                    <td><?=$row->F_FIN?></td>
                                    <td><?=utf8_encode($row->HORARIO)?></td>
                                    <td><?=utf8_encode($row->C_OBS)?></td>
                                    <td><?=$row->IMPORTE?></td>
                                    <td><?=$row->N_IMPORTE_PROFESOR?></td>
                                    <td><?=$row->C_CONFIRMADO?></td>
                                </tr>
                            <?php   endforeach; ?>
                           
                        </tbody>
                    </table>
                </div>
 

                
            </div>  
        </div>
    </div>
 <!-- /. PAGE WRAPPER  -->
</div>
 <!-- /. WRAPPER  -->



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