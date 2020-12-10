<?php
/*
Template base del proyecto para no repetir código
Son necesarias las variables
  $ruta_contenido
*/
if (!file_exists($main = "$ROOT/resources/templates/contenido$ruta_contenido")) {
  header("Location: page404.php");
  die();
}
?>


<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titulo?></title>
    <link rel="icon" href="/logos_proyecto/logo.ico">
    <script type="text/javascript" src="JS/scroll.js"></script>
  </head>
  <body>
    <?php
        require("$ROOT/resources/templates/header.php");
        require($main);
        require("$ROOT/resources/templates/footer.php");
     ?>

    <button class='scroll'>
        <svg class="icon" viewBox="0 0 16 16">
            <title>Flecha</title>
            <g stroke-width="1" stroke="currentColor">
                <polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="15.5,11.5 8,4 0.5,11.5 ">
                </polyline>
            </g>
        </svg>
    </button>
    
  </body>
</html>
