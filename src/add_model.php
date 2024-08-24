<?php
// add_model.php

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $foto = $_FILES['foto'];

    // Validar y subir la foto
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($foto["name"]);
    move_uploaded_file($foto["tmp_name"], $target_file);

    // Insertar el nuevo modelo en la base de datos
    $query = "INSERT INTO empleado_modelo (Nombre, Edad, Email, Foto) VALUES ('$nombre', '$edad', '$email', '$target_file')";
    if ($conn->query($query) === TRUE) {
        echo "Modelo agregado exitosamente. <a href='models.php'>Volver a la lista</a>";
    } else {
        echo "Error al agregar el modelo: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Agregar Modelo - Erost</title>
</head>
<body>
    <div class="container">
        <h2>Agregar Nuevo Modelo</h2>
        <form action="add_model.php" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="edad">Edad:</label>
            <input type="number" name="edad" id="edad" required>

            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" required>

            <label for="foto">Foto del Modelo:</label>
            <input type="file" name="foto" id="foto" required>

            <button type="submit">Guardar</button>
            <button type="button" onclick="window.location.href='models.php';">Volver</button>
        </form>
    </div>
</body>
</html>