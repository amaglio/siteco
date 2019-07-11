<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2018-05-14 10:14:36 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-05-14 10:14:36 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-05-14 10:22:49 --> [Error PHP] - Notice - Undefined property: stdClass::$id_coordinador - controllers/programa.php - 630
ERROR - 2018-05-14 10:22:49 --> Severity: Notice  --> Undefined property: stdClass::$id_coordinador /var/www/html/siteco/application/controllers/programa.php 630
ERROR - 2018-05-14 10:22:49 --> [Error PHP] - Notice - Undefined property: stdClass::$id_coordinador - controllers/programa.php - 630
ERROR - 2018-05-14 10:22:49 --> Severity: Notice  --> Undefined property: stdClass::$id_coordinador /var/www/html/siteco/application/controllers/programa.php 630
ERROR - 2018-05-14 10:22:57 --> [Error PHP] - Notice - Undefined property: stdClass::$id_coordinador - controllers/programa.php - 630
ERROR - 2018-05-14 10:22:57 --> Severity: Notice  --> Undefined property: stdClass::$id_coordinador /var/www/html/siteco/application/controllers/programa.php 630
ERROR - 2018-05-14 10:22:57 --> [Error PHP] - Notice - Undefined property: stdClass::$id_coordinador - controllers/programa.php - 630
ERROR - 2018-05-14 10:22:57 --> Severity: Notice  --> Undefined property: stdClass::$id_coordinador /var/www/html/siteco/application/controllers/programa.php 630
ERROR - 2018-05-14 10:25:01 --> [Error PHP] - Notice - Undefined property: stdClass::$id_coordinador - controllers/programa.php - 630
ERROR - 2018-05-14 10:25:01 --> Severity: Notice  --> Undefined property: stdClass::$id_coordinador /var/www/html/siteco/application/controllers/programa.php 630
ERROR - 2018-05-14 10:25:01 --> [Error PHP] - Notice - Undefined property: stdClass::$id_coordinador - controllers/programa.php - 630
ERROR - 2018-05-14 10:25:01 --> Severity: Notice  --> Undefined property: stdClass::$id_coordinador /var/www/html/siteco/application/controllers/programa.php 630
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:27:04 --> [Error PHP] - Notice - Undefined property: stdClass::$ID_PERSONA_COORDINADOR - helpers/general_helper.php - 792
ERROR - 2018-05-14 10:27:04 --> Severity: Notice  --> Undefined property: stdClass::$ID_PERSONA_COORDINADOR /var/www/html/siteco/application/helpers/general_helper.php 792
ERROR - 2018-05-14 10:28:03 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-05-14 10:28:04 --> Query error: 
ERROR - 2018-05-14 10:28:04 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       co.c_identificacion,
											       co.c_programa,
											       co.c_orientacion,
											       m.d_descrip, m.n_id_materia,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
											       cp.n_id_persona,
											       cp.N_ID_HORARIO,
											       DEVUELVE_COORDINADOR_CARRERA( m.c_identificacion, m.c_programa, m.c_orientacion) as id_persona_coordinador

											FROM cursos cu, 
											     cursos_profesores cp, 
											     materias m, 
											     personas p, 
											     horarios ch,
											     planes_materias pm, 
											     comisiones co
											WHERE 
											    co.c_año_lectivo = (extract(YEAR FROM sysdate)) AND  
											    cu.c_año_lectivo = (extract(YEAR FROM sysdate)) AND
											    cp.c_año_lectivo= (extract(YEAR FROM sysdate)) AND
											     
											    pm.c_plan = (extract(YEAR FROM sysdate)) ||'00' AND
											    
											    cu.n_curso = cp.n_curso AND
											    cp.n_id_persona = p.n_id_persona AND
											    
											    cu.n_id_materia = m.n_id_materia AND
											    pm.n_id_materia = cu.n_id_materia AND
											    
											    ch.n_id_horario = cp.n_id_horario AND
											    
											    cu.n_id_comision = co.n_id_comision AND
											                            
											    co.c_identificacion = pm.c_identificacion AND
											    co.c_programa = pm.c_programa AND
											    co.c_orientacion = pm.c_orientacion AND
											    
											    cp.c_confirmado IS NULL AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1197</p>.
