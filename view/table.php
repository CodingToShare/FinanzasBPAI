<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("location: login.php"); // Redirige al usuario al formulario de login si no ha iniciado sesión
    exit();
}

// Incluir el archivo de conexión a la base de datos
include '../db/ConnectionDb.php';

// Realizar una consulta a la base de datos para obtener los datos de la tabla datos_formulario
$sql = "SELECT id, docNumber, docType, name, lastName, email, estado FROM datos_formulario";
$resultado = $conn->query($sql);

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
    <center>
        <div class="container mt-4">
            <h2 class="orange bold text-center">Tabla</h2>
            <br>
            <input type="text" id="filtro" placeholder="Buscar...">
            <br><br>
            <table class="table" id="tabla-datos">
                <thead>
                  <tr>
                    <th scope="col">Documento</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    // Recorrer los resultados de la consulta y mostrar cada fila en la tabla
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $fila["docType"] . " " . $fila["docNumber"] . "</th>";
                            echo "<td>" . $fila["name"] . "</td>";
                            echo "<td>" . $fila["lastName"] . "</td>";
                            echo "<td>" . $fila["email"] . "</td>";
                            echo "<td>" . $fila["estado"] . "</td>";
                            echo "<td>";
                            // Mostrar botones según el estado
                            if ($fila["estado"] == "en revisión") {
                                echo "<button class='add-btn icon-button filled' data-id='" . $fila['id'] . "'>";
                                echo "<span class='material-symbols-rounded'>add</span>";
                                echo "</button>";
                            } elseif ($fila["estado"] == "revisado") {
                                // Mostrar el segundo botón si el estado es "revisado"
                                echo "<button class='add-btn icon-button filled' data-id='" . $fila['id'] . "'>";
                                echo "<span class='material-symbols-rounded'>add</span>";
                                echo "</button>";                    
                                echo "<button class='export-btn icon-button filled' data-id='" . $fila['id'] . "'>";
                                echo "<span class='material-symbols-rounded'>export_notes</span>";
                                echo "</button>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No se encontraron datos</td></tr>";
                    }
                    ?>
                </tbody>
              </table>
        </div>
    </center>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const botonesExport = document.querySelectorAll('.export-btn');

            botonesExport.forEach(boton => {
                boton.addEventListener('click', function () {
                    const idRegistro = boton.getAttribute('data-id');
                    const jsonData = obtenerJSONPorID(idRegistro);
                });
            });

            function obtenerJSONPorID(idRegistro) {
                window.location.href = '../php/exportExcel.php?id=' + idRegistro;
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const filtro = document.getElementById('filtro');
            const tabla = document.getElementById('tabla-datos').getElementsByTagName('tbody')[0];
            const filas = tabla.getElementsByTagName('tr');

            filtro.addEventListener('input', function () {
                const texto = filtro.value.toLowerCase();
                for (let i = 0; i < filas.length; i++) {
                    const datos = filas[i].getElementsByTagName('td');
                    const encabezados = filas[i].getElementsByTagName('th');
                    let coincidencia = false;
                    for (let j = 0; j < datos.length; j++) {
                        if (datos[j].textContent.toLowerCase().includes(texto)) {
                            coincidencia = true;
                            break;
                        }
                    }
                    if (!coincidencia) {
                        for (let j = 0; j < encabezados.length; j++) {
                            if (encabezados[j].textContent.toLowerCase().includes(texto)) {
                                coincidencia = true;
                                break;
                            }
                        }
                    }
                    filas[i].style.display = coincidencia ? '' : 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const botonesAdd = document.querySelectorAll('.add-btn');

            botonesAdd.forEach(boton => {
                boton.addEventListener('click', function () {
                    const idRegistro = boton.getAttribute('data-id');
                    window.location.href = 'formulario.php?id=' + idRegistro;
                });
            });
        });
    </script>
</body>
</html>

