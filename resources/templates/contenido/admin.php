<?php

  //OBTENER ID del USER
   if ( isset($_SESSION['id']) ){
     $id = intval($_SESSION['id']);
     $user = UsuarioManager::getBy($id);

     //SI es ADMIN
     if( isset($user) && $user->getRol() === 'ADMIN') {
       $rutaImgProfile = (explode('.', $user->getFoto())[0] == 'profileDefault'? $user->getFoto():$user->getId().'/'.$user->getFoto());

       $usuarios = UsuarioManager::getAll();
       $viajes = ViajeManager::getAllTestAdmin();

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
    <h2><?=$user->getNombre()?></h2>
    <h4><?=$user->getEmail()?></h4>
  </div>
  <h2 id="h2Usuarios">Usuarios</h2>
  <div class="usuarios">
    <table border="1px">
      <thead>
        <tr>
          <th>Foto</th>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Descripción</th>
          <th>País</th>
          <th>Media Global</th>
          <th>Rol</th>
          <th>Borrar Usuario</th>
        </tr>
      </thead>
      <tbody>
    <?php foreach ($usuarios as $fila) { ?>
      <tr>
        <td>
          <a href="/perfilPublico.php?id_user=<?=$fila['id']?>">
            <img id=fotoPerfilUser src="imgs/<?=$fila['id']?>/<?=$fila['foto']?>" alt="">
          </a>
        </td>
        <td><?=$fila['id']?></td>
        <td><?=$fila['nombre']?></td>
        <td><?=$fila['email']?></td>
        <td><?=$fila['descripcion']?></td>
        <td><?=$fila['pais']?></td>
        <td><?=$fila['mediaGlobal']?></td>
        <td><?=$fila['rol']?></td>
        <td>
          <a href="borrarUsuario_ADMIN.php?id=<?=$fila['id']?>"><img id="basura" src="/logos_proyecto/basura.png" alt="Borrar usuario"></a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
    </table>
  </div>
  <h2 id="h2Viajes">Viajes</h2>
  <div class="viajes">
    <table border="1px">
      <thead>
        <tr>
          <th>Foto</th>
          <th>ID</th>
          <th>Ciudad Destino</th>
          <th>Pais Destino</th>
          <th>Ciudad Origen</th>
          <th>Pais Origen</th>
          <th>Media Global</th>
          <th>Nº de días</th>
          <th>Transporte</th>
          <th>Usuario</th>
          <th>Borrar Viaje</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($viajes as $fila) { ?>
        <tr>
          <td>
            <a href="/viaje.php?id=<?=$fila['viaje']->getId()?>">
              <img id='fotoViaje' src="imgs/<?=$fila['viaje']->getIdUser()?>/<?=$fila['viaje']->getFoto()?>" alt="">
            </a>
          </td>
          <td><?=$fila['viaje']->getId()?></td>
          <td><?=$fila['viaje']->getCiudadDestino()?></td>
          <td><?=$fila['viaje']->getPaisDestino()?></td>
          <td><?=$fila['viaje']->getCiudadOrigen()?></td>
          <td><?=$fila['viaje']->getPaisOrigen()?></td>
          <td><?=$fila['media']?></td>
          <td><?=$fila['diasViaje']?></td>
          <td><?=$fila['viaje']->getTransporte()?></td>
          <td><?=$fila['viaje']->getIdUser()?></td>
          <td>
            <a href="borrarViaje_ADMIN.php?id=<?=$fila['viaje']->getId()?>"><img id="basura" src="/logos_proyecto/basura.png" alt="Borrar Viaje"></a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
<div>
