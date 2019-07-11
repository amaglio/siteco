function confirmarCurso(id_curso, anio_lectivo, id_horario, id_profesor ,rol, c_identificacion, c_programa, c_orientacion, n_fila_curso)
{   

    $.ajax({
                url: CI_ROOT+'index.php/programa/confirmar_curso',
                data: { id_curso: id_curso, 
                        anio_lectivo: anio_lectivo, 
                        id_horario : id_horario, 
                        rol : rol, 
                        idUsuario : id_profesor
                      },
                async: false,
                type: 'POST' ,
                dataType: 'JSON',
                success: function(data)
                {
                    if(data.error == false)
                    {
                       window.location.replace(CI_ROOT+'index.php/programa/index/'+c_identificacion+'/'+c_programa+'/'+c_orientacion+'/'+n_fila_curso+'/'+data.mensaje);
                    }
                    else
                    {
                      alert(data.mensaje);
                    }
                  },
                  error: function(x, status, error){
                    alert("No se ejecuto la confirmacion");
                } 
            
            }); 
}

function desconfirmarCurso(id_curso, anio_lectivo, id_horario, id_profesor ,rol, c_identificacion, c_programa, c_orientacion, n_fila_curso)
{   
    
    $.ajax({
                url: CI_ROOT+'index.php/programa/desconfirmar_curso',
                data: { id_curso: id_curso, 
                        anio_lectivo: anio_lectivo, 
                        id_horario : id_horario, 
                        rol : rol, 
                        idUsuario : id_profesor
                      },
                async: false,
                type: 'POST' ,
                dataType: 'JSON',
                success: function(data)
                {
                    if(data.error == false)
                    {
                       window.location.replace(CI_ROOT+'index.php/programa/index/'+c_identificacion+'/'+c_programa+'/'+c_orientacion+'/'+n_fila_curso+'/'+data.mensaje);
                    }
                    else
                    {
                      alert(data.mensaje);
                    }
                  },
                  error: function(x, status, error){
                    alert("No se ejecuto la confirmacion");
                } 
            
            });
}