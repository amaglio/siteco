function rawurldecode (str) {

  return decodeURIComponent((str + '')
    .replace(/%(?![\da-f]{2})/gi, function () {
      // PHP tolerates poorly formed escape sequences
      return '%25'
    }))
}


$('#ingresar_fecha_pago').on('show.bs.modal', function (event) {


        
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/-/g, "\"");
            cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);

            array_json = JSON.parse(cadena_json_correcta);

            var id_profesor = array_json.id_profesor; 
            var id_curso = array_json.id_curso;
            var anio_lectivo = array_json.anio_lectivo;
            var id_horario = array_json.id_horario;
            var rol = array_json.rol;
            var fecha_factura =  array_json.fecha_factura.replace(/&/g, "-");
            var numero_factura = array_json.numero_factura;

            console.log(id_profesor);
            console.log(id_curso);
            console.log(anio_lectivo);
            console.log(id_horario);
            console.log(rol);
            console.log(fecha_factura);
            console.log(numero_factura);

            var array_fecha = fecha_factura.split("-");
            var fecha_co = array_fecha[0]+"-"+array_fecha[1]+"-"+array_fecha[2];
           

            // -----------------------------------------------------------
            var modal = $(this)

            modal.find('#idUsuario').val(id_profesor);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            modal.find('#fecha_factura').val(fecha_co);
            modal.find('#numero_factura').val(numero_factura);
            

            //comentarios_mod = utf8_encode(comentarios_mod);
        
});

$('#exampleModal').on('show.bs.modal', function (event) {


        
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/-/g, "\"");
            cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);

            array_json = JSON.parse(cadena_json_correcta);

            var id_materia = array_json.id_materia;
            var id_profesor = array_json.id_profesor; 
            var id_curso = array_json.id_curso;
            var anio_lectivo = array_json.anio_lectivo;
            var puntos = array_json.puntos;
            var id_horario = array_json.id_horario;
            var rol = array_json.rol;
            var comentarios = array_json.comentarios;
            //var n_fila_curso = array_json.n_fila_curso; 
            var c_identificacion = array_json.c_identificacion;
            var c_programa = array_json.c_programa;
            var c_orientacion = array_json.c_orientacion;

            console.log(id_materia);
            console.log(id_profesor);
            console.log(id_curso);
            console.log(id_materia);
            console.log(anio_lectivo);
            console.log(puntos);
            console.log(id_horario);
            console.log(rol);
            console.log(comentarios);

            console.log(c_identificacion);
            console.log(c_programa);
            console.log(c_orientacion);
            

            // -----------------------------------------------------------
            var modal = $(this)

            modal.find('#id_materia').val(id_materia);
            modal.find('#idUsuario').val(id_profesor);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#puntos').val(puntos);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            //modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);

            comentarios_mod = comentarios.replace(/\|/g, " \n");

            //comentarios_mod = utf8_encode(comentarios_mod);
        
            modal.find('#comentarios').val(comentarios_mod);
});
 

$('#editarExtraModal').on('show.bs.modal', function (event) {
             
           
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");
            //cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);
           
            array_json = JSON.parse(cadena_json_correcta);

            var liquidacion = array_json.liquidacion;
            var cpto = array_json.cpto; 
            var importe = array_json.importe;
            var legajo = array_json.legajo;
            var id_profesor = array_json.id_profesor;
            var observaciones = array_json.observaciones;
            //var rol = array_json.rol;
            //var comentarios = array_json.comentarios;
            //var n_fila_curso = array_json.n_fila_curso; 
            /*
            var c_identificacion = array_json.c_identificacion;
            var c_programa = array_json.c_programa;
            var c_orientacion = array_json.c_orientacion;*/
            
            console.log(liquidacion);
            console.log(cpto);
            console.log(importe);
            console.log(legajo);
            console.log(id_profesor);
            console.log(observaciones);

             var modal = $(this)

            modal.find('#liquidacion').val(liquidacion);
            modal.find('#concepto').val(cpto);
            modal.find('#importe').val(importe);
            modal.find('#legajo').val(legajo);
            modal.find('#n_id_profesor').val(id_profesor);
            modal.find('#comentarios').val(observaciones);
 });

$('#editarExtraModalAutonomo').on('show.bs.modal', function (event) {
             
           
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");
            //cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);
           
            array_json = JSON.parse(cadena_json_correcta);

            var liquidacion = array_json.liquidacion;
            var importe = array_json.importe;
            var id_profesor = array_json.id_profesor;
            var observaciones = array_json.observaciones;
            var id_extra_autonomo = array_json.id_extra_autonomo;
  
            
            console.log(liquidacion);
            console.log(importe);
            console.log(id_profesor);
            console.log(observaciones);
            console.log(id_extra_autonomo);
            
            var modal = $(this)

            modal.find('#id_extra_autonomo').val(id_extra_autonomo);
            modal.find('#liquidacion').val(liquidacion);
            modal.find('#importe').val(importe);
            modal.find('#n_id_profesor').val(id_profesor);
            modal.find('#comentarios').val(observaciones);
 });


        
$('#eliminarExtraModal').on('show.bs.modal', function (event) {
          
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");
            //cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);
           
            array_json = JSON.parse(cadena_json_correcta);

            var liquidacion = array_json.liquidacion;
            var cpto = array_json.cpto; 
            var importe = array_json.importe;
            var legajo = array_json.legajo;
            var id_profesor = array_json.id_profesor;
            var observaciones = array_json.observaciones;
             
            console.log(liquidacion);
            console.log(cpto);
            console.log(importe);
            console.log(legajo);
            console.log(id_profesor);
            console.log(observaciones);

             var modal = $(this)

            modal.find('#liquidacion').val(liquidacion);
            modal.find('#concepto').val(cpto);
            modal.find('#importe').val(importe);
            modal.find('#legajo').val(legajo);
            modal.find('#n_id_profesor').val(id_profesor);
            modal.find('#comentarios').val(observaciones);   
});

$('#eliminarExtraModalAutonomo').on('show.bs.modal', function (event) {
          
           
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");
            //cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

            console.dir(cadena_json_correcta);
           
            array_json = JSON.parse(cadena_json_correcta);

            var liquidacion = array_json.liquidacion;
            var importe = array_json.importe;
            var id_profesor = array_json.id_profesor;
            var observaciones = array_json.observaciones;
            var id_extra_autonomo = array_json.id_extra_autonomo;
  
            
            console.log(liquidacion);
            console.log(importe);
            console.log(id_profesor);
            console.log(observaciones);
            console.log(id_extra_autonomo);
            
            var modal = $(this)

            modal.find('#id_extra_autonomo').val(id_extra_autonomo);
            modal.find('#liquidacion').val(liquidacion);
            modal.find('#importe').val(importe);
            modal.find('#n_id_profesor').val(id_profesor);
            modal.find('#comentarios').val(observaciones);
});


$('#importeTesoreriaModal').on('show.bs.modal', function (event) {
        
            var cadena_json_correcta;
            var button = $(event.relatedTarget);

            // JSON -----------------------------------------------------

            var cadena_json_recibida = button.data('whatever');

            console.dir(cadena_json_recibida);

            cadena_json_correcta = cadena_json_recibida.replace(/-/g, "\"");

            console.dir(cadena_json_correcta);

            array_json = JSON.parse(cadena_json_correcta);
            
            var id_materia = array_json.id_materia;
            var nombre_materia = array_json.nombre_materia;
            var id_profesor = array_json.id_profesor; 
            var id_curso = array_json.id_curso;
            var anio_lectivo = array_json.anio_lectivo;
            var puntos = array_json.puntos;
            var sueldo = array_json.sueldo;
            var id_horario = array_json.id_horario;
            var rol = array_json.rol;
            var comentarios = array_json.comentarios;
            var n_fila_curso = array_json.n_fila_curso; 
            var c_identificacion = array_json.c_identificacion;
            var c_programa = array_json.c_programa;
            var c_orientacion = array_json.c_orientacion;

           
            console.log(id_materia);
            console.log(id_profesor);
            console.log(id_curso);
            console.log(anio_lectivo);
            console.log(puntos);
            console.log(id_horario);
            console.log(rol);
            console.log(c_identificacion);
            console.log(c_programa);
            console.log(c_orientacion);
            console.log(n_fila_curso);

            // -----------------------------------------------------------

            
            var modal = $(this)

            modal.find('#id_materia').val(id_materia);
            modal.find('#idUsuario').val(id_profesor);
            modal.find('#materia').val(nombre_materia);
            modal.find('#id_curso').val(id_curso);
            modal.find('#anio_lectivo').val(anio_lectivo);
            modal.find('#puntos').val(puntos);
            modal.find('#sueldo').val(sueldo);
            modal.find('#id_horario').val(id_horario);
            modal.find('#rol').val(rol);
            
            modal.find('#n_fila_curso').val(n_fila_curso);

            modal.find('#c_identificacion').val(c_identificacion);
            modal.find('#c_programa').val(c_programa);
            modal.find('#c_orientacion').val(c_orientacion);   
});


$('#agregar_deuda').on('show.bs.modal', function (event) {
      
      var cadena_json_correcta;
      var button = $(event.relatedTarget);

      // JSON -----------------------------------------------------

      var cadena_json_recibida = button.data('whatever');

      console.log(cadena_json_recibida);

      cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");

      console.log(cadena_json_correcta);

      array_json = JSON.parse(cadena_json_correcta);
            
      var id_persona = array_json.id_persona;
      var apellido = rawurldecode(array_json.apellido);
      var nombre = rawurldecode(array_json.nombre); 
      

      nombre =  nombre.replace(/\+/g," ");

      console.log(id_persona);
      console.log(apellido);
      console.log(nombre);

      var modal = $(this);

      modal.find('#profesor').val(apellido+', '+nombre);
      modal.find('#id_profesor').val(id_persona); 
});

$('#editar_deuda').on('show.bs.modal', function (event) {
      

      console.log("ABRIO MODAL");


      var cadena_json_correcta;
      var button = $(event.relatedTarget);

      // JSON -----------------------------------------------------

      var cadena_json_recibida = button.data('whatever');

      console.log(cadena_json_recibida);

      cadena_json_correcta = cadena_json_recibida.replace(/&/g, "\"");

      console.log(cadena_json_correcta);

      array_json = JSON.parse(cadena_json_correcta);
            
      var id_persona = array_json.id_persona;
      var apellido = rawurldecode(array_json.apellido);
      var nombre = rawurldecode(array_json.nombre); 
      var importe = array_json.importe;
      var comentario = rawurldecode(array_json.comentario);
      

      nombre =  nombre.replace(/\+/g," ");

      console.log(id_persona);
      console.log(apellido);
      console.log(nombre);

      var modal = $(this);

      modal.find('#profesor').val(apellido+', '+nombre);
      modal.find('#id_profesor').val(id_persona); 
      modal.find('#importe').val(importe); 
      modal.find('#comentarios').val(comentario); 
});