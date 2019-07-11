q(function(){

        q('#form_comentarios').validate({

            rules :{

                    comentario : {
                        required : true
                    }
            },
            messages : {

                    comentario : {
                        required : "Debe ingresar un comentario."
                    }
            }

        });    
}); 

q(function(){

    q('#form_editar_curso').validate({

        rules :{

                autocomplete : {
                    required : true
                },
                puntos : {
                    required : true,
                    number: true
                },
                sueldo : {
                    required : true,
                    number: true
                }
        },
        messages : {

                autocomplete : {
                    required : "Debe ingresar el profesor."
                },

                puntos : {
                    required :  "Debe ingresar los puntos.",
                    number: "Debe ingresar un numero."
                },
                sueldo : {
                    required :  "Debe ingresar el sueldo.",
                    number: "Debe ingresar un numero."
                }
        }

    });    
}); 

q(function(){

        q('#form_editar_importe').validate({

            rules :{
                    sueldo : {
                        required : true,
                        number: true
                    }
            },
            messages : {
                    sueldo : {
                        required :  "Debe ingresar el sueldo.",
                        number: "Debe ingresar un numero."
                    }
            }

        });    
}); 