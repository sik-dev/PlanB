<?php
  $num_viajes = 6;
  $page = 1;

  $filtrosBusqueda = ['País', 'Ciudad', 'Número de días'];
  $filtrosValue= ['viaje.pais_destino', 'viaje.ciudad_destino', 'diasViaje'];

  $filtro = '';
  $buscador = '';
  $errores = [];

  if( count($_POST) > 0) {
    if( isset($_POST['filtro']) && $_POST['filtro'] != ''){
      $filtro = clear_input($_POST['filtro']);
    }else{
      $errores['filtro'] = true;
    }

    if( isset($_POST['buscador']) && $_POST['buscador'] != ''){
      $buscador = clear_input($_POST['buscador']);
    }else{
      $errores['buscador'] = true;
    }

    if( count($errores) == 0){
      header("Location: resultadosBusqueda.php?filtro=$filtro&buscador=$buscador");
      die();
    }
  }

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
<script type="text/javascript" src="JS/sugerencias.js"></script>
<link rel="stylesheet" href="/css/inicio.css">
<div class="inicio">
  <form method="post" action="inicio.php">
    <select name="filtro">
      <option disabled selected value="">Elige una opción</option>
      <?php for ($i= 0; $i < count($filtrosBusqueda); $i++) {?>
            <option value="<?=$filtrosValue[$i]?>" <?=($filtro == $filtrosValue[$i])?'selected':''?>><?=$filtrosBusqueda[$i]?></option>
      <?php } ?>
    </select>
    <input type="text" name='buscador' value="<?=$buscador?>" placeholder="    ¿Qué quieres buscar?">
    <input type="submit" name='buscar' value='buscar'>
    <?php if( isset($errores['filtro']) && $errores['filtro'] == true) { ?>
    <br><span class="error">Debes selecionar un filtro</span>
    <?php } ?>
    <?php if( isset($errores['buscador']) && $errores['buscador'] == true) { ?>
    <br><span class="error">Debes escribir algo en la busqueda</span>
    <?php } ?>
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
        <a href="TestAllViajes.php?page=<?=$pagina?>"><?=$pagina?></a>
    <?php }?>
  </div>
</div>
