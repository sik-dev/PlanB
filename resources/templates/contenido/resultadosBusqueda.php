<?php
  //print_r($_POST);
  //print_r($_GET);

  $filtrosBusqueda = ['País', 'Ciudad', 'Tipo de viaje'];
  $filtrosValue = ['viaje.pais_destino', 'viaje.ciudad_destino', 'etiquetas'];

  $etiquetasSelect = ['Aventura', 'Cultural', 'Romántico', 'Relax', 'Gastronómico', 'Con amig@s', 'LowCost', 'Fiesta', 'Religioso'];

  $filtro = '';
  $buscador = '';
  $errores = [];
  $etiquetas = [];
  $contador = 0;

  $num_viajes = 6;
  $page = 1;

  if( count($_GET) > 0){
    if ( isset($_GET['filtro'])) {
      $filtro = clear_input($_GET['filtro']);
    }
    if ( isset($_GET['buscador'])) {
      $buscador = clear_input($_GET['buscador']);
    }
    if (isset($_GET['page']) && ($_GET['page']) != '') {
      $page = $_GET['page'];
    }
  }

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
  }

  //Por si en numero de dias meten una cadena, entonces seria 0
  if( isset($filtro) && $filtro == 'diasViaje' &&
      isset($buscador) && !is_numeric($buscador)
    ){
    $buscador = 0;
  }

  if(count($errores) == 0){
      $offset = ($page - 1) * $num_viajes;
      $datos = ViajeManager::getWhere($filtro, $buscador, $offset, $num_viajes);
  }


  //Convertir cadena de etiquetas a un Array
  for ($i = 0; $i < count($datos); $i++) {
    $etiquetas[$i] = explode('/', $datos[$i]['viaje']->getEtiquetas());
  }

  if (is_int(count($datos) / $num_viajes)) {
    $num_paginas = count($datos) / $num_viajes;
  }else{
    $num_paginas = (int) (count($datos) / $num_viajes) + 1;
  }

  /*
  print_r('<pre>');
  print_r($datos);
  print_r('</pre>');
  print_r($filtro);
  print_r($buscador);
  */

?>
<link rel="stylesheet" href="/css/resultadosBusqueda.css">
<script type="text/javascript" src="JS/sugerencias.js"></script>
<script type="text/javascript" src="JS/buscador.js"></script>


<div class="inicio">

  <div class="imagen">
    <h1>Todos los destinos al alcance de tu mano</h1>
  </div>

  <form method="post" action="inicio.php">
    <div>
      <label for="filtro">Filtro</label>
      <select id="filtro" name="filtro">
        <option disabled selected value="">Elige una opción</option>
        <?php for ($i= 0; $i < count($filtrosBusqueda); $i++) {?>
          <option value="<?=$filtrosValue[$i]?>" <?=($filtro == $filtrosValue[$i])?'selected':''?>><?=$filtrosBusqueda[$i]?></option>
        <?php } ?>
      </select>
    </div>
    <div>
      <label for="buscador">Buscador</label>
      <input id="buscador" type="text" name='buscador' value="<?=$buscador?>" placeholder="    ¿Qué quieres buscar?">
      <select id="buscadorEtiquetas" name="buscador" class="oculto">
        <option disabled selected>Elige una opción</option>
        <?php for ($i= 0; $i < count($etiquetasSelect); $i++) {?>
          <option value="<?=$etiquetasSelect[$i]?>"><?=$etiquetasSelect[$i]?></option>
        <?php } ?>
      </select>
    </div>
    <div>
      <input id='buscar' type="submit" name='buscar' value='Buscar'>
      <button id='aventura'>
        <a href="aventura.php">Aventura</a>
      </button>
    </div>

    <div class='errores'>
      <?php if( isset($errores['filtro']) && $errores['filtro'] == true) { ?>
      <br><span class="error">Debes selecionar un filtro</span>
      <?php } ?>

      <?php if( isset($errores['buscador']) && $errores['buscador'] == true) { ?>
      <br><span class="error">Debes escribir algo en la busqueda</span>
      <?php } ?>
    </div>

  </form>


  <div class="mejorValorados">
    <?php if( count($datos) == 0) { ?>
        <h2>Viaje no encontrado</h2>
    <?php  }else{ ?>
        <h2>Resultados de busqueda</h2>

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
          </div>
        <?php } ?>


    <?php  } ?>
  
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
