 q(function(){  

    q('.btn.btn-danger.btn-xs.submit').click(function() {

        buttonpressed = $(this).attr('name');
        
        //alert(buttonpressed);
        
        buttonpressed = '#'+buttonpressed;
        error = '#error_'+buttonpressed;

        q(buttonpressed).validate({

                rules : {
                        'check_confirma_coordinador[]' : {
                            required : true 
                        }                
                },
                messages : {
                        'check_confirma_coordinador[]' : {
                            required : "Debe chequear algun curso"
                        }
                },
                errorLabelContainer: error
        }); 

    }); 

});