<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.4.4.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui-1.8.10.custom.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script> 
<script>
        var q = jQuery.noConflict();
</script>

<script language="javascript" type="text/javascript" >

    q(function(){

        q('input#puntos').change(function() {
           q('input[name=sueldo]').val(Math.ceil(q('input#puntos').val()*16950));
        });

    });

    q(function(){

            q('#form_editar_curso').validate({

                rules :{

                        autocomplete : {
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

                        autocomplete : {
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

</script> 

<?php 
    $profesor = rawurldecode($apellido.", ".$nombre);
?>

</head>

<body>

<style type="text/css">
label.error {
    color:red;
    background: #fff;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
}
</style>

<form id="form_editar_curso" name="form_editar_curso" method="post" action="<?=base_url()?>index.php/programa/procesa_editar_importe_curso" >

<!--- hidden -->

<input type='hidden' name='id_materia' id='id_materia' value='<?=$id_materia?>'/>
<input type='hidden' name='id_curso' id='id_curso'  value='<?=$id_curso?>'/>
<input type='hidden' name='anio_lectivo' id='anio_lectivo'  value='<?=$anio_lectivo?>'/>
<input type='hidden' name='id_horario' id='id_horario'  value='<?=$id_horario?>'/>
<input type='hidden' id='rol' name='rol' value="<?=$rol?>"/>

<!-- <input type='hidden' id='carrera' name='carrera' value="<?=$carrera?>"/> -->

<input type='hidden' id='c_identificacion' name='c_identificacion' value="<?=$c_identificacion ?>"/>
<input type='hidden' id='c_programa' name='c_programa' value="<?=$c_programa ?>"/>
<input type='hidden' id='c_orientacion' name='c_orientacion' value="<?=$c_orientacion ?>"/>

<input type='hidden' id='sueldo_anterior' name='sueldo_anterior' value="<?=$sueldo?>"/>

<div class="panel panel-info">
    <div class="panel-heading">
        <h6><strong>EDITAR MATERIA</strong></h6>
    </div>
    <div class="panel-body">
            <div class="form-group">
                <label for="materia" class="control-label">Materia</label>
                <input class="form-control" name="materia" id="materia" type="text" placeholder="<?=utf8_encode($materia)?>" disabled />
            </div>
                  
            <div class="form-group">
                <label for="profesor" class="control-label">Profesor</label>
                <input class="form-control" type='text' id='autocomplete' value="<?=$profesor?>" name='autocomplete' disabled/>
                <input type='hidden' id='idUsuario' name='idUsuario' value="<?=$id_profesor?>"/>
            </div>

            <div class="form-group">
                <label for="puntos" class="control-label" >Puntos</label>
                <input class="form-control" name="puntos" id="puntos" value="<?=$puntos?>" disabled/>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <label for="sueldo" class="control-label">Sueldos ($)</label>
                <input class="form-control" name="sueldo" id="sueldo" value="<?=$sueldo?>" />
                <div class="help-block with-errors"></div>
            </div> 

            <div class="form-group">
                <label for="sueldo" class="control-label">Comentario</label>
                <textarea class="form-control" rows="3" name="comentario" id="comentario"></textarea>
            </div>
    </div>
                                             
    <div class="panel-footer" style='text-align:center;'>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <a class="btn" data-dismiss="modal">Close</a>
            </div>
    </div>
</div>
</form>

</body>
</html>