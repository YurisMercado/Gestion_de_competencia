<?php
// Datos de la conexión
$servername = "localhost";
$username = "root";         // Usualmente es 'root' en XAMPP
$password = "";             // Deja vacío si no tienes una contraseña para 'root'
$dbname = "gcl";            // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
