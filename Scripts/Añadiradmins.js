document.addEventListener("DOMContentLoaded",function(){

    var ID = document.getElementById("Documento");
    var Nombre = document.getElementById('Nombre');
    var Apellidos = document.getElementById('Apellido');
    var Email = document.getElementById('email');
    var Contraseña = document.getElementById('contraseña');
    var ConfirmarC = document.getElementById('Ccontraseña');

    const Agregar = document.querySelector('button[name="Agregar"]');

    Agregar.addEventListener("click", function(event) {
        if (
            ID.value.trim() === "" ||
            Nombre.value.trim() === "" ||
            Apellidos.value.trim() === "" ||
            Email.value.trim() === "" ||
            Contraseña.value.trim() === "" ||
            ConfirmarC.value.trim() === ""
        ) {
            event.preventDefault(); 
            alert("Por favor, completa todos los campos.");
        } 
        if(!validateEmail(Email.value)) { 
            alert("Ingrese un email correcto '@'")
            event.preventDefault(); 
            }
        if(Contraseña.value.length < 8){
            event.preventDefault(); 
            alert("La contraseña debe tener mas de 8 caracteres")
        }
    
        if(Contraseña.value!==ConfirmarC.value){
            event.preventDefault(); 
            alert("Las contraseñas no coinciden")
        }
        else{
            return true
        }
    })
  })
function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
