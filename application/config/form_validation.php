<?php 
$config = array(
            
            'loguearse' => array(
                                    array(
                                            'field' => 'correo',
                                            'label' => 'correo',
                                            'rules' => 'required|trim|xss_clean|valid_email'
                                        ),
                                    array(
                                            'field' => 'clave',
                                            'label' => 'clave',
                                            'rules' => 'required|trim|xss_clean'
                                        )
                                ),

         'editar_importe_profesor' => array(
                                            array(
                                                    'field' => 'id_materia',
                                                    'label' => 'id_materia',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'id_curso',
                                                    'label' => 'id_curso',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'anio_lectivo',
                                                    'label' => 'anio_lectivo',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'idUsuario',
                                                    'label' => 'idUsuario',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'id_horario',
                                                    'label' => 'id_horario',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'c_identificacion',
                                                    'label' => 'c_identificacion',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'c_programa',
                                                    'label' => 'c_programa',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'c_orientacion',
                                                    'label' => 'c_orientacion',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'rol',
                                                    'label' => 'rol',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'sueldo',
                                                    'label' => 'sueldo',
                                                    'rules' => 'required|trim|xss_clean|numeric'
                                                 ),
                                            array(
                                                    'field' => 'n_fila_curso',
                                                    'label' => 'n_fila_curso',
                                                    'rules' => 'required|trim|xss_clean'
                                                 )

                                ),

         'ingresar_comentario' => array(
                                            array(
                                                    'field' => 'id_materia',
                                                    'label' => 'id_materia',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'id_curso',
                                                    'label' => 'id_curso',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'anio_lectivo',
                                                    'label' => 'anio_lectivo',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'idUsuario',
                                                    'label' => 'idUsuario',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'id_horario',
                                                    'label' => 'id_horario',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'c_identificacion',
                                                    'label' => 'c_identificacion',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'c_programa',
                                                    'label' => 'c_programa',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'c_orientacion',
                                                    'label' => 'c_orientacion',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'rol',
                                                    'label' => 'rol',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'comentario',
                                                    'label' => 'comentario',
                                                    'rules' => 'required|trim|xss_clean'
                                                 )/*,
                                            array(
                                                    'field' => 'n_fila_curso',
                                                    'label' => 'n_fila_curso',
                                                    'rules' => 'required|trim|xss_clean'
                                                 )*/

                                ),
            
            'a_pagar' => array(
                                    array(
                                            'field' => 'sugerencia',
                                            'label' => 'sugerencia',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'datos_sugerencia',
                                            'label' => 'datos_sugerencia',
                                            'rules' => 'required'
                                        )
                                ),

            'cargar_extra' => array(
                                    array(
                                            'field' => 'liquidacion',
                                            'label' => 'liquidacion',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'legajo',
                                            'label' => 'legajo',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'concepto',
                                            'label' => 'concepto',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'sueldo',
                                            'label' => 'sueldo',
                                            'rules' => 'required'
                                        )
                                ),

            'cargar_extra_autonomo' => array(
                                    array(
                                            'field' => 'liquidacion',
                                            'label' => 'liquidacion',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'sueldo',
                                            'label' => 'sueldo',
                                            'rules' => 'required'
                                        )
                                ),
            
             'eliminar_extra' => array(
                                    array(
                                            'field' => 'liquidacion',
                                            'label' => 'liquidacion',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'legajo',
                                            'label' => 'legajo',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'concepto',
                                            'label' => 'concepto',
                                            'rules' => 'required'
                                        ) 
                                ),

             'eliminar_extra_autonomo' => array(
                                    array(
                                            'field' => 'id_extra_autonomo',
                                            'label' => 'id_extra_autonomo',
                                            'rules' => 'required'
                                        ) 
                                ),

              'editar_extra' => array(
                                    array(
                                            'field' => 'liquidacion',
                                            'label' => 'liquidacion',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'legajo',
                                            'label' => 'legajo',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'concepto',
                                            'label' => 'concepto',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'importe',
                                            'label' => 'importe',
                                            'rules' => 'required'
                                        )
                                ),

                 'editar_extra_autonomo' => array(
                                    array(
                                            'field' => 'liquidacion',
                                            'label' => 'liquidacion',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'n_id_profesor',
                                            'label' => 'n_id_profesor',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'importe',
                                            'label' => 'importe',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'id_extra_autonomo',
                                            'label' => 'id_extra_autonomo',
                                            'rules' => 'required'
                                        )
                                ),

            'confirmar_curso' => array(
                                    array(
                                            'field' => 'id_curso',
                                            'label' => 'id_curso',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'anio_lectivo',
                                            'label' => 'anio_lectivo',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'id_horario',
                                            'label' => 'id_horario',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'rol',
                                            'label' => 'rol',
                                            'rules' => 'required'
                                        ),
                                    array(
                                            'field' => 'idUsuario',
                                            'label' => 'idUsuario',
                                            'rules' => 'required'
                                        )
                                ),

        
    'confimar_cursos_check' => array(
                                        
                                    array(
                                            'field' => 'c_identificacion',
                                            'label' => 'c_identificacion',
                                            'rules' => 'required|trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'c_programa',
                                            'label' => 'c_programa',
                                            'rules' => 'required|trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'c_orientacion',
                                            'label' => 'c_orientacion',
                                            'rules' => 'required|trim|xss_clean'
                                         ) 

                                ),

    
    'agregar_deuda_profesor' => array(
                                        
                                    array(
                                            'field' => 'importe',
                                            'label' => 'importe',
                                            'rules' => 'required|trim|xss_clean'
                                         )

                                ),

    'editar_deuda_profesor' => array(
                                        
                                    array(
                                            'field' => 'importe',
                                            'label' => 'importe',
                                            'rules' => 'required|trim|xss_clean'
                                         )

                                ),

    'eliminar_deuda_profesor' => array(
                                        
                                    array(
                                            'field' => 'id_persona',
                                            'label' => 'id_persona',
                                            'rules' => 'required|trim|xss_clean'
                                         )

                                ),

    'cargar_curso_externo' => array(
                                        
                                    array(
                                            'field' => 'id_empresa',
                                            'label' => 'id_empresa',
                                            'rules' => 'required|trim|xss_clean|numeric'
                                         ),
                                    array(
                                            'field' => 'empresa',
                                            'label' => 'empresa',
                                            'rules' => 'required|trim|xss_clean'
                                         )

                                ),

    'cargar_profesor_curso' => array(
                                        
                                    array(
                                            'field' => 'id_curso_externo',
                                            'label' => 'id_curso_externo',
                                            'rules' => 'required|trim|xss_clean|numeric'
                                         )
                                ),
    
    'eliminar_profesor_curso' => array(
                                        
                                    array(
                                            'field' => 'id_profesor_curso',
                                            'label' => 'id_profesor_curso',
                                            'rules' => 'required|trim|xss_clean|numeric'
                                         )
                                ),

    'eliminar_curso_externo' => array(
                                        
                                    array(
                                            'field' => 'id_curso_externo',
                                            'label' => 'id_curso_externo',
                                            'rules' => 'required|trim|xss_clean|numeric'
                                         )
                                ),
    'editar_profesor_curso' => array(
                                        
                                    array(
                                            'field' => 'id_profesor_curso',
                                            'label' => 'id_profesor_curso',
                                            'rules' => 'required|trim|xss_clean|numeric'
                                         )
                                ),

    'editar_fecha_factura' => array(

                                            array(
                                                    'field' => 'id_curso',
                                                    'label' => 'id_curso',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'anio_lectivo',
                                                    'label' => 'anio_lectivo',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'idUsuario',
                                                    'label' => 'idUsuario',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'id_horario',
                                                    'label' => 'id_horario',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'rol',
                                                    'label' => 'rol',
                                                    'rules' => 'required|trim|xss_clean'
                                                 ),
                                            array(
                                                    'field' => 'fecha_factura',
                                                    'label' => 'fecha_factura',
                                                    'rules' => 'required|trim|xss_clean'
                                                 )

                                ),
    
    'enviar_email_cursos_sin_confirmar' => array(
                                        
                                    array(
                                            'field' => 'check_confirma_coordinador[]',
                                            'label' => 'check_confirma_coordinador[]',
                                            'rules' => 'required|trim'
                                         )
                                ),
    

     
    );
?>