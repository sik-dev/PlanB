<?php
/*
Template base del proyecto para no repetir código
Son necesarias las variables
  $ruta_contenido
*/
?>


<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titulo?></title>
    <link rel="icon" href="/logos_proyecto/logo.ico">
    <!-- <link rel="shortcut icon" href="<?php //"$ROOT/public/logos_proyecto/logo1.png"?>" type="image/png" /> -->
    <!--<link rel="stylesheet" href="/css/pure.css">-->
    <script type="text/javascript" src="JS/scroll.js"></script>
  </head>
  <body>
    <?php
        require("$ROOT/resources/templates/header.php");
        require("$ROOT/resources/templates/contenido$ruta_contenido");
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
