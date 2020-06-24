const previousBtn = document.getElementById('previousBtn');
const nextBtn = document.getElementById('nextBtn');
const finishBtn = document.getElementById('finishBtn');
const content = document.getElementById('content');
const bullets = [ ... document.querySelectorAll('.bullet')];

const MAX_STEPS = 3;
let currentStep = 1;

nextBtn.addEventListener('click', () => {
    const currentBullet = bullets[currentStep - 1];
    currentBullet.classList.add('completed');
    currentStep++;
    previousBtn.disabled = false;
    if(currentStep === MAX_STEPS){
        nextBtn.disabled = true;
        finishBtn.disabled = false;
    }
    content.innerText = `Step number ${currentStep}`;
});

previousBtn.addEventListener('click', () => {
    const previousBullet = bullets[currentStep - 2];
    previousBullet.classList.remove('completed');
    currentStep--;
    nextBtn.disabled = false;
    finishBtn.disabled = true;
    if (currentStep === 1) {
        previousBtn.disabled = true;
    }
    content.innerText = `Step number ${currentStep}`;
});

finishBtn.addEventListener('click', () => {
    location.reload();
});


if(currentStep === 1) {
    document.getElementById("pag1").style.display = "block";
    document.getElementById("pag1").style.visibility = "visible";
    document.getElementById("pag2").style.visibility = "hidden";
    document.getElementById("pag2").style.display = "none";

    document.getElementById("pag3").style.visibility = "hidden";
}
/*
if(currentStep === 2) {
    document.getElementById("pag1").style.visibility = "hidden";
    document.getElementById("pag3").style.visibility = "hidden";
}

if(currentStep === 3) {
    document.getElementById("pag1").style.visibility = "hidden";
    document.getElementById("pag2").style.visibility = "hidden";
}
*/

