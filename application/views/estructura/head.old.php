<?php 
    $CI = &get_instance(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript">
        CI_ROOT = "<?=base_url() ?>";
</script>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>SITECO : Sistema de tesoreria y coordinadores</title>
<link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" />
<link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet" />
<link href="<?=base_url()?>assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
<link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<link href="<?=base_url()?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?=base_url()?>assets/js/yoxview/yoxview.css" rel="stylesheet" type="text/css" />

<style type="text/css">
label.error 
{
    color:red;
    background: #fff;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
}
</style>

</head>
<body>

    <div id="wrapper">
    
        <nav class="navbar-default navbar-side" role="navigation">

            <div class="sidebar-collapse">

                <ul class="nav" id="main-menu">

                    <!-- LOGO -->

                    <li class="text-center" style="margin:0px; padding:0px;">
                        <img  style="margin-bottom:15px; margin-top:15px;" src="<?=base_url()?>assets/images/siteco.png" />
                    </li>

                    <!-- IMAGEN Y USUARIO -->

                    <li class="text-center" style="color:#fff; padding-top:5px; padding-bottom:5px">
                        
 
                        <?php   
                            if(in_array('ROLE_COORDINADOR',$this->session->userdata('roles'))):  

                                $texto = "Dir. Carrera: ";
                                $foto = base_url()."assets/images/fotos/".$this->session->userdata('usuario_tesoreria').".jpg";



                            elseif(in_array('ROLE_TESORERIA',$this->session->userdata('roles'))): 

                                $texto = "Tesoreria: ";
                                $foto  = "http://www.ucema.edu.ar/sites/default/files/2014/mgarcia.png";
                            
                            else:  

                                $texto = "Sec. Administrativo:";
                                $foto = base_url()."assets/images/fotos/SECRETARIO.jpg";

                            endif; 
                        ?>
                        
                        <table style="margin-left:50px">
                            <tr>
                                <td> 
                                    <img style='padding:3px; width:100px; height:100px;  background-color:#fff; border:solid 1px #1C1C1C;  margin-bottom:3px; margin-top:5px; ' src="<?=$foto?>" class="user-image img-responsive"/>
                                    <span style="font-size:11px; color:#8BC53F; font-weight:bold"> <?=$texto." ".$this->session->userdata('usuario_tesoreria')?> </span>
                                </td>
                                <td>
                                    <a href="<?=base_url()?>index.php/notificacion/" style="padding:0px;"><span class="glyphicon glyphicon-bell " style="color:#fff; vertical-align:middle;  font-size: 20px; padding-left:15px" aria-hidden="true">   </span> <span style="background-color:red" class="badge "><?=$CI->Notificacion_model->cantidad_notificaciones_nuevas($this->session->userdata('usuario_tesoreria'))?></span> </a>
                                </td>
                            </tr>
                        </table>
                    </li>
                    
                    <!-- HOME -->

                    <li>
                        <a href="<?=base_url()?>index.php/home/"><i class="fa fa-home fa-3x" style="width:50px" ></i> Home </a>
                    </li> 

                    <!-- PROFESORES -->

                    <?php   if( in_array('ROLE_TESORERIA',$this->session->userdata('roles')) || in_array('ROLE_COORDINADOR',$this->session->userdata('roles')) ): ?>

                            <li>
                               <a href="<?=base_url()?>index.php/profesor/"><i class="fa fa-users fa-3x"style="width:50px" ></i> Profesores</a>
                            </li>

                    <?php   endif;  ?>
                    
                    <!-- PROGRAMAS -->

                    <?php   if( in_array('ROLE_TESORERIA',$this->session->userdata('roles')) ): ?>
                        
                        <li>
                            <a href="#"><i class="fa fa-bars fa-3x" style="width:50px" ></i> Programas </a>
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
                                                    <a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=$carrera;?> <br><span style="font-size:10px"><?=$carrera_des;?></span></a>
                                                </li>
                                        <?php   } ?>
                                    </ul>                        
                                </li>
                            </ul>
                        </li>
                    
                    <?php   else:   ?>

                            <li>
                                <a  href="#"><i class="fa fa-file fa-3x" style="width:50px"></i> Programas<span class="fa arrow"></span></a>
                                  <ul class="nav nav-second-level">
                                    
                                    <?php   foreach ($carreras_dirigidas->result() as $row ) 
                                        { 
                                            $carrera = utf8_encode($row->CARRERA);
                                            $carrera_des = utf8_encode($row->D_DESCINF);

                                            ?>
                                            <li>
                                                <a href="<?=base_url()?>index.php/programa/index/<?=$row->C_IDENTIFICACION?>/<?=$row->C_PROGRAMA?>/<?=$row->C_ORIENTACION?>"><?=$carrera;?> <br><span style="font-size:10px"><?=$carrera_des;?></span> </a> 
                                            </li>
                                    <?php   } ?>

                                </ul>
                            </li>

                     <?php   endif;  ?>

                    <?php   if( in_array('ROLE_TESORERIA',$this->session->userdata('roles')) ): ?>
                        
                        <!-- CURSOS MODIFICADOS --> 
                        <li>
                           <a href="<?=base_url()?>index.php/programa/cursos_modificados"><i class="fa fa-refresh fa-3x" style="width:50px" ></i> Cursos Modificados </a>
                        </li>

                        <!-- CURSOS SIN CONFIRMAR -->
                        <li>
                           <a href="<?=base_url()?>index.php/programa/cursos_sin_confirmar_coordinador"><i class="fa fa-bars fa-3x" style="width:50px" ></i> Cursos sin confirmar </a>
                        </li>

                        <!-- CURSOS SIN LIQUIDACION -->
                        <li>
                           <a href="<?=base_url()?>index.php/programa/cursos_sin_importe_tesoreria"><i class="fa fa-usd fa-3x" style="width:50px" ></i> Cursos sin liquidacion </a>
                        </li>

                        <!-- RIACCO -->
                        <li>
                           <a href="<?=base_url()?>index.php/programa/riaco"><i class="fa fa-archive fa-3x" style="width:50px"></i> Riacco </a>
                        </li>

                        <!-- Res Prg -->
                        <li>
                           <a href="<?=base_url()?>index.php/programa/resumen_coordinadores_secretarios"> <i class="fa fa-tasks fa-3x   "></i> Resumen. Prg </a>
                        </li>
                
                    <?php   endif;  ?>
                    
                    <!-- AYUDA -->

                    <li>
                        <a href="<?=base_url()?>index.php/ayuda" > <i class="fa fa-question fa-3x" style="width:50px"></i>Ayuda </a>
                    </li>

                    <!-- SALIR -->
                    <li>
                        <a href="<?=base_url()?>index.php/login/logout" > <i class="fa fa-power-off fa-3x" style="width:50px" ></i>SALIR </a>
                    </li>     

                    <!-- LOGO  -->
                    <li class="text-center" style="margin:0px; padding:0px; border-bottom:none">
                        <img  style="width:260px; height:65px; margin-top:10px;" src="<?=base_url()?>assets/images/logo.png" />
                    </li> 

                   
                </ul>
            
            </div>

        </nav> 
