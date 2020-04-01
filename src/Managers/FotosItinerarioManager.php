<?php

class FotosItinerarioManager implements IDWESEntidadManager
{
  public static function getAll(){
  }

  public static function getBy($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT ruta from fotosIT
                  WHERE id_itinerario = ?",
                  $id);
    return $db->obtenDatos();
  }

  public static function insert(...$campos)
  {
    print_r('<pre>');
    print_r($campos);
    print_r('</pre>');
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO fotosIT (ruta, id_itinerario)
                  VALUES(?, ?)",
                  $campos[0]);
  }

  public static function update($id, ...$campos){
  }

  public static function delete($id){
  }
}
