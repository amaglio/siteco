$(document).ready(function() {

    //alert("Carga");

    // MODAL PARA COMENTARIOS 

    $('#comentarioModal').on('show.bs.modal', function (event) {
    
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
        var n_fila_curso = array_json.n_fila_curso; 
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
        modal.find('#n_fila_curso').val(n_fila_curso);

        modal.find('#c_identificacion').val(c_identificacion);
        modal.find('#c_programa').val(c_programa);
        modal.find('#c_orientacion').val(c_orientacion);

        comentarios_mod = comentarios.replace(/\|/g, " \n");
    
        modal.find('#comentarios').val(comentarios_mod);
    })

    // MODAL PARA EDITAR CURSOS

    $('#editarModal').on('show.bs.modal', function (event) {
    
        var cadena_json_correcta;
        var button = $(event.relatedTarget);

        // JSON -----------------------------------------------------

        var cadena_json_recibida = button.data('whatever');

        console.dir(cadena_json_recibida);

        cadena_json_correcta = cadena_json_recibida.replace(/\*/g, "\"");
        cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

        console.dir(cadena_json_correcta);

        array_json = JSON.parse(cadena_json_correcta);

        var id_materia = array_json.id_materia;
        var nombre_materia = array_json.nombre_materia;
        var id_profesor = array_json.id_profesor; 
        var nombre_profesor = array_json.nombre_profesor;
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
        console.log(nombre_materia);
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
        modal.find('#materia').val(nombre_materia);
        modal.find('#id_curso').val(id_curso);
        modal.find('#anio_lectivo').val(anio_lectivo);
        modal.find('#puntos').val(puntos);
        modal.find('#sueldo').val(sueldo);
        modal.find('#id_horario').val(id_horario);
        modal.find('#rol').val(rol);
        modal.find('#autocomplete').val(nombre_profesor);
        
        modal.find('#n_fila_curso').val(n_fila_curso);

        modal.find('#c_identificacion').val(c_identificacion);
        modal.find('#c_programa').val(c_programa);
        modal.find('#c_orientacion').val(c_orientacion);

        comentarios_mod = comentarios.replace(/\|/g, " \n");
    
        modal.find('#comentarios').val(comentarios_mod);
    })
    
    // MODAL PARA EDITAR IMPORTE
    $('#importeTesoreriaModal').on('show.bs.modal', function (event) {
    
        var cadena_json_correcta;
        var button = $(event.relatedTarget);

        // JSON -----------------------------------------------------

        var cadena_json_recibida = button.data('whatever');

        console.dir(cadena_json_recibida);

        cadena_json_correcta = cadena_json_recibida.replace(/\*/g, "\"");
        cadena_json_correcta = cadena_json_correcta.replace(/%/g, "-");

        console.dir(cadena_json_correcta);

        array_json = JSON.parse(cadena_json_correcta);

        var id_materia = array_json.id_materia;
        var nombre_materia = array_json.nombre_materia;
        var id_profesor = array_json.id_profesor; 
        var nombre_profesor = array_json.nombre_profesor;
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
        console.log(nombre_materia);
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
        modal.find('#materia').val(nombre_materia);
        modal.find('#id_curso').val(id_curso);
        modal.find('#anio_lectivo').val(anio_lectivo);
        modal.find('#puntos').val(puntos);
        modal.find('#sueldo').val(sueldo);
        modal.find('#id_horario').val(id_horario);
        modal.find('#rol').val(rol);
        modal.find('#autocomplete').val(nombre_profesor);
        
        modal.find('#n_fila_curso').val(n_fila_curso);

        modal.find('#c_identificacion').val(c_identificacion);
        modal.find('#c_programa').val(c_programa);
        modal.find('#c_orientacion').val(c_orientacion);

        comentarios_mod = comentarios.replace(/\|/g, " \n");
    
        modal.find('#comentarios').val(comentarios_mod);
    })

});
