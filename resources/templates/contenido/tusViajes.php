<?php
   if( $_SESSION['autentificado'] != true ) {
    header('Location: login.php');
    exit;
  }
  $contador = 0;
  $etiquetas = [];

  $datos = ViajeManager::getBy($_SESSION['id']);


  for ($i = 0; $i < count($datos); $i++) {
    $etiquetas[$i] = explode('/', $datos[$i]['viaje']->getEtiquetas());
  }


?>
<link rel="stylesheet" href="/css/tusViajes.css">

<div class="tusViajes">

  <div class="imagen">
    <h1>Todos los destinos al alcance de tu mano</h1>
  </div>

  <?php if($datos == null) { ?>
    <div class="noViajes">
     <h2>Aún no has subido ningún viaje</h2>
     <br>
     <div>
      <p>¿Quieres subir un viaje?</p>
      <a href="crearViaje_1.php?id=<?=$_SESSION['id']?>">Subir viaje</a>
     </div>

    </div>
  <?php }else{ ?>
    <h2>Tus Viajes:</h2>

    <div class="contenedor">

      <?php foreach ($datos as $fila) { ?>
        <div class='tarjeta'>
          <a href="viaje.php?id=<?=$fila['viaje']->getId()?>">
            <div class="puntuacion">
              <?php for($i=1; $i <= 5; $i++) { ?>
                <?php if ($fila['media'] >= $i) { ?>
                  <span class='rellena'>☆</span>
                <?php }else{ ?>
                  <span>☆</span>
                <?php } ?>
              <?php } ?>
              <span><?=$fila['media']?></span>
            </div>
          
            <img src="imgs/<?=$fila['viaje']->getIdUser()."/".$fila['viaje']->getFoto()?>" alt="">
          
            <h3><?=$fila['viaje']->getCiudadDestino()?></h3>
            <div>
              <div class="datos">
                  <p><?=($fila['diasViaje'] > 1)?  $fila['diasViaje']." días" : $fila['diasViaje']." día" ?></p>
                  <p><?=$fila['viaje']->getPrecio()?> &euro;</p>
              </div>
              <div class="etiquetas">
                <?php foreach ($etiquetas[$contador] as $valor) {?>
                  <span class="<?=($valor =='Con amig@s')?'Amigos':$valor ?>" title="<?=$valor?>" alt='<?=$valor?>'></span>
                <?php } ?>
              </div>
              <?php $contador++ ?>
            </div>
          </a>
          <a href="borrarViaje.php?id_viaje=<?=$fila['viaje']->getId()?>&id_user=<?=$_SESSION['id']?>" alt="Borrar viaje" title='Borrar viaje'>
             <img id='basura' src="/logos_proyecto/basura.png" class="borrarViaje">
            </a>
        </div>
      <?php } ?>

    </div>

  <?php }?>
  
</div>
