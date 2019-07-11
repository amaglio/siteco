
jq(document).ready(function () {

if( $('#a_descontar').val() < 0 )
{

    var cantidad_materias = $('#cantidad_total_materias').val();

    for(var i=0; i <= cantidad_materias; i++)
    {
        $("#materia_"+i).val(0);
    }
    
    //alert($('#cantidad_total_materias').val());    
}     

// Chequea los check de importe default
$('#check_all_default').change(function(){
    var checkboxes = $(this).closest('form').find('.clase_importe_default');
    if($(this).prop('checked')) {
      checkboxes.prop('checked', true);
    } else {
      checkboxes.prop('checked', false);
    }
});

// Chequea los check de importe coordinador
$('#check_all_coordinador').change(function(){
    var checkboxes = $(this).closest('form').find('.clase_importe_coordinador');
    if($(this).prop('checked')) {
      checkboxes.prop('checked', true);
    } else {
      checkboxes.prop('checked', false);
    }
});

$('[data-toggle="ajaxModalHistorial"]').on('click',
      function(e) {
        $('#ajaxModalHistorial').remove();
        e.preventDefault();
        var $this = $(this)
          , $remote = $this.data('remote') || $this.attr('href')
          , $modal = $('<div class="modal fade" style="width:600px; margin-top:20px;  margin-left: auto;  margin-right: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  id="ajaxModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        $modal.modal({backdrop: 'static', keyboard: false});
        $modal.load($remote);
      }
);


/*
    MODAL PARA EDITAR CON AJAX.
*/
$('[data-toggle="ajaxModal"]').on('click',
  function(e) {
    $('#ajaxModal').remove();
    e.preventDefault();
    var $this = $(this)
      , $remote = $this.data('remote') || $this.attr('href')
      , $modal = $('<div class="modal fade" style="width:500px; margin-top: 30px;  margin-bottom: auto;  margin-left: auto;  margin-right: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  id="ajaxModal"><div class="modal-body"></div></div>');
    $('body').append($modal);
    $modal.modal({keyboard: false});
    $modal.load($remote);
  }
);

}); 

$('[data-toggle="tooltip"]').tooltip();

function pasar_valor(valor,fila)
{
    jq("#materia_"+fila).val(valor);
    actualizar_parciales();
}

$( ".form-control.sugerencia" ).change(function() {

    id = $(this).attr('id');
    //alert(id);

    if(!$.isNumeric($('.form-control.sugerencia').val())) 
    {
        alert("Solo ingrese numeros");
        $("#"+id).val(0);
    }

     actualizar_parciales();
});


function actualizar_parciales()
{
    var extra_a_pagar = parseInt(jq("#extra_a_pagar").val());
    var cantidad_materias = parseInt(jq("#cantidad_total_materias").val());
    var i=1; 
    var parcial_sugerido = 0;
    var saldo = 0;

    //alert(extra_a_pagar);
    //alert(cantidad_materias);
    //alert(typeof(i));
    //alert(typeof(parcial_sugerido));

    while( i < cantidad_materias )
    {
        if(jq("#materia_"+i).val())
        {
            //  alert(i+':'+jq("#materia_"+i).val());
            parcial_sugerido = parseInt(jq("#materia_"+i).val()) + parcial_sugerido;
        }
        i++;

    }
    //alert(parcial_sugerido);

    saldo = extra_a_pagar - parcial_sugerido;
    //alert(saldo);
    jq("#saldo_a_pagar").val(saldo);
    jq("#total_repartido").val(parcial_sugerido);
}

function eliminar_deuda(id_profesor, anio_lectivo)
{
    var respuesta = confirm('¿Está seguro que desea ELIMINAR la deuda?');
    if (respuesta){
         
         window.location.replace(CI_ROOT+"index.php/profesor/eliminar_deuda_profesor/"+id_profesor+"/"+anio_lectivo);
    }
    else{
        
    }
}
