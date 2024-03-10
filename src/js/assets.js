const addAssetsButton = document.getElementById('addAssetsBtn');
const additionalAssetsItems = document.getElementById('additionalAssetsItems');

let assets = [];
let actualAssetsCounter = 0;

addAssetsButton.addEventListener('click', () => {
    addAsset();
});

function addAsset() {

    const containerName = 'dynAssetContainer' + actualAssetsCounter;
    const assetName = 'dynAssetName' + actualAssetsCounter;
    const assetTypeName = 'dynAssetType' + actualAssetsCounter;
    const effectsTypeName = 'dynAssetEffectsType' + actualAssetsCounter;
    const appraisalName = 'dynAssetAppraisal' + actualAssetsCounter;
    const propertyPercentName = 'dynAssetPropertyPercentage' + actualAssetsCounter;
    const removeBtnName = 'dynAssetRemoveBtn' + actualAssetsCounter;
    const counterID = actualAssetsCounter;

    assets.push({
        asset: '',
        assetType: '',
        effectsType: '',
        appraisal: 0,
        propertyPercent: 0,
        containerName: containerName,
        counterID: counterID
    });

    const templateString = `<div id="${containerName}" class="d-flex flex-wrap debt-container"><div class="row flex-grow-1"><div class="col-12 col-md-6 mb-2"><label class="gray">Patrimonio</label><input id="${assetName}" class="w-100" type="text"></div><div class="col-12 col-md-6 mb-2"><label class="gray">Tipo de patrimonio</label><select id="${assetTypeName}" class="form-select w-100"><option value="null">Seleccione una opcion...</option><option value="Vivienda">Vivienda</option><option value="Vehiculo">Vehiculo</option><option value="Moto">Moto</option><option value="Bodega">Bodega</option><option value="Lote">Lote</option><option value="Inversiones/Criptomonedas">Inversiones/Criptomonedas</option><option value="Otros">Otros</option></select></div><div class="col-12 col-md-6 mb-2"><label class="gray">Afectaciones</label><select id="${effectsTypeName}" class="form-select w-100"><option value="null">Seleccione una opcion...</option><option value="Ninguno">Ninguno</option><option value="Patrimonio de familia">Patrimonio de familia</option><option value="Vivienda familiar">Vivienda familiar</option><option value="Fideicomiso">Fideicomiso</option><option value="Prenda/Garantia mobiliaria">Prenda/Garantia mobiliaria</option></select></div><div class="col-12 col-md-6 mb-2"><label class="gray">Avalúo comercial</label><input id="${appraisalName}" class="w-100" type="number"></div><div class="col-12 col-md-6 mb-2"><label class="gray">Porcentaje propiedad</label><input id="${propertyPercentName}" class="w-100" type="number" min="0" max="100"></div></div><div class="w-100 center-content mt-2"><button id="${removeBtnName}" class="icon-button filled"><span class="material-symbols-rounded">close</span></button></div></div>`;

    const template = document.createElement('template');
    template.innerHTML = templateString;

    additionalAssetsItems.append(template.content.children[0]);

    const dynAssetInput = document.getElementById(assetName);
    const dynAssetTypeInput = document.getElementById(assetTypeName);
    const dynEffectsTypeInput = document.getElementById(effectsTypeName);
    const dynAppraisalInput = document.getElementById(appraisalName);
    const dynPropertyPercentInput = document.getElementById(propertyPercentName);

    dynAssetInput.addEventListener('input', () => {
        updateAsset(counterID, containerName);
    });

    dynAssetTypeInput.addEventListener('input', () => {
        updateAsset(counterID, containerName);
    });

    dynEffectsTypeInput.addEventListener('input', () => {
        updateAsset(counterID, containerName);
    });

    dynAppraisalInput.addEventListener('input', () => {
        updateAsset(counterID, containerName);
    });

    dynPropertyPercentInput.addEventListener('input', () => {
        updateAsset(counterID, containerName);
    });

    const dynRemoveButton = document.getElementById(removeBtnName);

    dynRemoveButton.addEventListener('click', () => {
        removeAsset(containerName);
    });

    actualAssetsCounter++;
}

function updateAsset(counter, containerName) {
    const item = assets.find(x => x.containerName == containerName);

    if (item == null)
        return;

    const assetName = 'dynAssetName' + counter;
    const assetTypeName = 'dynAssetType' + counter;
    const effectsTypeName = 'dynAssetEffectsType' + counter;
    const appraisalName = 'dynAssetAppraisal' + counter;
    const propertyPercentName = 'dynAssetPropertyPercentage' + counter;

    const dynAssetInput = document.getElementById(assetName);
    const dynAssetTypeInput = document.getElementById(assetTypeName);
    const dynEffectsTypeInput = document.getElementById(effectsTypeName);
    const dynAppraisalInput = document.getElementById(appraisalName);
    const dynPropertyPercentInput = document.getElementById(propertyPercentName);

    item.asset = dynAssetInput.value
    item.assetType = dynAssetTypeInput.value
    item.effectsType = dynEffectsTypeInput.value
    item.appraisal = dynAppraisalInput.value
    item.propertyPercent = dynPropertyPercentInput.value
}

function removeAsset(containerName) {
    const dynContainer = document.getElementById(containerName);
    dynContainer.remove();

    assets = assets.filter(x => x.containerName != containerName);    
}

function getAssetsData() {

    const data = [];

    for (let asset of assets) {
        data.push({
            asset: asset.asset,
            assetType: asset.assetType,
            effectsType: asset.effectsType,
            appraisal: asset.appraisal,
            propertyPercent: asset.propertyPercent
        });
    }

    return data;
}