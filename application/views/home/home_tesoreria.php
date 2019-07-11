<?php   echo $vista_head;    

       

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

                <div class="col-md-12 col-sm-12" style="padding-right: 0px; padding-left: 0px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Resumen de programas</strong>
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
                            
                                <div class="tab-pane fade active in" id="prg_grado"> <!-- GRADO  -->
                                        <table class="table table-striped table-bordered table-hover">  
                                            <thead>
                                                <tr class="info">
                                                    <th>Sigla </th>
                                                    <th>Programa</th>
                                                    <th  ># Cursos</th>
                                                    <th  ># Cursos confirmados</th>
                                                    <th  ># 1er Semestre</th>
                                                    <th  ># 2do Semestre</th>
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
                                                        <td><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->D_DESCRIP)?></a></td>   

                                                        <td style="text-align: center">
                                                            <?php  echo $cursos->num_rows(); ?>
                                                        </td>                                           
                                                        <td style="text-align: center" >  
                                                            <?php  echo $cursos_confirmados->num_rows(); ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            
                                                            <?php 
                                                                $cantidad_cursos = 0 ;
                                                                foreach ($cursos->result() as $row):

                                                                        if($row->N_PERIODO == 1):
                                                                            $cantidad_cursos++;
                                                                        endif;


                                                                endforeach;

                                                                $cantidad_cursos_confirmados = 0 ;
                                                                foreach ($cursos_confirmados->result() as $row):

                                                                        if($row->N_PERIODO == 1):
                                                                            $cantidad_cursos_confirmados++;
                                                                        endif;


                                                                endforeach;

                                                                echo $cantidad_cursos_confirmados."/".$cantidad_cursos;
                                                            ?>

                                                        </td> 
                                                        <td style="text-align: center">
                                                            
                                                             <?php 
                                                                $cantidad_cursos = 0 ;
                                                                foreach ($cursos->result() as $row):

                                                                        if($row->N_PERIODO == 2):
                                                                            $cantidad_cursos++;
                                                                        endif;


                                                                endforeach;

                                                                $cantidad_cursos_confirmados = 0 ;
                                                                foreach ($cursos_confirmados->result() as $row):

                                                                        if($row->N_PERIODO == 2):
                                                                            $cantidad_cursos_confirmados++;
                                                                        endif;


                                                                endforeach;

                                                                echo $cantidad_cursos_confirmados."/".$cantidad_cursos;
                                                            ?>

                                                        </td> 

                                                    </tr>
                                                <?php   endforeach; ?>
                                            </tbody>
                                        </table>
                                </div>

                                <div class="tab-pane fade" id="prg_posgrado"> <!-- POSGRADO  -->
                                        <table class="table table-striped table-bordered table-hover"> 
                                            <thead>
                                                <tr class="info">
                                                    <th>Sigla </th>
                                                    <th>Programa</th>
                                                    <th># Cursos</th>
                                                    <th># Cursos confirmados</th>
                                                    <th># 1er Trimestre</th>
                                                    <th># 2do Trimestre</th>
                                                    <th># 3er Trimestre</th>
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
                                                        <td><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->D_DESCRIP)?></a></td>   

                                                        <td style="text-align: center">
                                                            <?php  echo $cursos->num_rows(); ?>
                                                        </td>                                           
                                                        <td style="text-align: center" >  
                                                            <?php  echo $cursos_confirmados->num_rows(); ?>
                                                        </td>

                                                        <td style="text-align: center">
                                                            
                                                            <?php 
                                                                $cantidad_cursos = 0 ;
                                                                foreach ($cursos->result() as $row):

                                                                        if($row->N_PERIODO == 1):
                                                                            $cantidad_cursos++;
                                                                        endif;


                                                                endforeach;

                                                                $cantidad_cursos_confirmados = 0 ;
                                                                foreach ($cursos_confirmados->result() as $row):

                                                                        if($row->N_PERIODO == 1):
                                                                            $cantidad_cursos_confirmados++;
                                                                        endif;


                                                                endforeach;

                                                                echo $cantidad_cursos_confirmados."/".$cantidad_cursos;
                                                            ?>

                                                        </td> 

                                                        <td style="text-align: center">
                                                            
                                                            <?php 
                                                                $cantidad_cursos = 0 ;
                                                                foreach ($cursos->result() as $row):

                                                                        if($row->N_PERIODO == 2):
                                                                            $cantidad_cursos++;
                                                                        endif;


                                                                endforeach;

                                                                $cantidad_cursos_confirmados = 0 ;
                                                                foreach ($cursos_confirmados->result() as $row):

                                                                        if($row->N_PERIODO == 2):
                                                                            $cantidad_cursos_confirmados++;
                                                                        endif;


                                                                endforeach;

                                                                echo $cantidad_cursos_confirmados."/".$cantidad_cursos;
                                                            ?>

                                                        </td> 

                                                         <td style="text-align: center">
                                                            
                                                            <?php 
                                                                $cantidad_cursos = 0 ;
                                                                foreach ($cursos->result() as $row):

                                                                        if($row->N_PERIODO == 3):
                                                                            $cantidad_cursos++;
                                                                        endif;


                                                                endforeach;

                                                                $cantidad_cursos_confirmados = 0 ;
                                                                foreach ($cursos_confirmados->result() as $row):

                                                                        if($row->N_PERIODO == 3):
                                                                            $cantidad_cursos_confirmados++;
                                                                        endif;


                                                                endforeach;

                                                                echo $cantidad_cursos_confirmados."/".$cantidad_cursos;
                                                            ?>

                                                        </td> 

                        

                                                    </tr>
                                                <?php   endforeach; ?>
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane fade" id="prg_ejec_pac"> <!-- PE y PAC  -->
                                        <table class="table table-striped table-bordered table-hover"> 
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
                                                        <td style="width:450px;"><a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=utf8_encode($row->D_DESCRIP)?></a></td>   
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
 
        </div> 
 
    </div>

 
    <script src="<?=base_url()?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/custom.js"></script>
    
</body>
</html>
