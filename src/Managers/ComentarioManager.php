<?php

class ComentarioManager implements IDWESEntidadManager
{
  public static function getAll()
  {
  }

  public static function getBy($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT *
                  FROM comentario
                  WHERE id_viaje = ?", 
                  $id);

    //return $db->obtenDatos();
    return array_map(function($fila){
      return new Comentario(
        $fila['id'],
        $fila['texto'],
        $fila['fecha'],
        $fila['id_user'],
        $fila['id_viaje']
      );
    }, $db->obtenDatos());   
  }

  public static function insert(...$campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO comentario (texto, fecha, id_user, id_viaje)
                  VALUES (?, ?, ?, ?)", $campos);
  }

  public static function update($id, ...$campos)
  {
  }

  public static function delete($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM comentario
                  WHERE id = ?",
                  $id);
  }
}
