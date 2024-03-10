const step1Indicator = document.getElementById('setp1Indicator');
const step2Indicator = document.getElementById('setp2Indicator');
const step3Indicator = document.getElementById('setp3Indicator');
const step4Indicator = document.getElementById('setp4Indicator');
const step5Indicator = document.getElementById('setp5Indicator');

const step1NextBtn = document.getElementById('step1NextBtn');
const step2NextBtn = document.getElementById('step2NextBtn');
const step3NextBtn = document.getElementById('step3NextBtn');
const step4NextBtn = document.getElementById('step4NextBtn');

const step2BackBtn = document.getElementById('step2BackBtn');
const step3BackBtn = document.getElementById('step3BackBtn');
const step4BackBtn = document.getElementById('step4BackBtn');
const step5BackBtn = document.getElementById('step5BackBtn');


step1NextBtn.addEventListener('click', () => {
    updateIndicator(1, 2);
});

step2NextBtn.addEventListener('click', () => {
    updateIndicator(2, 3);
});

step3NextBtn.addEventListener('click', () => {
    updateIndicator(3, 4);
});

step4NextBtn.addEventListener('click', () => {
    updateIndicator(4, 5);
});


step2BackBtn.addEventListener('click', () => {
    updateIndicator(2, 1);
});

step3BackBtn.addEventListener('click', () => {
    updateIndicator(3, 2);
});

step4BackBtn.addEventListener('click', () => {
    updateIndicator(4, 3);
});

step5BackBtn.addEventListener('click', () => {
    updateIndicator(5, 4);
});

function updateIndicator(deactivate, activate) {
    const activeIndicator = document.getElementById(`step${deactivate}Indicator`);
    activeIndicator.classList.remove('active');

    const inactiveIndicator = document.getElementById(`step${activate}Indicator`);
    inactiveIndicator.classList.add('active');
}