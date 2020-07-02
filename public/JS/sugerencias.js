const app = (function() {
    document.addEventListener('DOMContentLoaded', main);

    function main() {
        const URL_SUGERENCIAS = '/AJAX-sugerencias.php';
        const input = document.querySelector('#buscador');
        const filtro = document.querySelector('#filtro');

        input.addEventListener('keyup', function() {
            const param = "suggest=" + this.value + "&opcion=" + filtro.value;
            pedirPostJSON(URL_SUGERENCIAS + '?' + param, gestionaSugerencias);
        });
    }

    function pedirPostJSON(uri, exito) {
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

    function gestionaSugerencias(datos) {
        const form = document.forms[0];
        const select = form.querySelector('select');
        const divBuscador = document.querySelector('form > div:nth-of-type(2)');
        const div = document.createElement('div');
        const ul = document.createElement('ul');
        const divSugerencias = document.querySelector('#sugerencia');
        let a, text, li;

        /* if (divSugerencias = form.querySelector('#sugerencia')) {
          form.removeChild(divSugerencias);
        } */
        console.log(datos);

        if (datos !== '') {
            /* console.log(datos); */
            datos.forEach(sugerencia => {
                li = document.createElement('li');
                text = document.createTextNode(sugerencia);
                a = document.createElement('a');
                if (location.hostname === 'localhost') {
                    a.href = 'http://localhost:9000/resultadosBusqueda.php?filtro=' + select.value + '&buscador=' + sugerencia /* .ciudad_destino */ ;
                } else {
                    a.href = location.origin + '/resultadosBusqueda.php?filtro=' + select.value + '&buscador=' + sugerencia /* .ciudad_destino */ ;
                }
                a.style.color = 'black';
                a.appendChild(text);
                li.appendChild(a);
                ul.appendChild(li);
            });

            div.appendChild(ul);
            div.id = 'sugerencia';

            if (divSugerencias) divBuscador.removeChild(divSugerencias);
            divBuscador.appendChild(div);
        } else {
            if (divSugerencias) divBuscador.removeChild(divSugerencias);
        }

    }

})();