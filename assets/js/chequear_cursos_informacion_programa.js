$(document).ready(function() {
    
    $('.check_all_confirm').change(function(){
        var checkboxes = $(this).closest('form').find('.check_confirma_coordinador');
        if($(this).prop('checked')) {
          checkboxes.prop('checked', true);
        } else {
          checkboxes.prop('checked', false);
        }
    });

    $('.check_all_default_tesoreria').change(function(){
        var checkboxes = $(this).closest('form').find('.check_importe_default');
        if($(this).prop('checked')) {
          checkboxes.prop('checked', true);
        } else {
          checkboxes.prop('checked', false);
        }
    });

    $('.check_all_coordinador_tesoreria').change(function(){
        var checkboxes = $(this).closest('form').find('.check_importe_coordinador');
        if($(this).prop('checked')) {
          checkboxes.prop('checked', true);
        } else {
          checkboxes.prop('checked', false);
        }
    });

});