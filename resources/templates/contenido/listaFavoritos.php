<?php
  if( $_SESSION['autentificado'] != true ){
    header('Location: login.php');
    exit;
  }

  //$listaFavoritos = ViajesManager::getFavoritoWhereUser($_SESSION['id']);
  $listaFavorito = FavoritosManager::getBy($_SESSION['id']);
/*   print_r($listaFavorito);
  print_r('<br>'); */

  $favoritos = array_map(function($lista){
    return ViajeManager::getById($lista->getIdViaje());
  }, $listaFavorito);

/*   print_r('<pre>');
  print_r($favoritos);
  print_r('</pre>'); */
/*   for ($i=0; $i < count($listaFavoritos); $i++) {
    $favoritos[$i] = ViajesManager::getViajesID($listaFavoritos[$i]['id_viaje'])[0];
  }

  for ($j=0; $j < count($favoritos); $j++) {
    $favoritos[$j]['id_user'] = ViajesManager::getInfoUsers($favoritos[$j]['id_user'])[0];
  } */

  
/*   echo "<pre>";
  print_r($favoritos);
  echo "</pre>"; */
 
?>
<link rel="stylesheet" href="/css/listaFavoritos.css">
<div class="listaFavoritos">
  <?php if($favoritos == null) { ?>
    <h1 id='noViajes'>Todavía no tienes ningún viaje en favoritos</h1>
  <?php }else{ ?>
    <h1>Mis Viajes Favoritos:</h1>
    <div class="contenedor">
    <?php foreach ($favoritos as $fila) { ?>
      <div class="viaje">
      <h2>País: <?=$fila['viaje']->getPaisDestino()?></h2>
      <h2>Destino: <?=$fila['viaje']->getCiudadDestino()?></h2>
      <h4>Origen: <?=$fila['viaje']->getCiudadOrigen()?></h4>
      <h4><?=$fila['viaje']->getDescripcion()?></h4>
      <a href="viaje.php?id=<?=$fila['viaje']->getId()?>">
        <img src="imgs/<?=$fila['viaje']->getIdUser().'/'.$fila['viaje']->getFoto()?>" alt="">
      </a>
      <div class="datos">
        <p>Precio: <?=$fila['viaje']->getPrecio()?></p>
        <p>Transporte: <?=$fila['viaje']->getTransporte()?></p>
        <p>Publicado por: 
          <a href="perfilPublico.php?id_user=<?=$fila['viaje']->getIdUser()?>">
            <?=UsuarioManager::getNombre($fila['viaje']->getIdUser())?>
          </a>
        </p>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php }?>
</div>
