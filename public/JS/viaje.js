const app = (function (){
  'use strict';
  let datosViaje = null;
  let datosItinerario = null;
  let numDia = 1;
  const idViaje = location.href.slice(35, location.href.length);  //cogemos el ID del viaje de la URL
  let idUser;
  let favorito;
  const URL_VIAJE = '/AJAX-obtenViaje.php?id=';
  const URL_FAVORITOS = '/AJAX-obtenFavoritos.php?id=';
  const URL_COMENTARIOS = '/AJAX-obtenComentarios.php?id=';
  const URL_COMENTARIOS_ADD_REMOVE = '/comentarios.php?';
  function iniciar(){
    pedirJSON(URL_VIAJE + idViaje, gestinaDatosViaje);

    const perfil = document.getElementById('perfil');
    if(perfil){
      idUser = document.getElementById('perfil').dataset.id;                 //cogemos el ID de usuario si se ha logueado
      eventoFavoritos();
    }
    pedirJSON(URL_FAVORITOS + idUser, gestinaDatosFavoritos);
    pedirJSON(URL_COMENTARIOS + idViaje, gestinaDatosComentarios);

  }

  function gestinaDatosComentarios(datos){
    //console.log(datos);

    if(!datos)return;

    //Borra los comentarios si los hubiera
    const h2 = document.querySelectorAll('.comentarios > h2')[0];
    if (h2.nextElementSibling) {
      while (h2.nextElementSibling.tagName == 'DIV') {
        h2.nextElementSibling.remove();
      }
    }

    pintaComentarios(datos);
    gestionaFormulario();
  }

  function pintaComentarios(datos){
    const h2 = document.querySelectorAll('.comentarios > h2')[0];
    datos.forEach( reg=> {
      console.dir(reg);
      let div = document.createElement('div');
      let div2 = document.createElement('div');
      let p = document.createElement('p');
      let a = document.createElement('a');
      let img = document.createElement('img');
      let span = document.createElement('span');
      a.href = 'http://localhost:9000/perfilPublico.php?id_user=' + reg.id_user;
      img.src = `imgs/${reg.id_user}/${reg.foto}`;
      img.classList.add('fotoSmall');
      a.appendChild(img);
      p.textContent = reg.texto;
      span.textContent = 'Publicado el ' + new Date(reg.fecha).toLocaleDateString() + ' a las ' + new Date(reg.fecha).toLocaleTimeString();

      div.appendChild(a);
      div2.appendChild(p);
      div2.appendChild(span);
      div.appendChild(div2);

      if(reg.id_user == idUser){  //si tu has escrito el comentario, puedes borrarlo
        let div3 = document.createElement('div');
        let borrar = document.createElement('p');
        borrar.textContent = 'Borrar comentario';
        borrar.dataset.id = reg.id;
        borrar.classList.add('borrarComentario');
        borrar.addEventListener('click', borrarComentario);
        div3.appendChild(borrar);
        div.appendChild(div3);
      }
      div.classList.add('comentario');
      h2.insertAdjacentElement('afterend', div);
    });

  }
  function gestionaFormulario(){
    const form = document.querySelector('.comentarios form');
    if(!form)return;    //si no se ha logueado no aparecerá el formualario y se saldra
    form.setAttribute('novalidate', true);

    if(form.getAttribute('listener') !== 'true'){
      form.setAttribute('listener', 'true');
      form.addEventListener('submit', validarFormulario);
    }

    function validarFormulario(e) {
      //console.dir(e.target);
      e.preventDefault();
      const textarea = document.querySelector('.comentarios form textarea');
      peticionAJAX(URL_COMENTARIOS_ADD_REMOVE + 'añadir_comentario=true&texto=' + textarea.value + '&id_user=' + idUser + '&id_viaje=' +idViaje, gestionaAddRemoveComentario);
      textarea.value = '';
    }
  }
  function borrarComentario(e){
    const element = e.target;

    peticionAJAX(URL_COMENTARIOS_ADD_REMOVE + 'quitar_comentario=true&id=' + element.dataset.id, gestionaAddRemoveComentario);
  }

  function gestionaAddRemoveComentario(respuesta){
    if(!respuesta)return;

    if(respuesta == 'EXITO'){
      pedirJSON(URL_COMENTARIOS + idViaje, gestinaDatosComentarios);
    }
  }

  function gestinaDatosViaje(datos){
    datosViaje = datos.datosViaje;
    datosItinerario = datos.datosItinerario;

    console.log(datosItinerario);
    document.querySelector('ul').addEventListener('click', gestorEvento);

    pintaDia();   //para que se selecione el dia 1 al cargar la pagina
  }

  function gestorEvento(e){
    const element = e.target;

    if( element.tagName !== 'P') return;

    numDia = element.parentNode.dataset.dia;  //obtenemos el numero de dia del itinerario del data set del LI
    pintaDia();
  }

  function pintaDia(){
    const divItinerario = document.querySelector('.itinerario');

    if(divItinerario.children[2].firstChild){   //si ya tiene contenido, lo vaciamos para poner un nuevo dia
      divItinerario.children[2].innerHTML = '';
    }

    const datos = datosItinerario[numDia -1];
    const div = document.getElementById('itinerarioDias');

    const localizacion = document.createElement('p');
    localizacion.textContent = 'Localización: ' + datos.localizacion;
    const alojamiento = document.createElement('p');
    alojamiento.textContent = 'Alojamiento: ' + datos.alojamiento;

    div.appendChild(localizacion);
    div.appendChild(alojamiento);

    const itinerario = document.createElement('div');

    const mañanaTitulo = document.createElement('h4');
    mañanaTitulo.textContent = 'Mañana';
    const mañana = document.createElement('p');
    mañana.textContent = datos.manana;
    const tardeTitulo = document.createElement('h4');
    tardeTitulo.textContent = 'Tarde';
    const tarde = document.createElement('p');
    tarde.textContent = datos.tarde;
    const nocheTitulo = document.createElement('h4');
    nocheTitulo.textContent = 'Noche';
    const noche = document.createElement('p');
    noche.textContent = datos.noche;

    itinerario.appendChild(mañanaTitulo);
    itinerario.appendChild(mañana);
    itinerario.appendChild(tardeTitulo);
    itinerario.appendChild(tarde);
    itinerario.appendChild(nocheTitulo);
    itinerario.appendChild(noche);

    div.appendChild(itinerario);

    divItinerario.appendChild(div);

    diaSeleccionado();
  }

  function diaSeleccionado(){
    const lis = document.querySelectorAll('.itinerario > ul > li');

    lis.forEach( element => {
        element.classList.remove('diaSeleccionado');  //quitamos a todas las LI la clase
    });

    lis[numDia -1].classList.add('diaSeleccionado');  //Selecionamos el dia actual de itinerario
  }

  function gestinaDatosFavoritos(datosFavoritos){

    console.log(datosFavoritos);
    if(!datosFavoritos)return;

    favorito = false;

    datosFavoritos.forEach( reg=> {
      if(reg.idViaje == idViaje){
        favorito = true;
      }
    });

    asignaEstrella();
  }


  function eventoFavoritos() {
    const URL = '/favoritos.php?';
    const img = document.querySelector('#estrella img');
    img.addEventListener('click', function(e){
      if(img.src.slice(37) == 'star_rellena.png'){    //Quitar favorito
        peticionAJAX(URL + 'quitar_favorito=true&id_viaje=' + idViaje + '&id_user=' + idUser, quitarFavoritos);
      }
      if(img.src.slice(37) == 'star_vacia.png'){      //añadir favorito
        peticionAJAX(URL + 'añadir_favorito=true&id_viaje=' + idViaje + '&id_user=' + idUser, addFavoritos);
      }
    });
  }

  function quitarFavoritos(respuesta) {

      if(respuesta == 'EXITO'){
          favorito = false;
          asignaEstrella();
      }
  }
  function addFavoritos(respuesta) {

      if(respuesta == 'EXITO'){
          pedirJSON(URL_FAVORITOS + idUser, gestinaDatosFavoritos);
      }
  }

  function asignaEstrella(){
    const img = document.querySelector('#estrella img');
    if(favorito){
      img.src = '/logos_proyecto/star_rellena.png';
    }
    if(!favorito){
      img.src = '/logos_proyecto/star_vacia.png';
    }

    console.log(favorito);
  }

  function peticionAJAX(uri, exito){
    const xhr = new XMLHttpRequest();

    xhr.open('GET', uri);
    xhr.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
    xhr.addEventListener('readystatechange', function(e) {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          exito(xhr.responseText);
        }else {
          console.error(`Error: ${xhr.status} ${xhr.statusText}`);
        }
      }
    });

    xhr.send();
  }
  function pedirJSON(uri, exito){
    const xhr = new XMLHttpRequest();

    xhr.open('GET', uri);
    xhr.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
    xhr.addEventListener('readystatechange', function(e) {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          exito(JSON.parse(xhr.responseText));
        }else {
          console.error(`Error: ${xhr.status} ${xhr.statusText}`);
        }
      }
    });

    xhr.send();
  }
  return {iniciar:iniciar()};
})()
