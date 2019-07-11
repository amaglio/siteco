<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2017-08-25 11:21:40 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 102
ERROR - 2017-08-25 11:21:40 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 102
ERROR - 2017-08-25 14:34:48 --> Severity: Warning  --> oci_execute(): ORA-12899: value too large for column "CEMAP"."CURSOS_PROFESORES"."C_FACTURA_PROF" (actual: 29, maximum: 20) /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2017-08-25 14:34:48 --> Query error: 
ERROR - 2017-08-25 14:34:48 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>UPDATE CURSOS_PROFESORES 
						SET  F_PAGADO = to_date('2017-07-13','yyyy/mm/dd') , C_FACTURA_PROF = '17 y 18 $ 1790.- (18/08/2017)'
						WHERE 	N_CURSO = '382' AND  
								C_AÑO_LECTIVO = '2017'	AND
								C_ROL = 'Profesor Titular'	AND
								N_ID_PERSONA = '16004' AND
								N_ID_HORARIO = '12' </p><p>Filename: /var/www/html/siteco/models/profesor_model.php</p><p>Line Number: 616</p>.
ERROR - 2017-08-25 15:01:05 --> [Error PHP] - Notice - Undefined variable: result - controllers/profesor.php - 1112
ERROR - 2017-08-25 15:01:05 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/profesor.php 1112
ERROR - 2017-08-25 15:01:08 --> [Error PHP] - Notice - Undefined variable: result - controllers/profesor.php - 1112
ERROR - 2017-08-25 15:01:08 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/profesor.php 1112
ERROR - 2017-08-25 15:01:08 --> [Error PHP] - Notice - Undefined variable: result - controllers/profesor.php - 1112
ERROR - 2017-08-25 15:01:08 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/profesor.php 1112
ERROR - 2017-08-25 15:01:13 --> [Error PHP] - Notice - Undefined variable: result - controllers/profesor.php - 1112
ERROR - 2017-08-25 15:01:13 --> Severity: Notice  --> Undefined variable: result /var/www/html/siteco/application/controllers/profesor.php 1112
ERROR - 2017-08-25 17:06:24 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 102
ERROR - 2017-08-25 17:06:24 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 102
