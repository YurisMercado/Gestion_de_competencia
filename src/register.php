<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion/conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Encriptar la contraseña
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (Nombre, Email, Contraseña) VALUES ('$nombre', '$email', '$password_hashed')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Usuario registrado exitosamente.'); window.location.href = 'login.php';</script>";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Registro de Usuario - Erost</title>
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form action="register.php" method="POST" class="form-register">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn-register">Registrar Usuario</button>
            <button type="button" onclick="window.location.href='login.php';" class="btn-back">Volver al Inicio</button>
        </form>
    </div>
</body>
</html>

