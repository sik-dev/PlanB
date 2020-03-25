<?php

class FavoritosManager implements IDWESEntidadManager
{
  /* public static function getFavoritos($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM favoritos
                    WHERE id_viaje =  ?
                    AND id_user =  ?", $info);
    return $db->obtenDatos();
  }

  public static function getFavoritoWhereUser($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT id_viaje FROM favoritos
                    WHERE id_user =  ?", $info);
    return $db->obtenDatos();
  } */

  public static function getAll(){
  }

  public static function getBy($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM favoritos
                  WHERE id_user =  ?", $id);
    //return $db->obtenDatos();
    return array_map(function($fila){
      return new Favoritos(
        $fila['id'],
        $fila['id_viaje'],
        $fila['id_user']
      );
    }, $db->obtenDatos());
  }

  public static function insert(...$campos)
  {
    //print_r($campos);
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO favoritos (id_viaje, id_user)
                  VALUES (?, ?)", $campos);
    //return $db->getLastId();
  }

  public static function update($id, ...$campos){
  }

  public static function delete($campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM favoritos
                    WHERE id_viaje =  ?
                    AND id_user = ?
                    ", $campos);
    return $db->obtenDatos();
  }
}
