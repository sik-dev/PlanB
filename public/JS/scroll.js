const app_aventura = (function() {
    document.addEventListener('DOMContentLoaded', main);


    function main() {
        const boton = document.querySelector('.scroll');
        const distanciaScroll = 500;

        boton.addEventListener('click', (e) => {
            window.scrollTo(pageXOffset, 0);
            document.body.focus(); //poner el focus en el body
        });

        window.addEventListener('scroll', (e) => {

            const scroll = window.scrollY || document.documentElement.scrollTo; //documentElement  = HTML        cualquiera de las dos te da la distancia, depende del navegador usa una u otra

            if (boton.classList.contains('visible') && scroll > distanciaScroll) return; //para no hacer tantas peticiones, cuando ya aparezca el boton no se mete dentro y si esta arriba si entra
            //console.log('scrolling....');

            (scroll > distanciaScroll) ? boton.classList.add('visible'): boton.classList.remove('visible');

        });

    }



    /* return {iniciar:main}; */
})();