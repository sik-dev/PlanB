<?php
  if( $_SESSION['autentificado'] != true ){
    header('Location: login.php');
    exit;
  }

  $contador = 0;
  $etiquetas = [];

  //$listaFavoritos = ViajesManager::getFavoritoWhereUser($_SESSION['id']);
  $listaFavorito = FavoritosManager::getBy($_SESSION['id']);
/*   print_r($listaFavorito);
  print_r('<br>'); */

  $favoritos = array_map(function($lista){
    return ViajeManager::getById($lista->getIdViaje());
  }, $listaFavorito);


  for ($i = 0; $i < count($favoritos); $i++) {
    $etiquetas[$i] = explode('/', $favoritos[$i]['viaje']->getEtiquetas());
  }

 
?>
<link rel="stylesheet" href="/css/listaFavoritos.css">

<div class="listaFavoritos"> 

  <div class="imagen">
    <h1>Todos los destinos al alcance de tu mano</h1>
  </div>

  <?php if($favoritos == null) { ?>
    <h2 id='noViajes'>Todavía no tienes ningún viaje en favoritos</h2>
  <?php }else{ ?>
    <h2>Mis Viajes Favoritos:</h2>

    <div class="contenedor">

      <?php foreach ($favoritos as $fila) { ?>
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

  <?php }?>

</div>
