<?php 
    $CI = &get_instance(); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>UCEMA : Tesoreria</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="<?=base_url()?>assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <style type="text/css">
    label.error {
        color:red;
        background: #fff;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
        padding: 2px 5px;
    }
    </style>

</head>
<body>

    <div id="wrapper">
                <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">

            <div class="sidebar-collapse">

                <ul class="nav" id="main-menu">
                     <li class="text-center" style="margin:0px; padding:0px;">
                        <img  style="margin-bottom:15px; margin-top:15px;" src="<?=base_url()?>assets/images/siteco.png" />
                    </li>
                    <li class="text-center" style="margin:0px; padding:0px; color:#fff;">
                       Tesoreria: <?=$this->session->userdata('usuario_tesoreria')?> <a href="<?=base_url()?>index.php/notificacion/"><span class="glyphicon glyphicon-bell " style="color:#fff; vertical-align:middle;  font-size: 20px; padding-left:15px" aria-hidden="true">   </span> <span style="background-color:red" class="badge "><?=$CI->Notificacion_model->cantidad_notificaciones_nuevas($this->session->userdata('usuario_tesoreria'))?></span> </a>
                    </li>
                    <li class="text-center" style="color:#fff; padding-top:5px">
                        
                        <!--<img style='padding:3px;  background-color:#C6C6C6; border:solid 1px #1C1C1C; margin-top:5px;' src="<?=base_url()?>assets/img/find_user.png" class="user-image img-responsive"/> -->
                        <img style='padding:3px; width:100px; height:100px;  background-color:#fff; border:solid 1px #1C1C1C; margin-top:5px;' src="http://www.ucema.edu.ar/sites/default/files/2014/mgarcia.png" class="user-image img-responsive"/> 
                    </li>
                     <li>
                        <a href="<?=base_url()?>index.php/home/"><i class="fa fa-home fa-3x"></i> Home </a>
                    </li> 
                    <li>
                       <a href="<?=base_url()?>index.php/profesor/"><i class="fa fa-users fa-3x"></i> Profesores</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bars fa-3x"></i> Programas </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Grado</a>
                                 <ul class="nav nav-third-level">
                                        <?php   foreach ($programas_grado->result() as $row ) 
                                        { 
                                            $carrera = utf8_encode($row->D_DESCRED);
                                            $carrera_des = utf8_encode($row->D_DESCINF);

                                            ?>
                                            <li>
                                                <!-- <a href="<?=base_url()?>index.php/programa/index/<?=rawurlencode($carrera)?>"><?=$carrera;?></a> -->
                                                <a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=$carrera;?> <br><span style="font-size:10px"><?=$carrera_des;?></span></a>
                                            </li>
                                    <?php   } ?>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Pos grado</a>
                                  <ul class="nav nav-third-level">
                                        <?php   foreach ($programas_posgrado->result() as $row ) 
                                        { 
                                            $carrera = utf8_encode($row->D_DESCRED);
                                            $carrera_des = utf8_encode($row->D_DESCINF);

                                            ?>
                                            <li>
                                                <!-- <a href="<?=base_url()?>index.php/programa/index/<?=rawurlencode($carrera)?>"><?=$carrera;?></a> -->
                                                <a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=$carrera;?> <br><span style="font-size:10px"><?=$carrera_des;?></span></a>
                                            </li>
                                    <?php   } ?>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Programas Ej y Ac.</a>       
                                 <ul class="nav nav-third-level">
                                        <?php   foreach ($programas_ejecutivos->result() as $row ) 
                                        { 
                                            $carrera = utf8_encode($row->D_DESCRED);
                                            $carrera_des = utf8_encode($row->D_DESCINF);

                                            ?>
                                            <li>
                                                <!-- <a href="<?=base_url()?>index.php/programa/index/<?=rawurlencode($carrera)?>"><?=$carrera;?></a> -->
                                                <a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=$carrera;?> <br><span style="font-size:10px"><?=$carrera_des;?></span></a>
                                            </li>
                                    <?php   } ?>
                                </ul>                        
                            </li>
                        </ul>

                    </li>
                    <li>
                       <a href="<?=base_url()?>index.php/programa/cursos_modificados"><i class="fa fa-refresh fa-3x"></i> Cursos Modificados </a>
                    </li>
                    <li>
                       <a href="<?=base_url()?>index.php/programa/cursos_sin_confirmar_coordinador"><i class="fa fa-bars fa-3x"></i> Cursos sin confirmar </a>
                    </li>
                    <li>
                       <a href="<?=base_url()?>index.php/programa/cursos_sin_importe_tesoreria"><i class="fa fa-usd fa-3x"></i> Cursos sin liquidacion </a>
                    </li>
                     <li>
                       <a href="<?=base_url()?>index.php/programa/riaco"><i class="fa fa-archive fa-3x"></i> Riacco </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>index.php/login/logout" > <i class="fa fa-power-off fa-3x"></i></i>SALIR </a>
                    </li>       
                </ul>
            </div>
        </nav> 
