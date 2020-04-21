<?php

  $filtrosBusqueda = ['País', 'Ciudad', 'Número de días'];
  $filtrosValue= ['viaje.pais_destino', 'viaje.ciudad_destino', 'diasViaje'];

  $filtro = '';
  $buscador = '';
  $errores = [];
  $etiquetas = [];
  $contador = 0;

  $num_viajes = 6;
  $page = 1;

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
  $datos = ViajeManager::getAllTest($offset, $num_viajes);
  $total_viajes = ViajeManager::getAll();
  /* $datos = ViajeManager::getViajes(); */


  //Convertir cadena de etiquetas a un Array
  for ($i = 0; $i < count($datos); $i++) {
    $etiquetas[$i] = explode('/', $datos[$i]['viaje']->getEtiquetas());
  }


  if (is_int($total_viajes / $num_viajes)) {
    $num_paginas = $total_viajes / $num_viajes;
  }else{
    $num_paginas = (int) ($total_viajes / $num_viajes) + 1;
  }

?>
<script type="text/javascript" src="JS/sugerencias.js"></script>
<link rel="stylesheet" href="/css/inicio.css">
<div class="pu">
  <!-- <a href="inicio.php">
    <iframe src="publicidades.php" frameborder="1" scrolling="no"></iframe>
  </a> -->
  <a href="#">
    <img src="imgs/p/publi_1.jpg" alt="">
  </a>
</div>
<div class="fondo">
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
        <?php foreach ($datos as $fila) { ?>
            <div class="viaje">
               <h2><?=$fila['viaje']->getCiudadDestino()?></h2>
               <div class="puntuacion">
                 <?php for($i=1; $i <= 5; $i++) { ?>
                   <?php if ($fila['media'] >= $i) { ?>
                     <span class='rellena'>☆</span>
                   <?php }else{ ?>
                     <span>☆</span>
                   <?php } ?>
                 <?php } ?>
               </div>
               <p>Media del viaje: <?=$fila['media']?></p>
               <br>

               <p><?=$fila['viaje']->getDescripcion()?></p>
               <a href="viaje.php?id=<?=$fila['viaje']->getId()?>">
                <img id='mejoresValorados' src="imgs/<?=$fila['viaje']->getIdUser()."/".$fila['viaje']->getFoto()?>" alt="">
               </a>
               <div class="datos">
                  <p>Nº de dias: <?=$fila['diasViaje']?></p>
                  <p>Precio: <?=$fila['viaje']->getPrecio()?>&euro;</p>
                  <p>Transporte: <?=$fila['viaje']->getTransporte()?></p>
               </div>
               <div class="etiquetas">
                 <?php foreach ($etiquetas[$contador] as $valor) {?>
                   <span class="<?=($valor =='Con amig@s')?'Amigos':$valor ?>" title="<?=$valor?>" alt='<?=$valor?>'></span>
                 <?php } ?>
               </div>
               <?php $contador++ ?>
            </div>
         <?php } ?>
      </div>
      <div class="paginacion">
        <?php for($pagina = 1;$pagina <= $num_paginas; $pagina++){?>
          <?php if($pagina == $page){?>
            <a href="inicio.php?page=<?=$pagina?>"><u><?=$pagina?></u></a>
          <?php }else{?>
            <a href="inicio.php?page=<?=$pagina?>"><?=$pagina?></a>
          <?php }?>
        <?php }?>
      </div>
   </div>
</div>
<div class="pu">
  <!-- <a href="inicio.php">
    <iframe src="publicidades.php" frameborder="1" scrolling="no"></iframe>
  </a> -->
  <a href="#">
    <img src="imgs/p/publi_8.jpg" alt="">
  </a>
</div>
