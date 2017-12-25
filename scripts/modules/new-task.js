// get inner text and check charcters;
function newTask() {
    let textField = document.getElementById('taskText'),
        validation = document.querySelector('.app-container input:checked'),
        faultField = document.querySelector('.fault');

    if (textField.value == '' || textField.value == ' ') {
        faultField.innerHTML = 'No describtion in new task.';
        return;
    }
    if (!validation) {
        faultField.innerHTML = 'Chose type of new task.';
        return;
    }
    if (textField.value.length >= 51) {
        faultField.innerHTML = 'Sorry, no more than 50 characters.'
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

        // create new task object;
        const newObj = new Object();
        newObj.id = textField.value;
        newObj.validity = validation;
        newObj.date = actualTimeDate;
        tasksArray.push(newObj);

        // reset fault section;
        document.querySelector('.fault').innerHTML = '';
        // default input text background image;
        resetInputBgc();
        // create and show list;
        createList();
    }
    return;
}
