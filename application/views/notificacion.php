<?php 

echo $vista_head;

?>
<link type="text/css" href="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
     <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-12 col-lg-12 ">
                <h4>  <i class="glyphicon glyphicon-bell "></i> - <strong> NOTIFICACIONES </strong></h4> 
            </div>
     </div>  

     <div id="page-inner" style="margin:0px; ">            
                        
        <div class="row">
            
            <div class="col-md-12">
                    
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px">
                        <thead>
                            <tr style="padding:10px; background-color:#CEECF5;">
                                <th style="width: 80px">Fecha</th>
                                <th >Notificacion</th>
                                <th style="width: 80px">Usuario notificador</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:11px">
                            <?php   foreach($notificaciones->result() as $row ):  ?>
                                <tr class="odd gradeX">
                                    <td><?=$row->F_ALTA?></td>
                                    <td>    
                                        <?=$row->TEXTO."."?>
                                        <?php 
                                            if($row->C_IDENTIFICACION):
                                                $href_programa = base_url()."/index.php/programa/index/".$row->C_IDENTIFICACION."/".$row->C_PROGRAMA."/".$row->C_ORIENTACION."";
                                                echo " En el programa: <a href='$href_programa' >".$row->PROGRAMA."</a>"; if($row->MATERIA) echo " la materia: <strong>".utf8_encode($row->MATERIA)."</strong>. ";
                                            endif;

                                            if($row->N_ID_PROFESOR):
                                                $href_profesor = base_url()."index.php/profesor/informacion_profesor/".$row->N_ID_PROFESOR;
                                                echo " Profesor/a : <a href='$href_profesor' >".utf8_encode($row->NOMBRE_PROFESOR)."</a>.";
                                            endif;

                                        ?>

                                    </td>
                                    <td><?=$row->C_USUARIOALT?></td>
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


<!-- TABLE STYLES-->

<script src="<?=base_url()?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.js"></script>

<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable( {
                    "language": {
                        "lengthMenu": "Mostrando _MENU_ notificaciones por pagina.",
                        "zeroRecords": "Ninguna notificacion fue encontrada.",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Ninguna notificacion disponible",
                        "infoFiltered": "(Filtrado de _MAX_ notificaciones totales)",
                        "sSearch": " Buscar    ",
                        "oPaginate": {
                                        "sNext": "Proxima pagina",
                                        "sPrevious": "Pagina anterior"
                                      }
                    }
                } );
        });
</script>

<script src="<?=base_url()?>assets/js/custom.js"></script>


</body>
</html>

</body>
</html>