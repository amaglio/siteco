 jq(function(){
    

    // Importe de tesoreria 

    jq('#form_factura').validate({

        rules :{
                fecha_factura : {
                    required : true
                }
        },
        messages : {
                fecha_factura : {
                    required :  "Debe ingresar la fecha de la factura."
                }
        }

    });
    

    // Importe de tesoreria 

    jq('#form_editar_importe').validate({

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

    // Cargar extra 
    jq('#form_cargar_extras').validate({

        rules :{

                sueldo : {
                    required : true,
                    number: true,
                    maxlength: 8
                },
                liquidacion : {
                    required : true
                },
                concepto :{
                    required : true
                }
        },
        messages : {

                sueldo : {
                    required : "Debe ingresar el importe.",
                    number: "El importe debe ser un numero positivo.",
                    maxlength: "El importe no puede tener mas de 8 digitos."
                },
                liquidacion : {
                    required : "Debe seleccionar el mes (liquidacion)."
                },
                concepto : {
                    required : "Debe elegir un concepto."
                }
        }
    });  

    // Editar extra
    jq('#form_editar_extra').validate({

        rules :{

                importe : {
                    required : true,
                    number: true,
                    maxlength: 8
                },
                liquidacion : {
                    required : true
                },
                concepto :{
                    required : true
                }
        },
        messages : {

                importe : {
                    required : "Debe ingresar el importe.",
                    number: "El importe debe ser un numero positivo.",
                    maxlength: "El importe no puede tener mas de 8 digitos."
                },
                liquidacion : {
                    required : "Debe ingresar la swwww."
                },
                concepto : {
                    required : "Debe elegir un concepto www."
                }
        }
    });   

     // Cargar extra autonomo
    jq('#form_cargar_extra_autonomo').validate({

        rules :{

                sueldo : {
                    required : true,
                    number: true,
                    maxlength: 8
                },
                liquidacion : {
                    required : true
                } 
        },
        messages : {

                sueldo : {
                    required : "Debe ingresar el importe.",
                    number: "El importe debe ser un numero positivo.",
                    maxlength: "El importe no puede tener mas de 8 digitos."
                },
                liquidacion : {
                    required : "Debe seleccionar el mes (liquidacion)."
                } 
        }
    });  

    // Editar extra
    jq('#form_editar_extra_autonomo').validate({

        rules :{

                importe : {
                    required : true,
                    number: true,
                    maxlength: 8
                },
                liquidacion : {
                    required : true
                } 
        },
        messages : {

                importe : {
                    required : "Debe ingresar el importe para el autonomo.",
                    number: "El importe debe ser un numero positivo.",
                    maxlength: "El importe no puede tener mas de 8 digitos."
                },
                liquidacion : {
                    required : "Debe ingresar la liquidacion."
                } 
        }
    });  
   
 

    jq.datepicker.regional['es'] = {
             closeText: 'Cerrar',
             prevText: '<Ant',
             nextText: 'Sig>',
             currentText: 'Hoy',
             monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
             monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
             dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
             dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
             dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
             weekHeader: 'Sm',
             dateFormat: 'dd/mm/yy',
             firstDay: 1,
             isRTL: false,
             showMonthAfterYear: false,
             yearSuffix: ''
        };

    jq.datepicker.setDefaults(jq.datepicker.regional['es']);
    
    jq('#liquidacion').datepicker({
            changeMonth: true,
            changeYear: true,
            changeDay: false,
            dateFormat: 'yymm'
    });
      

}); 