<?php
/* print_r($ROOT); */

?>

<!-- <link rel="stylesheet" href="/css/viaje.css"> -->

<!-- <div class="imgP">
  <img src="/imgs/publicidades/publi_1.jpg" alt="">
</div> -->
<!-- <?=$ROOT?>/public/ -->
<script>

  document.addEventListener('DOMContentLoaded', del);
  
  function del(){
    const div = document.createElement('div');
    const img = document.createElement('img');
    const link = document.createElement('link');
    const header = document.getElementsByTagName('header')[0];
    const footer = document.getElementsByTagName('footer')[0];

    document.body.removeChild(header);
    document.body.removeChild(footer);

    link.rel = "stylesheet";
    link.href = "/css/viaje.css";
    document.head.appendChild(link);

    img.src = "imgs/publicidades/pu_6.jpg";
   /*  let source = img.src.split('/');
    console.log(source); */
    
    div.className = "imgP";
    div.appendChild(img);
    document.body.appendChild(div);
  }
  
</script>