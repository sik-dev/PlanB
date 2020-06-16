const insertItinerario = (function () {
  'use strict';

  const URL_ITINERARIO = '/AJAX-modificarViaje.php';
  let idViaje;
  document.addEventListener('DOMContentLoaded', main);

  function main() 
  {
    const botonModificarViaje = document.getElementById('botonModificarViaje');
    const botonModificarItinerario = document.getElementById('modificarItinerario');

    if (botonModificarViaje) {
      botonModificarViaje.addEventListener('click', mostrarModalFormModificarViaje);
    }

    if (botonModificarItinerario) {
      botonModificarItinerario.addEventListener('click', mostrarBotonesItinerario);
    }
  }

  function mostrarModalFormModificarViaje(e) 
  {
    const divModificarViaje = document.createElement('div');
    const divForm = document.createElement('div');
    const form = document.createElement('form');
    const divEtiquetas = divForm.cloneNode();
    /* const divEtiqueta = divForm.cloneNode(); */
    const label = document.createElement('label');
    const textarea = document.createElement('textarea');
    const botonAceptar = document.createElement('button');
    const botonCancelar = document.createElement('button');
    const arraySrcFoto = document.getElementById('fotoViaje').src.split('/');
    const botonCerrar = document.createElement('img');
    botonCerrar.classList.add('btn-cerrar');
    botonCerrar.src = '../logos_proyecto/close.png';
    botonCerrar.addEventListener('click', cerrarModal);

    const inputsHidden = [
      'idViaje',
      'idUser',
      'fotoActual'
    ];

    const inputsValue = [
      location.href.slice(35, location.href.length),
      document.querySelector('.fotoSmall').dataset.iduserviaje,
      arraySrcFoto[arraySrcFoto.length - 1]
    ];

    inputsHidden.forEach((name, i) => {
      let input = document.createElement('input');
      input.type = 'text';
      input.name = name;
      input.setAttribute('value', inputsValue[i]);
      input.setAttribute('hidden', '');
      form.appendChild(input);
    });

    const inputs = [
      'foto', 
      'paisDestino', 
      'ciudadDestino', 
      'precio', 
      /* 'numDias',  */
      'transporte'
    ];

    const textLabel = [
      'Modifica tu foto principal', 
      'País:', 
      'Ciudad:', 
      'Precio:', 
      /* 'Numero de Días:',  */
      'Transporte:'
    ];

    inputs.forEach((name, i) => {
      let input = document.createElement('input');
      let label = document.createElement('label');

      input.type = 'text';
      input.id = name;
      input.name = name;
      if (name == 'foto')input.type = 'file';

      label.setAttribute('for', name);
      label.appendChild(document.createTextNode(textLabel[i]));
      
      form.appendChild(label);
      form.appendChild(input);
    });

    const etiquetas = [
      'Aventuras', 
      'Cultural', 
      'Religioso', 
      'Romántico', 
      'Con amig@s', 
      'Gastronómico', 
      'Relax', 
      'Fiesta', 
      'LowCost'
    ];

    etiquetas.forEach( etiqueta => {
      let input = document.createElement('input');
      let label = document.createElement('label');
      let divEtiqueta = document.createElement('div');

      input.id = etiqueta;
      input.type = 'checkbox';
      input.name = 'etiquetas[]';
      input.setAttribute('value', etiqueta);

      label.setAttribute('for', etiqueta);
      label.appendChild(document.createTextNode(etiqueta));

      divEtiqueta.appendChild(input);
      divEtiqueta.appendChild(label);
      divEtiqueta.classList.add('etiquetaCheckBox');

      divEtiquetas.appendChild(divEtiqueta);
    });

    const labelEtiqueta = label.cloneNode();
    labelEtiqueta.appendChild(document.createTextNode('Etiquetas'));
    divEtiquetas.classList.add('etiquetasCheckBox');

    label.setAttribute('for', 'descripcion');
    label.appendChild(document.createTextNode('Describe tu viaje:'));
    textarea.name = 'descripcion';
    textarea.id = 'descripcion';

    botonCancelar.appendChild(document.createTextNode('Cancelar'));
    botonAceptar.appendChild(document.createTextNode('Aceptar'));
    botonAceptar.addEventListener('click', updateViaje);

    form.action = location.href;
    form.method = "post";
    form.enctype = "multipart/form-data";
    form.appendChild(labelEtiqueta);
    form.appendChild(divEtiquetas);
    form.appendChild(label);
    form.appendChild(textarea);
    form.appendChild(botonAceptar);
    form.appendChild(botonCancelar);

    divForm.id = 'modificarViaje';
    divForm.appendChild(form);
    divForm.appendChild(botonCerrar);

    divModificarViaje.addEventListener('click', cerrarModal);
    divModificarViaje.appendChild(divForm);
    divModificarViaje.id = 'modalModificarViaje';

    document.body.appendChild(divModificarViaje);
  }

  function updateViaje(e) 
  {
    e.preventDefault();
    const URL_UPDATE_VIAJE = '/AJAX-updateViaje.php';

    formPedirJSON(URL_UPDATE_VIAJE, respuestaJSON, e.target.parentNode);
  }

  function mostrarBotonesItinerario(e) 
  {
    const textBotonModificar = e.target.textContent;
    if (textBotonModificar != 'Cancelar') e.target.textContent = 'Cancelar';
    if (textBotonModificar == 'Cancelar') e.target.textContent = 'Modificar Itinerario';

    const divItinerario = document.getElementsByClassName('itinerario')[0];
    if (!document.getElementsByClassName('botonesDia')[0]) {
      const diasItinerario = document.querySelectorAll('[data-dia]');
      let botonAjustes;
      let botonBorrar;
      let div;

      diasItinerario.forEach( li => {
        div = document.createElement('div');
        botonAjustes = document.createElement('img');
        botonBorrar = document.createElement('img');
        botonAjustes.src = '/logos_proyecto/ajustes.png';
        botonBorrar.src = '/logos_proyecto/basura.png';

        const ajustes = div.cloneNode();
        ajustes.appendChild(botonAjustes);
        const borrar = div.cloneNode();
        borrar.appendChild(botonBorrar);

        ajustes.addEventListener('click', mostrarModalFormItinerarioDia);
        borrar.addEventListener('click', borrarDia);

        div.classList.add('botonesDia');
        div.appendChild(ajustes);
        div.appendChild(borrar);
        li.lastElementChild.appendChild(div);
      });
    }else{
      const divsBotonesDia = document.querySelectorAll('.botonesDia');
      divsBotonesDia.forEach( div => {
        div.classList.toggle('desaparecer');
      });
    }

    if (!document.getElementById('agregarItinerario')) {
      const ulItinerario = divItinerario.querySelector('ul');
      const li = document.createElement('li');
      const boton = document.createElement('button');
      const text = document.createTextNode('Añadir itinerario');

      boton.appendChild(text);
      boton.id = 'agregarItinerario';
      boton.style.width = '100%';
      boton.style.height = '100%';
      boton.style.margin = '0';
      boton.style.border = 'none';
      boton.addEventListener('click', mostrarFormItinerario);
      li.appendChild(boton);
      ulItinerario.insertAdjacentElement('beforeend', li);
    }else{
      const liBotonAgregarItinerario = document.getElementById('agregarItinerario').parentElement;
      liBotonAgregarItinerario.classList.toggle('desaparecer');
    }
  }

  function mostrarModalFormItinerarioDia(e) {
    const idItinerario = e.target.parentNode.parentNode.parentNode.dataset['idItinerario'];
    const divModificarItinerario = document.createElement('div');
    const divForm = document.createElement('div');
    const form = document.createElement('form');
    const inputHiddenID = document.createElement('input');
    const botonAceptar = document.createElement('button');
    const botonCancelar = document.createElement('button');
    const botonCerrar = document.createElement('img');
    botonCerrar.classList.add('btn-cerrar');
    botonCerrar.src = '../logos_proyecto/close.png';
    botonCerrar.addEventListener('click', cerrarModal);
    
    const inputs = [
      'localizacion', 
      'alojamiento'
    ];

    const textLabelInput = [
      'Localización', 
      'Alojamiento'
    ];

    const textLabelTextArea = [
      'Mañana', 
      'Tarde', 
      'Noche'
    ];

    const textAreas = [
      'manana', 
      'tarde', 
      'noche'
    ];

    inputs.forEach((name, i) => {
      let input = document.createElement('input');
      let label = document.createElement('label');

      input.type = 'text';
      input.id = name;
      input.name = name;

      label.setAttribute('for', name);
      label.appendChild(document.createTextNode(textLabelInput[i]));
      
      form.appendChild(label);
      form.appendChild(input);
    });

    textAreas.forEach((name, i) => {
      let textarea = document.createElement('textarea');
      let label = document.createElement('label');

      textarea.id = name;
      textarea.name = name;

      label.setAttribute('for', name);
      label.appendChild(document.createTextNode(textLabelTextArea[i]));
      
      form.appendChild(label);
      form.appendChild(textarea);
    });

    inputHiddenID.type = 'text';
    inputHiddenID.name = 'idItinerario';
    inputHiddenID.setAttribute('value', idItinerario);
    inputHiddenID.setAttribute('hidden', '');

    botonCancelar.appendChild(document.createTextNode('Cancelar'));
    botonAceptar.appendChild(document.createTextNode('Aceptar'));
    botonAceptar.addEventListener('click', updateDia);

    form.action = location.href;
    form.method = "post";
    form.enctype = "multipart/form-data";
    form.appendChild(inputHiddenID);
    form.appendChild(botonAceptar);
    form.appendChild(botonCancelar);

    divForm.id = 'modificarItinerarioDia';
    divForm.appendChild(form);
    divForm.appendChild(botonCerrar);

    divModificarItinerario.addEventListener('click', cerrarModal);
    divModificarItinerario.appendChild(divForm);
    divModificarItinerario.id = 'modalModificarItinerario';

    document.body.appendChild(divModificarItinerario);
  }

  function updateDia(e) 
  {
    e.preventDefault();
    const URL_MODIFICAR_ITINERARIO = '/AJAX-modificarItinerario.php';

    formPedirJSON(URL_MODIFICAR_ITINERARIO, respuestaJSON, e.target.parentNode);
  }

  function borrarDia(e) 
  {
    const idItinerario = e.target.parentNode.parentNode.parentNode.dataset['idItinerario'];
    const URL_BORRAR_ITINERARIO = '/AJAX-borrarItinerario.php';

    pedirJSON(URL_BORRAR_ITINERARIO, respuestaJSON, `id=${idItinerario}`);
  }

  function mostrarFormItinerario(e) 
  {
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
      formPedirJSON(URL_ITINERARIO, redireccionar, e.target.parentNode);
    });

    botonCancelar.addEventListener('click', function (e) {
      e.preventDefault();
      window.location.href = `viaje.php?id=${idViaje}`;
    });
  }

  function cerrarModal(e) {
    let ele = e.target;
    if (ele !== e.currentTarget) return; 

    if (ele.tagName === 'IMG') ele = ele.parentNode.parentNode;
    document.body.removeChild(ele);
  }

  function redireccionar(datos) 
  {
    for (const key in datos) {
      if (!datos[key].toLowerCase().includes('error')) {
        window.location.href = `viaje.php?id=${idViaje}`;  
      }
    }
  }

  function respuestaJSON(datos) 
  {
    console.log(datos);
    if (!datos['errores']) {
      window.location.href = location.href;  
    }
  }

  function pedirJSON(uri, exito, param)
  {
    const xhr = new XMLHttpRequest();
    xhr.onload = function (){
      if (this.status === 200) {
        exito(JSON.parse(this.responseText));
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('POST', uri);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(param);
  }

  function formPedirJSON(uri, exito, form)
  {
    const xhr = new XMLHttpRequest();
    xhr.onload = function (){
      if (this.status === 200) {
        exito(JSON.parse(this.responseText));
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('POST', uri);
    xhr.send(new FormData(form));
  }
  
})();

