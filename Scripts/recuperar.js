document.addEventListener("DOMContentLoaded",function(){

    
    var Contraseña = document.getElementById('nueva_contraseña');

    
    const Registrarse = document.querySelector('input[type="submit"]');

    Registrarse.addEventListener("click", function(event) {
        if(Contraseña.value.length < 8){
            event.preventDefault(); 
            alert("La contraseña debe tener mas de 8 caracteres")
            
        }
    

  })
})
