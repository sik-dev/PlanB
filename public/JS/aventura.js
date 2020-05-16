const app_aventura = (function() {
    document.addEventListener('DOMContentLoaded', main);

    let viajes;

    function main() {
        const URL_VIAJES = '/AJAX-obtenTodosLosViajes.php';

        if (sessionStorage.getItem('viajes')) {
            viajes = JSON.parse(sessionStorage.getItem('viajes'));
        }

        const boton = document.getElementsByTagName('button')[0];

        boton.addEventListener('click', function() {

            if (!viajes) {
                pedirJSON(URL_VIAJES, gestionaViajes);
            }
            console.log(viajes);

            efecto();
        });


    }

    function efecto() {

        var cuentaAtras = setInterval(function() { startTime() }, 300);
        var contador = 1;
        let numRandom = 0;
        let nuevoNumero = 0;
        let mediaViaje;

        const tarjeta = document.querySelector('.tarjeta');
        const a = document.createElement('a');
        const h3 = document.createElement('h3');
        const img = document.createElement('img');
        const puntuacion = document.createElement('div');
        const div = document.createElement('div');
        const datos = document.createElement('div');
        const etiquetas = document.createElement('div');

        function startTime() {
            if (contador == 15) {

                clearInterval(cuentaAtras);

                while (numRandom == nuevoNumero) {
                    nuevoNumero = numAleatorio(0, viajes.length - 1);
                }
                numRandom = nuevoNumero;

                //remover tarjeta anterior
                if (tarjeta.firstElementChild) {
                    tarjeta.removeChild(tarjeta.firstChild);
                }
                mediaViaje = parseInt(viajes[numRandom].media);

                for (let i = 0; i < mediaViaje; i++) {
                    let span = document.createElement('span');
                    if (mediaViaje >= i) {
                        span.classList.add('rellena');
                    }
                    span.textContent = '☆';
                    puntuacion.appendChild(span);
                }
                let span = document.createElement('span');
                span.textContent = viajes[numRandom].media;
                puntuacion.appendChild(span);
                puntuacion.classList.add('puntuacion');
                a.appendChild(puntuacion);

                a.href = 'viaje.php?id=' + viajes[numRandom].id;

                img.src = `imgs/${viajes[numRandom].user}/${viajes[numRandom].img}`;
                a.appendChild(img);

                h3.textContent = viajes[numRandom].ciudad;
                h3.style.top = '30px';
                a.appendChild(h3);

                let numDias = document.createElement('p');
                numDias.textContent = (viajes[numRandom].diasViaje > 1) ? viajes[numRandom].diasViaje + ' días' : viajes[numRandom].diasViaje + ' día';
                datos.appendChild(numDias);
                let precio = document.createElement('p');
                precio.textContent = viajes[numRandom].precio + ' €';
                datos.appendChild(precio);

                datos.classList.add('datos');
                div.appendChild(datos);

                for (i = 0; i < viajes[numRandom].etiquetas.length; i++) {
                    let span2 = document.createElement('span');

                    if (viajes[numRandom].etiquetas[i] == 'Con amig@s') {
                        span2.classList.add('Amigos');
                    } else {
                        span2.classList.add(viajes[numRandom].etiquetas[i]);
                    }

                    span2.alt = viajes[numRandom].etiquetas[i];
                    span2.title = viajes[numRandom].etiquetas[i];

                    etiquetas.appendChild(span2);
                }
                etiquetas.classList.add('etiquetas');
                div.appendChild(etiquetas);

                a.appendChild(div);

                tarjeta.appendChild(a);
            } else {
                contador++;

                //remover tarjeta anterior
                if (tarjeta.firstElementChild) {
                    tarjeta.removeChild(tarjeta.firstChild);
                }

                while (numRandom == nuevoNumero) {
                    nuevoNumero = numAleatorio(0, viajes.length - 1);
                }
                numRandom = nuevoNumero;
                nuevoNumero = 0;

                a.href = 'viaje.php?id=' + viajes[numRandom].id;

                h3.textContent = viajes[numRandom].ciudad;
                h3.style.top = '0px';
                a.appendChild(h3);

                img.src = `imgs/${viajes[numRandom].user}/${viajes[numRandom].img}`;
                a.appendChild(img);

                tarjeta.appendChild(a);


                //clearInterval(cuentaAtras);
            }

        }



    }

    function gestionaViajes(datos) {
        if (!datos) return;

        viajes = datos;

        sessionStorage.setItem('viajes', JSON.stringify(viajes));
    }

    //devuelve un numero aleatorio entre un min y un max
    function numAleatorio(min, max) {
        return Math.round(Math.random() * (max - min) + min);
    }

    function pedirJSON(uri, exito) {
        const xhr = new XMLHttpRequest();

        xhr.open('GET', uri);
        xhr.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
        xhr.addEventListener('readystatechange', function(e) {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    exito(JSON.parse(xhr.responseText));
                } else {
                    console.error(`Error: ${xhr.status} ${xhr.statusText}`);
                }
            }
        });

        xhr.send();
    }

    /* return {iniciar:main}; */
})();