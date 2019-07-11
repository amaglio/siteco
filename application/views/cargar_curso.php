<link type="text/css" href="<?=base_url()?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.4.4.min.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui-1.8.10.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script>


<script language="javascript" type="text/javascript" >
    $(document).ready(function(){
        $('#autocomplete').autocomplete({
            source:'<?php echo site_url('programa/ajax'); ?>',
            select: function(event, ui) {
                //alert(ui.item ? "Selected: " + ui.item.id : "Nothing selected, input was " + this.value );
                $('input[name="idUsuario"]').val(ui.item.id);
            }
        });
    });
</script>

<script language="javascript" type="text/javascript" >
    
    $(function(){

            $('#form_cargar_curso').validate({

                rules :{

                        profesor : {
                            required : true
                        },
                        puntos : {
                            required : true,
                            number: true
                        },
                        sueldo : {
                            required : true,
                            number: true
                        }
                },
                messages : {

                        profesor : {
                            required : "Debe ingresar el profesor."
                        },

                        puntos : {
                            required :  "Debe ingresar los puntos.",
                            number: "Debe ingresar un numero."
                        },
                        sueldo : {
                            required :  "Debe ingresar el sueldo.",
                            number: "Debe ingresar un numero."
                        }
                }

            });    
    });

    $(function(){

        $('input#puntos').change(function() {

           $('input[name=sueldo]').val(Math.ceil($('input#puntos').val()*16950));
        });

         $('input[name=sueldo]').change(function() {

           $('input#puntos').val( ($('input[name=sueldo]').val() / 16950).toFixed(4) );
        });

    });

</script>

<form id="form_cargar_curso" name="form_cargar_curso" method="post" action="<?=base_url()?>index.php/programa/procesa_cargar_curso" >

<!--- hidden -->

<?php /*
<input type='hidden' name='id_materia' id='id_materia' value='<?=$id_materia?>'/>
<input type='hidden' name='id_curso' id='id_curso'  value='<?=$id_curso?>'/>
<input type='hidden' name='anio_lectivo' id='anio_lectivo'  value='<?=$anio_lectivo?>'/>
<input type='hidden' name='id_horario' id='id_horario'  value='<?=$id_horario?>'/>
<input type='hidden' id='rol' name='rol' value="<?=$rol?>"/>
<input type='hidden' id='carrera' name='carrera' value="<?=$carrera?>"/>
*/?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h6><strong>CARGAR CURSO</strong></h6>
    </div>
    <div class="panel-body">

            <div class="form-group">
                <label for="materia" class="control-label">Materia</label>
                <input class="form-control" name="materia" id="materia" type="text" placeholder="Materia" />
            </div>
                  
            <div class="form-group">
                <label for="profesor" class="control-label">Profesor</label>
                <input class="form-control" type='text' id='profesor' placeholder="Materia" name='profesor'/>
                <input type='hidden' id='idUsuario' name='idUsuario'/>
            </div>

            <div class="form-group">
                <label for="puntos" class="control-label">Puntos</label>
                <input class="form-control" name="puntos" id="puntos" value="<?=$puntos?>" placeholder="Puntos"/>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <label for="sueldo" class="control-label">Sueldos ($)</label>
                <input class="form-control" name="sueldo" id="sueldo" placeholder="Sueldo" />
                <div class="help-block with-errors"></div>
            </div> 
    </div>
                                             
    <div class="panel-footer" style='text-align:center;'>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cargar</button>
            </div>
    </div>
</div>
</form>