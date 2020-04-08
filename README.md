# web-estructura-proyecto
Estructura de un proyecto completo web

```
\- bin
    ^- Comandos ejecutables de nuestra aplicación
       Ejemplo: limpiar base de datos, crear base de datos,
                crar administrador web, etc.
\- config
    ^- Archivos con configuración
       Ejemplo: base de datos, API google, rutas, etc.
\- docs
    ^- Información y documentación del proyecto
\- public
    ^- Esto es lo que servirá el servidor
       Pero puede incluir otros archivos
       (Se puede incluir desde php, no accesible desde fuera)
\- resources
    ^- Recursos web, pueden ser muy variados...
        templates, scripts de base de datos, imágenes del proyecto, etc.
\- src
    ^- Código fuente de la aplicación
\- test
    ^- Pruebas automatizadas
```

## Base de datos

En PlanB ejecutar el script crearDB.sql
```
# desde la ruta raíz
$ mysql -u root -p < resources\archivos_sql\crearDB.sql
```
Esto creará :
- El usuario **viajes** con contraseña **viajes** 
- La base de datos **viajes** con las tablas e inserts ejecutados


Utilizamos la herramienta para acceder y facilitar consultas **DWESBaseDatos.php**.

Basándonos en esta también tenemos un interfaz que deberá implementar el manejador de las entidades **IDWESEntidadManager.php**

## Ejecución

Del servidor de prueba
```
# desde la ruta raíz
$ bin/runserver.sh
```

Limpiar archivos README.md de los directorios
```
# desde la ruta raíz
$ bin/cleanreadme.sh
```
