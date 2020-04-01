<?php

  //OBTENER ID del USER
   if ( isset($_SESSION['id']) ){
     $id = intval($_SESSION['id']);
     $user = UsuarioManager::getBy($id);

     //SI es ADMIN
     if( isset($user) && $user->getRol() === 'ADMIN') {
       $rutaImgProfile = (explode('.', $user->getFoto())[0] == 'profileDefault'? $user->getFoto():$user->getId().'/'.$user->getFoto());

       $usuarios = UsuarioManager::getAll();
       $viajes = ViajeManager::getAllTest();

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
<link rel="stylesheet" href="/css/admin.css">
<div class="contenedor">
  <div class="perfil">
    <h1>Área de Administración</h1>
    <br><br>
    <img id=fotoPerfil src="imgs/<?=$rutaImgProfile?>" alt="">
    <h2>Nombre: <?=$user->getNombre()?></h2>
    <h4>Email: <?=$user->getEmail()?></h4>
    <h4>País: <?=$user->getPais()?></h4>
  </div>
  <h2 id="h2Usuarios">Usuarios</h2>
  <div class="usuarios">
    <?php foreach ($usuarios as $fila) { ?>
      <div class="user">
        <div class="datosFoto">
          <img id=fotoPerfilUser src="imgs/<?=$fila['id']?>/<?=$fila['foto']?>" alt="">
          <h4><?=$fila['nombre']?></h4>
          <p>ID: <?=$fila['id']?></p>
        </div>
        <div class="datos">
          <p>Email: <?=$fila['email']?></p>
          <p>Descripción: <?=$fila['descripcion']?></p>
          <p>País: <?=$fila['pais']?></p>
          <p>Media global: <?=$fila['mediaGlobal']?></p>
          <p>Rol: <?=$fila['rol']?></p>
        </div>
        <div class="borrar">
          <a href="borrarUsuario_ADMIN.php?id=<?=$fila['id']?>"><img id="basura" src="/logos_proyecto/basura.png" alt=""></a>
        </div>
      </div>
    <?php } ?>
  </div>
  <h2 id="h2Viajes">Viajes</h2>
  <div class="viajes">
    <?php foreach ($viajes as $fila) { ?>
      <div class="viaje">
        <div class="viajeFoto">
          <img src="imgs/<?=$fila['viaje']->getIdUser()?>/<?=$fila['viaje']->getFoto()?>" alt="">
          <h4><?=$fila['viaje']->getCiudadDestino()?></h4>
          <p><?=$fila['viaje']->getPaisDestino()?></p>
          <p>ID: <?=$fila['viaje']->getId()?></p>
        </div>
        <div class="viajeDatos">
          <p>País origen: <?=$fila['viaje']->getPaisOrigen()?></p>
          <p>Ciudad Origen: <?=$fila['viaje']->getCiudadOrigen()?></p>
          <p>Media: <?=$fila['media']?></p>
          <p>Nº de días: <?=$fila['diasViaje']?></p>
          <a href="perfilPublico.php?id_user=<?=$fila['viaje']->getIdUser()?>"><p>Usuario: <?=$fila['viaje']->getIdUser()?></p></a>
        </div>
        <div class="borrar">
          <a href="borrarViaje_ADMIN.php?id=<?=$fila['viaje']->getId()?>"><img id="basura" src="/logos_proyecto/basura.png" alt=""></a>
        </div>
      </div>
    <?php } ?>
  </div>
<div>
