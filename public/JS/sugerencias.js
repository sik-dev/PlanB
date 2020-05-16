const app = (function() {
    document.addEventListener('DOMContentLoaded', main);

    function main() {
        const URL_SUGERENCIAS = '/AJAX-sugerencias.php';
        const input = document.querySelector('#buscador');
        const filtro = document.querySelector('#filtro');

        input.addEventListener('keyup', function() {
            const param = "suggest=" + this.value + "&opcion=" + filtro.value;
            pedirPostJSON(URL_SUGERENCIAS, gestionaSugerencias, param);
        });
    }

    function pedirPostJSON(uri, exito, param) {
        const xhr = new XMLHttpRequest();

        xhr.onload = function() {
            if (this.status === 200) {
                /* console.log(this.responseText);
                console.log(JSON.parse(this.responseText)); */
                (this.responseText == '') ? exito(this.responseText):exito(JSON.parse(this.responseText));
                /* exito(JSON.parse(this.responseText)) */
            } else {
                console.error(`Error: ${this.status} ${this.statusText}`);
            }
        }

        xhr.open('POST', uri);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(param);
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
                a.href = 'http://localhost:9000/resultadosBusqueda.php?filtro=' + select.value + '&buscador=' + sugerencia /* .ciudad_destino */ ;
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