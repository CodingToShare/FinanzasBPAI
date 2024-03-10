<?php
$servername = "localhost:3308"; // Cambia localhost por la dirección del servidor si es diferente
$username = "administrador"; // Cambia tu_usuario por el nombre de usuario de MySQL
$password = 'Pa$$w0rd1'; // Cambia tu_contraseña por la contraseña de MySQL
$dbname = "finanzasbpai"; // Cambia nombre_de_tu_base_de_datos por el nombre de la base de datos que creaste

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
