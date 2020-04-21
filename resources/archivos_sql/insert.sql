/*USUARIOS*/

/* contraseña: 1234*/
INSERT INTO usuario (descripcion,email, pass, nombre, pais, foto, mediaGlobal, rol)
 VALUES
  ('soy una persona muy aventurera', 'jorge_lacasta@hotmail.com', '$2y$10$MohhVfbQPLo78ahT2topReJJCrD52w3JbkuWW6WP.2EZLVpgdjih6', 'jorge', 'España', 'kurt-cobain.jpg',3, 'ADMIN'),
  ('soy una persona muy aventurera', 'joan@joan.es', '$2y$10$MohhVfbQPLo78ahT2topReJJCrD52w3JbkuWW6WP.2EZLVpgdjih6', 'joan', 'España', 'messi.jpg',5, 'ADMIN'),
  ('soy una persona muy aventurera', 'adriansanzperez.94@gmail.com', '$2y$10$MohhVfbQPLo78ahT2topReJJCrD52w3JbkuWW6WP.2EZLVpgdjih6', 'adrian', 'España', 'brad.jpg',4, 'ADMIN'),
  ('soy una persona muy aventurera', 'maria@maria.es', '$2y$10$MohhVfbQPLo78ahT2topReJJCrD52w3JbkuWW6WP.2EZLVpgdjih6', 'maria', 'España', 'maria.jpg', 2, 'USER'),
  ('soy una persona muy aventurera', 'sonia@sonia.es', '$2y$10$MohhVfbQPLo78ahT2topReJJCrD52w3JbkuWW6WP.2EZLVpgdjih6', 'sonia', 'España', 'sonia.jpg', 4.2, 'USER')
;

/*VIAJE*/
INSERT INTO viaje (pais_origen, ciudad_origen, pais_destino, ciudad_destino, foto, precio, transporte, descripcion, etiquetas, id_user)
 VALUES
  ('España', 'Madrid', 'España', 'Barcelona', 'barcelona1.jpg',200, 'Avion', 'Viaje express a Barcelona', 'Gastronómico/Con amig@s',1),
  ('España', 'Madrid', 'España', 'Santander, Bilbao, Burgos', 'santander.jpg',120, 'Coche', 'Viaje turistico por el Norte de España: Santander, Bilbao y Burgos', 'Aventuras/Con amig@s', 2),
  ('España', 'Valencia', 'España', 'Sevilla', 'sevilla.jpg', 180, 'Ave', 'Viaje a Sevilla', 'Cultural/Religioso', 3),
  ('España', 'Madrid', 'España', 'Segovia', 'segovia.jpg', 50, 'Coche', 'Viaje express a Segovia', 'Gastronómico/Low cost',4),
  ('España', 'Madrid', 'Italia', 'Roma', 'roma.jpg',300, 'Avion', 'Viaje a Roma, museos y cultura', 'Cultural/Rómantico', 1),
  ('España', 'Madrid', 'España', 'Toledo', 'toledo.jpg',35, 'Coche', 'Viaje a Toledo', 'Low cost',2),
  ('España', 'Madrid', 'España', 'Barcelona', 'barcelona2.jpg',150, 'Autobus', '2 dias en Barcelona', 'Fiesta/Con amig@s',3),
  ('España', 'Salamanca', 'Portugal', 'Lisboa', 'lisboa.jpg',225, 'Coche', '3 dias en Lisboa', 'Romántico/Relax',4),
  ('España', 'Madrid', 'España', 'Granada', 'granada.jpg',140, 'Autobus', 'Viaje turistico a Granada', 'Low Cost/Romántico/Religioso', 1),
  ('España', 'Madrid', 'Francia', 'Paris', 'paris.jpg',340, 'Avion', 'Viaje romantico a Paris', 'Romántico', 2),
  ('España', 'Madrid', 'Argentina', 'Buenos Aires, Iguazú y Ushuaia', 'argentina.jpg', 1460, 'Avion', 'Viaje de aventura por Argentina', 'Aventuras/Con amig@s/Cultural', 5),
  ('España', 'Madrid', 'Japón', 'Tokio, Osaka y Kioto', 'japon.jpg', 1735, 'Avion', 'Viaje de aventura por Japon', 'Aventuras/Gastronómico/Con amig@s', 5)
;

/*ITINERARIO*/
INSERT INTO itinerario (localizacion,alojamiento,titulo, manana, tarde, noche, id_viaje)
 VALUES
 ('Barcelona','hotel', '1º dia del viaje',  'aterrizaje en el aeropuerto y viaje al hotel', 'visita a la sagrada familia', 'paseo por las ramblas', 1),
 ('Barcelona','hotel', '2º dia del viaje', 'visita al parque Güell', 'paseo por la playa', 'vuelta al aeropuerto', 1),
 ('Santander', 'hotel','1º dia del viaje', 'Viaje en coche a Santander', 'visita por Santander', 'vuelta al hotel', 2),
 ('Bilbao','hotel', '2º dia del viaje', 'Viaje en coche a Bilbao', 'visita por Bilbao', 'cena por Bilbao y vuelta al hotel', 2),
 ('Burgos','hotel', '3º dia del viaje', 'Viaje en coche a Burgos', 'visita por Burgos', 'vuelta a casa en coche', 2),
 ('Sevilla','hotel', '1º dia del viaje', 'Viaje en Ave a Sevilla', 'Paseo por el rio', 'cena de tapas', 3),
 ('Sevilla','hotel', '2º dia del viaje', 'Visita al barrio de Triana', 'Visita a la Plaza de España', 'Vuelta en Ave', 3),
 ('Segovia', 'hotel','1º dia del viaje', 'Viaje en coche a Segovia', 'Paseo por la ciudad y comida en un bar tipico', 'Vuelta en coche a casa', 4),
 ('Roma','hotel', '1º dia del viaje', 'Viaje en Roma en avion', 'Visita al Coliseo', 'Cena en una pizzeria tipica', 5),
 ('Roma','hotel', '2º dia del viaje', 'Visita al Vaticano', 'Paseo por la ciudad, visita a la Piazza de Spagna', 'Cena el restaurante Di carli', 5),
 ('Roma','hotel', '3º dia del viaje', 'Visita al Panteon', 'Visita a la Fontana di Trevi', 'Vuelta a casa en avión', 5),
 ('Toledo', 'hotel','1º dia del viaje', 'Viaje en coche a Toledo', 'Paseo por la ciudad y visita a la catedral', 'Cena en un restaurante típico y vueltaa casa en coche', 6),
 ('Barcelona','hotel', '1º dia del viaje', 'Viaje en autobus a Barcelona', 'Paseo por la ciudad, paseo por las ramblas', 'Cena en un TGB', 7),
 ('Barcelona','hotel', '2º dia del viaje', 'Visita al paque Güell', 'Visita a la casa Batlló', 'Vuelta a casa en autobus', 7),
 ('Lisboa','hotel', '1º dia del viaje', 'Viaje en coche a Portugal', 'Paseo por la ciudad', 'Cena en el restaurante Obrigrado, donde se puede ver toda la ciudad desde un mirador', 8),
 ('Sintra','hotel', '2º dia del viaje', 'Viaje en tren a Sintra', 'Visita a los palacios de Sintra', 'Vuelta a Lisboa', 8),
 ('Lisboa','hotel', '3º dia del viaje', 'Visita a Belen, donde estan los famosos pasteles de Belen', 'paseo por la playa y el puente', 'Vuelta a casa', 8),
 ('Granada','hotel', '1º dia del viaje', 'Viaje en autobus a Granada', 'visita al barrio del Albaicín', 'Cena de tapas en el bar los Manueles', 9),
 ('Granada','hotel', '2º dia del viaje', 'Visita a la Alhambra', 'Paseo por la ciudad', 'Vuelta a casa en autobus', 9),
 ('Paris','hotel', '1º dia del viaje', 'Viaje en avion a Paris', 'Paseo por la ciudad, comida en el restaurante Ratatouille', 'Visita a la Torre Eiffel', 10),
 ('Paris','hotel', '2º dia del viaje', 'Visita al museo Louvre', 'Visita al arco de triunfo', 'Paseo romantico por el Sena', 10),
 ('Paris','hotel', '3º dia del viaje', 'Visita al barrio de Montmartre', 'Visita a Notre Dame', 'Vuelta a casa en avión', 10),
 ('Buenos Aires','hotel', '1º dia del viaje', 'Viaje en avión', 'Viaje en avión', 'Llegada al aeropuerto', 11),
 ('Buenos Aires','hotel', '2º dia del viaje', 'Visita al barrio antiguo', 'Comida de la famosa carne argentina', 'Baile de un tango', 11),
 ('Iguazú','hotel', '3º dia del viaje', 'Viaje en avión a Iguazú', 'Llegada al aeropuerto', 'Cena en el restaurante Carne y Leña', 11),
 ('Iguazú','hotel', '4º dia del viaje', 'Visita a las cataratas de Iguazú', 'Visita a las cataratas de Iguazú', 'Vuelta al hotel', 11),
 ('Ushuaia','hotel', '5º dia del viaje', 'Viaje en avión a Ushuaia', 'Viaje en avión a Ushuaia', 'Llegada al aeropuerto', 11),
 ('Ushuaia','hotel', '6º dia del viaje', 'Visita el glaciar del Perito Moreno', 'Excursión para ver a los pingüinos', 'Cena romántica', 11),
 ('Ushuaia','hotel', '7º dia del viaje', 'Llegada al aeropuerto', 'Viaje en avión a casa', 'Viaje en avión a casa', 11),
 ('Tokio','hotel', '1º dia del viaje', 'Viaje en avión', 'Viaje en avión', 'Llegada al aeropuerto de Tokio', 12),
 ('Tokio','hotel', '2º dia del viaje', 'Visita el centro de Tokio', 'Visita el museo de Edo-Tokyo', 'Cena en el barrio de Matsuya el ramen típico', 12),
 ('Tokio','hotel', '3º dia del viaje', 'Viaje en bus al monte Fuji', 'Visita al monte Fuji', 'Cena de sushi en el restaurante Shinagawa', 12),
 ('Osaka','hotel', '4º dia del viaje', 'Viaje en tren a Osaka', 'Visita el centro de Osaka', 'Paseo nocturno por la ciudad', 12),
 ('Kioto','hotel', '5º dia del viaje', 'Viaje en tren a Kioto', 'Visita el Santuario Heian', 'Cena frente al Santuario', 12),
 ('Kioto','hotel', '6º dia del viaje', 'Llegada al aeropuerto', 'Vuelta a casa en avión', 'Vuelta a casa en avión', 12)
;

/*PUNTO DE RUTA*/
INSERT INTO fotosIT (ruta, id_itinerario)
 VALUES
 ( 'barcelona3.jpg', 1),
 ('barcelona2.jpg' , 2),
 ( 'santander2.jpg', 3),
 ( 'bilbao.jpg', 4),
 ( 'burgos.jpg', 5),
 ( 'sevilla2.jpg', 6),
 ( 'triana.jpg', 7),
 ('segovia2.jpg', 8),
 ( 'vaticano.jpg', 9),
 ('Fontana_di_Trevi.jpg', 10),
 ( 'panteon.jpg', 11),
 ('toledo2.jpg', 12),
 ( 'barcelona3.jpg',13),
 ( 'sagradafamilia.jpg', 14),
 ( 'lisboa2.jpg', 15),
 ('sintra.jpg', 16),
 ('belem.jpg', 17),
 ('cathedral_granada.jpg', 18),
 ('alhambra.jpg', 19),
 ( 'paris4.jpg', 20),
 ( 'paris2.jpg', 21),
 ('louvre.jpg', 22),
 ('avion.jpg', 23),
 ('buenos_aires.jpg', 24),
 ('154252_iguaz_790856.jpg', 25),
 ('Iguazu-Falls.jpg', 26),
 ('ushuaia.jpg', 27),
 ('Glaciar-Perito-Moreno-cómo-llegar-1.jpg', 28),
 ('avion2.jpg', 29),
 ('tokyo_aerport.jpg', 30),
 ('tokio.jpg', 31),
 ('Monte-Fuji.jpg', 32),
 ('osaka.jpg', 33),
 ('kioto.jpg', 34),
 ('avion3.jpg', 35)
;

/*COMENTARIO*/
INSERT INTO comentario (texto, fecha, id_user, id_viaje)
 VALUES
 ('Que guapo el viaje', '2020-01-01', 2, 1),
 ('Me gusta mucho Barcelona', '2020-02-04', 4, 1),
 ('Muy barato !', '2020-12-13', 3, 2),
 ('¿Me recomiendas ir en verano?', '2020-10-05', 4, 2),
 ('¿Que sitio recomiendas para comer?', '2020-11-02', 4, 3),
 ('Como mola', '2020-11-22', 1, 4),
 ('oleeeeee', '2020-12-26', 2, 4),
 ('Chulisimo el viaje', '2020-11-06', 1, 5),
 ('¿Recomendarias algo más para visitar?', '2020-11-06', 4, 6),
 ('oleeeee', '2020-12-13', 4, 7),
 ('Maquinaaaa', '2020-12-13', 1, 8),
 ('Ole tu', '2020-06-21', 4, 8),
 ('¿recomiendas algun sitio para comer?', '2020-12-13', 3, 8),
 ('Como mola se merece una ola', '2020-11-16', 2, 9),
 ('Me encanta este viaje', '2020-10-05', 3, 9),
 ('Me gusta mucho este viaje, seguramente lo haga pronto', '2020-09-05', 3, 10),
 ('¿Recomiendas ur más días?', '2020-010-05', 2, 11),
 ('I love it', '2020-010-05', 1, 12)
;

/*VALORACION*/
INSERT INTO valoracion (puntuacion, id_user, id_viaje)
 VALUES
  (5, 3, 1),
  (4, 2, 2),
  (4, 4, 2),
  (2, 1, 3),
  (4, 2, 3),
  (5, 3, 4),
  (4, 4, 4),
  (1, 1, 5),
  (2, 1, 6),
  (5, 3, 6),
  (3, 3, 6),
  (5, 1, 6),
  (4, 4, 7),
  (3, 1, 8),
  (4, 2, 8),
  (4, 3, 9),
  (5, 1, 9),
  (5, 1, 9),
  (2, 2, 10),
  (4, 3, 10),
  (4, 3, 11),
  (5, 2, 11),
  (5, 1, 12),
  (4, 2, 12),
  (5, 4, 12)

;

/*FAVORITOS*/
INSERT INTO favoritos (id_user, id_viaje)
 VALUES
 (1, 1),
 (2, 4),
 (3, 1),
 (4, 7),
 (3, 8),
 (5, 2),
 (2, 12)
;
