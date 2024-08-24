<!-- login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Iniciar Sesión - Erost</title>
</head>
<body>
    <div class="container">
    <img src="../assets/LOGO EROST.jpg" alt="Logo de Erost" class="logo">

        <h2>Iniciar Sesión</h2>
        <form action="login_process.php" method="POST">
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <button onclick="window.location.href='register.php';" type="button">Registrarse</button>
        </form>
    </div>
</body>
</html>
