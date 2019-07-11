<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2016-11-14 09:48:30 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 09:49:03 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 09:58:49 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 09:59:24 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:03:50 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:04:12 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:14:00 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:15:43 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:22:42 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:30:59 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:31:14 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:33:23 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:38:17 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:38:30 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:39:22 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:41:23 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:44:10 --> 404 Page Not Found --> curso_externo/cargar_profesor_curso
ERROR - 2016-11-14 10:44:21 --> [Error PHP] - Notice - Undefined variable: result - controllers/curso_externo.php - 181
ERROR - 2016-11-14 10:44:21 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/curso_externo.php 181
ERROR - 2016-11-14 10:44:25 --> [Error PHP] - Notice - Undefined variable: result - controllers/curso_externo.php - 181
ERROR - 2016-11-14 10:44:25 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/curso_externo.php 181
ERROR - 2016-11-14 10:44:27 --> [Error PHP] - Notice - Undefined variable: result - controllers/curso_externo.php - 181
ERROR - 2016-11-14 10:44:27 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/curso_externo.php 181
ERROR - 2016-11-14 10:44:29 --> [Error PHP] - Notice - Undefined variable: result - controllers/curso_externo.php - 181
ERROR - 2016-11-14 10:44:29 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/curso_externo.php 181
ERROR - 2016-11-14 11:35:10 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;ID_PERSONA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2016-11-14 11:35:10 --> Query error: 
ERROR - 2016-11-14 11:35:10 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>INSERT INTO "CURSO_EXTERNO" ("ID_PROFESOR_CURSO", "FECHA_PAGO", "ID_CURSO_EXTERNO", "ID_PERSONA") VALUES (ID_PROFESOR_CURSO.nextval, to_date('2016-11-23','yyyy/mm/dd'), '9', '23425')</p><p>Filename: /var/www/html/siteco/models/curso_externo_model.php</p><p>Line Number: 155</p>.
ERROR - 2016-11-14 11:42:14 --> [Error PHP] - Notice - Undefined variable: cursos_externos - curso_externo/ver_curso.php - 121
ERROR - 2016-11-14 11:42:14 --> Severity: Notice  --> Undefined variable: cursos_externos /var/www/html/siteco/application/views/curso_externo/ver_curso.php 121
ERROR - 2016-11-14 11:43:10 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_CURSO_EXTERNO - curso_externo/ver_curso.php - 127
ERROR - 2016-11-14 11:43:10 --> Severity: Notice  --> Undefined property: stdClass::$ID_CURSO_EXTERNO /var/www/html/siteco/application/views/curso_externo/ver_curso.php 127
ERROR - 2016-11-14 11:45:39 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;PCE&quot;.&quot;ID_PROFESOR_CURSO_&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2016-11-14 11:45:39 --> Query error: 
ERROR - 2016-11-14 11:45:39 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>SELECT  DECODE(p.d_apellidos, null, pce.apellido, p.d_apellidos) as apellido,
						DECODE(p.d_nombres, null, pce.nombre, p.d_nombres) as nombre,
						decode(pce.id_persona, null, 'no', 'si') as es_profesor_ucema,
						pce.ID_PROFESOR_CURSO_
				FROM PROFESOR_CURSO_EXTERNO pce
				     	LEFT JOIN personas p ON pce.id_persona = p.n_id_persona
				WHERE pce.id_curso_externo = 9</p><p>Filename: /var/www/html/siteco/models/curso_externo_model.php</p><p>Line Number: 49</p>.
ERROR - 2016-11-14 11:59:15 --> [Error PHP] - Notice - Undefined property: stdClass::$ESTA_PAGADO - curso_externo/ver_curso.php - 129
ERROR - 2016-11-14 11:59:15 --> Severity: Notice  --> Undefined property: stdClass::$ESTA_PAGADO /var/www/html/siteco/application/views/curso_externo/ver_curso.php 129
ERROR - 2016-11-14 12:20:41 --> 404 Page Not Found --> curso_externo/eliminar_profesor
ERROR - 2016-11-14 12:44:31 --> 404 Page Not Found --> curso_externo/ver_profesor
ERROR - 2016-11-14 15:22:54 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_CURSO_EXTERNO - curso_externo/ver_profesor_curso.php - 45
ERROR - 2016-11-14 15:22:54 --> Severity: Notice  --> Undefined property: stdClass::$ID_CURSO_EXTERNO /var/www/html/siteco/application/views/curso_externo/ver_profesor_curso.php 45
ERROR - 2016-11-14 15:26:45 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA - curso_externo/ver_profesor_curso.php - 49
ERROR - 2016-11-14 15:26:45 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA /var/www/html/siteco/application/views/curso_externo/ver_profesor_curso.php 49
ERROR - 2016-11-14 15:26:45 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA - curso_externo/ver_profesor_curso.php - 52
ERROR - 2016-11-14 15:26:45 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA /var/www/html/siteco/application/views/curso_externo/ver_profesor_curso.php 52
ERROR - 2016-11-14 15:27:19 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;P&quot;.&quot;ID_PERSONA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2016-11-14 15:27:19 --> Query error: 
ERROR - 2016-11-14 15:27:19 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>SELECT  DECODE(p.d_apellidos, null, pce.apellido, p.d_apellidos) as apellido,
						DECODE(p.d_nombres, null, pce.nombre, p.d_nombres) as nombre,
						decode(pce.id_persona, null, 'no', 'si') as es_profesor_ucema,
						pce.PAGADO,
						pce.FECHA_PAGO,
						pce.importe_a_pagar,
						pce.ID_PROFESOR_CURSO,
						p.id_persona
				FROM PROFESOR_CURSO_EXTERNO pce
				     	LEFT JOIN personas p ON pce.id_persona = p.n_id_persona
				WHERE pce.ID_PROFESOR_CURSO = 9</p><p>Filename: /var/www/html/siteco/models/curso_externo_model.php</p><p>Line Number: 72</p>.
ERROR - 2016-11-14 15:40:03 --> Severity: Warning  --> oci_execute(): ORA-00936: missing expression /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2016-11-14 15:40:03 --> Query error: 
ERROR - 2016-11-14 15:40:03 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>SELECT  DECODE(p.d_apellidos, null, pce.apellido, p.d_apellidos) as apellido,
						DECODE(p.d_nombres, null, pce.nombre, p.d_nombres) as nombre,
						decode(pce.id_persona, null, 'no', 'si') as es_profesor_ucema,
						pce.PAGADO,
						pce.FECHA_PAGO,
						pce.importe_a_pagar,
						pce.ID_PROFESOR_CURSO,
				FROM PROFESOR_CURSO_EXTERNO pce
				     	LEFT JOIN personas p ON pce.id_persona = p.n_id_persona
				WHERE pce.id_curso_externo = 11</p><p>Filename: /var/www/html/siteco/models/curso_externo_model.php</p><p>Line Number: 52</p>.
