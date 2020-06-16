<?php

  //si no esta autentificado le mando al login
  if( $_SESSION['autentificado'] != true ){
    header('Location: login.php');
    exit;
  }

  $user = UsuarioManager::getBy($_SESSION['id']);
  $rutaImgProfile = (explode('.', $user->getFoto())[0] == 'profileDefault'? $user->getFoto():$user->getId().'/'.$user->getFoto());
/*   print_r('<pre>');
  print_r($user);
  print_r('</pre>'); */
?>
<link rel="stylesheet" href="/css/perfil.css">
<div class="perfil">

  <div class="imagen">
    <h1>Todos los destinos al alcance de tu mano</h1>
  </div>

  <div>
    <h2><?=$user->getNombre()?></h2>
    <img id=fotoPerfil src="imgs/<?=$rutaImgProfile?>" alt="">
    <p><?=$user->getEmail()?></p>
    <p><?=$user->getPais()?></p>
    <p id='descripcion'><?=$user->getDescripcion()?></p>
    <p>Media Global: <?=$user->getMedia()?></p>
    <div class='botones'>
      <a href="crearViaje_1.php?id=<?=$user->getId()?>">Subir viaje</a>
      <a href="tusViajes.php?id=<?=$user->getId()?>">Mis viajes</a>
      <a href="editarPerfil.php?id=<?=$user->getId()?>">Editar perfil</a>
    </div>

  </div>
</div>