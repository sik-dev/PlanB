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
    <title><?=$titulo?></title>
    <link rel="icon" href="/logos_proyecto/logo.ico">
    <!-- <link rel="shortcut icon" href="<?php //"$ROOT/public/logos_proyecto/logo1.png"?>" type="image/png" /> -->
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
