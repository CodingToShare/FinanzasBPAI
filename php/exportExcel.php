<?php
// Incluir el archivo de conexión a la base de datos
include '../db/ConnectionDb.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idRegistro = $_GET['id'];

    // Realizar una consulta para obtener los datos del registro por su ID
    $consulta = "SELECT json_data FROM datos_formulario WHERE id = ?";
    $statement = $conn->prepare($consulta);
    $statement->bind_param("i", $idRegistro);
    $statement->execute();
    $statement->store_result();


    // Verificar si se encontró algún registro con el ID proporcionado
    if ($statement->num_rows > 0) {
        // Obtener los datos del registro en formato JSON
        $statement->bind_result($json_data);
        $statement->fetch();
    } else {
        // Si no se encontró ningún registro, devolver un mensaje de error
        echo json_encode(array("error" => "No se encontró ningún registro con el ID proporcionado"));
    }

    // Cerrar la conexión y liberar los recursos
    $statement->close();
    $conn->close();
} else {
    // Si no se proporcionó el ID del registro, devolver un mensaje de error
    echo json_encode(array("error" => "ID de registro no proporcionado"));
}

// Decode JSON data
$data = json_decode($json_data, true);

// Define file path
$file_path = 'personal_finance_data.csv';

// Open file for writing
$file = fopen($file_path, 'w');

// Write personal info
foreach ($data['personalInfo'] as $key => $value) {
    fputcsv($file, array($key, $value));
}

// Write incomes
foreach ($data['incomes'] as $income) {
    foreach ($income as $key => $value) {
        fputcsv($file, array($key, $value));
    }
}

// Write expenses
foreach ($data['expenses'] as $expense) {
    foreach ($expense as $key => $value) {
        fputcsv($file, array($key, $value));
    }
}

// Write debts
foreach ($data['debts'] as $debt) {
    foreach ($debt as $key => $value) {
        fputcsv($file, array($key, $value));
    }
}

// Write assets
foreach ($data['assets'] as $asset) {
    foreach ($asset as $key => $value) {
        fputcsv($file, array($key, $value));
    }
}

// Close file
fclose($file);

// Send headers to download the CSV file
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=personal_finance_data.csv');
header('Pragma: no-cache');
readfile($file_path);

// Delete the CSV file
unlink($file_path);

?>