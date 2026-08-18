<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Gestión de Administradores</title>
  <link rel="stylesheet" href="../../../styles/reset.css">
  <link rel="stylesheet" href="../../../styles/global.css">
  <link rel="stylesheet" href="../../../styles/panel-styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<style>
  button[name="Agregar"] {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }

  button[name="Agregar"]:hover {
    background-color: #218838;
  }
</style>

<body>
  <main>
    <div class="container">
      <?php include __DIR__ . '/../adminview/layouts/Menu_PanelAdmin.php'; ?>
      <div class="main-content">
        <h2>Lista de Administradores</h2>
        <table>
          <thead>
            <tr>
              <td>Documento</td>
              <td>Nombre(s)</td>
              <td>Apellido(s)</td>
              <td>Email</td>
              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>
            <?php while ($admin = $administradores->fetch_assoc()): ?>
              <tr>
                <td><?= $admin['Documento_Administrador'] ?></td>
                <td><?= $admin['Nombre_Administrador'] ?></td>
                <td><?= $admin['Apellido_Administrador'] ?></td>
                <td><?= $admin['Email'] ?></td>
                <td>
                  <a href="?accion=eliminar&Documento_Administrador=<?= $admin['Documento_Administrador'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este Administrador?');">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <div class="event-form">
          <form method="POST">
            <label>Documento:</label><input type="text" name="Documento">
            <label>Nombre:</label><input type="text" name="Nombre">
            <label>Apellido:</label><input type="text" name="Apellido">
            <label>Email:</label><input type="email" name="email">
            <label>Contraseña:</label><input type="password" name="contraseña">
            <label>Confirmar Contraseña:</label><input type="password" name="Ccontraseña">
            <button type="submit" name="Agregar">Agregar Administrador</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php include __DIR__ . '/../adminview/layouts/footer.php'; ?>
</body>

</html>