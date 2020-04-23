const app = (function () {
  document.addEventListener('DOMContentLoaded', main);
  const itinerario = document.getElementsByClassName('itinerario');

  function main() {
    const URL_ITINERARIO = '/crearViaje_2.php?rellenar=true';
    /* const form = document.forms[0]; */
    /* const itinerario = document.getElementsByClassName('itinerario'); */
    const boton = document.querySelector("[name^='add']");
    pedirJSON(URL_ITINERARIO, llenarItinerario);

    boton.addEventListener('click', function (e) {
      e.preventDefault();
      addItinerario(/* itinerario */);
      /* pedirJSON(URL_ITINERARIO, llenarItinerario); */
    });
  }

  function addItinerario(/* itinerario */) {
    const newItinerario = itinerario[itinerario.length - 1].cloneNode(true);
    const numDia = itinerario.length + 1;
    /* console.log(newItinerario); */
    /* form.appendChild(newItinerario); */
    const h1 = newItinerario.getElementsByTagName('h1')[0];
    const inputs = newItinerario.getElementsByTagName('input');
    const texareas = newItinerario.getElementsByTagName('textarea');
    const file = inputs[0];
    const local = inputs[1];
    const manana = texareas[0];
    const tarde = texareas[1];
    const noche = texareas[2];

    h1.textContent = 'Dia '+ numDia;
    file.name = file.name + numDia;
    local.name = local.name + numDia;
    manana.name = manana.name + numDia;
    tarde.name = tarde.name + numDia;
    noche.name = noche.name + numDia;

    file.value = "";
    local.value = "";
    manana.value = "";
    tarde.value = "";
    noche.value = "";

    /* console.log(file.value);
    console.log(file.name); */

    itinerario[itinerario.length - 1].insertAdjacentElement('afterend', newItinerario);
  }

  function llenarItinerario(datos) {
    console.log(datos);
  }

  function pedirJSON(uri, exito){
    const xhr = new XMLHttpRequest();

    xhr.onload = function (){
      if (this.status === 200) {
        console.log(this.responseText);
        (this.responseText == '')?exito(this.responseText):exito(JSON.parse(this.responseText));
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('GET', uri);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.send();
  }
  
  /* return {iniciar:main}; */
})();