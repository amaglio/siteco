<?=$vista_head;?>

<style type="text/css">
    
    #div_cobrado{
        display:none;
    }

</style>

<link type="text/css" href="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<!-- /. NAV SIDE  -->
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

            <div class="col-md-7">
                    
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6><strong>Cursos externos</strong></h6>
                        </div>
                        <div class="panel-body">
                            
                            <?php  if($cursos_externos->num_rows() > 0): ?>
                                    
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Acciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php   foreach($cursos_externos->result() as $row): ?>

                                            <tr>
                                                <td><?=utf8_encode($row->NOMBRE_CURSO)?></td>
                                                <td><?=utf8_encode($row->D_EMPRESA)?></td>
                                                <td>
                                                    <a href="<?=base_url()?>index.php/curso_externo/ver_curso/<?=$row->ID_CURSO_EXTERNO?>"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> </a>
                                                    <button   data-target="#modal_eliminar_asociacion" onclick="eliminar_curso_externo(<?=$row->ID_CURSO_EXTERNO?>)" style="padding:5px; background-color: white; border:none; color: #428bca;">
                                                                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                
                                                        </button>

                                                </td>
                                            </tr>

                                    <?php   endforeach; ?>
                                     </tbody>
                                </table>

                            <?php  else: ?>
                                        
                                    <div class="alert alert-danger" role="alert"> No hay cursos externos cargados </div>

                            <?php  endif; ?>
                               
                        </div>
                    </div>


            </div>
            <div class="col-md-5">


                     <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6><strong><i class="fa fa-plus" aria-hidden="true"></i> Cargar curso externo</strong></h6>
                        </div>
                        <div class="panel-body">

                            <form  name="curso_externo_form" id="curso_externo_form" method="POST" action="<?=base_url()?>index.php/curso_externo/cargar_curso_externo/" >

                                 <div class="form-group">
                                    <label for="nombre_curso" class="control-label">Nombre curso</label>
                                    <input class="form-control" name="nombre_curso" type="text" id="nombre_curso" placeholder="Nombre curso" />
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12" style="padding:0px" for="empresa" class="control-label">Empresa</label>
                                    <div class="col-md-9" style="padding:0px">
                                        <input class="form-control" name="empresa" type="text" id="empresa" placeholder="Empresa" />
                                    </div>
                                    <div class="col-md-3" style="padding:0px 0px 10px 0px">
                                        <input class="form-control" name="id_empresa" type="text" id="id_empresa" readonly="readonly" /></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="concepto" class="control-label">Concepto</label>
                                    <input class="form-control" name="concepto" type="text" id="concepto" placeholder="Concepto" />
                                </div>

                                 <div class="form-group">
                                    <label for="fecha_evento" class="control-label">Fecha del curso</label>
                                    <input  class="form-control" id="fecha_evento" name="fecha_evento" placeholder="Fecha del evento">
                                </div>

                                <div class="form-group">
                                    <label for="cobrado" class="control-label">Cobrado</label><br>
                                    Si <input type="radio" name="cobrado" id="cobrado" class="cobrado" value="1"> - No <input type="radio" class="cobrado"  name="cobrado" id="cobrado" value="0"  checked="checked">
                                </div>

                                <div id="div_cobrado">

                                    <div class="form-group">
                                        <label for="fecha_cobro" class="control-label">Fecha Cobro</label><br>
                                        <input class="form-control" name="fecha_cobro" type="text" id="fecha_cobro" placeholder="Fecha de cobro" />
                                    </div>

                                    <div class="form-group">
                                        <label for="importe" class="control-label">Importe ($)</label><br>
                                        <input class="form-control" name="importe" type="text" id="importe" placeholder="Importe ($)" />
                                    </div>
                                
                                </div>
        
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

<!-- CONFIRMA -->
<script src="<?=base_url()?>assets/js/jquery.confirm.js"></script> 

<script type="text/javascript">
    
function eliminar_curso_externo(id_curso_externo)
{
  if (confirm('Seguro queres eliminar el curso externo ? Se eliminaran los profesores cargados en el mismo.')) 
  {
    $.ajax({
                url: CI_ROOT+'index.php/curso_externo/eliminar_curso_externo',
                data: { id_curso_externo: id_curso_externo },
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

    jq('#empresa').autocomplete({

                        source: CI_ROOT+'index.php/curso_externo/ajax_empresa',
                        select: function(event, ui) 
                        {
                            jq('input[name="empresa"]').val(ui.item.value);                 
                            jq('input[name="id_empresa"]').val(ui.item.id); 
                        } 

            });

 
    jq( "#empresa" ).change(function() {
      jq( "#id_empresa" ).val('');
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
            jq( "#importe" ).val('');

        }

    });

</script>

</body>
</html>

</body>
</html>