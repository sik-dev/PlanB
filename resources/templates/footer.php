<link rel="stylesheet" href="/css/footer.css">
<footer>
  <div>
    <div>
      <p>PLAN B</p>
      <p>Red social de viajes</p>
    </div>

    <div class="enlaces">
      <p>Menú</p>

      <a href="inicio.php">Inicio</a>
      <?php if( isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true ){ ?>
        <a href="perfil.php" data-id=<?=$_SESSION['id']?> id="perfil">Perfil</a>
      <?php }elseif($uri != '/login.php'){ ?>
        <a href="login.php">Login</a></li>
      <?php }?>
      <a href="quienesSomos.php">¿Quienes somos?</a>
      <a href="TestAllViajes.php">Ver todos los viajes</a>
    </div>

    <div class="social">
      <p>Contacto</p>
      <p>
        <span></span>
        daw.planb@gmail.com
      </p>
      <a href="https://www.facebook.com/" target="_blank"></a>
      <a href="https://twitter.com/" target="_blank"></a>
      <a href="https://www.youtube.com/" target="_blank"></a>
      <a href="https://www.instagram.com/" target="_blank"></a>
    </div>
  </div>

  <div class='copyright'>
    <p>Todos los derechos reservados</p>
    <p>Copyright©2020</p>
  </div>

</footer>
