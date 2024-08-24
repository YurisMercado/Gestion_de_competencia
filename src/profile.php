<?php
// profile.php

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
include '../conexion.php';

// Obtener los datos del usuario desde la sesión
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Perfil de Usuario - Erost</title>
</head>
<body>
    <div class="container">
        <h2>Perfil de Usuario</h2>
        <p><strong>Nombre:</strong> <?php echo $user_name; ?></p>
        <p><strong>Email:</strong> <?php echo $user_email; ?></p>

        <h3>Cambiar Contraseña</h3>
        <form action="change_password.php" method="POST">
            <input type="password" name="current_password" placeholder="Contraseña Actual" required>
            <input type="password" name="new_password" placeholder="Nueva Contraseña" required>
            <button type="submit">Cambiar Contraseña</button>
        </form>

        <br>
        <button onclic
