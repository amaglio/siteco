<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2015-09-30 09:49:22 --> [Error GENERAL] - An Error Was Encountered - <p>Unable to load the requested file: profesor/profesores.php</p>.
ERROR - 2015-09-30 10:04:58 --> [Error PHP] - Notice - Undefined property: Profesor::$Profesor_model - controllers/profesor.php - 586
ERROR - 2015-09-30 10:04:58 --> Severity: Notice  --> Undefined property: Profesor::$Profesor_model /var/www/html/siteco/application/controllers/profesor.php 586
ERROR - 2015-09-30 10:30:43 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 10:30:43 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 10:42:35 --> [Error PHP] - Warning - Missing argument 1 for Profesor::exportar_pdf() - controllers/profesor.php - 497
ERROR - 2015-09-30 10:42:35 --> Severity: Warning  --> Missing argument 1 for Profesor::exportar_pdf() /var/www/html/siteco/application/controllers/profesor.php 497
ERROR - 2015-09-30 10:42:35 --> [Error PHP] - Notice - Undefined variable: id_profesor - controllers/profesor.php - 592
ERROR - 2015-09-30 10:42:35 --> Severity: Notice  --> Undefined variable: id_profesor /var/www/html/siteco/application/controllers/profesor.php 592
ERROR - 2015-09-30 10:42:35 --> Severity: Warning  --> oci_execute(): ORA-00936: missing expression /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2015-09-30 10:42:35 --> Query error: 
ERROR - 2015-09-30 10:42:35 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>	SELECT 	h.c_dia_semanal || ' de ' || h.c_hora_desde || ' a ' || h.c_hora_hasta as HORARIO, 
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
									c.n_periodo
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
									cp.n_id_persona =   AND

									pr.c_identificacion = m.c_identificacion AND
									pr.c_programa = m.c_programa AND
									pr.c_orientacion= m.c_orientacion  AND

									-- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			

									cp.n_id_horario = 	(  	SELECT min(n_id_horario) 
									                   		FROM cursos_profesores cp2
									                   		WHERE 	cp2.c_año_lectivo = cp.c_año_lectivo 
									                   		AND		cp2.n_curso = cp.n_curso 
									                   		AND		cp2.n_id_persona = cp.n_id_persona
									                        AND		cp2.c_tipo_clase = cp.c_tipo_clase
									                        AND		cp2.c_rol = cp.c_rol
									                    )

							ORDER BY c.n_periodo, pr.d_descinf </p><p>Filename: /var/www/html/siteco/models/profesor_model.php</p><p>Line Number: 78</p>.
ERROR - 2015-09-30 10:42:45 --> [Error PHP] - Warning - Missing argument 1 for Profesor::exportar_pdf() - controllers/profesor.php - 498
ERROR - 2015-09-30 10:42:45 --> Severity: Warning  --> Missing argument 1 for Profesor::exportar_pdf() /var/www/html/siteco/application/controllers/profesor.php 498
ERROR - 2015-09-30 10:54:20 --> [Error GENERAL] - An Error Was Encountered - <p>Unable to load the requested file: programa/programa.php</p>.
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Warning - Missing argument 1 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:16:38 --> Severity: Warning  --> Missing argument 1 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Warning - Missing argument 2 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:16:38 --> Severity: Warning  --> Missing argument 2 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Warning - Missing argument 3 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:16:38 --> Severity: Warning  --> Missing argument 3 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Warning - Missing argument 4 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:16:38 --> Severity: Warning  --> Missing argument 4 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Notice - Undefined variable: anio - controllers/programa.php - 70
ERROR - 2015-09-30 11:16:38 --> Severity: Notice  --> Undefined variable: anio /var/www/html/siteco/application/controllers/programa.php 70
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Notice - Undefined variable: c_identificacion - controllers/programa.php - 71
ERROR - 2015-09-30 11:16:38 --> Severity: Notice  --> Undefined variable: c_identificacion /var/www/html/siteco/application/controllers/programa.php 71
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Notice - Undefined variable: c_programa - controllers/programa.php - 72
ERROR - 2015-09-30 11:16:38 --> Severity: Notice  --> Undefined variable: c_programa /var/www/html/siteco/application/controllers/programa.php 72
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Notice - Undefined variable: c_orientacion - controllers/programa.php - 73
ERROR - 2015-09-30 11:16:38 --> Severity: Notice  --> Undefined variable: c_orientacion /var/www/html/siteco/application/controllers/programa.php 73
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Notice - Undefined variable: c_identificacion - controllers/programa.php - 75
ERROR - 2015-09-30 11:16:38 --> Severity: Notice  --> Undefined variable: c_identificacion /var/www/html/siteco/application/controllers/programa.php 75
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Notice - Undefined variable: c_programa - controllers/programa.php - 75
ERROR - 2015-09-30 11:16:38 --> Severity: Notice  --> Undefined variable: c_programa /var/www/html/siteco/application/controllers/programa.php 75
ERROR - 2015-09-30 11:16:38 --> [Error PHP] - Notice - Undefined variable: c_orientacion - controllers/programa.php - 75
ERROR - 2015-09-30 11:16:38 --> Severity: Notice  --> Undefined variable: c_orientacion /var/www/html/siteco/application/controllers/programa.php 75
ERROR - 2015-09-30 11:16:38 --> Severity: Warning  --> oci_execute(): ORA-00936: missing expression /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2015-09-30 11:16:38 --> Query error: 
ERROR - 2015-09-30 11:16:38 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>	SELECT *
								FROM programas
								WHERE c_identificacion =  AND		
									  c_programa =  AND
									  c_orientacion =  </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 340</p>.
ERROR - 2015-09-30 11:17:27 --> [Error PHP] - Warning - Missing argument 1 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:17:27 --> Severity: Warning  --> Missing argument 1 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:17:27 --> [Error PHP] - Warning - Missing argument 2 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:17:27 --> Severity: Warning  --> Missing argument 2 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:17:27 --> [Error PHP] - Warning - Missing argument 3 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:17:27 --> Severity: Warning  --> Missing argument 3 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:17:27 --> [Error PHP] - Warning - Missing argument 4 for Programa::informacion_anio() - controllers/programa.php - 66
ERROR - 2015-09-30 11:17:27 --> Severity: Warning  --> Missing argument 4 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 66
ERROR - 2015-09-30 11:22:14 --> [Error PHP] - Warning - Missing argument 1 for Programa::informacion_anio() - controllers/programa.php - 65
ERROR - 2015-09-30 11:22:14 --> Severity: Warning  --> Missing argument 1 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 65
ERROR - 2015-09-30 11:22:14 --> [Error PHP] - Warning - Missing argument 2 for Programa::informacion_anio() - controllers/programa.php - 65
ERROR - 2015-09-30 11:22:14 --> Severity: Warning  --> Missing argument 2 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 65
ERROR - 2015-09-30 11:22:14 --> [Error PHP] - Warning - Missing argument 3 for Programa::informacion_anio() - controllers/programa.php - 65
ERROR - 2015-09-30 11:22:14 --> Severity: Warning  --> Missing argument 3 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 65
ERROR - 2015-09-30 11:22:14 --> [Error PHP] - Warning - Missing argument 4 for Programa::informacion_anio() - controllers/programa.php - 65
ERROR - 2015-09-30 11:22:14 --> Severity: Warning  --> Missing argument 4 for Programa::informacion_anio() /var/www/html/siteco/application/controllers/programa.php 65
ERROR - 2015-09-30 11:22:59 --> [Error PHP] - Warning - Missing argument 1 for Programa::exportar_cursos_asignados_excel() - controllers/programa.php - 131
ERROR - 2015-09-30 11:22:59 --> Severity: Warning  --> Missing argument 1 for Programa::exportar_cursos_asignados_excel() /var/www/html/siteco/application/controllers/programa.php 131
ERROR - 2015-09-30 11:22:59 --> [Error PHP] - Warning - Missing argument 2 for Programa::exportar_cursos_asignados_excel() - controllers/programa.php - 131
ERROR - 2015-09-30 11:22:59 --> Severity: Warning  --> Missing argument 2 for Programa::exportar_cursos_asignados_excel() /var/www/html/siteco/application/controllers/programa.php 131
ERROR - 2015-09-30 11:22:59 --> [Error PHP] - Warning - Missing argument 3 for Programa::exportar_cursos_asignados_excel() - controllers/programa.php - 131
ERROR - 2015-09-30 11:22:59 --> Severity: Warning  --> Missing argument 3 for Programa::exportar_cursos_asignados_excel() /var/www/html/siteco/application/controllers/programa.php 131
ERROR - 2015-09-30 11:22:59 --> [Error PHP] - Warning - Missing argument 4 for Programa::exportar_cursos_asignados_excel() - controllers/programa.php - 131
ERROR - 2015-09-30 11:22:59 --> Severity: Warning  --> Missing argument 4 for Programa::exportar_cursos_asignados_excel() /var/www/html/siteco/application/controllers/programa.php 131
ERROR - 2015-09-30 11:30:57 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;PM&quot;.&quot;N_ID2_MATERIA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2015-09-30 11:30:57 --> Query error: 
ERROR - 2015-09-30 11:30:57 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>	SELECT distinct(m.n_id_materia) as id, pm.N_AÑO_CARRERA as anio, pm.n_periodo_carrera as periodo, m.d_descrip,pm.n_grupo, devuelve_programa(pm.c_identificacion, pm.c_programa, pm.c_orientacion) as prg
							FROM planes_materias pm, materias m
							WHERE 
									pm.c_plan =  '2015' ||'00' AND
									pm.c_identificacion = '1' AND
									pm.c_programa = '6' AND
									pm.c_orientacion = '0' AND
									pm.n_id2_materia = m.n_id_materia AND
									pm.n_grupo != 2
							ORDER BY prg, pm.N_AÑO_CARRERA, pm.n_periodo_carrera,m.d_descrip  </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 53</p>.
ERROR - 2015-09-30 12:00:40 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 12:00:40 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 12:09:07 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 12:09:07 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 14:29:38 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 14:29:38 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 15:28:09 --> [Error PHP] - Notice - Undefined variable: result - controllers/profesor.php - 830
ERROR - 2015-09-30 15:28:09 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/profesor.php 830
ERROR - 2015-09-30 15:35:16 --> [Error PHP] - Warning - Missing argument 1 for Programa::confirmar_cursos_secretario() - controllers/programa.php - 391
ERROR - 2015-09-30 15:35:16 --> Severity: Warning  --> Missing argument 1 for Programa::confirmar_cursos_secretario() /var/www/html/siteco/application/controllers/programa.php 391
ERROR - 2015-09-30 15:35:16 --> [Error PHP] - Warning - Missing argument 2 for Programa::confirmar_cursos_secretario() - controllers/programa.php - 391
ERROR - 2015-09-30 15:35:16 --> Severity: Warning  --> Missing argument 2 for Programa::confirmar_cursos_secretario() /var/www/html/siteco/application/controllers/programa.php 391
ERROR - 2015-09-30 15:35:16 --> [Error PHP] - Warning - Missing argument 3 for Programa::confirmar_cursos_secretario() - controllers/programa.php - 391
ERROR - 2015-09-30 15:35:16 --> Severity: Warning  --> Missing argument 3 for Programa::confirmar_cursos_secretario() /var/www/html/siteco/application/controllers/programa.php 391
ERROR - 2015-09-30 15:43:20 --> [Error PHP] - Warning - trim() expects parameter 1 to be string, array given - libraries/Form_validation.php - 619
ERROR - 2015-09-30 15:43:20 --> Severity: Warning  --> trim() expects parameter 1 to be string, array given /var/www/html/siteco/system/libraries/Form_validation.php 619
ERROR - 2015-09-30 16:11:50 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 16:11:50 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 16:18:11 --> 404 Page Not Found --> programa/informacion_profesor
ERROR - 2015-09-30 16:31:17 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 16:31:17 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 16:36:45 --> [Error PHP] - Notice - Object of class CI_DB_oci8_result could not be converted to int - controllers/programa.php - 42
ERROR - 2015-09-30 16:36:45 --> Severity: Notice  --> Object of class CI_DB_oci8_result could not be converted to int /var/www/html/siteco/application/controllers/programa.php 42
ERROR - 2015-09-30 16:57:55 --> [Error PHP] - Notice - Undefined variable: consulta - models/programas_model.php - 780
ERROR - 2015-09-30 16:57:55 --> Severity: Notice  --> Undefined variable: consulta /var/www/html/siteco/application/models/programas_model.php 780
ERROR - 2015-09-30 16:58:13 --> [Error PHP] - Notice - Undefined variable: consulta - models/programas_model.php - 780
ERROR - 2015-09-30 16:58:13 --> Severity: Notice  --> Undefined variable: consulta /var/www/html/siteco/application/models/programas_model.php 780
ERROR - 2015-09-30 17:04:09 --> [Error PHP] - Notice - Undefined variable: result - controllers/profesor.php - 830
ERROR - 2015-09-30 17:04:09 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/profesor.php 830
ERROR - 2015-09-30 17:17:39 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 17:17:39 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 17:23:14 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 96
ERROR - 2015-09-30 17:23:14 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 96
ERROR - 2015-09-30 17:23:17 --> [Error PHP] - 4096 - Object of class Home could not be converted to string - controllers/home.php - 21
ERROR - 2015-09-30 17:23:17 --> Severity: 4096  --> Object of class Home could not be converted to string /var/www/html/siteco/application/controllers/home.php 21
ERROR - 2015-09-30 17:23:17 --> [Error PHP] - Notice - Object of class Home to string conversion - controllers/home.php - 21
ERROR - 2015-09-30 17:23:17 --> Severity: Notice  --> Object of class Home to string conversion /var/www/html/siteco/application/controllers/home.php 21
ERROR - 2015-09-30 17:33:05 --> 404 Page Not Found --> nullyoxview.css
ERROR - 2015-09-30 17:33:05 --> 404 Page Not Found --> nulljquery.yoxview-2.2.min.js
ERROR - 2015-09-30 17:43:43 --> 404 Page Not Found --> nullyoxview.css
ERROR - 2015-09-30 17:43:43 --> 404 Page Not Found --> nulljquery.yoxview-2.2.min.js
