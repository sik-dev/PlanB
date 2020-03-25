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

  public static function update($id, ...$campos){
  }

  public static function delete($id)
  {
    /* $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM valoracion
                  WHERE id_viaje = ?",
                  $id); */
  }
}
