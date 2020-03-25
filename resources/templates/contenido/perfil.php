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
<div class="fondoPerfil">
  <div class="perfil">
    <h1>Perfil Privado</h1>
    <br><br>
    <img id=fotoPerfil src="imgs/<?=$rutaImgProfile?>" alt="">
    <h2>Nombre: <?=$user->getNombre()?></h2>
    <h4>Email: <?=$user->getEmail()?></h4>
    <h4>País: <?=$user->getPais()?></h4>
    <h4>Descripción: <br><?=$user->getDescripcion()?> </h4>
    <h4>Media Global: <?=$user->getMedia()?></h4>
    <a href="crearViaje_1.php?id=<?=$user->getId()?>">nuevo viaje</a>
    <br>
    <a href="tusViajes.php?id=<?=$user->getId()?>">tus viajes</a>
    <br>
    <br>
    <a href="editarPerfil.php?id=<?=$user->getId()?>">Editar Perfil</a>

  </div>
<div>