<?php
// view_model.php

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

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Detalles del Modelo - Erost</title>
</head>
<body>
    <div class="container">
        <h2>Detalles del Modelo</h2>
        <img src="<?php echo $model['Foto']; ?>" alt="Foto del Modelo" class="model-photo">
        <p><strong>Nombre:</strong> <?php echo $model['Nombre']; ?></p>
        <p><strong>Edad:</strong> <?php echo $model['Edad']; ?></p>
        <p><strong>Email:</strong> <?php echo $model['Email']; ?></p>

        <h3>Competencias del Modelo</h3>
        <ul>
            <li><strong>Habilidades:</strong> Ejemplo de habilidad</li>
            <li><strong>Conocimientos:</strong> Ejemplo de conocimiento</li>
            <li><strong>Actitudes:</strong> Ejemplo de actitud</li>
        </ul>

        <button onclick="if(confirm('¿Estás seguro de que deseas eliminar este modelo?')) { window.location.href='delete_model.php?id=<?php echo $model_id; ?>'; }">Eliminar Modelo</button>

    </div>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
