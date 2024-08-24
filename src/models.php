<?php
// models.php

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
include '../conexion.php';

// Obtener la lista de modelos desde la base de datos
$query = "SELECT * FROM empleado_modelo";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Gestión de Modelos - Erost</title>
</head>
<body>
    <div class="container">
        <h2>Modelos Registrados</h2>
        <ul>
            <?php
            if ($result->num_rows > 0) {
                while ($model = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<strong>" . $model['Nombre'] . "</strong>";
                    echo " - " . $model['Email'];
                    echo " - <a href='view_model.php?id=" . $model['ID'] . "'>Ver</a>";
                    echo "</li>";
                }
            } else {
                echo "<p>No hay modelos registrados.</p>";
            }
            ?>
        </ul>

        <button onclick="window.location.href='add_model.php';">Agregar Modelo</button>
        <button onclick="window.location.href='profile.php';">Volver al Perfil</button>
    </div>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
