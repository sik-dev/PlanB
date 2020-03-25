<?php
session_start();

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

$viajes = ViajesManager::getAllViajes($id);

if($_POST>0 && $_POST['idViaje'] != ""){
  ViajesManager::deleteViaje([$id, $_POST['idViaje']]);
  header("Location: eliminarViaje.php?id=$id");
  die();
}

?>

<div class="inicio">
  <div class="mejorValorados">
    <?php foreach ($viajes as $viaje) { ?>
      <div class="viaje">
        <h2><?=$viaje['ciudad_destino']?></h2>
        <a href="viaje.php?id=<?=$viaje['id']?>">
          <img id='mejoresValorados' src="imgs/<?=$viaje['id_user']."/".$viaje['foto']?>" alt="">
        </a>

        <form action="eliminarViaje.php?id=<?=$id?>" method="post">
          <input type="text" name="idViaje" value="<?= $viaje['id']?>" hidden>
          <button type="submit">Eliminar Viaje</button>
        </form>

      </div>
    <?php } ?>
  </div>
</div>