// change text input background image, depending on mouse over validity element;
function eventListenerArray() {
    const validityList = document.getElementsByClassName('radio-span');
    for (let i = 0; i < validityList.length; i++) {
        // on mouse enter;
        validityList[i].addEventListener('mouseenter', hoverRadioList);
    }
}

function hoverRadioList(event) {
    const input = document.getElementById('taskText');
    const activeField = event.target.firstElementChild.attributes.id.value;
    let flag = false;
    // get current background image;
    let currentColor = input.style.backgroundImage;
    // wait to aprove color on click;
    event.target.addEventListener('click', function () {
        currentColor = input.style.backgroundImage;
        // if any color clicked, set this as background;
        if (event.target.firstElementChild.checked) {
            setBackground(activeField, input);
            flag = true;
            // on mouse leave after click;
            event.target.addEventListener('mouseleave', function () {
                resetColor(flag, currentColor);
            });
        }
    });
    setBackground(activeField, input);
    // on mouse leave without click;
    event.target.addEventListener('mouseleave', function () {
        resetColor(flag, currentColor);
    });
}
// reset color on mouse leave;
function resetColor(boolean, color) {
    if (!boolean) {
        // do not change defined backgorund;
        document.getElementById('taskText').style.backgroundImage = color;
    } else {
        // change defined background to actual one;
        document.getElementById('taskText').style.backgroundImage = color;
    }
}
