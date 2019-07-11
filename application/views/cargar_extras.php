<?php 
    $nombre = utf8_encode($nombre_profesor->D_APELLIDOS).", ".utf8_encode($nombre_profesor->D_NOMBRES);
?>

<link type="text/css" href="<?=base_url()?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.4.4.min.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui-1.8.10.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script>

<script language="javascript" type="text/javascript" >
     
    $(function(){

            $('#form_cargar_extras').validate({

                rules :{

                        sueldo : {
                            required : true,
                            number: true
                        }
                },
                messages : {

                        sueldo : {
                            required :  "Debe ingresar el sueldo.",
                            number: "Debe ingresar un numero."
                        }
                }

            });    
    });

</script>

<form id="form_cargar_extras" name="form_cargar_extras" method="post" action="<?=base_url()?>index.php/programa/procesa_cargar_curso" >

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
        <h6><strong>CARGAR EXTRAS</strong></h6>
    </div>
    <div class="panel-body">

            <div class="form-group">
                <label for="materia" class="control-label">Profesor</label>
                <input class="form-control" id="disabledInput" type="text" value="<?=$nombre?>"   placeholder="Disabled input" disabled  />
            </div>

            <div class="form-group">
                <label for="materia" class="control-label">Titulo</label>
                <input class="form-control" name="materia" id="materia" type="text" placeholder="Materia" />
            </div>

            <div class="form-group">
                <label for="sueldo" class="control-label">Importe ($)</label>
                <input class="form-control" name="sueldo" id="sueldo" placeholder="Sueldo" />
                <div class="help-block with-errors"></div>
            </div> 

            <div class="form-group">
                <label for="puntos" class="control-label">Categoria</label>
                 <label>Ca</label>
                        <select class="form-control">
                            <option>One Vale</option>
                            <option>Two Vale</option>
                            <option>Three Vale</option>
                            <option>Four Vale</option>
                        </select>
                <div class="help-block with-errors"></div>
            </div>
    </div>
                                             
    <div class="panel-footer" style='text-align:center;'>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cargar</button>
                    <a class="btn" data-dismiss="modal">Cerrar</a>
            </div>
    </div>
</div>
</form>