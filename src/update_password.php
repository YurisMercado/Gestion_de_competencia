<?php
include '../conexion/conexion.php';

// Nueva contraseña en texto plano
$new_password = '1mjwjdjnqw';
// Encriptar la contraseña
$new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

// Actualizar la contraseña en la base de datos
$query = "UPDATE usuarios SET Contraseña='$new_password_hashed' WHERE Email='yuris@gmail.com'";

if ($conn->query($query) === TRUE) {
    echo "Contraseña actualizada exitosamente.";
} else {
    echo "Error al actualizar la contraseña: " . $conn->error;
}

$conn->close();
?>
