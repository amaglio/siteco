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

    <link href="<?=base_url()?>assets/css/login.css" rel="stylesheet">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.png">

    <style type="text/css">

      .form-signin{

         -webkit-box-shadow: 0px 3px 29px 4px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 3px 29px 4px rgba(0,0,0,0.75);
        box-shadow: 0px 3px 29px 4px rgba(0,0,0,0.75);
      }
      
     

    </style>

  </head>

  <body style="background-image: url('<?=base_url()?>assets/images/fondo_ucema.png'); background-color:#B4B4B4;">

    <div class="container" >
    
      <form class="form-signin" method="post" id="loguearse">  
          <div>
                <img src="<?=base_url()?>assets/images/siteco2.png"/>
          </div>
          <br/>
          <input name='usuario'  id='usuario' type="text" class="input-block-level" placeholder="Usuario"/>
          <input name='clave' id='clave' type="password" class="input-block-level" placeholder="Clave"/>
          <button class="btn btn-large btn-primary" type="submit" style="margin-left:60px" name='iniciar' id='iniciar'> 
              Ingresar <div id="cargando" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></div>
          </button>

      </form>

    </div>  

    <script src="<?=base_url()?>assets/js/jquery.js"> </script>
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