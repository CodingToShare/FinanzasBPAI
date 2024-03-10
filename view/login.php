<?php
session_start();
include '../db/ConnectionDb.php'; // Incluye tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        $_SESSION['correo'] = $correo;
        header("location: table.php"); // Redirige al usuario al index
    } else {
        // Inicio de sesión fallido
        $error = "Correo o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../src/css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    
    <header>
        <div class="custom-header d-flex">
            <div class="custom-header-left d-flex flex-grow-1">
                <a href="../index.php">
                    <div class="d-flex align-items-center">
                        <img class="ms-5" src="../src/img/LogoIFI.PNG" alt="" style="height: 60px;">
                        <img class="ms-3" src="../src/img/LogoIFI_Text.PNG" alt="" style="height: 30px;">
                    </div>
                </a> 
            </div>
            <div class="d-none d-md-flex w-50 h-100 justify-content-between">
                <div>
                    <img src="../src/img/header-angled-shape.svg" class="h-100">
                </div>
                <div class="d-flex align-items-center">
                    <img class="me-5" src="../src/img/logo-web-insolvencia-colombia-small.webp" alt="">
                </div>
            </div>
        </div>
    </header>
<body>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <center>
        <div class="container mt-4">
            <h2 class="orange bold text-center">Login</h2>
            <form action="" method="post">
                <label for="correo">Correo</label><br>
                <input class="w-50" type="email" id="correo" name="correo" required><br>
                <label for="contraseña">Contraseña</label><br>
                <input class="w-50" type="password" id="contraseña" name="contraseña" required><br><br>
                <input type="submit" class="icon-button filled w-50" value="Iniciar sesión">
            </form>
        </div>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
