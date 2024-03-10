const sendDataBtn = document.getElementById('sendDataBtn');
const newWizardBtn = document.getElementById('newWizardBtn');

const wizadContainer = document.getElementById('wizardContainer');
const infoSentContainer = document.getElementById('infoSentContainer');

sendDataBtn.addEventListener('click', () => {

    const personalInfodocType = document.getElementById('personalInfodocType');
    const personalInfodocNumber = document.getElementById('personalInfodocNumber');
    const personalInfoName = document.getElementById('personalInfoName');
    const personalInfoLastName = document.getElementById('personalInfoLastName');
    const personalInfoEmail = document.getElementById('personalInfoEmail');
    const personalInfoPhone = document.getElementById('personalInfoPhone');

    const data = {
        incomes: getIncomeData(),
        expenses: getExpensesData(),
        debts: getDebtsData(),
        assets: getAssetsData(),
        personalInfo: {
            docType: personalInfodocType.value,
            docNumber: personalInfodocNumber.value,
            name: personalInfoName.value,
            lastName: personalInfoLastName.value,
            email: personalInfoEmail.value,
            phone: personalInfoPhone.value
        }
    }

    console.log(data);

    postData(data);
});

newWizardBtn.addEventListener('click', () => {
    location.reload();
});

async function postData(data) {
    const response = await fetch("/finanzas/php/echo.php", {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(() => {
        wizadContainer.classList.add('d-none');
        infoSentContainer.classList.remove('d-none');
    }).catch(err => {
        console.log(err);
    });

    const actualResponse = await response.json();
    console.log(actualResponse);
}