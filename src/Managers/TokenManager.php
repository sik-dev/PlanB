<?php

class TokenManager implements IDWESEntidadManager
{
  public static function getAll(){
  }

  public static function getBy($email)
  {
    $db = DWESBaseDatos::obtenerInstancia();

    $db->ejecuta("SELECT token
                    FROM token_password
                    WHERE email = ?",$email);
    return $db->obtenDatos();
  }

  public static function insert(...$campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO token_password (email, token)
                    VALUES (?, ?)", $campos);
    return $db->obtenDatos();
  }

  public static function update($id, ...$campos){
  }

  public static function delete($email)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM token_password
                    WHERE email =  ?", $email);
  }
}
