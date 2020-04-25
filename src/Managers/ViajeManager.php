<?php

class ViajeManager implements IDWESEntidadManager{

  private static function map($datos)
  {
    return array_map(function($fila){
      return
      [
        'viaje' => new Viaje(
          $fila['id'],
          $fila['pais_origen'],
          $fila['ciudad_origen'],
          $fila['pais_destino'],
          $fila['ciudad_destino'],
          $fila['foto'],
          $fila['precio'],
          $fila['transporte'],
          $fila['descripcion'],
          $fila['etiquetas'],
          $fila['id_user']
        ),
        'media' => $fila['media'],
        'diasViaje' => $fila['diasViaje']
      ];
    }, $datos);
  }

  //VIAJES MEJORES VALORADOS
  public static function getViajes()
  {
    $db = DWESBaseDatos::obtenerInstancia();

    $db->ejecuta("SELECT viaje.*,
                         round( avg(valoracion.puntuacion), 2) media,
                         (SELECT count(itinerario.id)
                         FROM itinerario
                         WHERE itinerario.id_viaje = viaje.id) as diasViaje
                  FROM viaje INNER JOIN valoracion
                  ON viaje.id = valoracion.id_viaje
                  GROUP BY valoracion.id_viaje
                  ORDER BY media DESC
                  LIMIT 6");

    //return $db->obtenDatos();
    return self::map($db -> obtenDatos());
  }
  /* ------- */

  public static function getInfoUsers($id)
  {
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

  public static function getByUser($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

    $db->ejecuta("SELECT viaje.*,
                          round( avg(valoracion.puntuacion), 2) media,
                         (SELECT count(itinerario.id)
                         FROM itinerario
                         WHERE itinerario.id_viaje = viaje.id) as diasViaje
                  FROM viaje LEFT JOIN valoracion
                  ON viaje.id = valoracion.id_viaje
                  WHERE viaje.id_user = ?
                  GROUP BY valoracion.id_viaje
                  ORDER BY media DESC;",
                  $id);

    //return $db->obtenDatos();
    return self::map($db -> obtenDatos());
  }

  public static function getWhere(...$datos)
  {
    $diasViaje = '(SELECT count(itinerario.id)
                  FROM itinerario
                  WHERE itinerario.id_viaje = viaje.id)';

    if (!is_numeric($datos[1])){
      $datos[1] = '%'.$datos[1].'%';
      $where = "WHERE $datos[0] LIKE";
    }else{
      $where = "WHERE $diasViaje =";
    }

    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT viaje.*,
                          round( avg(valoracion.puntuacion), 2) media,
                          $diasViaje as diasViaje
                  FROM viaje INNER JOIN valoracion
                  ON viaje.id = valoracion.id_viaje
                  $where ?
                  GROUP BY valoracion.id_viaje
                  ORDER BY media DESC
                  LIMIT ?, ?",
                  $datos[1], $datos[2], $datos[3]);
    //return $db->obtenDatos();
    return self::map($db -> obtenDatos());
  }

  public static function getAllNames($sugerencia){
    /* $sql = "SELECT $destino
            FROM viaje
            WHERE $destino LIKE ?
            LIMIT 5"; */

    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT DISTINCT ciudad_destino, pais_destino
                  FROM viaje
                  WHERE ciudad_destino LIKE ?
                  OR pais_destino LIKE ?
                  LIMIT 5",
                  ["%$sugerencia%", "%$sugerencia%"]);

    return $db->obtenDatos();
  }

  public static function getAllTest($offset, $limit)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT viaje.*,
                         round( avg(valoracion.puntuacion), 2) media,
                         (SELECT count(itinerario.id)
                         FROM itinerario
                         WHERE itinerario.id_viaje = viaje.id) as diasViaje
                  FROM viaje INNER JOIN valoracion
                  ON viaje.id = valoracion.id_viaje
                  GROUP BY valoracion.id_viaje
                  ORDER BY media DESC
                  LIMIT $offset, $limit"
                );

    return self::map($db -> obtenDatos());
  }

  public static function getAllTestAdmin()
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT viaje.*,
                         round( avg(valoracion.puntuacion), 2) media,
                         (SELECT count(itinerario.id)
                         FROM itinerario
                         WHERE itinerario.id_viaje = viaje.id) as diasViaje
                  FROM viaje INNER JOIN valoracion
                  ON viaje.id = valoracion.id_viaje
                  GROUP BY valoracion.id_viaje
                  ORDER BY viaje.id ASC
                  "
                );

    return self::map($db -> obtenDatos());
  }
  public static function getAll()
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT count(*) as numViajes FROM viaje");

    return $db->obtenDatos()[0]['numViajes'];
  }

  public static function getBy($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM viaje WHERE id_user = ?", $id);
    //return $db->obtenDatos();
    return self::map($db -> obtenDatos());
  }

  public static function getById($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT viaje.*,
                    round( avg(valoracion.puntuacion), 2) media,
                    (SELECT count(itinerario.id)
                    FROM itinerario
                    WHERE itinerario.id_viaje = viaje.id) as diasViaje
                  FROM viaje INNER JOIN valoracion
                  ON viaje.id = valoracion.id_viaje
                  WHERE viaje.id = ?
                  GROUP BY valoracion.id_viaje",
                  $id);
    //return $db->obtenDatos();
    return self::map($db -> obtenDatos())[0];
  }
  /* public static function getViajesID($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM viaje WHERE id = ?", $id);
    return $db->obtenDatos();
  } */

  public static function insert(...$campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO viaje
                    (pais_origen, ciudad_origen, pais_destino,
                    ciudad_destino, foto, precio, transporte, descripcion, etiquetas, id_user)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                    , $campos[0]);
    /*
    print_r('<pre>');
    print_r($campos);
    print_r('</pre>');
    */
    return /* $id_viaje =  */$db->getLastId();
    /* array_push($campos[1], $id_viaje);
    ValoracionManager::insert(0, end($campos[0]), $id_viaje);
    ItinerarioManager::insert($campos[1]);

    array_push($campos[2], $db->getLastId());
    FotosItinerarioManager::insert($campos[2]); */
  }

  public static function update($id, ...$campos){
  }

  /*Borrado de viaje*/
  public static function delete($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM viaje WHERE id = ?",$id);
    //$db->ejecuta("DELETE FROM itinerario WHERE id_viaje = ?",$id_viaje);
  }
}
