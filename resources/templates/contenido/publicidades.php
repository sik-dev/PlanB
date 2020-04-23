<?php
/* print_r($ROOT); */

?>

<!-- <link rel="stylesheet" href="/css/viaje.css"> -->

<!-- <div class="imgP">
  <img src="/imgs/publicidades/publi_1.jpg" alt="">
</div> -->

<script>

  document.addEventListener('DOMContentLoaded', publicidades);
  
  function publicidades(e){
    const div = document.createElement('div');
    const img = document.createElement('img');
    const link = document.createElement('link');
    /* const a = document.createElement('a'); */
    const header = document.getElementsByTagName('header')[0];
    const footer = document.getElementsByTagName('footer')[0];

    document.body.removeChild(header);
    document.body.removeChild(footer);

    link.rel = "stylesheet";
    link.href = "/css/viaje.css";
    document.head.appendChild(link);

    img.src = "imgs/p/publi_2.jpg";
    
    div.className = "imgP";
    div.appendChild(img);
    document.body.appendChild(div);
  }
  
</script>