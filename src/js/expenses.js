setRangeLogic('rangeArriendo', 'indicatorArriendo');
setRangeLogic('rangeEducacion', 'indicatorEducacion');
setRangeLogic('rangeServicios', 'indicatorServicios');
setRangeLogic('rangeAlimentacion', 'indicatorAlimentacion');
setRangeLogic('rangeSeguros', 'indicatorSeguros');
setRangeLogic('rangeTransporte', 'indicatorTransporte');

let additionalExpenses = [];

const addExpenseButton = document.getElementById('addExpenseBtn');
const addExpenseInput = document.getElementById('addExpenseInput');
const additionalExpenseItems = document.getElementById('additionalExpenseItems');

addExpenseButton.addEventListener('click', () => {
    AddExpense(addExpenseInput.value);
    addExpenseInput.value = '';
});

function AddExpense(name) {
    name = name.trim();

    if (name == '') {
        return;
    }

    const containerName = 'dynExpenseContainer' + name;
    const rangeName = 'dynExpenseRange' + name;
    const indicatorName = 'dynExpenseIndicator' + name;
    const removeBtnName = 'dynExpenseRemoveBtn' + name;

    if (additionalExpenses.find(x => x.name == name)) {
        return;
    }

    additionalExpenses.push({
        name: name,
        value: 1000000,
        containerName: containerName
    });

    const templateString = `<div id="${containerName}"><h3 class="gray">${name}</h3><div class="d-flex gap-4"><div class="d-flex flex-wrap flex-grow-1"><div class="col-12 col-md-8 center-content range-container"><input id="${rangeName}" class="w-100" type="range" min="0" max="10000000" step="100000"></div><div class="col-12 col-md-4 d-flex justify-content-end"><div class="col-12 col-md-11 range-value-indicator center-content"><h3 id="${indicatorName}" class="white">$ 1.000.000</h3></div></div></div><div class="center-content"><button id="${removeBtnName}" class="icon-button filled"><span class="material-symbols-rounded">close</span></button></div></div></div>`

    const template = document.createElement('template');
    template.innerHTML = templateString;

    additionalExpenseItems.append(template.content.children[0]);

    const dynRange = document.getElementById(rangeName);
    const dynIndicator = document.getElementById(indicatorName);

    dynIndicator.innerText = NumberToMoneyString(dynRange.value);
    updateExpense(name, dynRange.value);
    dynRange.addEventListener('input', () => {
        dynIndicator.innerText = NumberToMoneyString(dynRange.value);
        updateExpense(name, dynRange.value);
    });

    const dynRemoveButton = document.getElementById(removeBtnName);

    dynRemoveButton.addEventListener('click', () => {
        removeExpense(containerName);
    });
}

function updateExpense(name, value) {
    const item = additionalExpenses.find(x => x.name == name);

    if (item != null)
        item.value = value
}

function removeExpense(containerName) {
    const dynContainer = document.getElementById(containerName);
    dynContainer.remove();

    additionalExpenses = additionalExpenses.filter(x => x.containerName != containerName);
}

function getExpensesData(){

    const rangeArriendo = document.getElementById('rangeArriendo');
    const rangeEducacion = document.getElementById('rangeEducacion');
    const rangeServicios = document.getElementById('rangeServicios');
    const rangeAlimentacion = document.getElementById('rangeAlimentacion');
    const rangeSeguros = document.getElementById('rangeSeguros');
    const rangeTransporte = document.getElementById('rangeTransporte');

    const data = [
        {
            name: 'arriendo/hipoteca',
            value: rangeArriendo.value
        },
        {
            name: 'educacion',
            value: rangeEducacion.value
        },
        {
            name: 'servicios',
            value: rangeServicios.value
        },
        {
            name: 'alimentacion',
            value: rangeAlimentacion.value
        },
        {
            name: 'seguros',
            value: rangeSeguros.value
        },
        {
            name: 'transporte',
            value: rangeTransporte.value
        }
    ];

    for(let item of additionalExpenses){
        data.push({
            name: item.name,
            value: item.value
        });
    }

    return data;
}