<?php
  //print_r($_POST);
  //print_r($_GET);

  $filtrosBusqueda = ['País', 'Ciudad', 'Número de días'];
  $filtrosValue= ['viaje.pais_destino', 'viaje.ciudad_destino', 'diasViaje'];

  $filtro = '';
  $buscador = '';
  $errores = [];

  if( count($_GET) > 0){
    if ( isset($_GET['filtro'])) {
      $filtro = clear_input($_GET['filtro']);
    }
    if ( isset($_GET['buscador'])) {
      $buscador = clear_input($_GET['buscador']);
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

  $datos = ViajeManager::getWhere($filtro, $buscador);

/*   if ( $filtro == 'viaje.pais_destino'){
    $datos = ViajesManager::getViajesWherePais('%'.$buscador.'%');
  }elseif ($filtro == 'viaje.ciudad_destino') {
    $datos = ViajesManager::getViajesWhereCiudad('%'.$buscador.'%');
  }elseif ($filtro == 'numDias') {
    $datos = ViajesManager::getViajesNumDias($buscador);
  } */
  /* print_r('<pre>');
  print_r($datos);
  print_r('</pre>'); */

?>
<link rel="stylesheet" href="/css/resultadosBusqueda.css">
<div class="fondo">
   <div class="resultadosBusqueda">
      <div class="inicio">
         <form method="post" action="resultadosBusqueda.php">
            <select class="" name="filtro">
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

         <?php if( count($datos) == 0) { ?>
            <h1>Viaje no encontrado</h1>
         <?php  }else{ ?>
            <a href="aventura.php">Aventura</a>
            <h1>Mejores Valorados</h1>

            <div class="mejorValorados">
               <?php foreach ($datos as $fila) { ?>
                  <div class="viaje">
                     <h2><?=$fila['viaje']->getCiudadDestino()?></h2>
                     <h4><?=$fila['viaje']->getDescripcion()?></h4>
                     <a href="viaje.php?id=<?=$fila['viaje']->getId()?>">
                      <img id='mejoresValorados' src="imgs/<?=$fila['viaje']->getIdUser().'/'.$fila['viaje']->getFoto()?>" alt="">
                     </a>
                     <div class="datos">
                        <p>Precio: <?=$fila['viaje']->getPrecio()?></p>
                        <p>Nº de Dias: <?=$fila['diasViaje']?></p>
                        <p>Puntuación: <?=$fila['media']?></p>
                        <p>Transporte: <?=$fila['viaje']->getTransporte()?></p>
                        <!-- <p>Media del viaje: <?=$fila['media']?></p> -->
                     </div>
                  </div>
               <?php } ?>
            </div>
         <?php } ?>
      </div>
   </div>
</div>
