function setRangeLogic(rangeId, indicatorId) {
    const range = document.getElementById(rangeId);
    const indicator = document.getElementById(indicatorId);

    indicator.innerText = NumberToMoneyString(range.value);
    range.addEventListener('input', () => {
        indicator.innerText = NumberToMoneyString(range.value);
    });
}

function NumberToMoneyString(value) {
    return '$ ' + Intl.NumberFormat('es-ES').format(value);
}