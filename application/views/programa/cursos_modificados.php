<?php 

echo $vista_head;

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

     <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-1" style="color:#8BC53F; width:25px;">
                <h4>  <i class="fa fa-th-list"></i></h4>   
            </div>
            <div class="col-md-11" style="text-align:left;">
                 <h4> <strong> <p style=" line-height:20px">   Cursos que sufrieron modificaciones </strong>  </p>
            </div>
     </div> 

     <div id="page-inner" style="margin:0px; ">            
                        
        <div class="row">
            
            <div class="col-md-12">
 
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px">
                                    <thead>
                                        <tr style="padding:10px; background-color:#CEECF5;">
                                            <th style="width:80px" >Fecha</th>
                                            <th >Descripcion</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size:11px">
                                        <?php   foreach($cursos_modificados->result() as $row ):  ?>
                                            <tr class="odd gradeX">
                                                <td><?=$row->F_ALTA?></td>
                                                <td><?=utf8_encode($row->D_OBSERV)?></td>
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
                        "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ contactos",
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