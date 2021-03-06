const app = (function() {
    'use strict';

    let datosViaje = null;
    let datosItinerario = null;
    let numDia = 1;
    const idViaje = (location.hostname === 'localhost') ? location.href.slice(35, location.href.length) : location.href.slice(38, location.href.length); //cogemos el ID del viaje de la URL
    let idUser;
    let favorito;
    let haVotado = false;
    const URL_VIAJE = '/AJAX-obtenViaje.php?id=';
    const URL_FAVORITOS = '/AJAX-obtenFavoritos.php?id=';
    const URL_COMENTARIOS = '/AJAX-obtenComentarios.php?id=';
    const URL_COMENTARIOS_ADD_REMOVE = '/comentarios.php?';
    const URL_INSERTA_VALORACION = '/AJAX-insertaValoracion.php?';

    function iniciar() {
        pedirJSON(URL_VIAJE + idViaje, gestinaDatosViaje);

        const perfil = document.getElementById('perfil');
        if (perfil) {
            idUser = document.getElementById('perfil').dataset.id; //cogemos el ID de usuario si se ha logueado
        }
        eventoFavoritos();

        pedirJSON(URL_FAVORITOS + idUser, gestinaDatosFavoritos);
        pedirJSON(URL_COMENTARIOS + idViaje, gestinaDatosComentarios);

        gestionaFormulario();
        eventoPuntuacion();

        const imgViaje = document.getElementById('fotoViaje');
        imgViaje.addEventListener('click', crearModalFoto);
    }

    function gestinaDatosComentarios(datos) {
        //console.log(datos);

        if (!datos) return;

        //Borra los comentarios si los hubiera
        const h2 = document.querySelectorAll('.comentarios > h2')[0];
        if (h2.nextElementSibling) {
            while (h2.nextElementSibling.tagName == 'DIV') {
                h2.nextElementSibling.remove();
            }
        }

        pintaComentarios(datos);
    }

    function eventoPuntuacion() {

        const puntuacion = document.getElementsByClassName('puntuacion')[0];

        puntuacion.addEventListener('click', function(e) {
            const element = e.target;

            if (element.tagName != 'SPAN') return;
            let puntuacion = 0;

            switch (element) {
                case element.parentNode.children[0]:
                    puntuacion = 5;
                    break;
                case element.parentNode.children[1]:
                    puntuacion = 4;
                    break;
                case element.parentNode.children[2]:
                    puntuacion = 3;
                    break;
                case element.parentNode.children[3]:
                    puntuacion = 2;
                    break;
                case element.parentNode.children[4]:
                    puntuacion = 1;
                    break;
                default:
            }
            console.dir(puntuacion);

            //si la puntuacion es distinta de 0 y esta logueado
            if (puntuacion != 0) {
                if (idUser) {
                    peticionAJAX(`${URL_INSERTA_VALORACION}id_user=${idUser}&id_viaje=${idViaje}&puntuacion=${puntuacion}`, gestionaDatosValoracion);
                } else {
                    crearModalLogin();
                }
            }
        });
    }

    function crearModalLogin() {

        creaEstructuraModal();

        function creaEstructuraModal() {
            const div = document.createElement('div');
            div.id = 'modal';
            const div2 = document.createElement('div');

            const pTitulo = document.createElement('p');
            pTitulo.textContent = `Tienes que registrarte:`;
            const p = document.createElement('p');
            p.textContent = `Inicia sesión o registrate como un nuevo usuario.`;
            const aLogin = document.createElement('a');
            aLogin.href = `login.php?redirect=viaje.php?id=${idViaje}`;
            const aRegistro = document.createElement('a');
            aRegistro.href = `formulario.php?redirect=viaje.php?id=${idViaje}`;
            const btnLogin = document.createElement('button');
            btnLogin.textContent = 'Login';
            const btnRegistro = document.createElement('button');
            btnRegistro.textContent = 'Registrate';
            const cerrar = document.createElement('img');
            cerrar.src = '../logos_proyecto/close.png';
            cerrar.classList.add('btn-cerrar');

            div.addEventListener('click', cerrarModal);
            cerrar.addEventListener('click', cerrarModal);

            aLogin.appendChild(btnLogin);
            aLogin.appendChild(btnLogin);
            aRegistro.appendChild(btnRegistro);
            div2.appendChild(pTitulo);
            div2.appendChild(p);
            div2.appendChild(aLogin);
            div2.appendChild(aRegistro);
            div2.appendChild(cerrar);
            div.appendChild(div2);

            monstrarModal(div);
        }

        function monstrarModal(modal) {
            document.body.appendChild(modal);
        }

        function cerrarModal(e) {
            let ele = e.target;
            //closet
            if (ele !== e.currentTarget) return; //si no son lo mismo , sale

            if (ele.tagName === 'IMG') ele = ele.parentNode.parentNode; //si es un boton, quiero quitar al padre de tu padre
            document.body.removeChild(ele);
        }
    }

    function crearModalFoto(e) {

        const element = e.target;

        creaEstructuraModal(element);

        function creaEstructuraModal(element) {

            console.dir(element);

            const div = document.createElement('div');
            div.id = 'modalFoto';
            const div2 = document.createElement('div');

            const img = document.createElement('img');
            img.src = element.src;

            const cerrar = document.createElement('img');
            cerrar.src = '../logos_proyecto/close.png';
            cerrar.id = 'btn-cerrarFoto';

            div.addEventListener('click', cerrarModal);
            cerrar.addEventListener('click', cerrarModal);

            div2.appendChild(img);
            div2.appendChild(cerrar);
            div.appendChild(div2);

            monstrarModal(div);
        }

        function monstrarModal(modal) {
            document.body.appendChild(modal);
        }

        function cerrarModal(e) {
            let ele = e.target;
            //closet
            if (ele !== e.currentTarget) return; //si no son lo mismo , sale

            if (ele.tagName === 'IMG') ele = ele.parentNode.parentNode; //si es un boton, quiero quitar al padre de tu padre
            document.body.removeChild(ele);
        }
    }

    function gestionaDatosValoracion(datos) {
        if (!datos) return;

        //recibimos la nueva media del viaje y se la monstramos
        const p = document.getElementById('mediaViaje');
        p.textContent = datos;

        /*
        if (!haVotado) {
            const voto = document.getElementById('voto');
            voto.textContent = parseInt(voto.textContent) + 1;
            haVotado = true;
        }*/
        const voto = document.getElementById('mediaViaje').nextElementSibling;
        voto.textContent = '¡Gracias por votar!';

        const puntuacion = document.getElementById('estrellas').children;

        console.log(datos);


        let arrayMedia = [];

        for (let index = 0; index < puntuacion.length; index++) {
            if (datos >= index + 1) {
                arrayMedia[index] = 'rellena';
            } else {
                arrayMedia[index] = 'noRellena';
            }
        }

        arrayMedia = arrayMedia.reverse();

        arrayMedia.forEach((reg, i) => {
            if (reg == 'rellena') {
                puntuacion[i].classList.add('rellena');
            } else {
                puntuacion[i].classList.remove('rellena');
            }
        });




    }

    function pintaComentarios(datos) {
        const h2 = document.querySelectorAll('.comentarios > h2')[0];
        datos.forEach(reg => {
            console.dir(reg);
            let div = document.createElement('div');
            let div2 = document.createElement('div');
            let p = document.createElement('p');
            let a = document.createElement('a');
            let img = document.createElement('img');
            let span = document.createElement('span');
            a.href = '/perfilPublico.php?id_user=' + reg.id_user;
            img.src = `imgs/${reg.id_user}/${reg.foto}`;
            img.classList.add('fotoSmall');
            a.appendChild(img);
            p.textContent = reg.texto;
            span.textContent = 'Publicado el ' + new Date(reg.fecha).toLocaleDateString() + ' a las ' + new Date(reg.fecha).toLocaleTimeString();

            div.appendChild(a);
            div2.appendChild(p);
            div2.appendChild(span);
            div.appendChild(div2);

            if (reg.id_user == idUser) { //si tu has escrito el comentario, puedes borrarlo
                let div3 = document.createElement('div');
                let borrar = document.createElement('img');
                borrar.src = '/logos_proyecto/basura.png';
                borrar.alt = 'Borrar comentario';
                borrar.title = 'Borrar comentario';
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

    function gestionaFormulario() {
        const form = document.querySelector('.comentarios form');
        if (!form) return; //si no se ha logueado no aparecerá el formualario y se saldra
        form.setAttribute('novalidate', true);

        if (form.getAttribute('listener') !== 'true') {
            form.setAttribute('listener', 'true');
            form.addEventListener('submit', validarFormulario);
        }

        function validarFormulario(e) {
            //console.dir(e.target);
            e.preventDefault();

            if (idUser) {
                const textarea = document.querySelector('.comentarios form textarea');
                peticionAJAX(URL_COMENTARIOS_ADD_REMOVE + 'añadir_comentario=true&texto=' + textarea.value + '&id_user=' + idUser + '&id_viaje=' + idViaje, gestionaAddRemoveComentario);
                textarea.value = '';
            } else {
                crearModalLogin();
            }

        }
    }

    function borrarComentario(e) {
        const element = e.target;

        peticionAJAX(URL_COMENTARIOS_ADD_REMOVE + 'quitar_comentario=true&id=' + element.dataset.id, gestionaAddRemoveComentario);
    }

    function gestionaAddRemoveComentario(respuesta) {
        if (!respuesta) return;

        if (respuesta == 'EXITO') {
            pedirJSON(URL_COMENTARIOS + idViaje, gestinaDatosComentarios);
        }
    }

    function gestinaDatosViaje(datos) {
        datosViaje = datos.datosViaje;
        datosItinerario = datos.datosItinerario;

        console.log(datosItinerario);
        document.querySelector('.itinerario > ul').addEventListener('click', gestorEvento);

        pintaDia(); //para que se selecione el dia 1 al cargar la pagina
    }

    function gestorEvento(e) {
        const element = e.target;
        if (element.tagName !== 'P') return;

        numDia = element.parentNode.dataset.dia; //obtenemos el numero de dia del itinerario del data set del LI
        pintaDia();
    }

    function pintaDia() {
        const divItinerario = document.querySelector('.itinerario');
        const divItinerarioDias = document.getElementsByClassName('itinerarioDias')[0];
        const divFormItinerario = document.querySelector('.insertItinerario');
        const divFotosItinerario = document.querySelector('#fotosItinerario');

        //cuando se estee insertando un nuevo itinerario
        //y se haga click en un dia desaparezca el formulario
        divFormItinerario.classList.add('desaparecer');
        divItinerarioDias.classList.remove('desaparecer');

        if (divItinerarioDias.firstChild) { //si ya tiene contenido, lo vaciamos para poner un nuevo dia
            divItinerarioDias.innerHTML = '';
        }

        if (divFotosItinerario) {
            divFotosItinerario.remove();
        }




        const datos = datosItinerario[numDia - 1];
        /* const div = document.getElementById('itinerarioDias'); */

        const localizacion = document.createElement('p');
        localizacion.textContent = 'Localización: ' + datos.localizacion;
        const alojamiento = document.createElement('p');
        alojamiento.textContent = 'Alojamiento: ' + datos.alojamiento;

        divItinerarioDias.appendChild(localizacion);
        divItinerarioDias.appendChild(alojamiento);

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
        divItinerarioDias.appendChild(itinerario);

        const fotos = datos.fotos;

        const divFotos = document.createElement('div');
        const divImgs = document.createElement('div');
        const divImgSelect = document.createElement('div');
        const idUserViaje = document.querySelector('.fotoSmall').dataset.iduserviaje;
        let fotoDia;
        let divImg;

        /* rellenar el div con todas las imagenes del dia */
        fotos.forEach(foto => {
            fotoDia = document.createElement('img');
            fotoDia.src = `imgs/${idUserViaje}/${foto.ruta}`;

            divImg = document.createElement('div');
            divImg.classList.add('miniFoto');
            divImg.addEventListener('click', fotoSeleccionada);
            divImg.appendChild(fotoDia);
            divImgs.appendChild(divImg);
        });
        divImgs.id = 'fotos';

        /* primera imagen seleccionada */
        fotoDia = document.createElement('img');
        fotoDia.src = `imgs/${idUserViaje}/${fotos[0].ruta}`;
        fotoDia.id = 'fotoDiaSel';
        fotoDia.classList.add('cursor');
        fotoDia.addEventListener('click', crearModalFoto);
        divImgSelect.appendChild(fotoDia);
        divImgSelect.id = 'fotoSeleccionada';

        divFotos.id = 'fotosItinerario';
        divFotos.appendChild(divImgSelect);
        divFotos.appendChild(divImgs);

        /*divItinerarioDias.appendChild(divFotos);*/
        divItinerario.appendChild(divItinerarioDias);
        divItinerario.appendChild(divFotos);

        diaSeleccionado();
    }

    function fotoSeleccionada() {
        const src = 'imgs' + this.firstChild.src.split('imgs')[1];
        const fotoDia = document.getElementById('fotoDiaSel');
        /* const nuevaFotoSeleccionada = document.cloneNode() */
        fotoDia.src = src;
        /*         console.log(fotoDia);
                console.log(src); */
    }

    function diaSeleccionado() {
        const lis = document.querySelectorAll('.itinerario > ul > li');

        lis.forEach(element => {
            element.classList.remove('diaSeleccionado'); //quitamos a todas las LI la clase
        });

        lis[numDia - 1].classList.add('diaSeleccionado'); //Selecionamos el dia actual de itinerario
    }

    function gestinaDatosFavoritos(datosFavoritos) {

        console.log(datosFavoritos);
        if (!datosFavoritos) return;

        favorito = false;

        datosFavoritos.forEach(reg => {
            if (reg.idViaje == idViaje) {
                favorito = true;
            }
        });

        asignaAvion();
    }


    function eventoFavoritos() {
        const URL = '/favoritos.php?';
        const img = document.querySelector('#avion img');
        let n;

        if (location.hostname === 'localhost') { //si estamos ne localhost
            n = 37;
        } else { //si estamos con IP fija
            n = 40;
        }

        img.addEventListener('click', function(e) {
            if (idUser) {
                if (img.src.slice(n) == 'avion_dibujo_relleno.png') { //Quitar favorito
                    peticionAJAX(URL + 'quitar_favorito=true&id_viaje=' + idViaje + '&id_user=' + idUser, quitarFavoritos);
                }
                if (img.src.slice(n) == 'avion_dibujo_vacio.png') { //añadir favorito
                    peticionAJAX(URL + 'añadir_favorito=true&id_viaje=' + idViaje + '&id_user=' + idUser, addFavoritos);
                }
            } else {
                crearModalLogin();
            }

        });
    }

    function quitarFavoritos(respuesta) {

        if (respuesta == 'EXITO') {
            favorito = false;
            asignaAvion();
        }
    }

    function addFavoritos(respuesta) {

        if (respuesta == 'EXITO') {
            pedirJSON(URL_FAVORITOS + idUser, gestinaDatosFavoritos);
        }
    }

    function asignaAvion() {
        const img = document.querySelector('#avion img');
        if (favorito) {
            img.src = '/logos_proyecto/avion_dibujo_relleno.png';
        }
        if (!favorito) {
            img.src = '/logos_proyecto/avion_dibujo_vacio.png';
        }

        console.log(favorito);
    }

    function peticionAJAX(uri, exito) {
        const xhr = new XMLHttpRequest();

        xhr.open('GET', uri);
        xhr.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
        xhr.addEventListener('readystatechange', function(e) {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    exito(xhr.responseText);
                } else {
                    console.error(`Error: ${xhr.status} ${xhr.statusText}`);
                }
            }
        });
        xhr.send();
    }

    function pedirJSON(uri, exito) {
        const xhr = new XMLHttpRequest();

        xhr.open('GET', uri);
        xhr.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
        xhr.addEventListener('readystatechange', function(e) {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    /* console.log(JSON.parse(xhr.responseText)); */
                    exito(JSON.parse(xhr.responseText));
                } else {
                    console.error(`Error: ${xhr.status} ${xhr.statusText}`);
                }
            }
        });

        xhr.send();
    }
    return { iniciar: iniciar() };
})()