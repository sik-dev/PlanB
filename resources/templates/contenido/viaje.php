<?php
  /* global $ROOT; */
  $comentario = '';
  $dibujaEstrella = false;
  $etiquetas = [];

  if ( isset($_GET['id']) ){
    $id = $_GET['id'];
    $viajeEnviado = true;
  }
/*
  if (isset($_POST['comentario']) && $_POST['comentario'] != null) {
    $comentario = $_POST['comentario'];
    $date = new DateTime('now');
    $dateCadena = $date->format('Y-m-d H:i:s');
    ComentarioManager::insert($comentario, $dateCadena, $_SESSION['id'], $id);
  }
  */

  //$datos = ViajesManager::getViajesID($id)[0];
  $datos = ViajeManager::getById($id);
  //$id_user = $datos['id_user'];
  //$datosPerfil = ViajesManager::getInfoUsers($datos['id_user'])[0];
  $datosPerfil = UsuarioManager::getBy($datos['viaje']->getIdUser());
  //$comentarios =  ViajesManager::getComentariosID($id);
  $comentarios = ComentarioManager::getBy($id);

  //$datosItinerario = ViajesManager::getItinerario($id);
  $datosItinerario = ItinerarioManager::getBy($id);
  $contador = 1;

  $viajeFavorito = FavoritosManager::getBy($_SESSION['id']);


  //Convertir cadena de etiquetas a un Array
  $etiquetas = explode('/', $datos['viaje']->getEtiquetas());

/*
  foreach ($viajeFavorito as $fila) {
    if ($fila->getIdViaje() == $id ) $agregaAFavorito = true;
  }

  */

?>
<link rel="stylesheet" href="/css/viaje.css">
<div class="contenedor">
  <?php if(count($datos) > 0) {?>
  <div class="datosUsuario">
    <div id='estrella'>
        <img class="favoritos" src="logos_proyecto/star_vacia.png">
    </div>
    <h1><?=$datos['viaje']->getCiudadDestino()?></h1>
    <div class="puntuacion">
      <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
    </div>
    <p>Puntuación: <span id="mediaViaje"><?=$datos['media']?><span></p>
    <h2>País: <?=$datos['viaje']->getPaisDestino()?></h2>
    <h4>Origen: <?=$datos['viaje']->getCiudadOrigen()?></h4>
    <h4><?=$datos['viaje']->getDescripcion()?></h4>
    <img src="imgs/<?=$datos['viaje']->getIdUser().'/'.$datos['viaje']->getFoto()?>">
    <div class="datos">
      <p>Precio: <?=$datos['viaje']->getPrecio()?>&euro;</p>
      <p>Nº de Dias: <?=count($datosItinerario)?></p>
      <p>Transporte: <?=$datos['viaje']->getTransporte()?></p>
      <p>Publicado por:
        <a href="perfilPublico.php?id_user=<?=$datos['viaje']->getIdUser()?>">
          <img class="fotoSmall"src="imgs/<?=$datosPerfil->getId().'/'.$datosPerfil->getFoto()?>" data-idUserViaje="<?=$datos['viaje']->getIdUser()?>">
        </a>
      </p>
      <div class="etiquetas">
        <p>Etiquetas del viaje:</p>
        <?php foreach ($etiquetas as $valor) {?>
          <span class="<?=($valor =='Con amig@s')?'Amigos':$valor?>" title="<?=$valor?>" alt='<?=$valor?>'></span>
        <?php } ?>
      </div>
      <br><br>
    </div>
  </div>
  <div class="itinerario">
    <h2>Itinerario</h2>
    <ul>
      <?php foreach ($datosItinerario as $fila){ ?>
        <li data-dia='<?=$contador?>'>
          <p>Día <?=$contador++?></p>
        </li>
      <?php } ?>
    </ul>
    <div id="itinerarioDias">
    </div>
  </div>
  <div class="comentarios">
    <h2>Comentarios</h2>
    <form>
      <textarea name="comentario" rows="8" cols="80" placeholder="Añade un comentario"></textarea>
      <br>
      <input type="text" name="id_viaje" value="<?=$id?>" hidden>
      <button>Enviar</button>
    </form>
  </div>
  <?php }else{ ?>
    <div class="noEncontrado">
      <h1>Viaje no encontrado</h1>
    </div>
  <?php }?>
  <div class="pu">
    <!-- <a href="inicio.php">
      <iframe src="publicidades.php" frameborder="1" scrolling="no"></iframe>
    </a> -->
    <a href="#">
      <img src="imgs/p/publi_2.jpg" alt="">
    </a>
  </div>
</div>

<script type="text/javascript" src="JS/viaje.js">
  app.iniciar();
</script>
