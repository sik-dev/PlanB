<?php

class CookieManager implements IDWESEntidadManager 
{
  public static function getAll(){
  }

  public static function getBy($cookie)
  {
    $db = DWESBaseDatos::obtenerInstancia();

    $db->ejecuta("SELECT id_user
                  FROM cookieSesion
                  WHERE cookie = ?",
                  $cookie);
    return $db->obtenDatos();
  }

  public static function insert(...$campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO cookieSesion (cookie, id_user)
                  VALUES (?, ?)", $campos);
    return $db->obtenDatos();
  }

  public static function update($id, ...$campos){
  }

  public static function delete($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM cookieSesion
                  WHERE id_user =  ?", $id);
  }
}
