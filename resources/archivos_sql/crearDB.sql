/* DROP DATABASE viajes; */
CREATE DATABASE IF NOT EXISTS viajes;
/* CREATE DATABASE viajes; */
/* DROP USER 'viajes'@'localhost'; */
CREATE USER IF NOT EXISTS 'viajes'@'localhost' IDENTIFIED BY 'viajes';
GRANT ALL PRIVILEGES ON viajes.* TO 'viajes'@'localhost' WITH GRANT OPTION;
USE viajes;
SOURCE resources/archivos_sql/viajes.sql;
SOURCE resources/archivos_sql/insert.sql;

