<?php
   $datos = ViajeManager::getViajes();
   $aventura = $datos[mt_rand(0, count($datos)-1)];
/*    print_r('<pre>');
   print_r($aventura);
   print_r('</pre>'); */
?>
<link rel="stylesheet" href="/css/aventura.css">
<div class="mainAventura">
   <a href="viaje.php?id=<?=$aventura['viaje']->getId()?>">
    <img src="imgs/<?=$aventura['viaje']->getIdUser().'/'.$aventura['viaje']->getFoto()?>" alt="">
   </a>
   <div>
      <h3><?=$aventura['viaje']->getDescripcion()?></h3>
      <p>Nº de dias: <?=$aventura['diasViaje']?></p>
      <p>Precio: <?=$aventura['viaje']->getPrecio()?></p>
      <p>Transporte: <?=$aventura['viaje']->getTransporte()?></p>
      <p>Media del viaje: <?=$aventura['media']?></p>
   </div>
   <a id='a-aventura' href="aventura.php">Aventura</a>
</div>
