setRangeLogic('rangeSalario', 'indicatorSalario');
setRangeLogic('rangeHonorarios', 'indicatorHonorarios');
setRangeLogic('rangeArrendamiento', 'indicatorArrendamiento');

let additionalIncome = [];

const addIncomeButton = document.getElementById('addIncomeBtn');
const addIncomeInput = document.getElementById('addIncomeInput');
const additionalIncomeItems = document.getElementById('additionalIncomeItems');

addIncomeButton.addEventListener('click', () => {
    AddIncome(addIncomeInput.value);
    addIncomeInput.value = '';
});

function AddIncome(name) {
    name = name.trim();

    if (name == '') {
        return;
    }

    const containerName = 'dynIncomeContainer' + name;
    const rangeName = 'dynIncomeRange' + name;
    const indicatorName = 'dynIncomeIndicator' + name;
    const removeBtnName = 'dynIncomeRemoveBtn' + name;

    if (additionalIncome.find(x => x.name == name)) {
        return;
    }

    additionalIncome.push({
        name: name,
        value: 1000000,
        containerName: containerName
    });

    const templateString = `<div id="${containerName}"><h3 class="gray">${name}</h3><div class="d-flex gap-4"><div class="d-flex flex-wrap flex-grow-1"><div class="col-12 col-md-8 center-content range-container"><input id="${rangeName}" class="w-100" type="range" min="0" max="10000000" step="100000"></div><div class="col-12 col-md-4 d-flex justify-content-end"><div class="col-12 col-md-11 range-value-indicator center-content"><h3 id="${indicatorName}" class="white">$ 1.000.000</h3></div></div></div><div class="center-content"><button id="${removeBtnName}" class="icon-button filled"><span class="material-symbols-rounded">close</span></button></div></div></div>`

    const template = document.createElement('template');
    template.innerHTML = templateString;

    additionalIncomeItems.append(template.content.children[0]);

    const dynRange = document.getElementById(rangeName);
    const dynIndicator = document.getElementById(indicatorName);

    dynIndicator.innerText = NumberToMoneyString(dynRange.value);
    updateIncome(name, dynRange.value);
    dynRange.addEventListener('input', () => {
        dynIndicator.innerText = NumberToMoneyString(dynRange.value);
        updateIncome(name, dynRange.value);
    });

    const dynRemoveButton = document.getElementById(removeBtnName);

    dynRemoveButton.addEventListener('click', () => {
        removeIncome(containerName);
    });
}

function updateIncome(name, value) {
    const item = additionalIncome.find(x => x.name == name);

    if (item != null)
        item.value = value
}

function removeIncome(containerName) {
    const dynContainer = document.getElementById(containerName);
    dynContainer.remove();

    additionalIncome = additionalIncome.filter(x => x.containerName != containerName);
}

function getIncomeData(){
    const rangeSalario = document.getElementById('rangeSalario');
    const rangeHonorarios = document.getElementById('rangeHonorarios');
    const rangeArrendamiento = document.getElementById('rangeArrendamiento');

    const data = [
        {
            name: 'salario',
            value: rangeSalario.value
        },
        {
            name: 'honorarios',
            value: rangeHonorarios.value
        },
        {
            name: 'arrendamiento',
            value: rangeArrendamiento.value
        }
    ];

    for(let item of additionalIncome){
        data.push({
            name: item.name,
            value: item.value
        });
    }

    return data;
}