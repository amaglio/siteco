<?php 
echo $vista_head;
//if(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))) echo "Tesoreria";
?>

<div id="page-wrapper" >
    <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-12 col-lg-12 ">
                <h4>  <i class="fa fa-th-list"></i> -  Cursos modificados </h4>   
            </div>
     </div>  

    <div id="page-inner" style="margin:0px; ">
                
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php   foreach ($cursos_modificados->result() as $row): ?>
                                        <tr>
                                            <td> <?=$row->F_ALTA?> </td>
                                            <td> <?=utf8_encode($row->D_DESCRIP)?> </td>
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

<!-- CUSTOM SCRIPTS -->
<script src="<?=base_url()?>assets/js/custom.js"></script> 

<script type="text/javascript">
        CI_ROOT = "<?=base_url() ?>";
</script>
 <script>
         
        jq(document).ready(function () {

            /*
             $('[data-toggle="ajaxExtras"]').on('click',
              function(e) {
                $('#ajaxExtras').remove();
                e.preventDefault();
                var $this = $(this)
                  , $remote = $this.data('remote') || $this.attr('href')
                  , $modal = $('<div class="modal fade" style="width:500px; margin-top: 30px;  margin-bottom: auto;  margin-left: auto;  margin-right: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  id="ajaxModal"><div class="modal-body"></div></div>');
                $('body').append($modal);
                $modal.modal({keyboard: false});
                $modal.load($remote);
              }
            );*/


           jq('#form_cargar_extras').validate({

                rules :{

                        sueldo : {
                            required : true
                        },
                        fecha : {
                            required : true
                        },
                        concepto :{
                            required : true
                        }
                },
                messages : {

                        sueldo : {
                            required : "Debe ingresar el importe."
                        },
                        fecha : {
                            required : "Debe ingresar la fecha."
                        },
                        concepto : {
                            required : "Debe elegir un concepto."
                        }
                }

            });    


         });  
    </script>

</body>
</html>