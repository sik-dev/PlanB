CREATE DATABASE viajes;
CREATE USER 'viajes'@'localhost' IDENTIFIED BY 'viajes';
GRANT ALL PRIVILEGES ON viajes.* TO 'viajes'@'localhost' WITH GRANT OPTION;

use viajes;
