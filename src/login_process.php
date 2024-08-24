<?php
// Mostrar todos los errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
include '../conexion/conexion.php';

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $query = "SELECT * FROM usuarios WHERE Email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña encriptada con password_verify
        if (password_verify($password, $user['Contraseña'])) {
            // Contraseña correcta, iniciar sesión
            echo "<script>alert('Inicio de sesión exitoso'); window.location.href = 'dashboard.php';</script>";
        } else {
            // Contraseña incorrecta
            echo "<script>alert('Contraseña incorrecta.'); window.location.href = 'login.php';</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('No se encontró un usuario con ese correo electrónico.'); window.location.href = 'login.php';</script>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
