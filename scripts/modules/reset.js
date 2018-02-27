// set default background for input text field;
function resetInputBgc() {
    document.getElementById('taskText').style.backgroundImage = 'linear-gradient(90deg, rgba(255, 255, 255, .8)50%, rgba(10, 30, 60, .01)99%)';

}
// reset radio buttons;
function resetRadio() {
    let radioList = document.getElementsByName('validity');
    for (let i = 0; i < radioList.length; i++) {
        radioList[i].checked = false;
    }
}

// clear fault field;
function resetFaultField() {
    const el = document.querySelector('#tasks h4');
    if (el){
        el.innerHTML = '';  
    }
}
// clear input field;
function clearInputField() {
    document.getElementById('taskText').value = '';
}
