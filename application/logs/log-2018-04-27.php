<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2018-04-27 10:13:30 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-04-27 10:13:30 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-04-27 10:14:32 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 10:14:32 --> Query error: 
ERROR - 2018-04-27 10:14:32 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 995</p>.
ERROR - 2018-04-27 10:14:49 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 10:14:49 --> Query error: 
ERROR - 2018-04-27 10:14:49 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 995</p>.
ERROR - 2018-04-27 10:15:13 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 10:15:13 --> Query error: 
ERROR - 2018-04-27 10:15:13 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    -- TRAER UN SOLO CURSO PROFESOR NO DOS SI HAY UNO CON MAS DE UN HORARIO			

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 995</p>.
ERROR - 2018-04-27 10:15:45 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 10:15:45 --> Query error: 
ERROR - 2018-04-27 10:15:45 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 993</p>.
ERROR - 2018-04-27 10:26:02 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 10:26:02 --> Query error: 
ERROR - 2018-04-27 10:26:02 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 993</p>.
ERROR - 2018-04-27 10:27:16 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 10:27:16 --> Query error: 
ERROR - 2018-04-27 10:27:16 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 993</p>.
ERROR - 2018-04-27 10:31:56 --> Severity: Warning  --> oci_execute(): ORA-00904: &quot;DEVUELVE_COORDINADOR_CARRERA&quot;: invalid identifier /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 10:31:56 --> Query error: 
ERROR - 2018-04-27 10:31:56 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 993</p>.
ERROR - 2018-04-27 11:14:31 --> Severity: Warning  --> oci_execute(): ORA-00936: missing expression /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:14:31 --> Query error: 
ERROR - 2018-04-27 11:14:31 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    AND cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate))

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:15:10 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:15:10 --> Query error: 
ERROR - 2018-04-27 11:15:10 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:15:28 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:15:28 --> Query error: 
ERROR - 2018-04-27 11:15:28 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:15:29 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:15:29 --> Query error: 
ERROR - 2018-04-27 11:15:29 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:16:41 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:16:41 --> Query error: 
ERROR - 2018-04-27 11:16:41 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:17:01 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:17:01 --> Query error: 
ERROR - 2018-04-27 11:17:01 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:17:18 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:17:18 --> Query error: 
ERROR - 2018-04-27 11:17:18 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:17:19 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:17:19 --> Query error: 
ERROR - 2018-04-27 11:17:19 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:17:42 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:17:42 --> Query error: 
ERROR - 2018-04-27 11:17:42 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:17:59 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2018-04-27 11:17:59 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2018-04-27 11:18:02 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-04-27 11:18:02 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-04-27 11:20:43 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:20:43 --> Query error: 
ERROR - 2018-04-27 11:20:43 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  ( '01/' || ((extract(MONTH FROM sysdate))+2) || '/'||(extract(YEAR FROM sysdate)) ) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:23:33 --> [Error GENERAL] - An Error Was Encountered - <p>Unable to load the requested file: programa/cursos_sin_confirmar_enviar_email.php</p>.
ERROR - 2018-04-27 11:26:07 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:26:07 --> Query error: 
ERROR - 2018-04-27 11:26:07 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  ( '01/'||((extract(MONTH FROM sysdate))+2)||'/'||(extract(YEAR FROM sysdate)) ) AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1058</p>.
ERROR - 2018-04-27 11:27:42 --> Severity: Warning  --> oci_execute(): ORA-00932: inconsistent datatypes: expected DATE got NUMBER /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:27:42 --> Query error: 
ERROR - 2018-04-27 11:27:42 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  01/5/2018 AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:27:58 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:27:58 --> Query error: 
ERROR - 2018-04-27 11:27:58 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/5/2018' AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:28:15 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:28:15 --> Query error: 
ERROR - 2018-04-27 11:28:15 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/08/2018' AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:29:38 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:29:38 --> Query error: 
ERROR - 2018-04-27 11:29:38 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/05/2018' AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:30:16 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:30:16 --> Query error: 
ERROR - 2018-04-27 11:30:16 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/05/2018' AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:30:17 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:30:17 --> Query error: 
ERROR - 2018-04-27 11:30:17 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/05/2018' AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:30:24 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:30:24 --> Query error: 
ERROR - 2018-04-27 11:30:24 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/05/2018' AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:30:25 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:30:25 --> Query error: 
ERROR - 2018-04-27 11:30:25 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  '01/05/2018' AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:30:40 --> Severity: Warning  --> oci_execute(): ORA-01843: not a valid month /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:30:40 --> Query error: 
ERROR - 2018-04-27 11:30:40 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  to_char('01/05/2018') AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1064</p>.
ERROR - 2018-04-27 11:33:10 --> Severity: Warning  --> oci_execute(): ORA-01858: a non-numeric character was found where a numeric was expected /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:33:10 --> Query error: 
ERROR - 2018-04-27 11:33:10 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  to_date(01/08/2018,'dd/mm/yyyy') AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1065</p>.
ERROR - 2018-04-27 11:33:17 --> Severity: Warning  --> oci_execute(): ORA-01858: a non-numeric character was found where a numeric was expected /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 11:33:17 --> Query error: 
ERROR - 2018-04-27 11:33:17 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT cu.C_AÑO_LECTIVO as anio_lectivo,
											       cu.n_curso,
											       devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
											       devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
											       m.d_descrip,
											       p.d_apellidos ||', '|| p.d_nombres as nombre, 
											       cu.f_inicio, 
											       cu.f_fin,
											       ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
											       cp.c_rol,
											       cp.C_OBS,
											       cp.importe,
											       cp.N_IMPORTE_PROFESOR,
											       cp.C_CONFIRMADO,
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

											    cu.f_inicio <=  to_date(01/08/2018,'dd/mm/yyyy') AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1065</p>.
ERROR - 2018-04-27 11:42:56 --> [Error GENERAL] - An Error Was Encountered - <p>Unable to load the requested file: programa/cursos_sin_confirmar_enviar_email2.php</p>.
ERROR - 2018-04-27 14:51:57 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-04-27 14:51:57 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-04-27 15:53:53 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-04-27 15:53:53 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-04-27 16:04:40 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-04-27 16:04:40 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-04-27 16:36:03 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-04-27 16:36:03 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-04-27 16:37:29 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2018-04-27 16:37:29 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2018-04-27 17:03:34 --> [Error PHP] - 4096 - Object of class stdClass could not be converted to string - controllers/login.php - 74
ERROR - 2018-04-27 17:03:34 --> Severity: 4096  --> Object of class stdClass could not be converted to string /var/www/html/siteco/application/controllers/login.php 74
ERROR - 2018-04-27 17:09:51 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2018-04-27 17:09:51 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2018-04-27 17:10:01 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2018-04-27 17:10:01 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2018-04-27 17:10:05 --> [Error PHP] - Warning - session_destroy(): Trying to destroy uninitialized session - controllers/login.php - 120
ERROR - 2018-04-27 17:10:05 --> Severity: Warning  --> session_destroy(): Trying to destroy uninitialized session /var/www/html/siteco/application/controllers/login.php 120
ERROR - 2018-04-27 17:36:44 --> Severity: Warning  --> oci_execute(): ORA-00923: FROM keyword not found where expected /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 17:36:44 --> Query error: 
ERROR - 2018-04-27 17:36:44 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT 
												cu.C_AÑO_LECTIVO as anio_lectivo,
												cu.n_curso,
												devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
												devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
												m.d_descrip,
												p.d_apellidos ||', '|| p.d_nombres as nombre, 
												cu.f_inicio, 
												cu.f_fin,
												ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
												cp.c_rol,
												cp.C_OBS,
												cp.importe,
												cp.N_IMPORTE_PROFESOR,
												cp.C_CONFIRMADO,
												DEVUELVE_COORDINADOR_CARRERA( co.c_identificacion, co.c_programa, co.c_orientacion) as id_persona_coordinador
												co.c_identificacion,
												co.N_ID_HORARIO

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

											    cu.f_inicio <=  to_date('01/6/2018','dd/mm/yyyy') AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1081</p>.
ERROR - 2018-04-27 17:36:58 --> Severity: Warning  --> oci_execute(): ORA-00923: FROM keyword not found where expected /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 17:36:58 --> Query error: 
ERROR - 2018-04-27 17:36:58 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT 
												cu.C_AÑO_LECTIVO as anio_lectivo,
												cu.n_curso,
												devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
												devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
												m.d_descrip,
												p.d_apellidos ||', '|| p.d_nombres as nombre, 
												cu.f_inicio, 
												cu.f_fin,
												ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
												cp.c_rol,
												cp.C_OBS,
												cp.importe,
												cp.N_IMPORTE_PROFESOR,
												cp.C_CONFIRMADO,
												DEVUELVE_COORDINADOR_CARRERA( co.c_identificacion, co.c_programa, co.c_orientacion) as id_persona_coordinador
												co.c_identificacion,
												cp.N_ID_HORARIO

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

											    cu.f_inicio <=  to_date('01/6/2018','dd/mm/yyyy') AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1081</p>.
ERROR - 2018-04-27 17:37:00 --> Severity: Warning  --> oci_execute(): ORA-00923: FROM keyword not found where expected /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 17:37:00 --> Query error: 
ERROR - 2018-04-27 17:37:00 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p>  	SELECT 
												cu.C_AÑO_LECTIVO as anio_lectivo,
												cu.n_curso,
												devuelve_programa( m.c_identificacion, m.c_programa, m.c_orientacion) as Programa,
												devuelve_programa( co.c_identificacion, co.c_programa, co.c_orientacion) as PROGCOMISION,
												m.d_descrip,
												p.d_apellidos ||', '|| p.d_nombres as nombre, 
												cu.f_inicio, 
												cu.f_fin,
												ch.c_dia_semanal||' '||ch.c_hora_desde||'-'||ch.c_hora_hasta as Horario,       
												cp.c_rol,
												cp.C_OBS,
												cp.importe,
												cp.N_IMPORTE_PROFESOR,
												cp.C_CONFIRMADO,
												DEVUELVE_COORDINADOR_CARRERA( co.c_identificacion, co.c_programa, co.c_orientacion) as id_persona_coordinador
												co.c_identificacion,
												cp.N_ID_HORARIO

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

											    cu.f_inicio <=  to_date('01/6/2018','dd/mm/yyyy') AND

											    cp.n_id_horario = (Select min(n_id_horario) 
											                               from cursos_profesores cp2
											                               where cp2.c_año_lectivo = cp.c_año_lectivo and
											                                     cp2.n_curso = cp.n_curso and
											                                     cp2.n_id_persona = cp.n_id_persona and
											                                     cp2.c_tipo_clase = cp.c_tipo_clase and
											                                     cp2.c_rol = cp.c_rol)

											ORDER BY pm.N_AÑO_CARRERA ASC, cu.n_id_materia, cp.c_tipo_clase desc,  cp.C_CONFIRMADO DESC </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 1081</p>.
ERROR - 2018-04-27 17:38:39 --> Severity: Warning  --> oci_execute(): ORA-01722: invalid number /var/www/html/siteco/system/database/drivers/oci8/oci8_driver.php 172
ERROR - 2018-04-27 17:38:39 --> Query error: 
ERROR - 2018-04-27 17:38:39 --> [Error DB] - A Database Error Occurred - <p>Error Number: </p><p></p><p> SELECT clases_PROFESOR( '3' , '508' , '6919-', '2018' ) as CLASES
				    	 FROM  dual </p><p>Filename: /var/www/html/siteco/models/programas_model.php</p><p>Line Number: 869</p>.
