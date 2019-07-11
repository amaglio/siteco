 jq(function(){

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


    jq('#form_cargar_extras').validate({

        rules :{

                sueldo : {
                    required : true,
                    number: true,
                    maxlength: 12
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
                    maxlength: "El importe no puede tener mas de 12 digitos."
                },
                liquidacion : {
                    required : "Debe ingresar la ss."
                },
                concepto : {
                    required : "Debe elegir un concepto."
                }
        }
    });  

    jq('#form_cargar_extra_autonomo').validate({

        rules :{

                sueldo : {
                    required : true,
                    number: true,
                    maxlength: 12
                },
                liquidacion : {
                    required : true
                } 
        },
        messages : {

                sueldo : {
                    required : "Debe ingresar el importe.",
                    number: "El importe debe ser un numero positivo.",
                    maxlength: "El importe no puede tener mas de 12 digitos."
                },
                liquidacion : {
                    required : "Debe ingresar la fechaaaa."
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