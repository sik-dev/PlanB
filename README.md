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

# Evolución
Este es un proyecto de ejemplo siguiendo el proyecto [web-estructura-proyecto](https://github.com/JorgeDuenasLerin/web-estructura-proyecto).

Aquí tenemos un boceto para implementar un foro.

## Base de datos
Utilizamos la herramienta para acceder y facilitar consultas **DWESBaseDatos.php**.

Basándonos en esta también tenemos un interfaz que deberá implementar el manejador de las entidas **IDWESEntidadManager.php**

Para implementar una entidad, por ejemplo un Tema del foro, tendremos la entidad como objeto desacoplada de la base de datos **Tema.php** y un **TemaManager.php** encargador de hacer la transición entre el mundo de la base de datos y el mundo de los objetos.

Ver en la carpeta **src**

## Requisitos de la aplicación

``` NOTA: Los siguientes requisitos no están implementados ```

La aplicación resultante será un foro sin registro. En la página principal del foro podremos ver un listado de temas abiertos y un botón para crear un tema nuevo.

Para crear un tema nuevo se pedirá la siguiente información
- Título del tema (max 120 caracteres)
- Nombre de quién lo inició (max 20 caracteres)
- Clave de administración. (max 20. La persona que sepa la clave de administración podrá borrar el tema)
- Etiqueta con la que se relaciona el tema (texto libre sin espacio, max 20 car)
- También se guardará la fecha de publicación aunque el usuario no la introduzca

Los campos que aparecen en el listado de temas son:
- Título
- Nombre del creador
- Etiqueta
- Fecha de creación
- Número de respuestas

Junto con cada línea aparecerá un enlace para ver las respuestas y un icono
para borrarlo.

Este listado estará paginado y a través de los botones de la cabecera permitirá realizar una ordenación por todos los campos.

Cuando se pinche en un tema aparecerá un listado de respuestas ordenado por fecha de publicación. También existirá un botón para introducir una respuesta.

El listado de respuestas no se podrá ordenar de otra manera y tendrá los siguientes campos:
- Título de respuesta
- Contenido de respuesta
- Nombre del que publica
- Fecha

Al crear un respuesta se pedirán los siguientes campos:
- Título (max 120 car)
- Nombre (max 20 caracteres)
- Contenido (max 500 car). Para este contenido se permite introducir HTML. Incluiremos en nuestro proyecto algún editor WYSIWYG HTML
- También se guardará la fecha de publicación aunque el usuario no la introduzca


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
