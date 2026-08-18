document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("formulario");

  formulario.addEventListener("submit", function (event) {
    const ID = document.getElementById("Documento");
    const Nombre = document.getElementById("Nombre");
    const Apellidos = document.getElementById("Apellidos");
    const Edad = document.getElementById("Edad");
    const Usuario = document.getElementById("Usuario");
    const Email = document.getElementById("Email");
    const Contraseña = document.getElementById("Contraseña");
    const ConfirmarC = document.getElementById("ConfirmarContraseña");

    // 1. Validar campos vacíos
    if (
      ID.value.trim() === "" ||
      Edad.value.trim() === "" ||
      Nombre.value.trim() === "" ||
      Apellidos.value.trim() === "" ||
      Email.value.trim() === "" ||
      Contraseña.value.trim() === "" ||
      ConfirmarC.value.trim() === "" ||
      Usuario.value.trim() === ""
    ) {
      alert("Por favor, completa todos los campos.");
      event.preventDefault();
      return;
    }

    // 2. Validar email
    if (!validateEmail(Email.value)) {
      alert("Ingrese un email válido.");
      event.preventDefault();
      return;
    }

    // 3. Validar seguridad de la contraseña
    if (!ContrasenaSegura(Contraseña.value)) {
      event.preventDefault();
      return;
    }

    // 4. Validar coincidencia de contraseñas
    if (Contraseña.value !== ConfirmarC.value) {
      alert("Las contraseñas no coinciden.");
      event.preventDefault();
      return;
    }

  });

  function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  function ContrasenaSegura(contra) {
    if (!/[A-Z]/.test(contra)) {
      alert("La contraseña debe tener al menos una letra mayúscula.");
      return false;
    }
    if (!/[a-z]/.test(contra)) {
      alert("La contraseña debe tener al menos una letra minúscula.");
      return false;
    }
    if (!/[0-9]/.test(contra)) {
      alert("La contraseña debe tener al menos un número.");
      return false;
    }
    if (!/[!@#$%^&*(),.?":{}|<>]/.test(contra)) {
      alert("La contraseña debe tener al menos un carácter especial.");
      return false;
    }
    if (contra.length < 8) {
      alert("La contraseña debe tener al menos 8 caracteres.");
      return false;
    }
    return true;
  }
});
