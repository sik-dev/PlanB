<?php
  $num_viajes = 6;
  $page = 1;

  if (isset($_GET['page']) && ($_GET['page']) != '') {
    $page = $_GET['page'];
  }

  $offset = ($page - 1) * $num_viajes;
  $viajes = ViajeManager::getAllTest($offset, $num_viajes);
  $total_viajes = ViajeManager::getAll();
  /* echo "<pre>";
  print_r($viajes);
  echo "</pre>"; */

  if (is_int($total_viajes / $num_viajes)) {
    $num_paginas = $total_viajes / $num_viajes;
  }else{
    $num_paginas = (int) ($total_viajes / $num_viajes) + 1;
  }
  
?>
<link rel="stylesheet" href="/css/test.css">
<div class="inicio">
  <form action="inicio.php">
    <input type="text" placeholder="¿que quieres buscar?">
    <input type="submit" name='buscar' value='buscar'>
  </form>
  <a href="aventura.php">Aventura</a>
  <h1>Mejores Valorados</h1>

  <div class="mejorValorados">
    <?php foreach ($viajes as $fila) { ?>
      <div class="viaje">
        <h2><?=$fila['viaje']->getCiudadDestino()?></h2>
        <h4><?=$fila['viaje']->getDescripcion()?></h4>
        <a href="viaje.php?id=<?=$fila['viaje']->getId()?>">
        <img id='mejoresValorados' src="imgs/<?=$fila['viaje']->getIdUser()."/".$fila['viaje']->getFoto()?>" alt="">
        </a>
        <div class="datos">
          <p>Precio: <?=$fila['viaje']->getPrecio()?></p>
          <p>Transporte: <?=$fila['viaje']->getTransporte()?></p>
          <p>Media del viaje: <?=$fila['media']?></p>
          <p>Nº de dias: <?=$fila['diasViaje']?></p>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="paginacion">
    <?php for($pagina = 1;$pagina <= $num_paginas; $pagina++){?>
      <div>
        <a href="TestAllViajes.php?page=<?=$pagina?>"><?=$pagina?></a>
      </div>
    <?php }?>
  </div>
</div>
