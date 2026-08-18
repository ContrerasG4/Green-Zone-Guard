// Función para mostrar/ocultar el formulario de edición de perfil
function toggleEditProfile() {
  const editForm = document.getElementById('edit-form');
  editForm.style.display = (editForm.style.display === 'block') ? 'none' : 'block';
}

// Función para guardar los cambios del perfil (solo para mostrar como ejemplo)
function saveProfile() {
  const name = document.getElementById('edit-name').value;
  const email = document.getElementById('edit-email').value;

  // Actualizamos los datos en el perfil
  document.getElementById('name').textContent = name;
  document.getElementById('email').textContent = email;

  // Cerramos el formulario de edición
  toggleEditProfile();
}