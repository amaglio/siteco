<?php 
echo $vista_head;

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

 

    <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
        <div class="col-md-1" style="color:#8BC53F; width:25px;">
            <h4>  <i class="fa fa-users"></i> </h4>   
        </div>
        <div class="col-md-11" style="text-align:left;">
            <h4> <strong>Profesores</strong>  </h4>
        </div>
    </div>

    <div id="page-inner" style="margin:0px; padding:0px; ">
        
        <a style="float:right; margin:10px" href="<?=base_url()?>index.php/profesor/exportar_todos_cursos_anio_xls" class="btn btn-danger btn-sm"><i class="fa fa-file"></i> Exportar todo XLS</a>

        <form  name="profesores_form" id="profesores_form" method="POST" action="<?=base_url()?>index.php/profesor/informacion_profesor/" >
        <div class="panel panel-info">
            <div class="panel-heading">
                <h6><strong>BUSCAR PROFESOR</strong></h6>
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        <label for="profesor" class="control-label">Apellido del profesor</label>
                        <input class="form-control" name="profesor" type="text" id="profesor" placeholder="Profesor"/> <br />
                        
                        <label class="radio-inline"><input type="radio" name="radio_relacion_dependencia" class="clase_relacion" value="todos" checked="checked">Todos</label>
                        <label class="radio-inline"><input type="radio" name="radio_relacion_dependencia" class="clase_relacion" value="dependencia" autocomplete="off">Relacion de Dependencia</label>
                        <label class="radio-inline"><input type="radio" name="radio_relacion_dependencia" class="clase_relacion" value="Autonomos" autocomplete="off"> Autonomos</label>
                        <label class="radio-inline"><input type="radio" name="radio_relacion_dependencia" class="clase_relacion" value="sin_curso" autocomplete="off" >Sin cursos</label>
                        
                        <!-- <input type='hidden' id='idUsuario' name='idUsuario'/> -->
                        <div style="color:blue; text-align:right; font-weight:bold; padding:5px; font-size:12px">* No utilizar acentos, ni mayusculas.</div>
                    </div>

                    <div class="info-box" id="datos_profesor" style="width:50%;">
                        
                        <div class="col-md-1" style="color:#8BC53F;">
                            <h4>  <i class="fa fa-user fa-4x"></i></h4>   
                        </div>
                        <div class="col-md-11" style="text-align:left; padding-top:5px;">
                            <div class="info-box-content">

                                  <label for="nombre">Nombre: </label>
                                  <input class="form-control" type="text" name="nombre_profesor" id="nombre_profesor" readonly="readonly"  />

                                  <label for="nombre">Id Persona:</label>
                                  <input class="form-control" type="text" name="idUsuario" name="idUsuario" readonly="readonly"  />

                                  <label for="nombre">Relacion:</label>
                                  <input class="form-control" type="text" name="relacion_dependencia" name="relacion_dependencia" readonly="readonly"  />

                            </div> 

                            <div class="form-group" style="margin:10px; text-align:center;">
                                    <button type="submit" name="buscar" id="buscar" class="btn btn-success">Aceptar</button>
                            </div>                        
                        </div>

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

    var relacion;

    jq( document ).ready(function() {
            
        jq('#profesor').autocomplete({

                        source: CI_ROOT+'index.php/profesor/ajax_profesor?relacion=todos',
                        select: function(event, ui) 
                        {
                            jq('input[name="nombre_profesor"]').val(ui.item.value);                 
                            jq('input[name="idUsuario"]').val(ui.item.id); 
                            jq('input[name="relacion_dependencia"]').val(ui.item.relacion_dependencia);
                            jq('#datos_profesor').show();
                            
                            jq( "#datos_profesor" ).animate({
                              backgroundColor: "#E6E0F8",
                              color: "#000",
                              width: "100%"
                            }, 200 ); 
                            jq("#datos_profesor").effect( "shake", {times:2, distance:5}, 200 );

                        } 

            }); 

    });

    jq(function(){

        $('.clase_relacion').on('change', function() {
           
            relacion= $('input[name=radio_relacion_dependencia]:checked', '#profesores_form').val();

            $('#profesor').val('');

            jq('#profesor').autocomplete({

                        source: CI_ROOT+'index.php/profesor/ajax_profesor?relacion='+relacion,
                        select: function(event, ui) 
                        {
                            jq('input[name="nombre_profesor"]').val(ui.item.value);                 
                            jq('input[name="idUsuario"]').val(ui.item.id); 
                            jq('input[name="relacion_dependencia"]').val(ui.item.relacion_dependencia);
                            jq('#datos_profesor').show();
                            
                            jq( "#datos_profesor" ).animate({
                              backgroundColor: "#E6E0F8",
                              color: "#000",
                              width: "100%"
                            }, 200 ); 
                            jq("#datos_profesor").effect( "shake", {times:2, distance:5}, 200 );

                        } 

            }); 

        });

    });

    jq(function(){

        jq("#datos_profesor").hide();  

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