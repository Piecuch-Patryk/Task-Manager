// get inner text and check characters;
function newTask() {
    let textField = document.getElementById('taskText'),
        validation = document.querySelector('.app-container input:checked'),
        faultField = document.querySelector('.fault');

    if (textField.value == '' || textField.value == ' ') {
        faultField.innerHTML = 'No describtion in new task.';
        errorFieldBgc();
        return;
    }
    if (!validation) {
        faultField.innerHTML = 'Chose type of new task.';
        errorFieldBgc();
        return;
    }
    if (textField.value.length >= 51) {
        faultField.innerHTML = 'Sorry, no more than 50 characters.'
        errorFieldBgc();
        return;
    } else {
        let newDate = new Date(),
            year = newDate.getFullYear(),
            month = newDate.getMonth(),
            day = newDate.getDay(),
            hour = newDate.getHours(),
            minute = newDate.getMinutes(),
            second = newDate.getSeconds();
        if (second < 10 && second >= 0) {
            second = '0' + second;
        }
        if (minute < 10 && minute >= 0) {
            minute = '0' + minute;
        }
        if (hour < 10 && hour >= 0) {
            hour = '0' + hour;
        }
        if (day < 10 && day >= 0) {
            day = '0' + day;
        }
        if (month < 10 && month >= 0) {
            month = '0' + month;
        }
        const actualTimeDate = 'Added ' + hour + ':' + minute + ':' + second + ' | ' + day + '/' + month + '/' + year;

        validation = validation.id;
        
        const text = textField.value,
            validity = validation,
            checkbox = 0,
            date = actualTimeDate;
        // create new task object;
        newTaskDb(text,validity,checkbox,date);
        const newTaskObj = new Object();
        newTaskObj.id = '';
        newTaskObj.user = '';
        newTaskObj.checkbox = checkbox;
        newTaskObj.task = text;
        newTaskObj.validity = validity;   
        // reset fault section;
        document.querySelector('.fault').innerHTML = '';
        // default input text background image;
        resetInputBgc();
        // add into tasks list as last;
        showNewTask([newTaskObj]);
    }
    return;
}
// add new task to data base;
function newTaskDb(text, validity, checkbox, date){
    if($('#login-title').text() !== 'DemoUser'){
        checkbox = parseInt(checkbox);
        $.ajax({
                url: "../logged-in/new-task.php",
                type: "POST",
                data: {'task': text, 'checkbox': checkbox, 'validity': validity, 'date': date},                   
                success: function(){
                    // callback!
                    // hide message;
                    showMessage(false);
                    // get last id from data base;
                    getLastId();
                }
        });
    }
}
// add new task into list as last one;
function showNewTask(tasksArray){
    const list = document.getElementById('tasks');
    for (let i = 0; i < tasksArray.length; i++) {
        // create single task element;
        list.appendChild(createTaskElement(tasksArray[i]));
    }
    toggleTask();
    // clear fault field;
    resetFaultField();
    // clear input field;
    clearInputField();
    // task buttons;
    deleteTask();
    // reset radio input;
    resetRadio();
}
// get last added task id from data base;
const getLastId = function(){
    if($('#login-title').text() !== 'DemoUser'){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // return last id number;
                let lastId = JSON.parse(this.responseText)[0].id;
                lastId = parseInt(lastId);
                // add id to last task;
                addIdToLastTask(lastId);
            }
        };
        xmlhttp.open("GET", "../logged-in/getLastId.php", true);
        xmlhttp.send();
    }
}
// add last id to the latest task;
function addIdToLastTask(num){
    let lastEl = document.getElementById('tasks');
    lastEl = lastEl.lastChild;
    lastEl = lastEl.querySelector('.taskID');
    lastEl.innerHTML = num;
}




