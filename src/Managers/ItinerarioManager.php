<?php

class ItinerarioManager implements IDWESEntidadManager
{
  public static function getAll(){
  }

  public static function getBy($id)//id del viaje
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM itinerario
                  WHERE id_viaje = ?",
                  $id);
    return $db->obtenDatos();
  }

  public static function insert(...$campos)
  {
    /* print_r('<pre>');
    print_r($campos);
    print_r('</pre>'); */
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO itinerario
                    (localizacion, alojamiento,
                    manana, tarde, noche, id_viaje)
                  VALUES(?, ?, ?, ?, ?, ?)",
                  $campos[0]);
    $idItinerario = $db->getLastId();

    foreach ($campos[1] as $value) {
      array_push($value, $idItinerario);
      FotosItinerarioManager::insert($value, $idItinerario);
    }
  }

  public static function update($id, ...$campos)
  {
    array_push($campos, $id);
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("UPDATE itinerario
                  SET 
                    localizacion = ?,
                    alojamiento = ?,
                    manana = ?,
                    tarde = ?,
                    noche = ?
                  WHERE id = ?",
                  $campos);
  }

  public static function delete($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM itinerario WHERE id = ?",$id);
  }
}
