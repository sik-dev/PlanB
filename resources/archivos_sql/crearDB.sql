CREATE DATABASE viajes;
CREATE USER 'viajes'@'localhost' IDENTIFIED BY 'viajes';
GRANT ALL PRIVILEGES ON viajes.* TO 'viajes'@'localhost' WITH GRANT OPTION;
USE viajes;
SOURCE viajes.sql;
SOURCE insert.sql;

