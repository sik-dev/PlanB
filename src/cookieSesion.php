<?php
  /*PARA GUARDAR O CREAR COOKIES DE SESION*/

  $db = DWESBaseDatos::obtenerInstancia();

  function guardaSesion($id, $data){
    $data = serialize($data);

    $sql = "INSERT INTO usuario (cookie, id_user)
            VALUES ('$data', '$id')";
    $db->ejecuta($sql);
  }

  function obten_o_crea_sesion(&$id, &$data){
      //tiene cookie ??
      if ( isset($_COOKIE['mi_sesion']) ){
        //ya me has visitado
        $id = $_COOKIE['mi_sesion'];
        $sql = "SELECT cookie FROM cookieSesion WHERE id_user = '$id'";
        $datoCookie = $db->ejecuta($sql);
        $data = unserialize($datoCookie);  //leemos sus datos
      }else{
        //nuevo usuario
        $id = mt_rand(10000, 999999);
        $data = [];
        setcookie('mi_sesion', $id);
      }
  }

 ?>
