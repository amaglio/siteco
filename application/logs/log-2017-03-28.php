<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2017-03-28 09:41:39 --> Severity: Warning  --> oci_connect(): ORA-01017: invalid username/password; logon denied /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 80
ERROR - 2017-03-28 09:41:39 --> Unable to connect to the database
ERROR - 2017-03-28 09:41:39 --> [Error DB] - A Database Error Occurred - <p>Unable to connect to your database server using the provided settings.</p><p>Filename: core/Loader.php</p><p>Line Number: 338</p>.
ERROR - 2017-03-28 09:41:44 --> Severity: Warning  --> oci_connect(): ORA-01017: invalid username/password; logon denied /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 80
ERROR - 2017-03-28 09:41:44 --> Unable to connect to the database
ERROR - 2017-03-28 09:41:44 --> [Error DB] - A Database Error Occurred - <p>Unable to connect to your database server using the provided settings.</p><p>Filename: core/Loader.php</p><p>Line Number: 338</p>.
ERROR - 2017-03-28 09:42:14 --> Severity: Warning  --> oci_connect(): ORA-01017: invalid username/password; logon denied /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 80
ERROR - 2017-03-28 09:42:14 --> Unable to connect to the database
ERROR - 2017-03-28 09:42:14 --> [Error DB] - A Database Error Occurred - <p>Unable to connect to your database server using the provided settings.</p><p>Filename: core/Loader.php</p><p>Line Number: 338</p>.
ERROR - 2017-03-28 14:48:53 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 101
ERROR - 2017-03-28 14:48:53 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 101
ERROR - 2017-03-28 16:40:30 --> Severity: Warning  --> oci_execute(): ORA-06502: PL/SQL: numeric or value error: character string buffer too small
ORA-06512: at &quot;CEMAP.BUSCAR_CLASES_PROFE_CURSO&quot;, line 23 /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2017-03-28 16:40:30 --> Query error: 
ERROR - 2017-03-28 16:40:30 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>	SELECT 	h.c_dia_semanal || ' de ' || h.c_hora_desde || ' a ' || h.c_hora_hasta as HORARIO, 
								    c.N_CURSO,  
								    cp.c_tipo_clase, 
								    cp.c_rol, 
								    c.f_inicio as FECHA_INI, 
								    c.f_fin as FECHA_FIN, 
								    m.D_DESCRED, 
								    m.D_PUBLICA,
								    m.D_DESCRIP, 
								    m.n_id_materia,
								    cp.N_ID_HORARIO, 
								    cp.N_ID_PERSONA, 
								    cp.C_AÑO_LECTIVO as anio_lectivo,
								    p.d_apellidos || ', ' || p.d_nombres as NOMBRE,
								    pr.d_descinf as PROGRAMA,
								    pr.D_DESCRED as PROGRAMA2,
								    devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PRGCOMISION,
									co.c_identificacion,
									co.c_programa,
									co.c_orientacion,
									cp.n_importe_profesor ,
									cp.importe,
									cp.n_importe_profesor,
									cp.c_confirmado,
									cp.C_OBS,
									cp.f_pagado,
									c.n_periodo,
									BUSCAR_CLASES_PROFE_CURSO(co.c_identificacion, c.N_CURSO, cp.N_ID_PERSONA, cp.C_AÑO_LECTIVO ) as CLASES_FECHAS
							FROM 
									cursos_profesores cp,
									materias m, 
									cursos c,
									personas p,
									horarios h,
									programas pr,
									comisiones co
							WHERE 
									cp.n_id_horario = h.n_id_horario AND
									cp.n_id_persona = p.n_id_persona AND
									cp.n_curso = c.n_curso          AND
									c.n_id_materia = m.n_id_materia AND
									c.n_id_comision = co.n_id_comision AND

									cp.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))         AND
									c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
									c.C_AÑO_LECTIVO = (extract(YEAR FROM sysdate))          AND
									cp.n_id_persona = 7913  AND

									pr.c_identificacion = m.c_identificacion AND
									pr.c_programa = m.c_programa AND
									pr.c_orientacion= m.c_orientacion  AND

									cp.n_id_horario = 	(  	SELECT min(n_id_horario) 
									                   		FROM cursos_profesores cp2
									                   		WHERE 	cp2.c_año_lectivo = cp.c_año_lectivo 
									                   		AND		cp2.n_curso = cp.n_curso 
									                   		AND		cp2.n_id_persona = cp.n_id_persona
									                        AND		cp2.c_tipo_clase = cp.c_tipo_clase
									                        AND		cp2.c_rol = cp.c_rol
									                    )

							ORDER BY c.n_periodo, pr.d_descinf </p><p>Filename: /var/www/html/siteco/models/profesor_model.php</p><p>Line Number: 141</p>.
