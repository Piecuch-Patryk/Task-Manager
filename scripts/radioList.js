// change new task input background color, depending on mouse over validity element;
function eventListenerArray() {
    let validityList = document.getElementsByClassName('radio-span');
    for (let i = 0; i < validityList.length; i++) {
        // ON;
        validityList[i].addEventListener('mouseenter', hoverRadioList);
        // OFF;
        validityList[i].addEventListener('mouseleave', resetColor);
    }
}

function hoverRadioList(event) {
    const input = document.getElementById('taskText');
    const activeField = event.target.firstElementChild.attributes.id.value;

    switch (activeField) {
        case 'validity-1':
            input.style.backgroundImage = 'linear-gradient(90deg, rgba(255, 255, 255, .8)50%, rgba(200,20,0,.8)80%)';
            break;
        case 'validity-2':
            input.style.backgroundImage = 'linear-gradient(90deg,rgba(255,255,255,.8)50%, rgba(0, 20, 200, .8)80%)';
            break;
        case 'validity-3':
            input.style.backgroundImage = 'linear-gradient(90deg, rgba(255,255,255,.8)50%, rgba(40,150,10,.8)80%)';
            break;
    }
}
// reset color on mouse leave;
function resetColor() {
    document.getElementById('taskText').style.background = 'rgba(255,255,255,.8)';
}

document.addEventListener('DOMContentLoaded', eventListenerArray);
