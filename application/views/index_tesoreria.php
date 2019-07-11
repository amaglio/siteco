<?php 

    echo $vista_head;
     
?>
        <!-- /. NAV SIDE  -->
        
        <div id="page-wrapper" >

            <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
                    <div class="col-md-12 col-lg-12 ">
                         <h3><strong> ADMINISTRADOR </strong></h3>   
                         <h5>Bienvenido/a: <strong><?=$this->session->userdata('usuario_tesoreria');?></strong>. </h5>
                    </div>
            </div> 
            
            <div id="page-inner">

                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Resumen de programas
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#prg_grado" data-toggle="tab"> <i class="fa fa-list-ol"></i> Programas de Grado</a>
                                </li>
                                <li class=""><a href="#prg_posgrado" data-toggle="tab"> <i class="fa fa-th-list"></i> Programas de Posgrado</a>
                                </li>
                                <li class=""><a href="#prg_ejec_pac" data-toggle="tab"><i class="fa fa-list-ul"></i> Programas Ejec. y Programas de Act.</a>
                                </li>
                            </ul>

                            <div class="tab-content" style="margin-top:20px">
                            
                                <div class="tab-pane fade active in" id="prg_grado">
                                        <table class="table table-striped table-bordered table-hover">  <!-- GRADO  -->
                                            <thead>
                                                <tr class="info">
                                                    <th>Sigla </th>
                                                    <th>Programa</th>
                                                    <th  ># Cursos</th>
                                                    <th  ># Cursos confirmados</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  foreach ($programas_grado->result() as $row): 

                                                        $cursos = $this->Programas_model->cursos_asignados_programa(    $row->C_IDENTIFICACION, 
                                                                                                                        $row->C_PROGRAMA, 
                                                                                                                        $row->C_ORIENTACION,
                                                                                                                        date('Y'));

                                                        $cursos_confirmados = $this->Programas_model->cursos_confirmados_programa(  $row->C_IDENTIFICACION, 
                                                                                                                                    $row->C_PROGRAMA, 
                                                                                                                                    $row->C_ORIENTACION,
                                                                                                                                    date('Y'));

                                                        if( $cursos->num_rows() == $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                                            $class = "success";
                                                        elseif( $cursos->num_rows() != $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                                            $class = "danger";
                                                        else
                                                            $class = " ";    
                                                ?>

                                                     <tr class="<?=$class?>" >
                                                        <td><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->D_DESCRED)?></a></td>   
                                                        <td><?=utf8_encode($row->D_DESCRIP)?></td>   

                                                        <td style="text-align: center">
                                                            <?php  echo $cursos->num_rows(); ?>
                                                        </td>                                           
                                                        <td style="text-align: center" >  
                                                            <?php  echo $cursos_confirmados->num_rows(); ?>
                                                        </td>
                                                    </tr>
                                                <?php   endforeach; ?>
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane fade" id="prg_posgrado">
                                        <table class="table table-striped table-bordered table-hover"> <!-- POSGRADO  -->
                                            <thead>
                                                <tr class="info">
                                                    <th>Sigla </th>
                                                    <th>Programa</th>
                                                    <th># Cursos</th>
                                                    <th># Cursos confirmados</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  foreach ($programas_posgrado->result() as $row): 

                                                        $cursos = $this->Programas_model->cursos_asignados_programa(    $row->C_IDENTIFICACION, 
                                                                                                                        $row->C_PROGRAMA, 
                                                                                                                        $row->C_ORIENTACION,
                                                                                                                        date('Y'));

                                                        $cursos_confirmados = $this->Programas_model->cursos_confirmados_programa(  $row->C_IDENTIFICACION, 
                                                                                                                                    $row->C_PROGRAMA, 
                                                                                                                                    $row->C_ORIENTACION,
                                                                                                                                    date('Y'));

                                                        if( $cursos->num_rows() == $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                                            $class = "success";
                                                        elseif( $cursos->num_rows() != $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                                            $class = "danger";
                                                        else
                                                            $class = " ";    
                                                ?>

                                                     <tr class="<?=$class?>" >
                                                        <td><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->D_DESCRED)?></a></td>   
                                                        <td><?=utf8_encode($row->D_DESCRIP)?></td>   

                                                        <td style="text-align: center">
                                                            <?php  echo $cursos->num_rows(); ?>
                                                        </td>                                           
                                                        <td style="text-align: center" >  
                                                            <?php  echo $cursos_confirmados->num_rows(); ?>
                                                        </td>
                                                    </tr>
                                                <?php   endforeach; ?>
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane fade" id="prg_ejec_pac">
                                         <table class="table table-striped table-bordered table-hover"> <!-- PE y PAC  -->
                                            <thead>
                                                <tr class="info">
                                                    <th>Sigla 2</th>
                                                    <th>Programa</th>
                                                    <th># Cursos</th>
                                                    <th># Cursos confirmados</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  foreach ($programas_ejecutivos->result() as $row): 
                                                  
                                                                                                 
                                                        $cursos = $this->Programas_model->cursos_asignados_programa_ejepac(     $row->C_IDENTIFICACION, 
                                                                                                                                $row->C_PROGRAMA, 
                                                                                                                                $row->C_ORIENTACION,
                                                                                                                                date('Y')
                                                                                                                            );

                                                         
                                                        $cursos_confirmados = $this->Programas_model->cursos_confirmados_programa_ejepac(  $row->C_IDENTIFICACION, 
                                                                                                                                    $row->C_PROGRAMA, 
                                                                                                                                    $row->C_ORIENTACION,
                                                                                                                                    date('Y'));

                                                        if( $cursos->num_rows() == $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                                            $class = "success";
                                                        elseif( $cursos->num_rows() != $cursos_confirmados->num_rows() && $cursos->num_rows() > 0 )
                                                            $class = "danger";
                                                        else
                                                            $class = " ";   

                                                ?>
                                                    <tr class="<?=$class?>" >
                                                        <td style="width:160px;"><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->D_DESCRED)?></a></td>   
                                                        <td style="width:450px;"><?=utf8_encode($row->D_DESCRIP)?></td>   
                                                        <td style="text-align: center">
                                                            <?php  
                                                                //echo $row->C_IDENTIFICACION." - ".$row->C_PROGRAMA." - ".$row->C_ORIENTACION."<br>";
                                                                echo $cursos->num_rows(); ?>
                                                        </td>                                           
                                                        <td style="text-align: center" >  
                                                            <?php  echo $cursos_confirmados->num_rows(); ?>
                                                        </td>
                                                    </tr>
                                                <?php  
                                                    endforeach; ?>
                                            </tbody>
                                        </table>
                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> 
           <!-- /. PAGE INNER  -->
        </div> 
         <!-- /. PAGE WRAPPER  -->
    </div>

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="<?=base_url()?>assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="<?=base_url()?>assets/js/custom.js"></script>

</body>
</html>
