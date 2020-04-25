<?php

$comentario = '';
$dibujaEstrella = false;
$etiquetas = [];

/* print_r($id); */
if ( isset($_GET['id']) ){
  $id_viaje = $_GET['id'];
  $viajeEnviado = true;
}
/*
if (isset($_POST['comentario']) && $_POST['comentario'] != null) {
  $comentario = $_POST['comentario'];
  $date = new DateTime('now');
  $dateCadena = $date->format('Y-m-d H:i:s');
  ComentarioManager::insert($comentario, $dateCadena, $_SESSION['id'], $id_viaje);
}
*/

$datos = ViajeManager::getById($id_viaje);
$datosPerfil = UsuarioManager::getBy($datos['viaje']->getIdUser());
$datosItinerario = ItinerarioManager::getBy($id_viaje);
$comentarios = ComentarioManager::getBy($id_viaje);

$viajeFavorito = FavoritosManager::getBy($_SESSION['id']);
//Convertir cadena de etiquetas a un Array
$etiquetas = explode('/', $datos['viaje']->getEtiquetas());

$contador = 1;
/*
foreach ($viajeFavorito as $fila) {
  if ($fila->getIdViaje() == $id_viaje ) $agregaAFavorito = true;
}

*/
/* $idsIguales = ($id === $datos['viaje']->getIdUser());
print_r(!$idsIguales); */
?>
<link rel="stylesheet" href="/css/viaje.css">
<?php if ($id === $datos['viaje']->getIdUser()) {?>
  <button id="modificar">Modificar Viaje</button>
<?php }?>
<div class="contenedor">
  <?php if(count($datos) > 0) {?>
  <div class="datosUsuario">
    <?php if ($_SESSION['autentificado'] == 1){ ?>
      <div id='estrella'>
          <img class="favoritos" src="logos_proyecto/star_vacia.png">
      </div>
    <?php } ?>
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
      <?php //if ($id !== $datos['viaje']->getIdUser()) {?>
        <p>Publicado por:
          <a href="perfilPublico.php?id_user=<?=$datos['viaje']->getIdUser()?>">
            <img class="fotoSmall"src="imgs/<?=$datosPerfil->getId().'/'.$datosPerfil->getFoto()?>" data-idUserViaje="<?=$datos['viaje']->getIdUser()?>">
          </a>
        </p>
      <?php //}?>
      
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
    <h2>Itinerario<!-- <button>+</button> --></h2>
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
        <input type="text" name="id_viaje" value="<?=$id_viaje?>" hidden>
        <button>Enviar</button>
      </form>
    <?php } ?>
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
