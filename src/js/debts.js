const addDebtButton = document.getElementById('addDebtBtn');
const additionalDebtsItems = document.getElementById('additionalDebtItems');

let debts = [];
let actualCounter = 0;

addDebtButton.addEventListener('click', () => {
    addDebt();
});

function addDebt() {

    const containerName = 'dynDebtContainer' + actualCounter;
    const entityName = 'dynDebtEntity' + actualCounter;
    const productTypeName = 'dynDebtProductType' + actualCounter;
    const guarantyTypeName = 'dynDebtGuarantyType' + actualCounter;
    const capitalName = 'dynDebtCapital' + actualCounter;
    const interestName = 'dynDebtInterest' + actualCounter;
    const capitalPlusInteresName = 'dynDebtCapitalPlusInteres' + actualCounter;
    const arrearsName = 'dynDebtArrears' + actualCounter;
    const percentWeightName = 'dynDebtPercentWeight' + actualCounter;
    const feeName = 'dynDebtFee' + actualCounter;
    const removeBtnName = 'dynDebtRemoveBtn' + actualCounter;
    const counterID = actualCounter;

    debts.push({
        entity: '',
        productType: '',
        guarantyType: '',
        capital: 0,
        interest: 0,
        capitalPlusInteres: 0,
        arrears: '',
        percentWeight: 0,
        fee: 0,
        containerName: containerName,
        counterID: counterID,
        idProduct: null,
        reconciledCapital: null,
        vote: null,
        class: null,
        ic: null,
        im: null,
    });

    const templateString = `<div id="${containerName}" class="d-flex flex-wrap debt-container"><div class="row flex-grow-1"><div class="col-12 col-md-6 mb-2"><label class="gray">Entidad</label><input id="${entityName}" class="w-100" type="text"></div><div class="col-12 col-md-6 mb-2"><label class="gray">Tipo de producto</label><select id="${productTypeName}" class="form-select w-100"><option value="null">Seleccione una opcion...</option><option value="Libre destino">Libre destino</option><option value="Tarjeta de credito">Tarjeta de crédito</option><option value="Credito hipotecario/leasing">Crédito hipotecario/leasing</option><option value="Rotativo">Rotativo</option><option value="Educativo">Educativo</option><option value="Credito vehicular">Crédito vehicular</option></select></div><div class="col-12 col-md-6 mb-2"><label class="gray">Tipo de garantia</label><select id="${guarantyTypeName}" class="form-select w-100"><option value="null">Seleccione una opcion...</option><option value="Pagare">Pagaré</option><option value="Hipoteca">Hipoteca</option><option value="Codeudor/Fiador/Avalista">Codeudor/Fiador/Avalista</option><option value="Garantia mobiliaria">Garantia mobiliaria</option><option value="No lo tengo claro">No lo tengo claro</option><option value="Sin garantía">Sin garantía</option><option value="Leasing">Leasing</option></select></div><div class="col-12 col-md-6 mb-2"><label class="gray">Capital</label><input id="${capitalName}" class="w-100" type="number"></div><div class="col-12 col-md-6 mb-2"><label class="gray">Intereses</label><input id="${interestName}" class="w-100" type="number"></div><div class="col-12 col-md-6 mb-2"><label class="gray">Capital e intereses</label><input id="${capitalPlusInteresName}" class="w-100" type="text" disabled></div><div class="col-12 col-md-6 mb-2"><label class="gray">Altura mora</label><input id="${arrearsName}" class="w-100" type="text"></div><div class="col-12 col-md-6 mb-2"><label class="gray">Peso porcentual capital</label><input id="${percentWeightName}" class="w-100" type="text" disabled></div><div class="col-12 col-md-6 mb-2"><label class="gray">Cuota</label><input id="${feeName}" class="w-100" type="number"></div></div><div class="w-100 center-content mt-2"><button id="${removeBtnName}" class="icon-button filled"><span class="material-symbols-rounded">close</span></button></div></div>`;

    const template = document.createElement('template');
    template.innerHTML = templateString;

    additionalDebtsItems.append(template.content.children[0]);

    const dynEntityInput = document.getElementById(entityName);
    const dynProductTypeInput = document.getElementById(productTypeName);
    const dynGuarantyTypeInput = document.getElementById(guarantyTypeName);
    const dynCapitalInput = document.getElementById(capitalName);
    const dynInterestInput = document.getElementById(interestName);
    const dynCapitalPlusInterestInput = document.getElementById(capitalPlusInteresName);
    const dynArrearsInput = document.getElementById(arrearsName);
    const dynPercentWeightInput = document.getElementById(percentWeightName);
    const dynFeeInput = document.getElementById(feeName);

    dynEntityInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynProductTypeInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynGuarantyTypeInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynCapitalInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynInterestInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynCapitalPlusInterestInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynArrearsInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynPercentWeightInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    dynFeeInput.addEventListener('input', () => {
        updateDebt(counterID, containerName);
    });

    const dynRemoveButton = document.getElementById(removeBtnName);

    dynRemoveButton.addEventListener('click', () => {
        removeDebt(containerName);
    });

    actualCounter++;
}

function updateDebt(counter, containerName) {    
    const item = debts.find(x => x.containerName == containerName);

    if (item == null)
        return;

    const entityName = 'dynDebtEntity' + counter;
    const productTypeName = 'dynDebtProductType' + counter;
    const guarantyTypeName = 'dynDebtGuarantyType' + counter;
    const capitalName = 'dynDebtCapital' + counter;
    const interestName = 'dynDebtInterest' + counter;
    const capitalPlusInteresName = 'dynDebtCapitalPlusInteres' + counter;
    const arrearsName = 'dynDebtArrears' + counter;
    const percentWeightName = 'dynDebtPercentWeight' + counter;
    const feeName = 'dynDebtFee' + counter;

    const dynEntityInput = document.getElementById(entityName);
    const dynProductTypeInput = document.getElementById(productTypeName);
    const dynGuarantyTypeInput = document.getElementById(guarantyTypeName);
    const dynCapitalInput = document.getElementById(capitalName);
    const dynInterestInput = document.getElementById(interestName);
    const dynCapitalPlusInterestInput = document.getElementById(capitalPlusInteresName);
    const dynArrearsInput = document.getElementById(arrearsName);
    const dynPercentWeightInput = document.getElementById(percentWeightName);
    const dynFeeInput = document.getElementById(feeName);

    item.entity = dynEntityInput.value
    item.productType = dynProductTypeInput.value
    item.guarantyType = dynGuarantyTypeInput.value
    item.capital = dynCapitalInput.value
    item.interest = dynInterestInput.value
    item.capitalPlusInteres = Number(dynCapitalInput.value) + Number(dynInterestInput.value)
    item.arrears = dynArrearsInput.value
    item.percentWeight = dynPercentWeightInput.value
    item.fee = dynFeeInput.value

    dynCapitalPlusInterestInput.value = Number(dynCapitalInput.value) + Number(dynInterestInput.value);

    updateDebtsPercentage();
}

function updateDebtsPercentage() {

    const totalCapital = debts.reduce((acc, obj) => {
        return acc + Number(obj.capital)
    }, 0);

    for (let debt of debts) {

        const percentWeightName = 'dynDebtPercentWeight' + debt.counterID;
        const dynPercentWeightInput = document.getElementById(percentWeightName);

        dynPercentWeightInput.value = debt.capital * 100 / totalCapital;
        debt.percentWeight = debt.capital * 100 / totalCapital;
    }
}

function removeDebt(containerName) {
    const dynContainer = document.getElementById(containerName);
    dynContainer.remove();

    debts = debts.filter(x => x.containerName != containerName);

    updateDebtsPercentage();
}

function getDebtsData() {

    const data = [];

    for (let debt of debts) {
        data.push({
            entity: debt.entity,
            productType: debt.productType,
            guarantyType: debt.guarantyType,
            capital: debt.capital,
            interest: debt.interest,
            capitalPlusInteres: debt.capitalPlusInteres,
            arrears: debt.arrears,
            percentWeight: debt.percentWeight,
            fee: debt.fee,
            idProduct: null,
            reconciledCapital: null,
            vote: null,
            class: null,
            ic: null,
            im: null,

        });
    }

    return data;
}