<?=$vista_head;?>

<link type="text/css" href="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />


<style type="text/css">
    
    #div_profesor_ucema, #div_profesor_externo
    {
        display:none;
    } 

</style>

<div id="page-wrapper" >
     <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-12 col-lg-12 ">
                <h4>  <i class="fa fa-external-link fa-1x"  ></i> - <strong> Cursos externos </strong></h4> 
            </div>
     </div>  

     <div id="page-inner" style="margin:0px; ">       


        <?php  if ($mensaje): ?>

            <div class="alert alert-danger" style="margin:10px;">
              <h5><?=$mensaje;?></h5>
            </div>


        <?php  endif; ?>     
            
            <div class="col-md-6"> 
                
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h6><strong><i class="fa fa-plus" aria-hidden="true"></i> Ver curso externo</strong></h6>
                    </div>
                    <div class="panel-body">

                        <form  name="curso_externo_form" id="curso_externo_form" method="POST" action="<?=base_url()?>index.php/curso_externo/editar_curso_externo/" >
                            
                            <input type="hidden" name="id_curso_externo" id="id_curso_externo" value="<?=$informacion_curso_externo->ID_CURSO_EXTERNO?>">

                            <div class="form-group">
                                <label for="nombre_curso" class="control-label">Nombre curso</label>
                                <input class="form-control" name="nombre_curso" type="text" id="nombre_curso" placeholder="Nombre curso" <?php  if($informacion_curso_externo->NOMBRE_CURSO) echo "value='".$informacion_curso_externo->NOMBRE_CURSO."'";?> />
                            </div>

                            <div class="form-group">
                                <label class="col-md-12" style="padding:0px" for="empresa" class="control-label">Empresa</label>
                                <div class="col-md-9" style="padding:0px">
                                    <input class="form-control" name="empresa" type="text" id="empresa" placeholder="Empresa" <?php  if($informacion_curso_externo->D_EMPRESA) echo "value='".utf8_encode($informacion_curso_externo->D_EMPRESA)."'";?> />
                                </div>
                                <div class="col-md-3" style="padding:0px 0px 10px 0px">
                                    <input class="form-control" name="id_empresa" type="text" id="id_empresa" placeholder="Id empresa" readonly="readonly" value="<?=$informacion_curso_externo->N_ID_EMPRESA?>" />
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="concepto" class="control-label">Concepto</label>
                                <input class="form-control" name="concepto" type="text" id="concepto" placeholder="Concepto" <?php  if($informacion_curso_externo->CONCEPTO) echo "value='".utf8_encode($informacion_curso_externo->CONCEPTO)."'";?>/>
                            </div>

                             <div class="form-group">
                                <label for="fecha_evento" class="control-label">Fecha del curso</label>
                                <input  class="form-control" id="fecha_evento" name="fecha_evento" placeholder="Fecha del evento" <?php  if($informacion_curso_externo->FECHA) echo "value='".utf8_encode($informacion_curso_externo->FECHA)."'";?>>
                            </div>

                            <div class="form-group">
                                <label for="cobrado" class="control-label">Cobrado</label><br>
                                Si <input type="radio" name="cobrado" class="cobrado" id="cobrado_si" <?php  if($informacion_curso_externo->COBRADO == 1) echo " checked='checked'; "?> value="1"> - No <input type="radio" name="cobrado" class="cobrado" id="cobrado_no" value="0"  <?php  if($informacion_curso_externo->COBRADO == 0) echo " checked='checked'; "?>>
                            </div>

                            <!-- <div id="div_cobrado"> -->

                                <div class="form-group">
                                    <label for="fecha_cobro" class="control-label">Fecha Cobro</label><br>
                                    <input class="form-control" name="fecha_cobro" type="text" id="fecha_cobro" placeholder="Fecha que se cobro" <?php  if($informacion_curso_externo->FECHA_COBRO) echo "value='".utf8_encode($informacion_curso_externo->FECHA_COBRO)."'";?> />
                                </div>

                                <div class="form-group">
                                    <label for="importe" class="control-label">Importe ($)</label><br>
                                    <input class="form-control" name="importe" type="text" id="importe_cobrado" placeholder="Importe ($)" <?php  if($informacion_curso_externo->IMPORTE_A_COBRAR) echo "value='".utf8_encode($informacion_curso_externo->IMPORTE_A_COBRAR)."'";?> />
                                </div>

                            <!-- </div> -->


                            <div class="form-group">
                                <input class="btn btn-primary btn-block" name="submit" type="submit" id="submit" value="Modificar" />
                            </div>

                        </form>
    
                           
                    </div>
                </div>
            </div>

            <div class="col-md-6"> 

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h6><strong><i class="fa fa-plus" aria-hidden="true"></i> Profesores del curso </strong></h6>
                    </div>
                    <div class="panel-body">

                        <?php  if($profesores_curso_externo->num_rows() > 0): ?>


                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Ucema</th>
                                        <th>Pagado</th>
                                        <th> </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php   foreach($profesores_curso_externo->result() as $row): ?>

                                            <tr>
                                                <td><?=utf8_encode($row->APELLIDO)?></td>
                                                <td><?=utf8_encode($row->NOMBRE)?></td>
                                                <td><?=utf8_encode($row->ES_PROFESOR_UCEMA)?></td>
                                                <td style="font-size:10px">
                                                    <?php  if($row->PAGADO == 1): ?>

                                                            $<?=utf8_encode($row->IMPORTE_A_PAGAR)?> <br>
                                                            <?=utf8_encode($row->FECHA_PAGO)?>

                                                    <?php  else: ?>
                                                            
                                                            No

                                                    <?php  endif; ?>
    
                                                </td>
                                                <td>
                                                        <a href="<?=base_url()?>index.php/curso_externo/ver_profesor/<?=$row->ID_PROFESOR_CURSO?>"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> </a>
                                                        <button   data-target="#modal_eliminar_asociacion" onclick="eliminar_profesor_curso(<?=$row->ID_PROFESOR_CURSO?>)" style="padding:5px; background-color: white; border:none; color: #428bca;">
                                                                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                
                                                        </button>
                                                </td>


                                            </tr>

                                    <?php   endforeach; ?>
                                     </tbody>
                                </table>
                            
                        <?php   else: ?>

                                <div class="alert alert-danger" style="margin:10px;">
                                  <h5>Aun no se cargaron profesores</h5>
                                </div>

                        <?php  endif; ?>

                    </div>

                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h6><strong><i class="fa fa-plus" aria-hidden="true"></i> Agregar profesor </strong></h6>
                    </div>
                    <div class="panel-body">

                        <form  name="cargar_profesor_form" id="cargar_profesor_form" method="POST" action="<?=base_url()?>index.php/curso_externo/cargar_profesor_curso/" >
                                
                                <input type="hidden" name="id_curso_externo" id="id_curso_externo" value="<?=$informacion_curso_externo->ID_CURSO_EXTERNO?>">

                                <div class="row" style="background-color:rgba(66, 139, 202, 0.52); padding:5px; margin:2px; margin-bottom:10px">
                                    <div class="col-md-6" style="padding:0px">
                                        <label for="nombre_curso" class="control-label">Profesor UCEMA: </label> <input style="margin-left:5px;" class="radio_profesor" type="radio" name="origen_profesor" id="origen_ucema" value="ucema"/> </br>
                                    </div>
                                    <div class="col-md-6" style="padding:0px">
                                        <label for="nombre_curso" class="control-label">Profesor externos: </label><input style="margin-left:5px;" class="radio_profesor"   type="radio" name="origen_profesor" id="origen_externo" value="externo"/> 
                                    </div>
                                </div>

                                
                                <div class="row" id="div_profesor_ucema" style="padding:10px">
                                    <label class="col-md-12" style="padding:0px" for="empresa" class="control-label">Profesor UCEMA</label>
                                    <div class="col-md-9" style="padding:0px">
                                        <input class="form-control" name="profesor_ucema" type="text" id="profesor_ucema" placeholder="Profesor Ucema" />
                                    </div>
                                    <div class="col-md-3" style="padding:0px 0px 10px 0px">
                                        <input class="form-control" name="id_profesor_ucema" type="text" id="id_profesor_ucema" readonly="readonly" />
                                    </div>
                                </div>

                                <div class="row" id="div_profesor_externo" style="padding:10px">

                                    <div class="form-group">
                                        <label for="nombre" class="control-label">Nombre</label>
                                        <input class="form-control" name="nombre" type="text" id="nombre" placeholder="Nombre profesor externo" />
                                    </div>

                                     <div class="form-group">
                                        <label for="apellido" class="control-label">Apellido</label>
                                        <input  class="form-control" id="apellido" name="apellido" placeholder="Apellido profesor externo">
                                    </div>

                                </div>

                                <div class="form-group" style="border-top:1px solid rgba(66, 139, 202, 0.52); padding-top:5px">
                                    <label for="pagado" class="control-label">Pagado</label><br>
                                    Si <input type="radio" name="pagado"  class="pagado" id="pagado_si" value="1"> - No <input type="radio" name="pagado" class="pagado"  id="pagado_no" value="0"  checked="checked">
                                </div>

                                <!-- <div id="div_pagado"> -->

                                    <div class="form-group">
                                        <label for="fecha_pago" class="control-label">Fecha Pago</label><br>
                                        <input class="form-control" name="fecha_pago" type="text" id="fecha_pago" placeholder="Fecha de pago" />
                                    </div>

                                    <div class="form-group">
                                        <label for="importe" class="control-label">Importe pagado ($)</label><br>
                                        <input class="form-control" name="importe_pago" type="text" id="importe_pago" placeholder="Importe ($)" />
                                    </div>

                                <!-- </div> -->


                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" name="submit" type="submit" id="submit" value="Cargar" />
                                </div>

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

<!-- BOOTSTRAP SCRIPTS -->
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

<!-- METISMENU SCRIPTS -->
<script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>


<!-- TABLE STYLES-->

<script src="<?=base_url()?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.js"></script>
<!-- CONFIRMA -->
<script src="<?=base_url()?>assets/js/jquery.confirm.js"></script> 

<script type="text/javascript">
    
function eliminar_profesor_curso(id_profesor_curso)
{
  if (confirm('Seguro queres eliminar el profesor curso ?')) 
  {
    $.ajax({
                url: CI_ROOT+'index.php/curso_externo/eliminar_profesor_curso',
                data: { id_profesor_curso: id_profesor_curso },
                async: true,
                type: 'POST',
                dataType: 'JSON',
                success: function(data)
                {
                  if(data.error == false)
                  {
                    //alert("Se ha eliminado el profesor exitosamente");
                    location.reload();
                  }
                  else
                  {
                    //alert("No se ha eliminado el profesor");
                    location.reload();
                  }
                },
                error: function(x, status, error){
                  alert(status);
                }
          });
  }
}


</script>

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
<link   type="text/css" href="<?php echo base_url(); ?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 


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
    jq('#curso_externo_form').validate({


        rules :{

                nombre_curso : {
                    required : true 
                },
                id_empresa : {
                    required : true 
                }  
        },
        messages : {

                nombre_curso : {
                    required : "Ingrese el nombre del evento." 
                },
                id_empresa : {
                    required : "La empresa debe ser seleccionada del listado." 
                } 
        }
    }); 

    jq.validator.addMethod("profesor_ucema_funcion", 
                              function(value, element) 
                              {
                                    relacion= $('input[name=origen_profesor]:checked', '#cargar_profesor_form').val();

                                    if(  relacion == "ucema" )
                                    {   
                                        console.log("ucema");

                                        if(  jq( "#id_profesor_ucema" ).val() == '' )
                                        {
                                            console.log("vacio");
                                            return false;
                                        }
                                        else
                                        {
                                            console.log("lleno");
                                            return true;
                                        }

                                    }
                                    else
                                    {
                                        console.log("externo");
                                    }

                              }, 
                             "Debe seleccionar algun criterio de busqueda."
    );

    jq.validator.addMethod("profesor_nombre_funcion", 
                            function(value, element) 
                              {
                                    relacion= $('input[name=origen_profesor]:checked', '#cargar_profesor_form').val();

                                    if(  relacion == "externo" )
                                    {   
                                        console.log("externo");

                                        if(  jq( "#nombre" ).val() == '' )
                                        {
                                            console.log("vacio");
                                            return false;
                                        }
                                        else
                                        {
                                            console.log("lleno");
                                            return true;
                                        }

                                    }
                                    else
                                    {
                                        console.log("externo");
                                    }

                              }, 
                             "Debe seleccionar algun criterio de busqueda."
    );
    
    jq.validator.addMethod("profesor_apellido_funcion", 
                            function(value, element) 
                              {
                                    relacion= $('input[name=origen_profesor]:checked', '#cargar_profesor_form').val();

                                    if(  relacion == "externo" )
                                    {   
                                        console.log("externo");

                                        if(  jq( "#apellido" ).val() == '' )
                                        {
                                            console.log("vacio");
                                            return false;
                                        }
                                        else
                                        {
                                            console.log("lleno");
                                            return true;
                                        }

                                    }
                                    else
                                    {
                                        console.log("externo");
                                    }

                              }, 
                             "Debe seleccionar algun criterio de busqueda."
    );


    // cargar_profesor
    jq('#cargar_profesor_form').validate({
 
        rules :{

                origen_profesor : {
                    required : true 
                },
                id_profesor_ucema : {
                    profesor_ucema_funcion : true 
                },
                nombre : {
                    profesor_nombre_funcion : true 
                },
                apellido : {
                    profesor_apellido_funcion : true 
                }   
        },
        messages : {

                origen_profesor : {
                    required : "Seleccione el tipo de profesor" 
                },
                id_profesor_ucema : {
                    profesor_ucema_funcion : "Debe seleccionar un profesor UCEMA del listado emergente"  
                },
                nombre : {
                    profesor_nombre_funcion : "Debe ingresar el nombre del profesor externo"  
                },
                apellido : {
                    profesor_apellido_funcion : "Debe ingresar el apellido del profesor externo"  
                }   
        } 
    }); 
    
    jq.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
    };

    jq.datepicker.setDefaults(jq.datepicker.regional['es']);
    
    jq('#fecha_evento').datepicker({
            changeMonth: true,
            changeYear: true,
            changeDay: true,
            dateFormat: 'yy-mm-dd'
    });

    jq('#fecha_cobro').datepicker({
            changeMonth: true,
            changeYear: true,
            changeDay: true,
            dateFormat: 'yy-mm-dd'
    });

    jq('#fecha_pago').datepicker({
            changeMonth: true,
            changeYear: true,
            changeDay: true,
            dateFormat: 'yy-mm-dd'
    });

    jq('#empresa').autocomplete({

                        source: CI_ROOT+'index.php/curso_externo/ajax_empresa',
                        select: function(event, ui) 
                        {
                            jq('input[name="empresa"]').val(ui.item.value);                 
                            jq('input[name="id_empresa"]').val(ui.item.id); 
                        } 

            });

     jq('#profesor_ucema').autocomplete({

                        source: CI_ROOT+'index.php/curso_externo/ajax_profesor',
                        select: function(event, ui) 
                        {
                            jq('input[name="profesor_ucema"]').val(ui.item.value);                 
                            jq('input[name="id_profesor_ucema"]').val(ui.item.id); 
                        } 

            });

 
    jq( "#empresa" ).change(function() {
      jq( "#id_empresa" ).val('');
    });


    jq( "#profesor_ucema" ).change(function() {
      jq( "#id_profesor_ucema" ).val('');
    });


    jq( ".radio_profesor" ).change(function() {
      
        if($(this).val() == 'ucema')
        {
            jq( "#div_profesor_ucema" ).show();
            jq( "#div_profesor_externo" ).hide();
            jq( "#nombre" ).val('');
            jq( "#apellido" ).val('');
        }
        else
        {
            jq( "#div_profesor_ucema" ).hide();
            jq( "#div_profesor_externo" ).show();
            jq( "#id_profesor_ucema" ).val('');
            jq( "#profesor_ucema" ).val('');
        }


    });

    /*
    jq( document ).ready(function() {
        
        if (jq( "#cobrado_si" ).is(':checked')){

            jq( "#div_cobrado" ).show();

        }

        if (jq( "#cobrado_no" ).is(':checked')){

           jq( "#div_cobrado" ).hide();

        }


        if (jq( "#pagado_si" ).is(':checked')){

            jq( "#div_pagado" ).show();

        }

        if (jq( "#pagado_no" ).is(':checked')){

           jq( "#div_pagado" ).hide();

        }
 
 


    });


    jq( ".cobrado" ).change(function() {
    
        if( jq(this).val()== 1 )
        {
            jq( "#div_cobrado" ).show();
        }
        else
        {
            jq( "#div_cobrado" ).hide();
            jq( "#fecha_cobro" ).val('');
            jq( "#importe_cobrado" ).val('');

        }

    });


    jq( ".pagado" ).change(function() {
    
        if( jq(this).val()== 1 )
        {
            jq( "#div_pagado" ).show();
        }
        else
        {
            jq( "#div_pagado" ).hide();
            jq( "#fecha_pago" ).val('');
            jq( "#importe_pagado" ).val('');

        }

    });*/


</script>

</body>
</html>

</body>
</html>