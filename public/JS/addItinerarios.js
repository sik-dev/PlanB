const insertItinerario = (function () {
  'use strict';

  const URL_ITINERARIO = '/AJAX-itinerario.php';
  let idViaje;
  document.addEventListener('DOMContentLoaded', main);

  function main() {
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
    idViaje = divFormItinerario.querySelector("[name='idViaje']").value;

    if (divItinerario) {
      divItinerario.classList.add('desaparecer');
    }

    botonAñadir.addEventListener('click', function (e) {
      e.preventDefault();
      pedirJSON(URL_ITINERARIO, redireccionar, e.target.parentNode);
    });

    botonCancelar.addEventListener('click', function (e) {
      e.preventDefault();
      window.location.href = `viaje.php?id=${idViaje}`;
    });
  }

  function redireccionar(datos) {
    for (const key in datos) {
      if (!datos[key].toLowerCase().includes('error')) {
        window.location.href = `viaje.php?id=${idViaje}`;  
      }
    }
  }


  function pedirJSON(uri, exito, form){
    const xhr = new XMLHttpRequest();
    xhr.onload = function (){
      if (this.status === 200) {
        /* let datos = JSON.parse(this.responseText);
        if(datos){exito(datos, form)}  */ 
        exito(JSON.parse(this.responseText));
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('POST', uri);
    xhr.send(new FormData(form));
  }
  
  /* return {iniciar:main}; */
})();