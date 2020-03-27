<?php
error_reporting(0);

 if(isset($_GET['id']) && !empty($_GET['id'])) {
     $id = $_GET['id'];
     $comentarios = ComentarioManager::getBy($id);
     $nuevoArray = [];
     $i = 0;

     foreach ($comentarios as $fila) {
       $nuevoArray[$i]['id'] = $fila->getId();
       $nuevoArray[$i]['texto'] = $fila->getTexto();
       $nuevoArray[$i]['fecha'] = $fila->getFecha();
       $nuevoArray[$i]['id_user'] = $fila->getIdUser();
       $nuevoArray[$i]['id_viaje'] = $fila->getIdViaje();

       $datosUsuario = UsuarioManager::getBy($fila->getIdUser());
       $nuevoArray[$i++]['foto'] = $datosUsuario->getFoto();
     }

     $obj = json_encode($nuevoArray, JSON_UNESCAPED_UNICODE);
     echo $obj;
  }
?>
