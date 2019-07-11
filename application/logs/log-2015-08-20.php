<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2015-08-20 13:44:17 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2015-08-20 13:44:17 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2015-08-20 14:38:08 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:38:08 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 14:39:34 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:39:34 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 14:41:36 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:41:36 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 14:43:23 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:43:23 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 14:43:47 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:43:47 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 14:44:03 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:44:03 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 14:45:59 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:45:59 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 14:48:01 --> [Error PHP] - Notice - Trying to get property of non-object - controllers/login.php - 72
ERROR - 2015-08-20 14:48:01 --> Severity: Notice  --> Trying to get property of non-object /var/www/html/siteco/application/controllers/login.php 72
ERROR - 2015-08-20 14:48:01 --> Severity: Warning  --> oci_execute(): ORA-00936: missing expression /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2015-08-20 14:48:01 --> Query error: 
ERROR - 2015-08-20 14:48:01 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>	SELECT distinct(s.carrera), s.c_identificacion, s.c_programa, s.c_orientacion, p.d_descinf
								  FROM 
								        (
								        SELECT cc.*, devuelve_programa(cc.c_identificacion, cc.c_programa, cc.c_orientacion) as CARRERA
								        FROM crm_coordinador_programa cc, planes_materias pm
								        WHERE cc.n_id_persona =  AND
								              cc.c_identificacion = pm.c_identificacion AND
								              cc.c_programa = pm.c_programa AND
								              cc.c_orientacion = pm.c_orientacion AND
								              pm.c_plan = (extract(YEAR FROM sysdate)) ||'00' ) s,
								        programas p
								WHERE p.c_identificacion =  s.c_identificacion
								AND p.c_programa =  s.c_programa
								AND p.c_orientacion =  s.c_orientacion
								ORDER BY s.c_identificacion, s.carrera</p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 38</p>.
ERROR - 2015-08-20 14:57:23 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 14:57:23 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:09:09 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:09:09 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:15:36 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:15:36 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:15:58 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:15:58 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:16:36 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:16:36 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:26:04 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2015-08-20 15:26:04 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2015-08-20 15:30:18 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:30:18 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:33:17 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:33:17 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:35:07 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:35:07 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:36:19 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:36:19 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:36:49 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:36:49 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:36:56 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:36:56 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:37:22 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:37:22 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:37:29 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:37:29 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:37:49 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:37:49 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:37:54 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:37:54 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:38:10 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:38:10 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:46:39 --> [Error PHP] - Notice - Undefined variable: result - controllers/programa.php - 360
ERROR - 2015-08-20 15:46:39 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/programa.php 360
ERROR - 2015-08-20 15:50:11 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:50:11 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:50:58 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:50:58 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:51:21 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:51:21 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:51:42 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:51:42 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:52:02 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2015-08-20 15:52:02 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2015-08-20 15:52:05 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:52:05 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:52:19 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:52:19 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:53:45 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:53:45 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:54:07 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:54:07 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:54:33 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:54:33 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:54:39 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:54:39 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:54:44 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:54:44 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:56:05 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:56:05 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:56:44 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:56:44 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:57:37 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:57:37 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 15:59:36 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 15:59:36 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:20:51 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:20:51 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:21:01 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:21:01 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:21:02 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:21:02 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:21:57 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:21:57 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:22:29 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:22:29 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:22:55 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:22:55 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:44:10 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2015-08-20 16:44:10 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2015-08-20 16:44:58 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:44:58 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:45:07 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:45:07 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:45:20 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:45:20 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:45:29 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:45:29 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:46:31 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:46:31 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:46:52 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:46:52 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:47:01 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:47:01 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:47:32 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:47:32 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:47:45 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:47:45 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:47:52 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:47:52 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:47:57 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:47:57 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:48:12 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:48:12 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:49:42 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:49:42 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:51:00 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:51:00 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:52:25 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:52:25 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:54:45 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:54:45 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 16:55:16 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 16:55:16 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 18:03:10 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 18:03:10 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 19:01:56 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 19:01:56 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 19:03:44 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 19:03:44 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 19:05:55 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 19:05:55 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 19:06:11 --> [Error PHP] - Notice - Undefined variable: datos_enviar_coordinador - views/profesores_cursos.php - 647
ERROR - 2015-08-20 19:06:11 --> Severity: Notice  --> Undefined variable: datos_enviar_coordinador /var/www/html/siteco/application/views/profesores_cursos.php 647
ERROR - 2015-08-20 19:13:47 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2015-08-20 19:13:47 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
