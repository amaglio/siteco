<?php 

echo $vista_head;

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

     <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-1" style="color:#8BC53F; width:25px;">
                <h4>  <i class="fa fa-tasks "></i></h4>   
            </div>
            <div class="col-md-11" style="text-align:left;">
                 <h4> <strong> <p style=" line-height:20px">   Resumen Programas </strong>  </p>
            </div>
     </div>  

     <div id="page-inner" style="margin:0px; ">            
                        
        <div class="row">
            
            <div class="col-md-12">
                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a href="#prg_grado" data-toggle="tab"> <i class="fa fa-list-ol"></i> Programas de Grado</a>
                    </li>
                    <li class=""><a href="#prg_posgrado" data-toggle="tab"> <i class="fa fa-th-list"></i> Programas de Posgrado</a>
                    </li>
                    <li class=""><a href="#prg_ejec_pac" data-toggle="tab"><i class="fa fa-list-ul"></i> Programas Ejec. y Programas de Act.</a>
                    </li>
                </ul>

                <div class="tab-content" style="margin-top:20px">
                
                    <div class="tab-pane fade active in" id="prg_grado"> 

                        <table class="table">
                            <tr style="background-color:#CEF6E3;">    
                                <th>Programa Grado</th>
                                <th>Coordinador</th>
                                <th>Secretarios</th>
                            </tr>

                        <?php  for($i=0; $i < count($programas_grado); $i++  ): ?>
                            
                            <tr>
                                <td><?=utf8_encode($programas_grado[$i]['programa'])?></td>
                                <td>
                                    <?php   foreach ($programas_grado[$i]['coordinadores_programa']->result() as $row): ?>
                                    
                                        <?=$row->GRANTEE."<br>"?>
                                                                            
                                    <?php   endforeach; ?>
                                </td>
                                <td>
                                     <?php   foreach ($programas_grado[$i]['secretarios_programa']->result() as $row): ?>
                                    
                                        <?=$row->GRANTEE."<br>"?>
                                                                            
                                     <?php   endforeach; ?>

                                </td>
                            </tr>

                        <?php  endfor; ?>
                        </table>

                    </div>

                    <div class="tab-pane fade in" id="prg_posgrado"> 
                        
                        <table class="table">
                            <tr style="background-color:#CEF6E3;">    
                                <th>Programa Posgrado</th>
                                <th>Coordinador</th>
                                <th>Secretarios</th>
                            </tr>

                        <?php  for($i=0; $i < count($programas_posgrado); $i++  ): ?>
                            
                            <tr>
                                <td><?=utf8_encode($programas_posgrado[$i]['programa'])?></td>
                                <td>
                                    <?php   foreach ($programas_posgrado[$i]['coordinadores_programa']->result() as $row): ?>
                                    
                                        <?=$row->GRANTEE."<br>"?>
                                                                            
                                    <?php   endforeach; ?>
                                </td>
                                <td>
                                     <?php   foreach ($programas_posgrado[$i]['secretarios_programa']->result() as $row): ?>
                                    
                                        <?=$row->GRANTEE."<br>"?>
                                                                            
                                     <?php   endforeach; ?>
                                    
                                </td>
                            </tr>

                        <?php  endfor; ?>
                        </table>

                    </div>

                    <div class="tab-pane fade in" id="prg_ejec_pac"> 

                        <table class="table">
                            <tr style="background-color:#CEF6E3;">    
                                <th>Programa PE y PAC</th>
                                <th>Coordinador</th>
                                <th>Secretarios</th>
                            </tr>

                        <?php  for($i=0; $i < count($programas_ejecutivos); $i++  ): ?>
                            
                            <tr>
                                <td><?=utf8_encode($programas_ejecutivos[$i]['programa'])?></td>
                                <td>
                                    <?php   foreach ($programas_ejecutivos[$i]['coordinadores_programa']->result() as $row): ?>
                                    
                                        <?=$row->GRANTEE."<br>"?>
                                                                            
                                    <?php   endforeach; ?>
                                </td>
                                <td>
                                     <?php   foreach ($programas_ejecutivos[$i]['secretarios_programa']->result() as $row): ?>
                                    
                                        <?=$row->GRANTEE."<br>"?>
                                                                            
                                     <?php   endforeach; ?>
                                    
                                </td>
                            </tr>

                        <?php  endfor; ?>
                        </table>

                    </div>
                
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