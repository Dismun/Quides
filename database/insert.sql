

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico uno','968112233','me1@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico dos','968112233','me2@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico tres','968112233','me3@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico cuatro','968112233','me4@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico cinco','968112233','me1@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico seis','968112233','me2@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico siete','968112233','me1@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico ocho','968112233','me2@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico NUEVE','968112233','me2@quides.es','utl1',true,0);

INSERT INTO `personas`(`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`, `idequipo`) VALUES (null,'Médico DIEZ','968112233','me2@quides.es','utl1',true,0);


INSERT INTO `turnos`(`id`, `descripcion`, `desde`, `hasta`, `codigo`, `activo`) VALUES (null,'Mañana','08:00','15:00','M',true);

INSERT INTO `turnos`(`id`, `descripcion`, `desde`, `hasta`, `codigo`, `activo`) VALUES (null,'Tarde','15:00','22:00','T',true);

INSERT INTO `turnos`(`id`, `descripcion`, `desde`, `hasta`, `codigo`, `activo`) VALUES (null,'Guardia','08:00','07:59','G',true);

INSERT INTO `turnos`(`id`, `descripcion`, `desde`, `hasta`, `codigo`, `activo`) VALUES (null,'Descanso Guardia ','08:00','07:59','D',true);


INSERT INTO `clave`(`id`, `orden`, `idturno`) VALUES (null,100,3);

INSERT INTO `clave`(`id`, `orden`, `idturno`) VALUES (null,200,4);

INSERT INTO `clave`(`id`, `orden`, `idturno`) VALUES (null,300,4);

INSERT INTO `clave`(`id`, `orden`, `idturno`) VALUES (null,400,1);

INSERT INTO `clave`(`id`, `orden`, `idturno`) VALUES (null,500,1);

INSERT INTO `clave`(`id`, `orden`, `idturno`) VALUES (null,600,2);





INSERT INTO `centros`(`id`, `descripcion`, `codigo`, `color`, `direccion`, `telefonos`, `poblacion`) VALUES (null,'Santa Lucia','STL','000000',' ','999887766','Cartagena');

INSERT INTO `centros`(`id`, `descripcion`, `codigo`, `color`, `direccion`, `telefonos`, `poblacion`) VALUES (null,'Rossel','RO','000000',' ','999887766','Cartagena');



INSERT INTO `niveles`(`id`, `descripcion`, `codigo`, `colorrgb`, `nivel`) VALUES (null,'consulta unidd de cuidados','uni','FF0000','100');

INSERT INTO `niveles`(`id`, `descripcion`, `codigo`, `colorrgb`, `nivel`) VALUES (null,'consultas verdes','V','00FF00','200');

INSERT INTO `niveles`(`id`, `descripcion`, `codigo`, `colorrgb`, `nivel`) VALUES (null,'consultas amarillas','A','00AA00','300');





INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Unidad 1','U1',1,1,100);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Unidad 2','U2',1,1,200);

INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta General 1','V1',1,2,300);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta General 2','V2',1,2,400);

INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consula 4','C4',1,3,500);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta 5','C5',1,3,600);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consula 6','C6',1,3,700);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta 7','C7',1,3,800);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consula 8','C8',1,3,900);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta 9','C9',1,3,1000);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consula 10','C10',1,3,1100);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta 11','C11',1,3,1200);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta 12','C12',2,3,1300);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`) VALUES (null,'Consulta 13','C13',2,3,1300);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`,`guardia`) VALUES (null,'Responsable de Guardia','GR',1,1,10,1);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`,`guardia`) VALUES (null,'Turno de Guardia  STL','G1',1,1,20,1);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`,`guardia`) VALUES (null,'Turno de Guardia RO','G2',2,1,30,1);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`,`guardia`) VALUES (null,'Turno de Guardia  STL','G3',1,1,40,1);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`,`guardia`) VALUES (null,'Turno de Guardia STL','G4',1,1,50,1);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`,`guardia`) VALUES (null,'Turno de Guardia  STL','G5',1,1,60,1);
INSERT INTO `puntos`(`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`,`guardia`) VALUES (null,'Turno de Guardia STL','G6',1,1,70,1);


INSERT INTO `calendario_laboral`(`id`, `fecha`, `descripcion`, `tipo_fiesta`) VALUES (null,'2018/01/06','Festividad de Reyes','Nacional');
INSERT INTO `calendario_laboral`(`id`, `fecha`, `descripcion`, `tipo_fiesta`) VALUES (null,'2018/01/01','Año nuevo','Nacional');
INSERT INTO `calendario_laboral`(`id`, `fecha`, `descripcion`, `tipo_fiesta`) VALUES (null,'2017/12/06','Día de la Constitución','Nacional');
INSERT INTO `calendario_laboral`(`id`, `fecha`, `descripcion`, `tipo_fiesta`) VALUES (null,'2017/12/08','Día de la Región de Murcia','Regional');

INSERT INTO `categorias_externos`(`id`, `descripcion`, `activa`) VALUES (null,'Contrato de Guardias',1);
INSERT INTO `categorias_externos`(`id`, `descripcion`, `activa`) VALUES (null,'Protocolo Abiertos',1);
INSERT INTO `categorias_externos`(`id`, `descripcion`, `activa`) VALUES (null,'Altas/Bajas',1);

INSERT INTO `chamanes`(`id`, `idpersona`, `desde`, `hasta`, `idpunto`, `idturno`) VALUES (null,8,'2017/11/25',null,6,1);
INSERT INTO `chamanes`(`id`, `idpersona`, `desde`, `hasta`, `idpunto`, `idturno`) VALUES (null,9,'2017/11/25',null,7,1);







INSERT INTO `equipos`(`id`, `descripcion`, `codigo`, `orden`) VALUES (null,'Equipo 1','E1',100);
INSERT INTO `equipos`(`id`, `descripcion`, `codigo`, `orden`) VALUES (null,'Equipo 2','E2',200);
INSERT INTO `equipos`(`id`, `descripcion`, `codigo`, `orden`) VALUES (null,'Equipo 3','E3',300);


INSERT INTO `tipos_incidencias`(`id`, `descripcion`) VALUES (null,'Vacaciones');
INSERT INTO `tipos_incidencias`(`id`, `descripcion`) VALUES (null,'IT Accidente');
INSERT INTO `tipos_incidencias`(`id`, `descripcion`) VALUES (null,'IT Enfermedad');
INSERT INTO `tipos_incidencias`(`id`, `descripcion`) VALUES (null,'Baja en Quides');
INSERT INTO `tipos_incidencias`(`id`, `descripcion`) VALUES (null,'Permiso Personal');
INSERT INTO `tipos_incidencias`(`id`, `descripcion`) VALUES (null,'Comision de Servicios');


INSERT INTO `sabadosydomingos`(`id`, `idcentro`, `sabadosm`, `sabadost`, `domingos`, `desde`, `hasta`) VALUES (null,1,0,0,0,'2017-11-01',null)
;

INSERT INTO `sabadosydomingos`(`id`, `idcentro`, `sabadosm`, `sabadost`, `domingos`, `desde`, `hasta`) VALUES (null,2,0,0,0,'2017-11-01',null)
;


INSERT INTO `persona_externos`(`id`, `idpersona`, `idcategoria`, `lugar_trabajo`, `predisposicion`, `desde`, `hasta`) VALUES (null,10,1,'Clinica Practiser','Buena','2017-11-01',null);




INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,1,1,'2017-11-01',NULL);

INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,1,2,'2017-11-01',NULL);

INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,1,3,'2017-11-01',NULL);

INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,2,4,'2017-11-01',NULL);

INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,2,5,'2017-11-01',NULL);

INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,2,6,'2017-11-01',NULL);

INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,3,7,'2017-11-01',NULL);

INSERT INTO `equipos_composicion`(`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES (NULL,3,8,'2017-11-01',NULL);

