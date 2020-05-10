<?php

$contador = 0;
$etiquetas = [];

//$datosUser = ViajesManager::getInfoUsers($_GET['id_user'])[0];
//$datosViaje = ViajesManager::getViajeUsers($_GET['id_user']);
$datosUser = UsuarioManager::getBy($_GET['id_user']);
$datosViaje = ViajeManager::getByUser($datosUser->getId());
$rutaImgProfile = (explode('.',$datosUser->getFoto())[0] == 'profileDefault'? $datosUser->getFoto():$datosUser->getId().'/'.$datosUser->getFoto());
//$numDatos = count($datosUser);

for ($i = 0; $i < count($datosViaje); $i++) {
  $etiquetas[$i] = explode('/', $datosViaje[$i]['viaje']->getEtiquetas());
}

/*
echo "<pre>";
print_r($datosUser);
print_r($datosViaje);
print_r($etiquetas);
echo "</pre>";
*/

?>
<link rel="stylesheet" href="/css/perfilPublico.css">

<div class="perfilPublico">

  <div class="imagen">
    <h1>Todos los destinos al alcance de tu mano</h1>
  </div>

  <div class='contenedorGlobal'>
    <div class="datosUser">
      <h2><?=$datosUser->getNombre()?></h2>
      <img src="imgs/<?=$rutaImgProfile?>" alt="">
      <p><?=$datosUser->getDescripcion()?></p>
      <p><?=$datosUser->getPais()?></p>
      <p>Media Global: <?=$datosUser->getMedia()?></p>
    </div>
    
    <div class="contenedor">
      <h2>Sus viajes: </h2>

      <?php foreach ($datosViaje as $fila) { ?>
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
          </div>
        <?php } ?>
  
    </div>
  </div>

  
</div>
