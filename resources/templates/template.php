<?php
/*
Template base del proyecto para no repetir código
Son necesarias las variables
  $ruta_contenido
*/
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=$titulo?></title>
    <!-- <link rel="shortcut icon" href="<?php //"$ROOT/public/logos_proyecto/logo1.png"?>" type="image/png" /> -->
    <!--<link rel="stylesheet" href="/css/pure.css">-->
    <script type="text/javascript" src="JS/sugerencias.js"></script>
  </head>
  <body>
    <?php
        require("$ROOT/resources/templates/header.php");
        require("$ROOT/resources/templates/contenido$ruta_contenido");
        require("$ROOT/resources/templates/footer.php");
     ?>
  </body>
</html>
