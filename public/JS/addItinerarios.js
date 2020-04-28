const insertItinerario = (function () {
  'use strict';

  const URL_ITINERARIO = '/AJAX-itinerario.php';
  document.addEventListener('DOMContentLoaded', main);

  function main() {
    /* const itinerario = document.getElementsByClassName('itinerario'); */
    const botonModificar = document.getElementById('modificar');
    if (botonModificar) {
      botonModificar.addEventListener('click', function (e) {
        const divItinerario = document.getElementsByClassName('itinerario')[0];
        mostrarBotones(divItinerario);
      });
    }
  }

  function mostrarBotones(divItinerario) {
    if(!document.getElementById('agregarItinerario')){
      const h2 = divItinerario.querySelector('h2');
      const boton = document.createElement('button');
      const text = document.createTextNode('+');

      boton.appendChild(text);
      boton.id = 'agregarItinerario';
      boton.style.float = 'right';
      boton.addEventListener('click', mostrarFormItinerario);
      h2.appendChild(boton);
    }
    
  }

  function mostrarFormItinerario(e) {
    /* console.log(e.target); */
    const divFormItinerario = document.getElementsByClassName('insertItinerario')[0];
    divFormItinerario.classList.remove('desaparecer');
    const divItinerario = divFormItinerario.nextElementSibling;
    const botones = divFormItinerario.querySelectorAll('button');
    const botonAñadir = botones[0];
    const botonCancelar = botones[1];

    if (divItinerario) {
      divItinerario.classList.add('desaparecer');
    }

    botonAñadir.addEventListener('click', function (e) {
      e.preventDefault();
      /* const imgs = document.querySelector("[type='file']");
      const alojamiento = document.getElementById('alojamiento').value;
      const local = document.getElementById('local').value;
      const manana = document.getElementById('manana').value;
      const tarde = document.getElementById('tarde').value;
      const noche = document.getElementById('noche').value; */

      /* const Itinerario = {
        'imgs': document.querySelector("[type='file']").files,
        'alojamiento' : document.getElementById('alojamiento').value,
        'local' : document.getElementById('local').value,
        'manana' : document.getElementById('manana').value,
        'tarde' : document.getElementById('tarde').value,
        'noche' : document.getElementById('noche').value
      }; */
      /* const imgs = document.querySelector("[type='file']");
      const Itinerario = [
        document.querySelector("[type='file']").files,
        document.getElementById('alojamiento').value,
        document.getElementById('local').value,
        document.getElementById('manana').value,
        document.getElementById('tarde').value,
        document.getElementById('noche').value
      ]; */
      /* console.dir(imgs);
      console.log(e.target.parentNode); */
      /* 'itinerario=' + Itinerario */
      pedirJSON(URL_ITINERARIO, exito, new FormData(e.target.parentNode));
      /* console.dir(imgs.files);
      console.log(alojamiento);
      console.log(local);
      console.log(manana);
      console.log(tarde);
      console.log(noche); */
      /* console.dir(imgs); */
    });

    botonCancelar.addEventListener('click', function (e) {
      e.preventDefault();
    });
  }

  function exito(datos) {
    console.log('funciona');
  }
  /* function llenarItinerario(datos) {
    console.log(datos);
  } */

  function pedirJSON(uri, exito, param){
    const xhr = new XMLHttpRequest();
    console.log(this);
    xhr.onload = function (){
      if (this.status === 200) {
        /* console.dir(this.responseText);
        console.dir(JSON.parse(this.responseText)); */
        /* datos = JSON.parse(this.responseText); */
        console.log(JSON.parse(this.responseText));
        /* exito(datos); */
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('POST', uri);
    xhr.send(param);
  }
  
  /* return {iniciar:main}; */
})();