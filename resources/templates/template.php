<?php
/*

Template base del proyecto para no repetir código
Son necesarias las variables
  $titulo
  $ruta_contenido

*/
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=$titulo?></title>
    <link rel="shortcut icon" href="<?="$ROOT/public/logos_proyecto/fondo10.jpg"?>">
    <!--<link rel="stylesheet" href="/css/pure.css">-->
  </head>
  <body>
    <?php
        require("$ROOT/resources/templates/header.php");
        require("$ROOT/resources/templates/contenido$ruta_contenido");
        require("$ROOT/resources/templates/footer.php");
     ?>
  </body>
</html>
