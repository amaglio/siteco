
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Administracion </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #ffffff;
        background-image: url('<?=base_url()?>assets/images/fondo_ucema.png');
        background-repeat: no-repeat;

      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      label.error {
          color:red;
          background: #fff;
          box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
          padding: 2px 5px;
      }

      .glyphicon-refresh-animate {
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
    <link href="<?=base_url()?>assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="..assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.png">
  </head>

  <body>

    <div class="container" >
      


      <form class="form-signin" method="post" id="loguearse">
        <div><img src="<?=base_url()?>assets/images/siteco.png"></div>
        
          </br><input name='usuario'  id='usuario' type="text" class="input-block-level" placeholder="Usuario">
          <input name='clave' id='clave' type="password" class="input-block-level" placeholder="Clave">
          <button class="btn btn-large btn-primary" type="submit" style="margin-left:60px" name='iniciar' id='iniciar'> Ingresar <div id="cargando" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></div></button>
        
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>assets/js/jquery.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-transition.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-alert.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-modal.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-tab.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-tooltip.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-popover.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-button.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-collapse.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-carousel.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-typeahead.js"></script>

    <script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.4.4.min.js"></script> 
    <script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui-1.8.10.custom.min.js"></script> 
    <script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
    <script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script> 
    <script>
            var q = jQuery.noConflict();
    </script>

    <script language="javascript" type="text/javascript" >

      $(function(){

        $("#cargando").hide();   
      });

      q(function(){

              q('#loguearse').validate({

                  rules :{

                          usuario : {
                              required : true
                          },
                          clave : {
                              required : true
                          }
                  },
                  messages : {

                          usuario : {
                              required : "Debe ingresar su usuario."
                          },

                          clave : {
                              required :  "Debe ingresar su clave."
                          }
                  },
                   submitHandler: function(form) {
                    // do other things for a valid form
                    //$("#btnAddProfile").prop('value', );
                    $('#cargando').show();
                    form.submit();
                      
                     
                  }

              });    
      }); 

   

    </script>

  </body>
</html>