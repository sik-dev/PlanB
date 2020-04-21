const app = (function () {
  document.addEventListener('DOMContentLoaded', main);

  function main() {
    const form = document.forms[0];
    const itinerario = document.getElementsByClassName('itinerario');
    const boton = document.querySelector("[name^='add']");

    boton.addEventListener('click', function (e) {
      e.preventDefault();
      addItinerario(itinerario, form);
    });
  }

  function addItinerario(itinerario, form) {
    const newItinerario = itinerario[itinerario.length - 1].cloneNode(true);
    /* console.log(newItinerario); */
    /* form.appendChild(newItinerario); */
    const h1 = newItinerario.getElementsByTagName('h1')[0];
    h1.textContent = 'Dia '+ (itinerario.length+1);
    itinerario[itinerario.length - 1].insertAdjacentElement('afterend', newItinerario);
  }
  
  /* return {iniciar:main}; */
})();