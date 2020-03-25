<?php
   if( $_SESSION['autentificado'] != true ) {
    header('Location: login.php');
    exit;
  }
  $datos = ViajeManager::getBy($_SESSION['id']);

?>
<link rel="stylesheet" href="/css/tusViajes.css">
<div class="inicio">
   <h1>Tus viajes</h1>
   <?php if( count($datos) > 0) { ?>
   <div class="mejorValorados">
     <?php foreach ($datos as $fila) { ?>
       <div class="viaje">
         <h2><?=$fila['viaje']->getCiudadDestino()?></h2>
         <h4><?=$fila['viaje']->getDescripcion()?></h4>
         <a href="viaje.php?id=<?=$fila['viaje']->getId()?>">
          <img id='mejoresValorados' src="imgs/<?=$fila['viaje']->getIdUser()."/".$fila['viaje']->getFoto()?>" alt="">
         </a>
         <div class="datos">
           <p>Precio: <?=$fila['viaje']->getPrecio()?></p>
           <p>Transporte: <?=$fila['viaje']->getTransporte()?></p>
           <a href="borrarViaje.php?id=<?=$fila['viaje']->getId()?>">Borrar viaje</a>
         </div>
       </div>
     <?php } ?>
   </div>
 <?php }else{ ?>
   <div class="tusViajes">
     <h2>Aún no has subido ningún viaje</h2>
     <br>
     <p>¿Quieres subir un viaje?</p>
     <a href="crearViaje_1.php?id=<?=$_SESSION['id']?>">Subir viaje</a>
   </div>
 <?php } ?>

</div>
