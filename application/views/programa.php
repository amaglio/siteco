<?php 
    $row_carrera = $datos_programa->row();

    $c_identificacion = $row_carrera->C_IDENTIFICACION;
    $c_programa = $row_carrera->C_PROGRAMA;
    $c_orientacion = $row_carrera->C_ORIENTACION;

    //echo $n_fila_curso;
    //$programa = rawurldecode($this->uri->segment(3));

    //echo  $programa;

    $programa = utf8_encode($row_carrera->D_DESCRED);

    //$carrera = utf8_encode($row->CARRERA);
    //$resultado_programa = $this->Programas_model->datos_programa($row_carrera->D_DESCRED);

    //$row_programa = $resultado_programa->row(); 

    echo $vista_head;



    ?>
        <style type="text/css">
            
              .glyphicon-refresh-animate {
                   font-size: 30px;
                   margin-top: 50px;
                   margin: 0 auto;
                   color:#3D82BD;
                   
                  -animation: spin .7s infinite linear;
                  -webkit-animation: spin2 .7s infinite linear;
                  }

                  @-webkit-keyframes spin2 {
                      from { -webkit-transform: rotate(0deg);}
                      to { -webkit-transform: rotate(360deg);}
                  }

                  @keyframes spin {
                      from { transform: scale(1) rotate(0deg);}
                      to { transform: scale(1) rotate(360deg);}
                  }


        </style>

        </style>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
             <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
                    <div class="col-md-12 col-lg-12 ">
                        <h4>  <i class="fa fa-th-list"></i> - <strong> <?=utf8_encode($row_carrera->D_DESCRIP)?></strong> <?="(".utf8_encode($row_carrera->D_DESCRED).")";?></h4>   
                    </div>
             </div>  
        
               <?php   if(isset($mensaje)): ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong> <?=$mensaje?> </strong>
                        </div>
                <?php       unset($mensaje);
                    endif;   ?>

             <div id="page-inner" style="margin:0px;">            
                                
                <div class="row" >
                
                 <div class="col-md-12" >

                   <div class="panel panel-default" style=" background-color:#F2F2F2;">
                        <div class="panel-body">
                            <ul class="nav nav-tabs" >
                                <li class="active">
                                    <a style="cursor: pointer;" id="anio_actual" data-toggle="tab"><strong><?=date('Y')?></strong></a>
                                </li>
                                <li class="">
                                    <a style="cursor: pointer;" id="anio_siguiente" data-toggle="tab"><?=date('Y')+1?></a>
                                </li>

                            </ul>
                            
                            <div class="tab-content" style="margin-top:10px">
                                <div class="tab-pane fade active in" id="resultado">
                                    

                                    <div id="cargando" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></div>


                                </div>
                            </div>
                        </div>
                    </div>   

                    </div>
                </div>  
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
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    
    <!-- METISMENU SCRIPTS -->
    <script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>

    <!-- CONFIRMA -->
    <script src="<?=base_url()?>assets/js/jquery.confirm.js"></script> 

    <!-- MORRIS CHART SCRIPTS -->
    <script src="<?=base_url()?>assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/js/morris/morris.js"></script>


    <link   type="text/css" href="<?php echo base_url(); ?>assets/css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" /> 

       
    <script>

    $(document).ready(function() {

        // LOAD 
        $('#resultado').load('<?php echo site_url('programa/informacion_anio').'/'.date('Y').'/'.$c_identificacion.'/'.$c_programa.'/'.$c_orientacion.'/'.$n_fila_curso;?>', {valor1:'primer valor', valor2:'segundo valor'}, function( response, status, xhr ) {
                              if ( status == "success" ) {
                               //alert("EXITOSO");
                              
                              }

                          });

         
        $("#anio_actual").load(function(){

            $('#resultado').load('<?php echo site_url('programa/informacion_anio').'/'.date('Y').'/'.$c_identificacion.'/'.$c_programa.'/'.$c_orientacion.'/'.$n_fila_curso;?>');

        });
        

        // CLICK 
        $("#anio_actual").click(function(){

            $('#resultado').load('<?php echo site_url('programa/informacion_anio').'/'.date('Y').'/'.$c_identificacion.'/'.$c_programa.'/'.$c_orientacion.'/'.$n_fila_curso;?>');

        });

        $("#anio_siguiente").click(function(){
            <?php $anio_proximo = date('Y')+1; ?>
            $('#resultado').load('<?php echo site_url('programa/informacion_anio').'/'.$anio_proximo.'/'.$c_identificacion.'/'.$c_programa.'/'.$c_orientacion;?>');

        }); 
        
    
    });
  
    </script>

    <!-- CUSTOM SCRIPTS -->
    <script src="<?=base_url()?>assets/js/custom.js"></script> 

</body>
</html>