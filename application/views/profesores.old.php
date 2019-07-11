<?php 
echo $vista_head;

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

     <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-12 col-lg-12 ">
                <h4>  <i class="fa fa-users"></i> - <strong> PROFESORES </strong></h4>   
            </div>
    </div>  
    <div id="page-inner" style="margin:0px; ">
   
        <form  name="profesores_form" id="profesores_form" method="POST" action="<?=base_url()?>index.php/profesor/informacion_profesor/" > <!-- action="<?php base_url()?>/tesoreria/index.php/profesor_tesoreria/buscar_profesor_cursos/" -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h6><strong>BUSCAR PROFESOR</strong></h6>
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        <label for="profesor" class="control-label">Apellido del profesor</label>
                        <input class="form-control" name="profesor" type="text" id="profesor" placeholder="Profesor"/>
                        <input type='hidden' id='idUsuario' name='idUsuario'/>
                        <div style="color:red; text-align:right; font-weight:bold; padding:5px; font-size:12px">* El usuario debe ser seleccionado del listado emergente</div>
                        <div style="color:blue; text-align:right; font-weight:bold; padding:5px; font-size:12px">* No utilizar acentos, ni mayusculas.</div>
                    </div>

            </div>
                                                     
            <div class="panel-footer" style='text-align:center;'>
                    <div class="form-group">
                            <button type="submit" name="buscar" id="buscar" class="btn btn-primary">Buscar</button>
                    </div>
            </div>

        </div>
        </form>

        <div class="tab-pane fade active in" id="resultado">

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

<script type="text/javascript">

    jq('#profesor').autocomplete({
                source:'<?php echo site_url('programa/ajax_profesor'); ?>',
                select: function(event, ui) {
                    //alert(ui.item ? "Selected: " + ui.item.id : "Nothing selected, input was " + this.value );
                    jq('input[name="idUsuario"]').val(ui.item.id);
                }

        });

     jq(function(){

            jq('#profesores_form').validate({

                rules :{

                        profesor : {
                            required : true
                        },
                        idUsuario: {
                            required : true
                        }
                },
                messages : {

                        profesor : {
                            required : "Debe ingresar el profesor."
                        },
                        idUsuario: {
                            required : "Debe seleccionar un profesor de la lista."
                        }
                },
                submitHandler: function(form) {


                    if ( jq('input[name="idUsuario"]').val() != "" ){ // si eligio al usuario del listado
                        form.submit();
                    }
                    else // si tipio y no eligio al usuario
                    {
                        alert( "El usuario debe ser seleccionado del listado" );
                    }

                        
                }

            });    
    });     

</script>

</body>
</html>