const app = (function () {
  document.addEventListener('DOMContentLoaded', main);

  function main() {
    const URL_SUGERENCIAS = '/AJAX-sugerencias.php';
    //const form = document.forms[0];
    const input = document.querySelector('form input:first-of-type');
    //console.log(form);
    //console.log(input);

    input.addEventListener('keyup', function(){
      //console.log(this.previousElementSibling.value);
      let param = "suggest="+this.value+"&opcion="+this.previousElementSibling.value;
      pedirPostJSON(URL_SUGERENCIAS, gestionaSugerencias, param);
    });
  }

  function pedirPostJSON(uri, exito, param){
    const xhr = new XMLHttpRequest();

    xhr.onload = function (){
      if (this.status === 200) {
        /* console.log(this.responseText); */
        (this.responseText == '')?exito(this.responseText):exito(JSON.parse(this.responseText));
        /* exito(JSON.parse(this.responseText)) */
      }else {
        console.error(`Error: ${this.status} ${this.statusText}`);
      }
    }

    xhr.open('POST', uri);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(param);
  }

  function gestionaSugerencias(datos) {
    /* const form = document.getElementsByClassName('inicio')[0].getElementsByTagName('form')[0]; */
    const form = document.forms[0];
    const select = form.querySelector('select');
    const br = document.createElement('br');
    const div = document.createElement('div');
    const ul = document.createElement('ul');
    let a, text, li, divAntiguo;
    /* if (divAntiguo = form.querySelector('#sugerencia')) {
      form.removeChild(divAntiguo);
    } */
    if (datos !== '') {
      /* console.log(datos); */
      datos.forEach(sugerencia => {
        li = document.createElement('li');
        /* text = document.createTextNode(sugerencia.ciudad_destino); */
        text = document.createTextNode(sugerencia);
        a = document.createElement('a');
        a.href = 'http://localhost:9000/resultadosBusqueda.php?filtro='+select.value+'&buscador='+sugerencia/* .ciudad_destino */;
        a.style.color = 'black';
        a.appendChild(text);
        li.appendChild(a);
        ul.appendChild(li);
        /* div.style.borderBottom = '.5px solid black'; */
        /* div.appendChild(br); */
        /* form.insertAdjacentElement('beforeend', div);
        form.insertAdjacentElement('beforeend', br); */
      });

      /* div.style.backgroundColor = 'white'; */
      div.appendChild(ul);
      div.id = 'sugerencia';

      if (divAntiguo = form.querySelector('#sugerencia')) {
        form.replaceChild(div, divAntiguo);
      }else{
        form.insertAdjacentElement('beforeend', div);
      }
      /* console.log(form.querySelector('#sugerencia')); */
      /* console.log(form); */
      /* form.insertAdjacentElement('beforeend', br); */ 
    }else{
      if (divAntiguo = form.querySelector('#sugerencia')) {
        form.removeChild(divAntiguo);
      }
    }
    
  }
  
  /* return {iniciar:main}; */
})();