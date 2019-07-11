<?php 
echo $vista_head;
?>
       
    <div id="page-wrapper" >
        
        <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
                <div class="col-md-1" style="color:#8BC53F; width:25px;">
                    <h4>  <i class="fa fa-home 2x"></i></h4>   
                </div>
                <div class="col-md-11" style="text-align:left;">
                     <h4> <strong>Home</strong>  </h4>
                </div>
         </div>  

        <div id="page-inner">
               <?php  echo "ID PERSONA: ".$this->session->userdata('id_persona'); ?>
                <!-- Año actual -->
                <div class="panel panel-info ">
                   
                    <div class="panel-heading">
                       <strong> Resumen de las carrera coordinadas <?=date('Y')?> </strong>
                    </div>
                    
                    <div class="panel-body ">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="background-color:#E6E6E6;">
                                         <th>Sigla </th>
                                        <th>Programa</th>
                                        <th># Cursos SIGEU</th>
                                        <th># Cursos SIGEU confirmados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php  foreach ($carreras_dirigidas->result() as $row): 

                                        $cursos = $this->Programas_model->cursos_asignados_programa(    $row->C_IDENTIFICACION, 
                                                                                                        $row->C_PROGRAMA, 
                                                                                                        $row->C_ORIENTACION,
                                                                                                        date('Y')
                                                                                                    );
                                        $cursos_confirmados = $this->Programas_model->cursos_confirmados_programa(  $row->C_IDENTIFICACION, 
                                                                                                                    $row->C_PROGRAMA, 
                                                                                                                    $row->C_ORIENTACION,
                                                                                                                    date('Y'));

                                        if( $cursos->num_rows() == $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                            $class = "success";
                                        else
                                            $class = " ";    
                                ?>

                                    <tr  class="<?=$class?>" >
                                        <td><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->CARRERA)?></a></td>
                                        <td><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->D_DESCINF)?></a></td>
                                        <td><?=$cursos->num_rows();?></td>
                                        <td><?=$cursos_confirmados->num_rows();?></td>
                                    </tr>
                                <?php  endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                
                <!-- Año que viene -->
                <div class="panel panel-info ">
                   
                    <div class="panel-heading">
                       <strong> Resumen de las carrera coordinadas <?=date('Y')+1?> </strong>
                    </div>
                    
                    <div class="panel-body ">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="background-color:#E6E6E6;">
                                        <th>Sigla </th>
                                        <th>Programa</th>
                                        <th># Cursos SIGEU</th>
                                        <th># Cursos SIGEU confirmados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                 <?php  foreach ($carreras_dirigidas->result() as $row): 

                                        $cursos = $this->Programas_model->cursos_asignados_programa(    $row->C_IDENTIFICACION, 
                                                                                                        $row->C_PROGRAMA, 
                                                                                                        $row->C_ORIENTACION,
                                                                                                        date('Y')+1
                                                                                                    );
                                        $cursos_confirmados = $this->Programas_model->cursos_confirmados_programa(  $row->C_IDENTIFICACION, 
                                                                                                                    $row->C_PROGRAMA, 
                                                                                                                    $row->C_ORIENTACION,
                                                                                                                    date('Y')+1);

                                        if( $cursos->num_rows() == $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                            $class = "success";
                                        else
                                            $class = " ";    
                                ?>

                                    <tr  class="<?=$class?>" >
                                        <td><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->CARRERA)?></a></td>
                                         <td><?=utf8_encode($row->D_DESCINF)?></td>
                                        <td><?=$cursos->num_rows();?></td>
                                        <td><?=$cursos_confirmados->num_rows();?></td>
                                    </tr>
                                <?php  endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
           
        </div>

    </div>
  
    <script src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/js/morris/morris.js"></script>
    <script src="<?=base_url()?>assets/js/custom.js"></script>

    <script src="<?=base_url()?>assets/js/yoxview/yox.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/js/yoxview/jquery.yoxview-2.21.js" type="text/javascript"></script>

    <script type="text/javascript">$(document).ready(function () {
        $('.yoxview').yoxview({
                                autoHideInfo:false,
                                renderInfoPin:false,
                                allowInternalLinks:true,
                                backgroundColor:'#ffffff',
                                backgroundOpacity:0.8,
                                infoBackColor:'#000000',
                                dataSourceOptions: {
                                                        "max-results": 10,
                                                        imgmax: 800
                                                    },
                                infoBackOpacity:1});
                                
                                $('.yoxview a img').hover(function(){   $(this).animate({opacity:0.7},300)},function(){
                                                                        $(this).animate({opacity:1},300)});});
    </script>

</body>
</html>
