SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



ALTER TABLE `bosquejo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_fecha_persona` (`fecha`,`idpersona`,`idturno`),
  ADD KEY `fk_personas_bosquejo_idx` (`idpersona`),
  ADD KEY `fk_turnos_bosquejo_idx` (`idturno`),
  ADD KEY `fk_puntos_bosquejo_idx` (`idpunto`);

--
-- Indices de la tabla `calendario_laboral`
--
ALTER TABLE `calendario_laboral`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_externos`
--
ALTER TABLE `categorias_externos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chamanes`
--
ALTER TABLE `chamanes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personas_chamanes_idx` (`idpersona`),
  ADD KEY `fk_puntos_chamanes_idx` (`idpunto`),
  ADD KEY `fk_turnos_chamanes_idx` (`idturno`);

--
-- Indices de la tabla `clave`
--
ALTER TABLE `clave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_turnos_clave_idx` (`idturno`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos_composicion`
--
ALTER TABLE `equipos_composicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipos_eq_composicion_idx` (`idequipo`),
  ADD KEY `fk_personas_eq_composicion_idx` (`idpersona`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipos_incidencias_incidencias_idx` (`idincidencia`),
  ADD KEY `fk_personas_incidencia_idx` (`idpersona`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_nombre` (`nombre`);

--
-- Indices de la tabla `persona_externos`
--
ALTER TABLE `persona_externos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personas_persona_externos_idx` (`idpersona`),
  ADD KEY `fk_categoria_persona_externos_idx` (`idcategoria`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_centros_puntos_idx` (`idcentro`),
  ADD KEY `fk_niveles_puntos_idx` (`idnivel`);

--
-- Indices de la tabla `sabadosydomingos`
--
ALTER TABLE `sabadosydomingos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_puntos_sabadosydomingos_idx` (`idpunto`),
  ADD KEY `fk_turnos_sabadosydomingos_idx` (`idturno`);

--
-- Indices de la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_sustituciones_idx` (`idpersona`),
  ADD KEY `fk_persona_externa_sustituciones_idx` (`idpersona_externa`);

--
-- Indices de la tabla `tipos_incidencias`
--
ALTER TABLE `tipos_incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bosquejo`
--
ALTER TABLE `bosquejo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro';

--
-- AUTO_INCREMENT de la tabla `calendario_laboral`
--
ALTER TABLE `calendario_laboral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias_externos`
--
ALTER TABLE `categorias_externos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centros`
--
ALTER TABLE `centros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de Reginstro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `chamanes`
--
ALTER TABLE `chamanes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `clave`
--
ALTER TABLE `clave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro\n', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipos_composicion`
--
ALTER TABLE `equipos_composicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro';

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `persona_externos`
--
ALTER TABLE `persona_externos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `sabadosydomingos`
--
ALTER TABLE `sabadosydomingos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro';

--
-- AUTO_INCREMENT de la tabla `tipos_incidencias`
--
ALTER TABLE `tipos_incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de regidtro', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bosquejo`
--
ALTER TABLE `bosquejo`
  ADD CONSTRAINT `fk_personas_bosquejo` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_puntos_bosquejo` FOREIGN KEY (`idpunto`) REFERENCES `puntos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turnos_bosquejo` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `chamanes`
--
ALTER TABLE `chamanes`
  ADD CONSTRAINT `fk_personas_chamanes` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_puntos_chamanes` FOREIGN KEY (`idpunto`) REFERENCES `puntos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turnos_chamanes` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clave`
--
ALTER TABLE `clave`
  ADD CONSTRAINT `fk_turnos_clave` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipos_composicion`
--
ALTER TABLE `equipos_composicion`
  ADD CONSTRAINT `fk_equipos_eq_composicion` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_eq_composicion` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_personas_incidencia` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipos_incidencias_incidencias` FOREIGN KEY (`idincidencia`) REFERENCES `tipos_incidencias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona_externos`
--
ALTER TABLE `persona_externos`
  ADD CONSTRAINT `fk_categoria_persona_externos` FOREIGN KEY (`idcategoria`) REFERENCES `categorias_externos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_persona_externos` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD CONSTRAINT `fk_centros_puntos` FOREIGN KEY (`idcentro`) REFERENCES `centros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_niveles_puntos` FOREIGN KEY (`idnivel`) REFERENCES `niveles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sabadosydomingos`
--  

ALTER TABLE `sabadosydomingos`
  ADD CONSTRAINT `fk_puntos_sabadosydomingos` FOREIGN KEY (`idpunto`) REFERENCES `puntos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turnos_sabadosydomingos` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Filtros para la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  ADD CONSTRAINT `fk_persona_externa_sustituciones` FOREIGN KEY (`idpersona_externa`) REFERENCES `persona_externos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_sustituciones` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;