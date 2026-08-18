document.addEventListener("DOMContentLoaded",function(){
    const eventos = document.getElementById('eventos');
    eventos.addEventListener("click", function(){
    alert('Primero debes iniciar sesion para acceder a este apartado');
    window.location.href="/index.html";
    });
    
    
    });