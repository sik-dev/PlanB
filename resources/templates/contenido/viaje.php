<?php
  /* global $ROOT; */
  $comentario = '';
  $dibujaEstrella = false;

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

/*   print_r('<pre>');
  print_r($viajeFavorito);
  print_r($id);
  print_r('</pre>'); */

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
    <?php if ($_SESSION['autentificado'] == 1){ ?>
      <div id='estrella'>
          <img class="favoritos" src="logos_proyecto/star_vacia.png">
      </div>
    <?php } ?>
    <h1>Destino: <?=$datos['viaje']->getCiudadDestino()?></h1>
    <h2>País: <?=$datos['viaje']->getPaisDestino()?></h2>
    <h4>Origen: <?=$datos['viaje']->getCiudadOrigen()?></h4>
    <h4><?=$datos['viaje']->getDescripcion()?></h4>
    <img src="imgs/<?=$datos['viaje']->getIdUser().'/'.$datos['viaje']->getFoto()?>">
    <div class="datos">
      <p>Precio: <?=$datos['viaje']->getPrecio()?>&euro;</p>
      <p>Nº de Dias: <?=count($datosItinerario)?></p>
      <p>Puntuación: <?=$datos['media']?></p>
      <p>Transporte: <?=$datos['viaje']->getTransporte()?></p>
      <p>Publicado por:
        <a href="perfilPublico.php?id_user=<?=$datos['viaje']->getIdUser()?>">
          <img class="fotoSmall"src="imgs/<?=$datosPerfil->getId().'/'.$datosPerfil->getFoto()?>" data-idUserViaje="<?=$datos['viaje']->getIdUser()?>">
        </a>
      </p>
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
    <?php if(isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true) { ?>
      <form>
        <textarea name="comentario" rows="8" cols="80" placeholder="Añade un comentario"></textarea>
        <br>
        <input type="text" name="id_viaje" value="<?=$id?>" hidden>
        <button>Enviar</button>
      </form>
    <?php } ?>
  </div>
  <?php }else{ ?>
    <div class="noEncontrado">
      <h1>Viaje no encontrado</h1>
    </div>
  <?php }?>
</div>

<script type="text/javascript" src="JS/viaje.js">
  app.iniciar();
</script>
