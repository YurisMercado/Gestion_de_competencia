<?php
// change_password.php

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
include '../conexion.php';

// Obtener los datos del formulario
$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

// Buscar al usuario en la base de datos
$query = "SELECT * FROM usuarios WHERE ID='$user_id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar la contraseña actual
    if (password_verify($current_password, $user['Contraseña'])) {
        // Encriptar la nueva contraseña
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $update_query = "UPDATE usuarios SET Contraseña='$new_password_hashed' WHERE ID='$user_id'";
        if ($conn->query($update_query) === TRUE) {
            echo "Contraseña actualizada exitosamente. <a href='profile.php'>Volver al perfil</a>";
        } else {
            echo "Error al actualizar la contraseña: " . $conn->error;
        }
    } else {
        echo "La contraseña actual es incorrecta. <a href='profile.php'>Volver</a>";
    }
} else {
    echo "Usuario no encontrado. <a href='profile.php'>Volver</a>";
}

// Cerrar la conexión
$conn->close();
?>
