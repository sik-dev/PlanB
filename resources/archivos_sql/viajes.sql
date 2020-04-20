/* BD del proyecto
jorge ,joan y Adrian
*/

/* SET FOREIGN_KEY_CHECKS=0;   si es que se agregan las tablas mas de una vez */
/* use viajes; */
SET FOREIGN_KEY_CHECKS=0;
SET NAMES 'utf8';
/* SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', '')); */

DROP TABLE IF EXISTS valoracion;
DROP TABLE IF EXISTS comentario;
DROP TABLE IF EXISTS fotosIT;
DROP TABLE IF EXISTS itinerario;
DROP TABLE IF EXISTS viaje;
DROP TABLE IF EXISTS cookieSesion;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS favoritos;
DROP TABLE IF EXISTS token_password;

CREATE TABLE usuario(
    id INT NOT NULL auto_increment PRIMARY KEY,
    descripcion VARCHAR(200) NOT NULL,
    email VARCHAR(30) NOT NULL,
    pass VARCHAR(200) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    foto VARCHAR(50) NOT NULL,
    mediaGlobal FLOAT DEFAULT 0,
    rol VARCHAR(30) NOT NULL DEFAULT 'USER'
);

CREATE TABLE cookieSesion(
    id INT NOT NULL auto_increment PRIMARY KEY,
    cookie VARCHAR(200) NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES usuario(id) ON DELETE CASCADE
);

CREATE TABLE token_password(
    id INT NOT NULL auto_increment PRIMARY KEY,
    email VARCHAR(200) NOT NULL,
    token VARCHAR(200) NOT NULL
);

CREATE TABLE viaje(
    id INT NOT NULL auto_increment  PRIMARY KEY,
    pais_origen VARCHAR(50) NOT NULL,
    ciudad_origen VARCHAR(50) NOT NULL,
    pais_destino VARCHAR(50) NOT NULL,
    ciudad_destino VARCHAR(50) NOT NULL,
    foto VARCHAR(50),
    precio FLOAT ,
    transporte VARCHAR(30),
    descripcion VARCHAR(200),
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES usuario(id) ON DELETE CASCADE
);

CREATE TABLE itinerario(
    id INT NOT NULL auto_increment PRIMARY KEY,
    localizacion VARCHAR(50) NOT NULL,
    alojamiento VARCHAR(50),
    manana VARCHAR(200),
    tarde VARCHAR(200),
    noche VARCHAR(200),
    id_viaje INT NOT NULL,
    FOREIGN KEY (id_viaje) REFERENCES viaje(id) ON DELETE CASCADE
);

CREATE TABLE fotosIT(
    id INT NOT NULL auto_increment PRIMARY KEY,
    ruta VARCHAR(50) NOT NULL,
    id_itinerario INT NOT NULL,
    FOREIGN KEY (id_itinerario) REFERENCES itinerario(id) ON DELETE CASCADE
);

CREATE TABLE favoritos(
    id INT NOT NULL auto_increment PRIMARY KEY,
    id_viaje INT NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_viaje) REFERENCES viaje(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES usuario(id) ON DELETE CASCADE
);

CREATE TABLE comentario(
    id INT NOT NULL auto_increment PRIMARY KEY,
    texto VARCHAR (500) NOT NULL,
    fecha TIMESTAMP NOT NULL,
    id_user INT NOT NULL,
    id_viaje INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES usuario(id) ON DELETE CASCADE,
    FOREIGN KEY (id_viaje) REFERENCES viaje(id) ON DELETE CASCADE
);

CREATE TABLE valoracion(
    id INT NOT NULL auto_increment PRIMARY KEY,
    puntuacion INT(1),
    id_user INT NOT NULL,
    id_viaje INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES usuario(id) ON DELETE CASCADE,
    FOREIGN KEY (id_viaje) REFERENCES viaje(id) ON DELETE CASCADE
);
