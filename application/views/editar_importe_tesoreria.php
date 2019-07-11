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

            q('#form_editar_importe').validate({

                rules :{

                        sueldo : {
                            required : true,
                            number: true
                        }
                },
                messages : {

                        sueldo : {
                            required : "Debe ingresar un importe.",
                            number: "Debe ingresar un numero"
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


<?php 
    /*
	echo $id_materia."<br>";
	echo $idUsuario."<br>";
	echo $id_curso."<br>";
	echo $anio_lectivo."<br>";
	echo $puntos."<br>";
    echo $id_horario."<br>";
    echo rawurldecode($rol)."<br>";*/

?>
 

<form id="form_editar_importe" name="form_editar_importe" method="post" action="<?=base_url()?>index.php/profesor/procesa_editar_importe_tesoreria" >
<!--- hidden -->

 <input type='hidden' name='id_materia' id='id_materia' value='<?=$id_materia?>'/>
<input type='hidden' name='id_curso' id='id_curso'  value='<?=$id_curso?>'/>
<input type='hidden' name='anio_lectivo' id='anio_lectivo'  value='<?=$anio_lectivo?>'/>
<input type='hidden' name='id_horario' id='id_horario'  value='<?=$id_horario?>'/>
<input type='hidden' id='rol' name='rol' value="<?=$rol?>"/>
<input type='hidden' id='idUsuario' name='idUsuario' value="<?=$idUsuario?>"/>


<div class="panel panel-info">
    <div class="panel-heading">
        <h6><strong>EDITAR IMPORTE DEL CURSO</strong></h6>
    </div>
    <div class="chat-panel panel panel-default chat-boder chat-panel-head" style="padding:10px" >
        
         <div class="form-group">
                <label for="sueldo" class="control-label">Sueldo ($)</label>
                <input class="form-control" name="sueldo" id="sueldo" />
                <div class="help-block with-errors"></div>
            </div> 

    </div>
                                             
    <div class="panel-footer" style='text-align:center;'>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <a class="btn" data-dismiss="modal">Cerrar</a>
            </div>
    </div>
</div>
</form>  

</body>
</html>