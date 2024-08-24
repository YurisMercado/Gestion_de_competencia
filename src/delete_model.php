<?php
// delete_model.php

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

// Eliminar el modelo de la base de datos
$query = "DELETE FROM empleado_modelo WHERE ID='$model_id'";

if ($conn->query($query) === TRUE) {
    echo "Modelo eliminado exitosamente. <a href='models.php'>Volver a la lista</a>";
} else {
    echo "Error al eliminar el modelo: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
