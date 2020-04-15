<?php

class ViajesManager implements IDWESEntidadManager{

  public static function autentificado($nombre){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT id, nombre, pass FROM usuario WHERE nombre = ?", $nombre);
    return $db->obtenDatos();
  }

  /* REGISTRO DE USUARIO */
  public static function insertUsuario($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO usuario (descripcion,email, pass, nombre, pais, foto)
                    VALUES (?, ?, ?, ?, ?, ?)", $info);
    return $db->getLastId();
  }
  /* ------- */

  /*Borrado de viaje*/
  public static function borrarViaje($id_viaje){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM viaje WHERE id = ?",$id_viaje);
    //$db->ejecuta("DELETE FROM itinerario WHERE id_viaje = ?",$id_viaje);

  }

  public static function updateUsuario($info){
    $db = DWESBaseDatos::obtenerInstancia();

    if (count($info) == 2) {
      $db->ejecuta("UPDATE usuario
                  SET foto = ?
                  WHERE id = ?", $info);
    }else{
      $db->ejecuta("UPDATE usuario
                     SET ? = ?
                     WHERE email = ? ",$info);
      return $db->obtenDatos();
   }
  }

  public static function updatePassword($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("UPDATE usuario
                   SET   pass = ?
                   WHERE email = ?", $info);
 }

 /* FAVORITOS */
 public static function insertFavoritos($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO favoritos (id_viaje, id_user)
                   VALUES (?, ?)", $info);
    return $db->getLastId();
 }

 public static function getFavoritos($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM favoritos
                    WHERE id_viaje =  ?
                    AND id_user =  ?", $info);
    return $db->obtenDatos();
 }

 public static function deleteFavoritos($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM favoritos
                   WHERE id =  ?", $id);
    return $db->obtenDatos();
 }

 public static function getFavoritoWhereUser($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT id_viaje FROM favoritos
                    WHERE id_user =  ?", $info);
    return $db->obtenDatos();
 }
 /* ------- */

 /* TOKEN PASSWORD*/
 public static function insertTokenPassword($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO token_password (email, token)
                   VALUES (?, ?)", $info);
    return $db->obtenDatos();
 }
 public static function getTokenPassword($email){
    $db = DWESBaseDatos::obtenerInstancia();

    $db->ejecuta("SELECT token
                   FROM token_password
                   WHERE email = ?",$email);
    return $db->obtenDatos();
 }
 public static function deleteTokenPassword($email){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM token_password
                   WHERE email =  ?", $email);
 }


 /* COOKIE SESSION*/
 public static function insertCookieSesion($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO cookieSesion (cookie, id_user)
                   VALUES (?, ?)", $info);
    return $db->obtenDatos();
 }
 public static function getCookieSesion($cookie){
    $db = DWESBaseDatos::obtenerInstancia();

    $db->ejecuta("SELECT id_user
                   FROM cookieSesion
                   WHERE cookie = ?",$cookie);
    return $db->obtenDatos();
 }
 public static function deleteCookieSesion($id_user){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM cookieSesion
                    WHERE id_user =  ?", $id_user);
 }

 /* ------- */

 /* UPDATE
 public static function updateUsuario($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("UPDATE usuario
                   SET ? = ?
                   WHERE email = ? ",$info);
    return $db->obtenDatos();
 }
 */


   //VIAJES MEJORES VALORADOS
   public static function getViajes(){
      $db = DWESBaseDatos::obtenerInstancia();

      $db->ejecuta("SELECT  DISTINCT
                           viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) as media,
                           (SELECT count(itinerario.id) from itinerario WHERE itinerario.id_viaje = viaje.id) as diasViaje
                     FROM viaje INNER JOIN valoracion
                     ON viaje.id = valoracion.id_viaje
                     GROUP BY valoracion.id_viaje
                     ORDER BY media DESC
                     LIMIT 6");

      return $db->obtenDatos();
   }
   /* ------- */

   public static function getInfoUsers($id){
      $db = DWESBaseDatos::obtenerInstancia();

      $db->ejecuta("SELECT usuario.id,
                           usuario.descripcion,
                           usuario.email,
                           usuario.nombre,
                           usuario.pais,
                           usuario.foto,
                           usuario.mediaGlobal,
                           viaje.id
                     From usuario INNER JOIN viaje
                     ON usuario.id = viaje.id_user
                     WHERE usuario.id = ?",$id);

      return $db->obtenDatos();
   }

   /* **************    DIAS ITINERARIO   *******************************/
   public static function countItinerarioWhere($id){
      $db = DWESBaseDatos::obtenerInstancia();

      $db->ejecuta("SELECT count(*)
                     From viaje INNER JOIN itinerario
                     ON viaje.id = itinerario.id_viaje
                     GROUP BY itinerario.id_viaje
                     WHERE viaje.id = ?", $id);

      return $db->obtenDatos();
   }

   public static function getViajeUsers($id){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

      $db->ejecuta("SELECT viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) media,
                           (SELECT count(itinerario.id) 
                           FROM itinerario 
                           WHERE itinerario.id_viaje = viaje.id) as diasViaje
                     FROM viaje LEFT JOIN valoracion
                     ON viaje.id = valoracion.id_viaje
                     WHERE viaje.id_user = ?
                     GROUP BY valoracion.id_viaje
                     ORDER BY media DESC;
                     ",$id);

      return $db->obtenDatos();

   }
     /*hasta aqui */

   public static function getViajesWhere($datos){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) media,
                           (SELECT count(itinerario.id) from itinerario WHERE itinerario.id_viaje = viaje.id) as diasViaje
                     FROM viaje INNER JOIN valoracion
                     ON viaje.id = valoracion.id_viaje
                     WHERE ? = ?
                     GROUP BY valoracion.id_viaje
                     ORDER BY media DESC
                     ", $datos);
      return $db->obtenDatos();
   }

   public static function getViajesWherePais($datos){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) media,
                           (SELECT count(itinerario.id) from itinerario WHERE itinerario.id_viaje = viaje.id) as diasViaje
                     FROM viaje INNER JOIN valoracion
                     ON viaje.id = valoracion.id_viaje
                     WHERE viaje.pais_destino LIKE ?
                     GROUP BY valoracion.id_viaje
                     ORDER BY media DESC
                     LIMIT 6
                     ", $datos);

      return $db->obtenDatos();

   }
   public static function getViajesWhereCiudad($datos){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) media,
                           (SELECT count(itinerario.id) from itinerario WHERE itinerario.id_viaje = viaje.id) as diasViaje
                     FROM viaje INNER JOIN valoracion
                     ON viaje.id = valoracion.id_viaje
                     WHERE viaje.ciudad_destino LIKE ?
                     GROUP BY valoracion.id_viaje
                     ORDER BY media DESC
                     LIMIT 6
                     ", $datos);

      return $db->obtenDatos();
   }

   public static function getViajesNumDias($datos){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) as media,
                           (SELECT count(itinerario.id) from itinerario WHERE itinerario.id_viaje = viaje.id) as diasViaje
                     FROM viaje INNER JOIN valoracion
                     ON viaje.id = valoracion.id_viaje
                     WHERE (SELECT count(itinerario.id) from itinerario WHERE itinerario.id_viaje = viaje.id) = ?
                     GROUP BY valoracion.id_viaje
                     ORDER BY media DESC
                     LIMIT 6
                     ", $datos);

      return $db->obtenDatos();
   }

   public static function getTest(){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) media,
                           (SELECT count(itinerario.id) from itinerario WHERE itinerario.id_viaje = viaje.id) as diasViaje
                     FROM viaje INNER JOIN valoracion
                     ON viaje.id = valoracion.id_viaje
                     GROUP BY valoracion.id_viaje
                     ORDER BY media DESC
                     ");

      return $db->obtenDatos();
   }

   public static function getViajesID($id){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT viaje.id,
                           viaje.precio,
                           viaje.transporte,
                           viaje.descripcion,
                           viaje.ciudad_destino,
                           viaje.pais_destino,
                           viaje.ciudad_origen,
                           viaje.foto,
                           viaje.id_user,
                           round( avg(valoracion.puntuacion), 2) media
                       FROM viaje INNER JOIN valoracion
                       ON viaje.id = valoracion.id_viaje
                       WHERE viaje.id = ?
                       GROUP BY valoracion.id_viaje
                       ", $id);
      return $db->obtenDatos();
   }

   public static function getItinerario($id_viaje){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT * FROM itinerario WHERE id_viaje = ?", $id_viaje);
      return $db->obtenDatos();
   }

   /* COMENTARIOS */
   public static function getComentariosID($id){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT *
                     FROM comentario
                     WHERE id_viaje = ?
                     ", $id);

         return $db->obtenDatos();

   }
   public static function insertComentario($info){
     $db = DWESBaseDatos::obtenerInstancia();
     $db->ejecuta("INSERT INTO comentario (texto, fecha, id_user, id_viaje)
                    VALUES (?, ?, ?, ?)", $info);
   }

   public static function borrarComentario($id){
     $db = DWESBaseDatos::obtenerInstancia();
     $db->ejecuta("DELETE FROM comentario
                    WHERE id = $id");
   }

   public static function getInfo($id){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("SELECT email, descripcion, nombre, pais, foto, pass, mediaGlobal
                    FROM usuario
                    WHERE id = ?"
                    , $id);
      return $db->obtenDatos();
   }

   /* CREAR NUEVO VIAJE */
   public static function insertViaje($paramViaje, $paramItinerario, $paramFoto){
      $db = DWESBaseDatos::obtenerInstancia();
      $db->ejecuta("INSERT INTO viaje
                     (pais_origen, ciudad_origen, pais_destino,
                     ciudad_destino, foto, precio, transporte, descripcion, id_user)
                     VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)"
                     , $paramViaje);

      array_push($paramItinerario, $db->getLastId());
      ViajesManager::insertItinerario($db, $paramItinerario);

      array_push($paramFoto, $db->getLastId());
      ViajesManager::insertFotoIti($db, $paramFoto);
   }

   public static function insertItinerario($db, $par){
      $db->ejecuta("INSERT INTO itinerario
                     (localizacion, alojamiento, titulo,
                     manana, tarde, noche, id_viaje)
                     VALUES(?, ?, ?, ?, ?, ?, ?)"
                     , $par);
   }

   public static function insertFotoIti($db, $par){
      $db->ejecuta("INSERT INTO fotosIT (ruta, id_itinerario) VALUES(?, ?)", $par);
   }
   /* ------- */

   //obtener todos los viajes
   public static function getAllViajes($id = NULL){
      $db = DWESBaseDatos::obtenerInstancia();

      if($id == null){
        $db->ejecuta("SELECT * FROM viaje");
      } else{
        $db->ejecuta("SELECT * FROM viaje WHERE id_user = ?", $id);
      }

      return $db->obtenDatos();
   }
   /* ------- */

   /* SIN IMPLEMENTAR */

   public static function getAll(){
   }

   public static function getBy($id){
   }

   public static function insert(...$campos){
   }

   public static function update($id, ...$campos){
   }

   public static function delete($id){
   }
}
