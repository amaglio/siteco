<?php 
echo $vista_head;

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

    <div id="page-inner" style="margin:0px; ">
   
        <form  name="profesores_form" id="profesores_form" method="POST" action="<?=base_url()?>/index.php/profesor/informacion_profesor/" >
        <div class="panel panel-info">
            <div class="panel-heading">
                <h6><strong>BUSCAR PROFESOR</strong></h6>
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        <label for="profesor" class="control-label">Profesor</label>
                        <input class="form-control" name="profesor" type="text" id="profesor" placeholder="Profesor"/>
                        <input type='hidden' id='idUsuario' name='idUsuario'/>
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
                        }
                },
                messages : {

                        profesor : {
                            required : "Debe ingresar el profesor."
                        }
                }/*,
                submitHandler: function (form) {

                    jq.ajax({
                        url:  CI_ROOT+'index.php/profesor_tesoreria/buscar_profesor_cursos',
                        data: $('#profesores_form').serialize(),
                        async: false,
                        type: 'POST',
                        dataType:'json', 
                        success: function(data)
                        {
                            if(data.error == false)
                            {
                                
                                jq("#resultado").empty();
                                jq("#resultado").append(data.html_view);
                            }
                            else
                            {
                                alert("ERROR AL TRAER LOS DATOS. AVISAR A ADRIAN");
                            }
                        },
                        error: function(x, status, error){
                            alert(error);
                        }
                    });
                }*/ 

            });    
    });     

</script>

</body>
</html>