<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("location: login.php"); // Redirige al usuario al formulario de login si no ha iniciado sesión
    exit();
}

// Incluye tu archivo de conexión
include '../db/ConnectionDb.php';

if (isset($_GET['id'])) {
    // Obtener el ID del registro de la URL
    $idRegistro = $_GET['id'];

    // Realizar la consulta SQL para obtener la fila correspondiente al ID proporcionado
    $consulta = "SELECT json_data FROM datos_formulario WHERE id = ?";

    // Preparar la consulta
    $statement = $conn->prepare($consulta);

    // Vincular el parámetro ID a la consulta
    $statement->bind_param("i", $idRegistro);

    // Ejecutar la consulta
    $statement->execute();

    // Obtener el resultado de la consulta
    $resultado = $statement->get_result();

    // Verificar si se encontró la fila
    if ($resultado->num_rows > 0) {
        // Obtener la fila como un arreglo asociativo
        $fila = $resultado->fetch_assoc();

        // Obtener el JSON de la columna json_data
        $json_data = $fila['json_data'];

        // Decodificar el JSON para obtener un arreglo asociativo
        $datos = json_decode($json_data, true);

        // Ahora puedes acceder a los datos como un arreglo asociativo y usarlos en tu formulario
        // Por ejemplo:
        // $datos['personalInfo']['docType']
        // $datos['personalInfo']['docNumber']
        // $datos['incomes'][0]['name']
        // etc.

    } else {
        echo "No se encontró ningún registro con el ID proporcionado.";
    }
    // Liberar el resultado y cerrar la conexión
    $statement->close();
} else {
    echo "No se proporcionó ningún ID en la URL.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodifica los datos JSON recibidos
    $requestData = json_decode(file_get_contents("php://input"), true);

    // Obtiene el ID del registro y los datos del formulario
    $idRegistro = isset($_POST['id']) ? $_POST['id'] : null;
    $formData = isset($_POST['json']) ? $_POST['json'] : null;
    // Extrae el estado del formData
    $estado = "revisado";

    echo "<script>console.log('Console: " . $formData . "' );</script>";

    // Realiza la actualización en la base de datos
    $consulta = "UPDATE datos_formulario SET json_data = ?, estado = ? WHERE id = ?";
    $statement = $conn->prepare($consulta);
    $statement->bind_param("ssi", $formData, $estado, $idRegistro);
    
    
    
    $statement->execute();

    // Verifica si la actualización fue exitosa
    if ($statement->affected_rows > 0) {
        // Redirecciona al usuario a table.php
        header("Location: ../View/table.php");
        exit(); // Asegura que no haya más salida después de la redirección
    } else {
        echo "Error al actualizar el registro";
    }

    // Cierra la conexión y libera recursos
    $statement->close();
    $conn->close();
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
        <center>
            <div class="container mt-4">
                <h2 class="orange bold text-center">Formulario</h2>
                <br>
                <!-- Personal Info -->
                <form id="formulario" action="" method="post"> 
                    <input type="hidden" name="id" value="<?php echo $idRegistro; ?>">
                    <input type="hidden" id="json" name="json" value="">

                    <label class="gray col-md-12" for="docType">Tipo de Documento</label>
                    <input class="w-50" type="text" id="docType" name="docType" value="<?php echo $datos['personalInfo']['docType']; ?>"><br><br>
                    
                    <label class="gray col-md-12" for="docNumber">Número de Documento</label>
                    <input class="w-50" type="text" id="docNumber" name="docNumber" value="<?php echo $datos['personalInfo']['docNumber']; ?>"><br><br>
                    
                    <label class="gray col-md-12" for="name">Nombres</label>
                    <input class="w-50" type="text" id="name" name="name" value="<?php echo $datos['personalInfo']['name']; ?>"><br><br>
                    
                    <label class="gray col-md-12" for="lastName">Apellidos</label>
                    <input class="w-50" type="text" id="lastName" name="lastName" value="<?php echo $datos['personalInfo']['lastName']; ?>"><br><br>
                    
                    <label class="gray col-md-12" for="email">Correo Electrónico</label>
                    <input class="w-50" type="text" id="email" name="email" value="<?php echo $datos['personalInfo']['email']; ?>"><br><br>
                    
                    <label class="gray col-md-12" for="phone">Teléfono</label>
                    <input class="w-50" type="text" id="phone" name="phone" value="<?php echo $datos['personalInfo']['phone']; ?>"><br><br>
                    
                    <!-- Incomes -->
                    <h3 class="ps-3 bold">Ingresos</h3>
                    <br>
                    <?php foreach ($datos['incomes'] as $ingreso): ?>
                        <label class="gray col-md-12" for="income_<?php echo $ingreso['name']; ?>"><?php echo $ingreso['name']; ?>:</label>
                        <input class="w-50" type="text" id="income_<?php echo $ingreso['name']; ?>" name="income_<?php echo $ingreso['name']; ?>" value="<?php echo $ingreso['value']; ?>"><br><br>
                    <?php endforeach; ?>

                    <!-- Expenses -->
                    <h3 class="ps-3 bold">Gastos</h3>
                    <br>
                    <?php foreach ($datos['expenses'] as $gasto): ?>
                        <label class="gray col-md-12" for="expense_<?php echo $gasto['name']; ?>"><?php echo $gasto['name']; ?>:</label>
                        <input class="w-50" type="text" id="expense_<?php echo $gasto['name']; ?>" name="expense_<?php echo $gasto['name']; ?>" value="<?php echo $gasto['value']; ?>"><br><br>
                    <?php endforeach; ?>

                    <!-- Debts -->
                    <h3 class="ps-3 bold">Deudas</h3>
                    <br>
                    <?php foreach ($datos['debts'] as $deuda): ?>
                        <label class="gray col-md-12" for="entity<?php echo $deuda['entity']; ?>">Entidad</label>
                        <input class="w-50" type="text" id="entity<?php echo $deuda['entity']; ?>" name="entity<?php echo $deuda['entity']; ?>" value="<?php echo $deuda['entity']; ?>"><br><br>

                        <label class="gray col-md-12" for="productType<?php echo $deuda['productType']; ?>">Tipo de producto</label>
                        <input class="w-50" type="text" id="productType<?php echo $deuda['productType']; ?>" name="productType<?php echo $deuda['productType']; ?>" value="<?php echo $deuda['productType']; ?>"><br><br>

                        <label class="gray col-md-12" for="guarantyType<?php echo $deuda['guarantyType']; ?>">Tipo de garantia</label>
                        <input class="w-50" type="text" id="guarantyType<?php echo $deuda['guarantyType']; ?>" name="guarantyType<?php echo $deuda['guarantyType']; ?>" value="<?php echo $deuda['guarantyType']; ?>"><br><br>

                        <label class="gray col-md-12" for="capital<?php echo $deuda['capital']; ?>">Capital</label>
                        <input class="w-50" type="text" id="capital<?php echo $deuda['capital']; ?>" name="capital<?php echo $deuda['capital']; ?>" value="<?php echo $deuda['capital']; ?>"><br><br>
                    
                        <label class="gray col-md-12" for="interest<?php echo $deuda['interest']; ?>">Intereses</label>
                        <input class="w-50" type="text" id="interest<?php echo $deuda['interest']; ?>" name="interest<?php echo $deuda['interest']; ?>" value="<?php echo $deuda['interest']; ?>"><br><br>

                        <label class="gray col-md-12" for="capitalPlusInteres<?php echo $deuda['capitalPlusInteres']; ?>">Capital e intereses</label>
                        <input class="w-50" type="text" id="capitalPlusInteres<?php echo $deuda['capitalPlusInteres']; ?>" name="capitalPlusInteres<?php echo $deuda['capitalPlusInteres']; ?>" value="<?php echo $deuda['capitalPlusInteres']; ?>"><br><br>

                        <label class="gray col-md-12" for="arrears<?php echo $deuda['arrears']; ?>">Altura mora</label>
                        <input class="w-50" type="text" id="arrears<?php echo $deuda['arrears']; ?>" name="arrears<?php echo $deuda['arrears']; ?>" value="<?php echo $deuda['arrears']; ?>"><br><br>

                        <label class="gray col-md-12" for="percentWeight<?php echo $deuda['percentWeight']; ?>">Peso porcentual capital</label>
                        <input class="w-50" type="text" id="percentWeight<?php echo $deuda['percentWeight']; ?>" name="percentWeight<?php echo $deuda['percentWeight']; ?>" value="<?php echo $deuda['percentWeight']; ?>"><br><br>

                        <label class="gray col-md-12" for="fee<?php echo $deuda['fee']; ?>">Cuota</label>
                        <input class="w-50" type="text" id="fee<?php echo $deuda['fee']; ?>" name="fee<?php echo $deuda['fee']; ?>" value="<?php echo $deuda['fee']; ?>"><br><br>

                        <label class="gray col-md-12" for="idProduct<?php echo $deuda['idProduct']; ?>">ID Producto</label>
                        <input class="w-50" type="text" id="idProduct<?php echo $deuda['idProduct']; ?>" name="idProduct<?php echo $deuda['idProduct']; ?>" value="<?php echo $deuda['idProduct']; ?>"><br><br>
                    
                        <label class="gray col-md-12" for="reconciledCapital<?php echo $deuda['reconciledCapital']; ?>">Capital Conciliado</label>
                        <input class="w-50" type="text" id="reconciledCapital<?php echo $deuda['reconciledCapital']; ?>" name="reconciledCapital<?php echo $deuda['reconciledCapital']; ?>" value="<?php echo $deuda['reconciledCapital']; ?>"><br><br>
                        
                        <label class="gray col-md-12" for="vote<?php echo $deuda['vote']; ?>">Voto</label>
                        <select class="w-50" id="vote<?php echo $deuda['vote']; ?>" name="vote<?php echo $deuda['vote']; ?>" value="<?php echo $deuda['vote']; ?>"><br><br>
                            <option value="null">Seleccione una opcion...</option>
                            <option value="Positivo">Positivo</option>
                            <option value="Negativo">Negativo</option>
                            <option value="No asistio">No asistio</option>
                            <option value="No voto">No voto</option>
                            <option value="Otro">Otro</option>
                        </select>

                        <label class="gray col-md-12" for="class<?php echo $deuda['class']; ?>">Clase</label>
                        <select class="w-50" id="class<?php echo $deuda['class']; ?>" name="class<?php echo $deuda['class']; ?>" value="<?php echo $deuda['class']; ?>"><br><br>
                            <option value="null">Seleccione una opcion...</option>
                            <option value="PRIMERA CLASE">PRIMERA CLASE</option>
                            <option value="SEGUNDA CLASE">SEGUNDA CLASE</option>
                            <option value="TERCERA CLASE">TERCERA CLASE</option>
                            <option value="CUARTA CLASE">CUARTA CLASE</option>
                            <option value="QUINTA CLASE">QUINTA CLASE</option>
                            <option value=" EN DISPUTA"> EN DISPUTA</option>
                            <option value="OTRA CLASE">OTRA CLASE</option>
                        </select>
                        
                        <label class="gray col-md-12" for="ic<?php echo $deuda['ic']; ?>">IC</label>
                        <input class="w-50" type="text" id="ic<?php echo $deuda['ic']; ?>" name="ic<?php echo $deuda['ic']; ?>" value="<?php echo $deuda['ic']; ?>"><br><br>

                        <label class="gray col-md-12" for="im<?php echo $deuda['im']; ?>">IM</label>
                        <input class="w-50" type="text" id="im<?php echo $deuda['im']; ?>" name="im<?php echo $deuda['im']; ?>" value="<?php echo $deuda['im']; ?>"><br><br>
                    <?php endforeach; ?>

                    <!-- Assets -->
                    <h3 class="ps-3 bold">Activos</h3>
                    <br>
                    <?php foreach ($datos['assets'] as $activo): ?>
                        <label class="gray col-md-12" for="asset<?php echo $activo['asset']; ?>">Patrimonio</label>
                        <input class="w-50" type="text" id="asset<?php echo $activo['asset']; ?>" name="asset<?php echo $activo['asset']; ?>" value="<?php echo $activo['asset']; ?>"><br><br>

                        <label class="gray col-md-12" for="assetType<?php echo $activo['assetType']; ?>">Tipo de patrimonio</label>
                        <input class="w-50" type="text" id="assetType<?php echo $activo['assetType']; ?>" name="assetType<?php echo $activo['assetType']; ?>" value="<?php echo $activo['assetType']; ?>"><br><br>

                        <label class="gray col-md-12" for="effectsType<?php echo $activo['effectsType']; ?>">Afectaciones</label>
                        <input class="w-50" type="text" id="effectsType<?php echo $activo['effectsType']; ?>" name="effectsType<?php echo $activo['effectsType']; ?>" value="<?php echo $activo['effectsType']; ?>"><br><br>

                        <label class="gray col-md-12" for="appraisal<?php echo $activo['appraisal']; ?>">Avalúo comercial</label>
                        <input class="w-50" type="text" id="appraisal<?php echo $activo['appraisal']; ?>" name="appraisal<?php echo $activo['appraisal']; ?>" value="<?php echo $activo['appraisal']; ?>"><br><br>

                        <label class="gray col-md-12" for="propertyPercent<?php echo $activo['propertyPercent']; ?>">Porcentaje propiedad</label>
                        <input class="w-50" type="text" id="propertyPercent<?php echo $activo['propertyPercent']; ?>" name="propertyPercent<?php echo $activo['propertyPercent']; ?>" value="<?php echo $activo['propertyPercent']; ?>"><br><br>
                    <?php endforeach; ?>

                    <input id="guardarBtn" class="guardarBtn icon-button filled w-50" type="submit" value="Guardar" onclick="save()">

                    <br>
                </form>
            </div>
        </center>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

        <script>
            // Define la estructura de datos con los valores PHP proporcionados
            var datos = <?php echo json_encode($datos); ?>;
            
            // Define una función para generar el objeto JSON
            function generarJSON() {
                var formData = {};
                // Recorre los datos y agrega los valores al objeto formData
                formData.personalInfo = {
                    docType: document.getElementById('docType').value,
                    docNumber: document.getElementById('docNumber').value,
                    name: document.getElementById('name').value,
                    lastName: document.getElementById('lastName').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value
                };

                // Recorre los ingresos y agrega los valores al objeto formData
                formData.incomes = [];
                <?php foreach ($datos['incomes'] as $ingreso): ?>
                    formData.incomes.push({
                        name: '<?php echo $ingreso['name']; ?>',
                        value: document.getElementById('income_<?php echo $ingreso['name']; ?>').value
                    });
                <?php endforeach; ?>

                // Recorre los gastos y agrega los valores al objeto formData
                formData.expenses = [];
                <?php foreach ($datos['expenses'] as $gasto): ?>
                    formData.expenses.push({
                        name: '<?php echo $gasto['name']; ?>',
                        value: document.getElementById('expense_<?php echo $gasto['name']; ?>').value
                    });
                <?php endforeach; ?>

                                // Recorre las deudas y agrega los valores al objeto formData
                                formData.debts = [];
                <?php foreach ($datos['debts'] as $deuda): ?>
                    formData.debts.push({
                        entity: document.getElementById('entity<?php echo $deuda['entity']; ?>').value,
                        productType: document.getElementById('productType<?php echo $deuda['productType']; ?>').value,
                        guarantyType: document.getElementById('guarantyType<?php echo $deuda['guarantyType']; ?>').value,
                        capital: document.getElementById('capital<?php echo $deuda['capital']; ?>').value,
                        interest: document.getElementById('interest<?php echo $deuda['interest']; ?>').value,
                        capitalPlusInteres: document.getElementById('capitalPlusInteres<?php echo $deuda['capitalPlusInteres']; ?>').value,
                        arrears: document.getElementById('arrears<?php echo $deuda['arrears']; ?>').value,
                        percentWeight: document.getElementById('percentWeight<?php echo $deuda['percentWeight']; ?>').value,
                        fee: document.getElementById('fee<?php echo $deuda['fee']; ?>').value,
                        idProduct: document.getElementById('idProduct<?php echo $deuda['idProduct']; ?>').value,
                        reconciledCapital: document.getElementById('reconciledCapital<?php echo $deuda['reconciledCapital']; ?>').value,
                        vote: document.getElementById('vote<?php echo $deuda['vote']; ?>').value,
                        class: document.getElementById('class<?php echo $deuda['class']; ?>').value,
                        ic: document.getElementById('ic<?php echo $deuda['ic']; ?>').value,
                        im: document.getElementById('im<?php echo $deuda['im']; ?>').value,
                        // Agrega los demás campos de deudas aquí
                    });
                <?php endforeach; ?>

                // Recorre los activos y agrega los valores al objeto formData
                formData.assets = [];
                <?php foreach ($datos['assets'] as $activo): ?>
                    formData.assets.push({
                        asset: document.getElementById('asset<?php echo $activo['asset']; ?>').value,
                        assetType: document.getElementById('assetType<?php echo $activo['assetType']; ?>').value,
                        effectsType: document.getElementById('effectsType<?php echo $activo['effectsType']; ?>').value,
                        appraisal: document.getElementById('appraisal<?php echo $activo['appraisal']; ?>').value,
                        propertyPercent: document.getElementById('propertyPercent<?php echo $activo['propertyPercent']; ?>').value,
                        // Agrega los demás campos de activos aquí
                    });
                <?php endforeach; ?>

                // Convierte el objeto formData a JSON
                var jsonData = JSON.stringify(formData);
                return jsonData;
            }

            // Agrega un evento de clic al botón de guardar formulario
            function save(){
                var jsonData = generarJSON();
                var idRegistro = <?php echo isset($_GET['id']) ? $_GET['id'] : 'null'; ?>;

                document.getElementById("json").value = jsonData;


                console.log(jsonData);
                console.log(idRegistro);
            }
        </script>

    </body>
</html>
