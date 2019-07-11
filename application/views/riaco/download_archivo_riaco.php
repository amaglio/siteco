<?php 
echo $vista_head;

?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

    <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-1" style="color:#8BC53F; width:25px;">
                <h4>  <i class="fa  fa-archive"></i></h4>   
            </div>
            <div class="col-md-11" style="text-align:left;">
                 <h4> <strong> <p style=" line-height:20px">    Archivo Riaco </strong>  </p>
            </div>
    </div>

    <div id="page-inner" style="margin:0px; ">
   
        <form  name="profesores_form" id="profesores_form" method="POST"  enctype="multipart/form-data" enctype="multipart/form-data" action="<?=base_url()?>index.php/programa/procesa_archivo_riaco/" >
        <div class="panel panel-info">
            <div class="panel-heading">
                <h6><strong>Riaco</strong></h6>
            </div>
            <div class="panel-body">

                  <div class="form-group">
                    <label for="exampleInputFile">Archivo</label>
                     <input type="file" name="file" size="10" />
                  </div>
            </div>


                                                     
            <div class="panel-footer" style='text-align:center;'>
                    <div class="form-group">
                            <button type="submit" name="buscar" id="buscar" class="btn btn-primary">Generar</button>
                    </div>
            </div>
		
        </div>
		</form>

        <div class="alert alert-success">
                Descargue el Archivo: <a href="<?=base_url()?>assets/uploads/riaco.dat" target="_blank">Riaco.dat</a>
        </div>

        <div class="alert alert-danger">
                Dado que el archivo contiene información confidencial por favor presione el boton borrar para borrar el archivo del servidor
                <form method="post" action="<?=base_url()?>index.php/programa/borrar_archivo_riaco/"  />
					<button type="submit" name="borrar" id="borrar" class="btn btn-danger">Borrar</button>
				</form>
        </div>
        

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


</body>
</html>