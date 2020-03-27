<?php
error_reporting(0);

 if(isset($_GET['id']) && !empty($_GET['id'])) {
     $id = $_GET['id'];
     $datos = UsuarioManager::getBy($id);
     $nuevoArray = [];
     $i = 0;

     $nuevoArray['id'] = $datos->getId();
     $nuevoArray['descripcion'] = $datos->getDescripcion();
     $nuevoArray['email'] = $datos->getEmail();
     $nuevoArray['nombre'] = $datos->getNombre();
     $nuevoArray['pais'] = $datos->getPais();
     $nuevoArray['foto'] = $datos->getFoto();
     $nuevoArray['media'] = $datos->getMedia();

     $obj = json_encode($nuevoArray, JSON_UNESCAPED_UNICODE);
     echo $obj;
  }
?>
