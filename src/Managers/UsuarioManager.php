<?php

class UsuarioManager implements IDWESEntidadManager
{

  public static function autentificado($nombre)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT id, nombre, pass
                  FROM usuario
                  WHERE nombre = ?",
                  $nombre);
    return $db->obtenDatos();
  }

  public static function getAll()
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM usuario");
    return $db->obtenDatos();
  }

  public static function getBy($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT * FROM usuario WHERE id = ?", $id);
    $fila = $db->obtenDatos()[0];
    //print_r($fila);
    return
    new Usuario(
      $fila['id'],
      $fila['descripcion'],
      $fila['email'],
      $fila['pass'],
      $fila['nombre'],
      $fila['pais'],
      $fila['foto'],
      $fila['mediaGlobal'],
      $fila['rol']
    );
  }

  /* REGISTRO DE USUARIO */
  public static function insert(...$campos)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("INSERT INTO usuario (descripcion, email, pass, nombre, pais, foto)
                  VALUES (?, ?, ?, ?, ?, ?)",
                  $campos);
    return $db->getLastId();
  }

  public static function update($id, ...$campos)
  {
/*     print_r('<pre>');
    print_r($campos);
    print_r('</pre>'); */
    $db = DWESBaseDatos::obtenerInstancia();
    if (count($campos) == 2) {
      $db->ejecuta("UPDATE usuario
                    SET foto = ?
                    WHERE id = ?",
                    $campos);
    }else{
      $db->ejecuta("UPDATE usuario
                    SET descripcion = ?,
                        email = ?,
                        pass = ?,
                        nombre = ?,
                        pais = ?
                    WHERE id = ?",
                    $campos);
    }
  }
  /*
  public static function updatePassword($info){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("UPDATE usuario
                    SET   pass = ?
                    WHERE email = ?", $info);
  }

  public static function getInfo($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT email, descripcion, nombre, pais, foto, pass, mediaGlobal
                  FROM usuario
                  WHERE id = ?"
                  , $id);
    return $db->obtenDatos();
  }
  */

  public static function getInfoUsers($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT id FROM viaje WHERE id_user = ?", $id);
    //$infoTarjeta = self::getBy($id);
    $infoTarjeta = [self::getBy($id), $db->obtenDatos()['id_user']];
    //array_push($infoTarjeta, $db->obtenDatos()['id_user']);//verificar luego
    return $infoTarjeta;
  }

  public static function getNombre($id){
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("SELECT nombre FROM usuario WHERE id = ?", $id);
    return $db->obtenDatos()[0]['nombre'];
  }

  public static function delete($id)
  {
    $db = DWESBaseDatos::obtenerInstancia();
    $db->ejecuta("DELETE FROM usuario WHERE id = ?", $id);
  }
}
