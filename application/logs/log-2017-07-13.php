<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2017-07-13 10:51:37 --> Severity: Warning  --> oci_execute(): ORA-12899: value too large for column "CEMAP"."CURSOS_PROFESORES"."C_FACTURA_PROF" (actual: 34, maximum: 20) /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2017-07-13 10:51:37 --> Query error: 
ERROR - 2017-07-13 10:51:37 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>UPDATE CURSOS_PROFESORES 
						SET  F_PAGADO = to_date('2017-07-13','yyyy/mm/dd') , C_FACTURA_PROF = '17 - Cado Osvaldo - (dió la clase)'
						WHERE 	N_CURSO = '384' AND  
								C_AÑO_LECTIVO = '2017'	AND
								C_ROL = 'Profesor Titular'	AND
								N_ID_PERSONA = '29804' AND
								N_ID_HORARIO = '12' </p><p>Filename: /var/www/html/siteco/models/profesor_model.php</p><p>Line Number: 616</p>.
