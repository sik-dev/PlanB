<?php

class ValoracionManager implements IDWESEntidadManager
{
  public static function getAll(){
  }

  public static function getBy($id){
  }

  public static function insert(...$campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO valoracion (puntuacion, id_user, id_viaje)
                  VALUES (?, ?, ?)",
                  $campos);
  }
  public static function getMediaViaje($idViaje)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT round(avg(puntuacion),2) media FROM valoracion
                  WHERE id_viaje = ?",
                  $idViaje);

    return $db->obtenDatos();
  }

  public static function update($id, ...$campos){
  }

  public static function delete($campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM valoracion
                  WHERE id_user = ?
                  AND id_viaje = ?",
                  $campos);
  }
}
