<?php

  //OBTENER ID del USER
   if ( isset($_SESSION['id']) ){
     $id = intval($_SESSION['id']);
     $user = UsuarioManager::getBy($id);

     //SI es ADMIN
     if(  isset($user) && $user->getRol() === 'ADMIN' &&
          isset($_GET['id']) && $_GET['id'] != null
        ) {

        ViajeManager::delete($_GET['id']);

     //SINO AL INICIO
     }else{
       header('Location: inicio.php');
       exit;
     }
   }else{
     header('Location: inicio.php');
     exit;
   }
?>
<link rel="stylesheet" href="/css/borrarViaje_ADMIN.css">
<div class="borrarViaje">
  <h2>Viaje borrado corectamente</h2>
  <a href="admin.php">Volver al área de administración</a>
</div>
