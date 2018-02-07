
DROP TRIGGER IF EXISTS TBI_equipos_composicion;
DELIMITER $$
CREATE TRIGGER `TBI_equipos_composicion` BEFORE INSERT ON `equipos_composicion`
 FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (chamanes.hasta>=new.desde OR chamanes.hasta is null ) AND chamanes.desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es Chaman y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externa y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END $$
DELIMITER ;

DROP TRIGGER IF EXISTS TBI_chamanes;
DELIMITER $$
CREATE TRIGGER `TBI_chamanes` BEFORE INSERT ON `chamanes`
 FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equimo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END $$
DELIMITER ;

DELIMITER ;

DROP TRIGGER IF EXISTS TBI_persona_externos;
DELIMITER $$
CREATE TRIGGER `TBI_persona_externos` BEFORE INSERT ON `persona_externos`
 FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es chaman y no puede ser externo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equimo y no puede ser externa!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END $$
DELIMITER ;


DROP TRIGGER IF EXISTS TBU_equipos_composicion;
DELIMITER $$
CREATE TRIGGER `TBU_equipos_composicion` BEFORE UPDATE ON `equipos_composicion`
 FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (chamanes.hasta>=new.desde OR chamanes.hasta is null ) AND chamanes.desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es Chaman y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externa y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END $$
DELIMITER ;

DROP TRIGGER IF EXISTS TBU_chamanes;
DELIMITER $$
CREATE TRIGGER `TBU_chamanes` BEFORE UPDATE ON `chamanes`
 FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equimo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END $$
DELIMITER ;

DELIMITER ;

DROP TRIGGER IF EXISTS TBu_persona_externos;
DELIMITER $$
CREATE TRIGGER `TBu_persona_externos` BEFORE UPDATE ON `persona_externos`
 FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es chaman y no puede ser externo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equimo y no puede ser externa!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END $$
DELIMITER ;

