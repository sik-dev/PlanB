const app_inicio = (function () {
  document.addEventListener('DOMContentLoaded', main);

  function main() {
    eventosFormulario();
  }
  function eventosFormulario(){
    const filtro = document.querySelector('#filtro');
    const buscador = document.querySelector('#buscador');
    const buscadorEtiquetas = document.querySelector('#buscadorEtiquetas');

    filtro.addEventListener('click', cambiaBuscador);

  }
  function cambiaBuscador(e){
    const element = e.target;
    const etiquetas = ['Aventura', 'Cultural', 'Romántico', 'Relax', 'Gastronómico', 'Con amig@s', 'LowCost', 'Fiesta', 'Religioso'];

    switch (element.value) {
      case 'viaje.pais_destino':
          buscador.classList.remove('oculto');
          buscadorEtiquetas.classList.add('oculto');
          buscador.type = 'text';
          buscador.placeholder = "    Escribe un país de destino";
        break;
      case 'viaje.ciudad_destino':
          buscador.classList.remove('oculto');
          buscadorEtiquetas.classList.add('oculto');
          buscador.type = 'text';
          buscador.placeholder = "    Escribe una ciudad de destino";
        break;
      case 'diasViaje':
          buscador.classList.remove('oculto');
          buscadorEtiquetas.classList.add('oculto');
          buscador.type = 'number';
          buscador.placeholder = 'Escribe un número';
          buscador.min = '1';
        break;
      case 'etiquetas':
          buscador.classList.add('oculto');
          buscadorEtiquetas.classList.remove('oculto');

        break;
      default:
    }
  }

  /* return {iniciar:main}; */
})();
