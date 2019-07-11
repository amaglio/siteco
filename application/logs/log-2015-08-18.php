<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2015-08-18 16:31:38 --> Session: HMAC mismatch. The session cookie data did not match what was expected.
ERROR - 2015-08-18 16:31:38 --> Session: HMAC mismatch. The session cookie data did not match what was expected.
ERROR - 2015-08-18 16:32:39 --> [Error PHP] - Notice - Trying to get property of non-object - controllers/login.php - 72
ERROR - 2015-08-18 16:32:39 --> Severity: Notice  --> Trying to get property of non-object /var/www/siteco/application/controllers/login.php 72
ERROR - 2015-08-18 16:32:40 --> Severity: Warning  --> oci_execute(): ORA-00936: missing expression /var/www/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2015-08-18 16:32:40 --> Query error: 
ERROR - 2015-08-18 16:32:40 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>	SELECT distinct(s.carrera), s.c_identificacion, s.c_programa, s.c_orientacion, p.d_descinf
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
								ORDER BY s.c_identificacion, s.carrera</p><p>Filename: /var/www/siteco/models/programas_model.php</p><p>Line Number: 38</p>.
ERROR - 2015-08-18 16:33:31 --> [Error PHP] - Notice - Trying to get property of non-object - controllers/login.php - 72
ERROR - 2015-08-18 16:33:31 --> Severity: Notice  --> Trying to get property of non-object /var/www/siteco/application/controllers/login.php 72
ERROR - 2015-08-18 16:33:51 --> [Error PHP] - Notice - Trying to get property of non-object - controllers/login.php - 74
ERROR - 2015-08-18 16:33:51 --> Severity: Notice  --> Trying to get property of non-object /var/www/siteco/application/controllers/login.php 74
