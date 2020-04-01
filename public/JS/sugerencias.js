const app = (function () {
  document.addEventListener('DOMContentLoaded', main);

  function main() {
    const URL_SUGERENCIAS = '/AJAX-sugerencias.php';
    const form = document.forms[0];
    const input = document.querySelector('form input:first-of-type');
    //console.log(form);
    //console.log(input);

    input.addEventListener('keyup', function(){
      //console.log(this.value);
      pedirPostJSON(URL_SUGERENCIAS, gestionaSugerencias, "suggest="+this.value);
    });
  }

  function pedirPostJSON(uri, exito, param){
    const xhr = new XMLHttpRequest();

    xhr.onload = function (){
      if (this.status === 200) {
        exito(JSON.parse(this.responseText));
        //console.log(JSON.parse(this.responseText));
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('POST', uri);
    //xhr.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(param);
  }

  function gestionaSugerencias(datos) {
    /* const form = document.getElementsByClassName('inicio')[0].getElementsByTagName('form')[0]; */
    const form = document.forms[0];
    const select = form.querySelector('select');
    const br = document.createElement('br');
    let a, text, div;
    //console.log(datos);
    datos.forEach(sugerencia => {
        text = document.createTextNode(sugerencia.ciudad_destino);
        div = document.createElement('div');
        a = document.createElement('a');
        a.href = 'http://localhost:9000/resultadosBusqueda.php?filtro='+select.value+'&buscador='+sugerencia.ciudad_destino;
        a.style.color = 'black';
        a.appendChild(text);
        div.appendChild(a);
        form.insertAdjacentElement('beforeend', div);
        form.insertAdjacentElement('beforeend', br);
    });
  }
  
  /* return {iniciar:main}; */
})();