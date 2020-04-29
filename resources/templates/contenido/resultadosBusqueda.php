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
<link rel="stylesheet" href="/css/inicio.css">
<script type="text/javascript" src="JS/sugerencias.js"></script>
<script type="text/javascript" src="JS/buscador.js"></script>
<div class="pu">
  <a href="#">
    <img src="imgs/p/publi_1.jpg" alt="">
  </a>
</div>
<div class="fondo">
   <!-- <div class="resultadosBusqueda"> -->
      <div class="inicio">
         <form method="post" action="resultadosBusqueda.php">
            <select id="filtro" name="filtro">
               <option disabled selected value="">Elige una opción</option>
               <?php for ($i= 0; $i < count($filtrosBusqueda); $i++) {?>
               <option value="<?=$filtrosValue[$i]?>" <?=($filtro == $filtrosValue[$i])?'selected':''?>><?=$filtrosBusqueda[$i]?></option>
               <?php } ?>
            </select>
            <input id="buscador" type="text" name='buscador' value="<?=$buscador?>" placeholder="    ¿Qué quieres buscar?">
            <select id="buscadorEtiquetas" name="buscador" class="oculto">
              <option disabled selected>Elige una opción</option>
              <?php for ($i= 0; $i < count($etiquetasSelect); $i++) {?>
                <option value="<?=$etiquetasSelect[$i]?>"><?=$etiquetasSelect[$i]?></option>
              <?php } ?>
            </select>

            <input type="submit" name='buscar' value='buscar'>

            <?php if( isset($errores['filtro']) && $errores['filtro'] == true) { ?>
               <br><span class="error">Debes selecionar un filtro</span>
            <?php } ?>
            <?php if( isset($errores['buscador']) && $errores['buscador'] == true) { ?>
               <br><span class="error">Debes escribir algo en la busqueda</span>
            <?php } ?>
         </form>

         <?php if( count($datos) == 0) { ?>
            <h1>Viaje no encontrado</h1>
         <?php  }else{ ?>
            <a href="aventura.php">Aventura</a>
            <h1>Resultados de busqueda</h1>

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
                      <img id='mejoresValorados' src="imgs/<?=$fila['viaje']->getIdUser().'/'.$fila['viaje']->getFoto()?>" alt="">
                     </a>
                     <div class="datos">
                        <p>Nº de Dias: <?=$fila['diasViaje']?></p>
                        <p>Precio: <?=$fila['viaje']->getPrecio()?> &euro;</p>
                        <p>Transporte: <?=$fila['viaje']->getTransporte()?></p>
                        <!-- <p>Media del viaje: <?=$fila['media']?></p> -->
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
         <?php } ?>
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
   <!-- </div> -->
</div>
<div class="pu">
  <a href="#">
    <img src="imgs/p/publi_1.jpg" alt="">
  </a>
</div>
