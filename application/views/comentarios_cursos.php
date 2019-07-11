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

            q('#form_comentarios').validate({

                rules :{

                        comentario : {
                            required : true
                        }
                },
                messages : {

                        comentario : {
                            required : "Debe ingresar un comentario."
                        }
                }

            });    
    }); 

</script> 
<link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
 <!-- MORRIS CHART STYLES-->

    <!-- CUSTOM STYLES-->
<link href="assets/css/custom.css" rel="stylesheet" />
 <!-- GOOGLE FONTS-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
 <!-- TABLE STYLES-->
<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

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



<form id="form_comentarios" name="form_comentarios" method="post" action="<?=base_url()?>index.php/programa/procesa_agregar_comentario" >
<!--- hidden -->

<input type='hidden' name='id_materia' id='id_materia' value='<?=$id_materia?>'/>
<input type='hidden' name='id_curso' id='id_curso'  value='<?=$id_curso?>'/>
<input type='hidden' name='anio_lectivo' id='anio_lectivo'  value='<?=$anio_lectivo?>'/>
<input type='hidden' name='id_horario' id='id_horario'  value='<?=$id_horario?>'/>
<input type='hidden' id='rol' name='rol' value="<?=$rol?>"/>

<input type='hidden' id='c_identificacion' name='c_identificacion' value="<?=$c_identificacion ?>"/>
<input type='hidden' id='c_programa' name='c_programa' value="<?=$c_programa ?>"/>
<input type='hidden' id='c_orientacion' name='c_orientacion' value="<?=$c_orientacion ?>"/>

<input type='hidden' id='idUsuario' name='idUsuario' value="<?=$idUsuario?>"/>

<?php 
     $comentarios=(explode("|",$comentarios));
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h6><strong>COMENTARIOS DEL CURSO</strong></h6>
    </div>
    <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
        <table class="table table-striped" style="font-size:11px; overflow: scroll; overflow-x:hidden; ">
            <thead>
                <tr>    
                    <th>Comentario</th>
                </tr>
            </thead>
            <tbody>

        <?php   foreach ($comentarios as $row): 

                echo "<tr> <td><strong>".$row."</td></tr>";

            endforeach; ?> 

            </tbody>
        </table> 
    </div>


    <div class="panel-body">
            <div class="form-group">
                <label for="materia" class="control-label">Comentario</label>
                 <textarea name="comentario" name="comentario" class="form-control" rows="3"></textarea>
            </div>
    </div>
                                             
    <div class="panel-footer" style='text-align:center;'>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <a class="btn" data-dismiss="modal">Cerrar</a>
            </div>
    </div>
</div>
</form>

</body>
</html>