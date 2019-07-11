<?php 

    echo $vista_head;
    /*<?=base_url()?>assets/MANUAL_SITECO.pdf*/
?>
        <!-- /. NAV SIDE  -->       
 
    <script type="text/javascript" src="<?=base_url()?>assets/js/yoxview.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
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
        });
    </script>


    <div id="page-wrapper" >

        <div class="row"  style="border-bottom:1px solid #000; color:#fff; border-top:1px solid #000; margin:0px; margin-bottom:10px; background-color:#202020;">
            <div class="col-md-1" style="color:#8BC53F; width:25px;">
                <h4>  <i class="fa  fa-question"></i></h4>   
            </div>
            <div class="col-md-11" style="text-align:left;">
                 <h4> <strong> <p style=" line-height:20px">  Manual de Ayuda </strong>  </p>
            </div>
        </div>

        <div id="page-inner">

            <div id="container">
                
                <div class="alert alert-info">
                    El manual le permitira conocer todas las caracteristicas de SITECO.
                </div>


                <div class="thumbnails yoxview">

                        <a href='<?=base_url()?>assets/siteco_manual/SITECO_WEB.html' target='yoxview'>
                             
                            <img src="<?=base_url()?>assets/images/ver_manual.jpeg" style="border:0px; margin-left:200px" alt="Ver manual"/>
                        
                        </a>
     

                </div>


<!-- 
        <iframe src="http://docs.google.com/gview?url=<?=base_url()?>assets/MANUAL_SITECO.pdf&embedded=true" 
style="width:600px; height:500px;" frameborder="0"></iframe> -->

        </div>
       
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

    <script src="<?=base_url()?>assets/js/yoxview/yox.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/js/yoxview/jquery.yoxview-2.21.js" type="text/javascript"></script>

 
</body>
</html>
