const insertItinerario = (function () {
  const URL_ITINERARIO = '/AJAX-itinerario.php';
  document.addEventListener('DOMContentLoaded', main);
  
  /* const URL_ITINERARIO = '/crearViaje_2.php?rellenar=true'; */

  function main() {
    const itinerario = document.getElementsByClassName('itinerario');
    const botonModificar = document.getElementById('modificar');
    if (botonModificar) {
      botonModificar.addEventListener('click', function (e) {
        const divItinerario = document.getElementsByClassName('itinerario')[0];
        /* const divItinerario = document.getElementsByClassName('itinerario')[0]; */
        /* console.log(e.target); */
        mostrarBotones(divItinerario);
      });
    }
  }

  function mostrarBotones(divItinerario) {
    /* console.log(divItinerario.querySelector('h2')); */
    if(!document.getElementById('agregarItinerario')){
      const h2 = divItinerario.querySelector('h2');
      const boton = document.createElement('button');
      const text = document.createTextNode('+');

      boton.appendChild(text);
      boton.id = 'agregarItinerario';
      boton.style.float = 'right';
      boton.addEventListener('click', function(e){ mostrarFormItinerario(e) });
      h2.appendChild(boton);
    }
  }

  function mostrarFormItinerario(e) {
    const divFormItinerario = document.getElementsByClassName('insertViaje')[0];
    divFormItinerario.classList.remove('desaparecer');
    const botones = divFormItinerario.querySelectorAll('button');
    const botonAñadir = botones[0];
    const botonCancelar = botones[1];
    const divItinerario = divFormItinerario.nextElementSibling;

    if (divItinerario) {
      divItinerario.classList.add('desaparecer');
    }
    /* divFormItinerario.nextElementSibling.classList.add('desaparecer'); */
    /* console.log(divFormItinerario.nextElementSibling.id); */

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
      const imgs = document.querySelector("[type='file']");
      const Itinerario = [
        document.querySelector("[type='file']").files,
        document.getElementById('alojamiento').value,
        document.getElementById('local').value,
        document.getElementById('manana').value,
        document.getElementById('tarde').value,
        document.getElementById('noche').value
      ];
      console.dir(imgs);

      pedirJSON(URL_ITINERARIO, exito, 'itinerario=' + Itinerario);
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

  function exito() {
    console.log('funciona');
  }
  /* function llenarItinerario(datos) {
    console.log(datos);
  } */

  function pedirJSON(uri, exito, param){
    const xhr = new XMLHttpRequest();

    xhr.onload = function (){
      if (this.status === 200) {
        console.dir(this.responseText);
        console.dir(JSON.parse(this.responseText));
        /* (this.responseText == '')?exito(this.responseText):exito(JSON.parse(this.responseText)); */
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('POST', uri);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(param);
  }
  
  /* return {iniciar:main}; */
})();