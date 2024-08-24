<?php
// edit_model.php

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
include '../conexion.php';

// Obtener el ID del modelo desde la URL
$model_id = $_GET['id'];

// Obtener los detalles del modelo desde la base de datos
$query = "SELECT * FROM empleado_modelo WHERE ID='$model_id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $model = $result->fetch_assoc();
} else {
    echo "Modelo no encontrado. <a href='models.php'>Volver a la lista</a>";
    exit();
}

// Actualizar los datos del modelo si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $foto = $_FILES['foto'];

    // Verificar si se subió una nueva foto
    if ($foto['name']) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($foto["name"]);
        move_uploaded_file($foto["tmp_name"], $target_file);

        // Actualizar con la nueva foto
        $query = "UPDATE empleado_modelo SET Nombre='$nombre', Edad='$edad', Email='$email', Foto='$target_file' WHERE ID='$model_id'";
    } else {
        // Actualizar sin cambiar la foto
        $query = "UPDATE empleado_modelo SET Nombre='$nombre', Edad='$edad', Email='$email' WHERE ID='$model_id'";
    }

    if ($conn->query($query) === TRUE) {
        echo "Modelo actualizado exitosamente. <a href='view_model.php?id=$model_id'>Ver Modelo</a>";
    } else {
        echo "Error al actualizar el modelo: " . $conn->error;
    }

    // Cerrar la conexión y salir del script
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
    <title>Editar Modelo - Erost</title>
</head>
<body>
    <div class="container">
        <h2>Editar Modelo</h2>
        <form action="edit_model.php?id=<?php echo $model_id; ?>" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $model['Nombre']; ?>" required>

            <label for="edad">Edad:</label>
            <input type="number" name="edad" id="edad" value="<?php echo $model['Edad']; ?>" required>

            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" value="<?php echo $model['Email']; ?>" required>

            <label for="foto">Foto del Modelo:</label>
            <input type="file" name="foto" id="foto">
            <p>Foto actual:</p>
            <img src="<?php echo $model['Foto']; ?>" alt="Foto del Modelo" class="model-photo">

            <button type="submit">Guardar Cambios</button>
            <button type="button" onclick="window.location.href='models.php';">Cancelar</button>
        </form>
    </div>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
