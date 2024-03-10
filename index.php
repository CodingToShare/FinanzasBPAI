<?php 
include 'db/ConnectionDb.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/styles.css">
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
            <div class="d-flex align-items-center">
                <img class="ms-5" src="src/img/LogoIFI.PNG" alt="" style="height: 60px;">
                <img class="ms-3" src="src/img/LogoIFI_Text.PNG" alt="" style="height: 30px;">
            </div>
        </div>
        <div class="d-none d-md-flex w-50 h-100 justify-content-between">
            <div>
                <img src="src/img/header-angled-shape.svg" class="h-100">
            </div>
            <div class="d-flex align-items-center">
                <img class="me-5" src="src/img/logo-web-insolvencia-colombia-small.webp" alt="">
            </div>
        </div>
    </div>
</header>

<body>
    <div class="container mt-4">

        <div id="infoSentContainer" class="debt-container d-none">
            <h1 class="bold text-center mb-4">Tus respuestas se han enviado satisfactoriamente</h1>
            <button id="newWizardBtn" class="icon-button filled w-100">
                <p>Agregar una nueva respuesta</p>
            </button>
        </div>

        <div id="wizardContainer" class="d-flex flex-column gap-2">

            <div class="row">
                <div class="d-flex">
                    <div id="step1Indicator" class="step-indicator active center-content">
                        <h1>1</h1>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <h1 class="ps-3 bold">Ingresos</h1>
                    </div>
                </div>
                <div class="collapse show multi-collapse" id="step1">
                    <div class="d-flex mb-3 mt-4">
                        <div class="step-bar-container d-flex justify-content-center align-items-center">
                            <div class="step-bar"></div>
                        </div>
                        <div class="step-body flex-grow-1">
                            <div class="d-flex flex-column gap-3">
                                <h3 class="orange bold text-center">Agrega tus ingresos</h3>
                                <div>
                                    <h3 class="gray">Salario</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeSalario" class="w-100" type="range" min="0" max="10000000"
                                                step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorSalario" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="gray">Honorarios</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeHonorarios" class="w-100" type="range" min="0"
                                                max="10000000" step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorHonorarios" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="gray">Arrendamiento</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeArrendamiento" class="w-100" type="range" min="0"
                                                max="10000000" step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorArrendamiento" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h2 class="bold">Otros ingresos</h2>
                                <div class="d-flex gap-4 mt-3">
                                    <div class="flex-grow-1">
                                        <input id="addIncomeInput" class="w-100" type="text">
                                    </div>
                                    <div>
                                        <button id="addIncomeBtn" class="icon-button filled">
                                            <span class="material-symbols-rounded">
                                                add
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="additionalIncomeItems" class="d-flex flex-column gap-3 mt-4">
                                <!-- <div>
                                    <h3 class="gray">Salario</h3>
                                    <div class="d-flex gap-4">
                                        <div class="d-flex flex-wrap flex-grow-1">
                                            <div class="col-12 col-md-8 center-content range-container">
                                                <input class="w-100" type="range">
                                            </div>
                                            <div class="col-12 col-md-4 d-flex justify-content-end">
                                                <div class="col-12 col-md-11 range-value-indicator center-content">
                                                    <h3 class="white">$ 1.000.000</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="center-content">
                                            <button class="icon-button filled">
                                                <span class="material-symbols-rounded">
                                                    close
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="d-flex justify-content-end gap-4 mt-4">
                                <button id="step1NextBtn" class="icon-button filled" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse" aria-expanded="false">
                                    <span class="material-symbols-rounded">
                                        navigate_next
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="d-flex">
                    <div id="step2Indicator" class="step-indicator center-content">
                        <h1>2</h1>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <h1 class="ps-3 bold">Gastos</h1>
                    </div>
                </div>
                <div class="collapse multi-collapse multi-collapse-2" id="step2">
                    <div class="d-flex mb-4 mt-4">
                        <div class="step-bar-container d-flex justify-content-center align-items-center">
                            <div class="step-bar"></div>
                        </div>
                        <div class="step-body flex-grow-1">
                            <div class="d-flex flex-column gap-3">
                                <h3 class="orange bold text-center">Agrega tus gastos</h3>
                                <div>
                                    <h3 class="gray">Arriendo / Hipoteca</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeArriendo" class="w-100" type="range" min="0" max="10000000"
                                                step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorArriendo" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="gray">Educación</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeEducacion" class="w-100" type="range" min="0" max="10000000"
                                                step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorEducacion" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="gray">Servicios publicos</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeServicios" class="w-100" type="range" min="0" max="10000000"
                                                step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorServicios" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="gray">Alimentación</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeAlimentacion" class="w-100" type="range" min="0"
                                                max="10000000" step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorAlimentacion" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="gray">Seguros</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeSeguros" class="w-100" type="range" min="0" max="10000000"
                                                step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorSeguros" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="gray">Transporte</h3>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-12 col-md-8 center-content range-container">
                                            <input id="rangeTransporte" class="w-100" type="range" min="0"
                                                max="10000000" step="100000">
                                        </div>
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <div class="col-12 col-md-11 range-value-indicator center-content">
                                                <h3 id="indicatorTransporte" class="white">$ 1.000.000</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-4">
                                <h2 class="bold">Otros gastos</h2>
                                <div class="d-flex gap-4 mt-3">
                                    <div class="flex-grow-1">
                                        <input id="addExpenseInput" class="w-100" type="text">
                                    </div>
                                    <div>
                                        <button id="addExpenseBtn" class="icon-button filled">
                                            <span class="material-symbols-rounded">
                                                add
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="additionalExpenseItems" class="d-flex flex-column gap-3 mt-4">
                                <!-- <div>
                                    <h3 class="gray">Alimentación</h3>
                                    <div class="d-flex gap-4">
                                        <div class="d-flex flex-wrap flex-grow-1">
                                            <div class="col-12 col-md-8 center-content range-container">
                                                <input class="w-100" type="range">
                                            </div>
                                            <div class="col-12 col-md-4 d-flex justify-content-end">
                                                <div class="col-12 col-md-11 range-value-indicator center-content">
                                                    <h3 class="white">$ 1.000.000</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="center-content">
                                            <button class="icon-button filled">
                                                <span class="material-symbols-rounded">
                                                    close
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="d-flex justify-content-end gap-4 mt-4">
                                <button id="step2BackBtn" class="icon-button outlined" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse" aria-expanded="false">
                                    <span class="material-symbols-rounded">
                                        navigate_before
                                    </span>
                                </button>
                                <button id="step2NextBtn" class="icon-button filled" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse-2" aria-expanded="false"
                                    aria-controls="step2 step3">
                                    <span class="material-symbols-rounded">
                                        navigate_next
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="d-flex">
                    <div id="step3Indicator" class="step-indicator center-content">
                        <h1>3</h1>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <h1 class="ps-3 bold">Deudas</h1>
                    </div>
                </div>
                <div class="collapse multi-collapse-2 multi-collapse-3" id="step3">
                    <div class="d-flex mb-4 mt-4">
                        <div class="step-bar-container d-flex justify-content-center align-items-center">
                            <div class="step-bar"></div>
                        </div>
                        <div class="step-body flex-grow-1">
                            <div id="additionalDebtItems" class="d-flex flex-column gap-3">
                                <h3 class="orange bold text-center">Agrega tus deudas</h3>
                                <!-- Content here -->

                                <!-- <div class="d-flex flex-wrap debt-container">

                                    <div class="row flex-grow-1">
                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Entidad</label>
                                            <input class="w-100" type="text">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Tipo de producto</label>
                                            <select class="form-select w-100">
                                                <option value="null">Seleccione una opcion...</option>
                                                <option value="Libre destino">Libre destino</option>
                                                <option value="Tarjeta de credito">Tarjeta de crédito</option>
                                                <option value="Credito hipotecario/leasing">Crédito hipotecario/leasing
                                                </option>
                                                <option value="Rotativo">Rotativo</option>
                                                <option value="Educativo">Educativo</option>
                                                <option value="Credito vehicular">Crédito vehicular</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Tipo de garantia</label>
                                            <select class="form-select w-100">
                                                <option value="null">Seleccione una opcion...</option>
                                                <option value="Pagare">Pagaré</option>
                                                <option value="Hipoteca">Hipoteca</option>
                                                <option value="Codeudor/Fiador/Avalista">Codeudor/Fiador/Avalista
                                                </option>
                                                <option value="Garantia mobiliaria">Garantia mobiliaria</option>
                                                <option value="No lo tengo claro">No lo tengo claro</option>
                                                <option value="Sin garantía">Sin garantía</option>
                                                <option value="Leasing">Leasing</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Capital</label>
                                            <input class="w-100" type="number">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Intereses</label>
                                            <input class="w-100" type="number">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Capital e intereses</label>
                                            <input class="w-100" type="text" disabled>
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Altura mora</label>
                                            <input class="w-100" type="text">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Peso porcentual capital</label>
                                            <input class="w-100" type="text" disabled>
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Cuota</label>
                                            <input class="w-100" type="text">
                                        </div>

                                    </div>
                                    <div class="w-100 center-content mt-2">
                                        <button class="icon-button filled">
                                            <span class="material-symbols-rounded">
                                                close
                                            </span>
                                        </button>
                                    </div>

                                </div> -->

                            </div>
                            <div class="mt-4">
                                <button id="addDebtBtn" class="icon-button filled w-100">
                                    <span class="material-symbols-rounded">
                                        add
                                    </span>
                                </button>
                            </div>
                            <div class="d-flex justify-content-end gap-4 mt-4">
                                <button id="step3BackBtn" class="icon-button outlined" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse-2" aria-expanded="false">
                                    <span class="material-symbols-rounded">
                                        navigate_before
                                    </span>
                                </button>
                                <button id="step3NextBtn" class="icon-button filled" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse-3" aria-expanded="false">
                                    <span class="material-symbols-rounded">
                                        navigate_next
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="d-flex">
                    <div id="step4Indicator" class="step-indicator center-content">
                        <h1>4</h1>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <h1 class="ps-3 bold">Patrimonios</h1>
                    </div>
                </div>
                <div class="collapse multi-collapse-3 multi-collapse-4" id="step4">
                    <div class="d-flex mb-4 mt-4">
                        <div class="step-bar-container d-flex justify-content-center align-items-center">
                            <div class="step-bar"></div>
                        </div>
                        <div class="step-body flex-grow-1">
                            <div id="additionalAssetsItems" class="d-flex flex-column gap-3">
                                <h3 class="orange bold text-center">Agrega tus patrimonios</h3>
                                <!-- Content here -->

                                <!-- <div class="d-flex flex-wrap debt-container">

                                    <div class="row flex-grow-1">
                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Patrimonio</label>
                                            <input class="w-100" type="text">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Tipo de patrimonio</label>
                                            <select class="form-select w-100">
                                                <option value="null">Seleccione una opcion...</option>
                                                <option value="Vivienda">Vivienda</option>
                                                <option value="Vehiculo">Vehiculo</option>
                                                <option value="Moto">Moto</option>
                                                <option value="Bodega">Bodega</option>
                                                <option value="Lote">Lote</option>
                                                <option value="Inversiones/Criptomonedas">Inversiones/Criptomonedas</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Afectaciones</label>
                                            <select class="form-select w-100">
                                                <option value="null">Seleccione una opcion...</option>
                                                <option value="Ninguno">Ninguno</option>
                                                <option value="Patrimonio de familia">Patrimonio de familia</option>
                                                <option value="Vivienda familiar">Vivienda familiar</option>
                                                <option value="Fideicomiso">Fideicomiso</option>
                                                <option value="Prenda/Garantia mobiliaria">Prenda/Garantia mobiliaria</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Avalúo comercial</label>
                                            <input class="w-100" type="number">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Porcentaje propiedad</label>
                                            <input class="w-100" type="number" min="0" max="100">
                                        </div>

                                    </div>
                                    <div class="w-100 center-content mt-2">
                                        <button class="icon-button filled">
                                            <span class="material-symbols-rounded">
                                                close
                                            </span>
                                        </button>
                                    </div>

                                </div> -->

                            </div>
                            <div class="mt-4">
                                <button id="addAssetsBtn" class="icon-button filled w-100">
                                    <span class="material-symbols-rounded">
                                        add
                                    </span>
                                </button>
                            </div>
                            <div class="d-flex justify-content-end gap-4 mt-4">
                                <button id="step4BackBtn" class="icon-button outlined" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse-3" aria-expanded="false">
                                    <span class="material-symbols-rounded">
                                        navigate_before
                                    </span>
                                </button>
                                <button id="step4NextBtn" class="icon-button filled" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse-4" aria-expanded="false">
                                    <span class="material-symbols-rounded">
                                        navigate_next
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="d-flex">
                    <div id="step5Indicator" class="step-indicator center-content">
                        <h1>5</h1>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <h1 class="ps-3 bold">Información personal</h1>
                    </div>
                </div>
                <div class="collapse multi-collapse-4" id="step5">
                    <div class="d-flex mb-4 mt-4">
                        <div class="step-bar-container d-flex justify-content-center align-items-center">
                            <div class="step-bar"></div>
                        </div>
                        <div class="step-body flex-grow-1">
                            <div class="d-flex flex-column gap-3">
                                <h3 class="orange bold text-center">Agrega tu información personal</h3>
                                <p class="text-center">Ahora que nos has registrado tu información, cuentanos quien eres
                                    para así avanzar hacía un mejor futuro financiero</p>
                                <!-- Content here -->

                                <div class="d-flex flex-wrap mt-2">

                                    <div class="row flex-grow-1">
                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Tipo de documento</label>
                                            <select id="personalInfodocType" class="form-select w-100">
                                                <option value="null">Seleccione una opcion...</option>
                                                <option value="CC">CC</option>
                                                <option value="CE">CE</option>
                                                <option value="Permiso especial">Permiso especial</option>
                                                <option value="otro">Otro</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Número de documento</label>
                                            <input id="personalInfodocNumber" class="w-100" type="text">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Nombres</label>
                                            <input id="personalInfoName" class="w-100" type="text">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Apellidos</label>
                                            <input id="personalInfoLastName" class="w-100" type="text">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Correo electronico</label>
                                            <input id="personalInfoEmail" class="w-100" type="text">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2">
                                            <label class="gray">Móvil de contacto</label>
                                            <input id="personalInfoPhone" class="w-100" type="text">
                                        </div>

                                    </div>

                                    <div class="d-flex flex-column col-12">
                                        <label class="gray">¿Alguna observación final?</label>
                                        <textarea></textarea>
                                    </div>

                                </div>

                            </div>
                            <div class="mt-4">
                                <button id="sendDataBtn" class="icon-button filled w-100">
                                    <span class="material-symbols-rounded me-3">
                                        send
                                    </span>
                                    <p>Registrar mi información</p>
                                </button>
                            </div>
                            <div class="d-flex justify-content-end gap-4 mt-4">
                                <button id="step5BackBtn" class="icon-button outlined" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse-4" aria-expanded="false">
                                    <span class="material-symbols-rounded">
                                        navigate_before
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="src/js/utils.js"></script>
    <script src="src/js/income.js"></script>
    <script src="src/js/expenses.js"></script>
    <script src="src/js/debts.js"></script>
    <script src="src/js/assets.js"></script>
    <script src="src/js/nav_buttons.js"></script>
    <script src="src/js/data.js"></script>
</body>

</html>