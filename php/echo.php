<?php
// Incluir el archivo de conexión a la base de datos
include '../db/ConnectionDb.php';

// Obtener el JSON enviado desde el formulario
$json = file_get_contents('php://input');

// Decodificar el JSON a un array asociativo
$data = json_decode($json, true);

// Procesar los datos de personalInfo
$docNumber = $data['personalInfo']['docNumber'];
$docType = $data['personalInfo']['docType'];
$name = $data['personalInfo']['name'];
$lastName = $data['personalInfo']['lastName'];
$email = $data['personalInfo']['email'];
$telefono = $data['personalInfo']['phone'];

// Procesar los datos y guardar el JSON completo en la base de datos
$sql = "INSERT INTO datos_formulario (json_data, docNumber, docType, name, lastName, email, telefono, estado) 
        VALUES ('$json', '$docNumber', '$docType', '$name', '$lastName', '$email', '$telefono', 'en revisión')";
if ($conn->query($sql) === TRUE) {
    $response = ['message' => 'Datos guardados correctamente en la base de datos'];
    echo json_encode($response);
} else {
    $response = ['error' => 'Error al guardar los datos en la base de datos'];
    echo json_encode($response);
}

// Cerrar conexión
$conn->close();
?>
