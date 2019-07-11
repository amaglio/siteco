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

            q('#form_editar_extra').validate({

                rules :{

                    importe : {
                        required : true,
                        digits: true,
                        maxlength: 8
                    },
                    liquidacion : {
                        required : true
                    },
                    concepto :{
                        required : true
                    }
                },
                messages : {

                        importe : {
                            required : "Debe ingresar el importe.",
                            digits: "El importe debe ser un numero positivo.",
                            maxlength: "El importe no puede tener mas de 8 digitos."
                        },
                        liquidacion : {
                            required : "Debe ingresar la fecha."
                        },
                        concepto : {
                            required : "Debe elegir un concepto."
                        }
                }

            });    
    }); 

</script> 


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

<form id="form_editar_extra" name="form_editar_extra" method="post" action="<?=base_url()?>index.php/profesor/procesa_editar_extra_profesor" >

    <input class="form-control" name="legajo" id="legajo" value="<?=$legajo?>" type="hidden"  />
    <input class="form-control" name="concepto" id="concepto" value="<?=$concepto?>" type="hidden" />
    <input class="form-control" name="n_id_profesor" id="n_id_profesor" value="<?=$n_id_profesor?>" type="hidden" />
    

    <div class="panel panel-info">
        <div class="panel-heading">
            <h6><strong>EDITAR EXTRA</strong></h6>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label for="liquidacion" class="control-label">Liquidacion</label>
                    <input class="form-control" name="liquidacion" id="liquidacion" type="text" value="<?=$liquidacion?>" /> <br>
                    <label for="importe" class="control-label">Extra</label>
                    <input class="form-control" name="importe" id="importe" type="text"  value="<?=$importe?>" />
                    <label>Comentarios</label>
                    <textarea class="form-control" id="comentarios" name="comentarios"  rows="3"><?=$c_observaciones?></textarea>
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