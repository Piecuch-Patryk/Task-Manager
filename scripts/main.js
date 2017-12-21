let tasksArray = [
    {
        id: 'first task',
        validity: 'validity-1',
        date: '21:27:31|04/10/2017'
    },
    {
        id: 'second task',
        validity: 'validity-2',
        date: '11:10:31|05/10/2017'
    },
    {
        id: 'third task',
        validity: 'validity-3',
        date: '15:32:59|11/10/2017'
    },
    {
        id: 'fourth task',
        validity: 'validity-2',
        date: '21:27:31|20/10/2017'
    }
];

// get inner text and do something only when it is't empty;
function newTask() {
    let textField = document.getElementById('taskText');
    let validation = document.querySelector('.app-container input:checked');

    if (textField.value == '' || textField.value == ' ') {
        document.querySelector('.fault').innerHTML = 'No describtion in new task.';
        return;
    }
    if (!validation) {
        document.querySelector('.fault').innerHTML = 'Chose type of new task.';
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
        const actualTimeDate = hour + ':' + minute + ':' + second + '|' + day + '/' + month + '/' + year;

        validation = validation.id;

        // create new task object;
        const newObj = new Object();
        newObj.id = textField.value;
        newObj.validity = validation;
        newObj.date = actualTimeDate;
        tasksArray.push(newObj);

        // reset fault section;
        document.querySelector('.fault').innerHTML = '';
        // create and show list;
        createList();
    }
    return;
}
// create list (inner html)
function createList() {
    let container = document.querySelector('.tasks-list'),
        ul = document.createElement('ul');
    // clear container, before new list is implemented; 
    container.innerHTML = '';

    container.appendChild(ul);
    let ulList = container.querySelector('ul');

    for (let i = 0; i < tasksArray.length; i++) {
        const li = document.createElement('li'),
            toggleBtn = document.createElement('button'),
            toggleBtnText = document.createTextNode('Done'),
            deleteBtn = document.createElement('button'),
            deleteBtnText = document.createTextNode('Delete'),
            span = document.createElement('span'),
            p = document.createElement('p'),
            textNodeP = document.createTextNode(tasksArray[i].id),
            textNodeDate = document.createTextNode(tasksArray[i].date),
            validity = tasksArray[i].validity;
        // 

        // build up buttons;
        toggleBtn.classList.add('toggle-btn');
        toggleBtn.setAttribute('type', 'button');
        toggleBtn.appendChild(toggleBtnText);
        deleteBtn.classList.add('delete-btn');
        deleteBtn.setAttribute('type', 'button');
        deleteBtn.appendChild(deleteBtnText);
        // build up task list;
        li.appendChild(toggleBtn);
        li.appendChild(p);
        p.appendChild(textNodeP);
        li.appendChild(span);
        span.appendChild(textNodeDate);
        li.appendChild(deleteBtn);
        ulList.appendChild(li);

        // set background depending on validity;
        setBackground(validity, li);
    }
    // clear input field;
    document.getElementById('taskText').value = '';
    // task buttons;
    toggleTask();
    deleteTask();
    // reset radio input;
    resetRadio();

}
// set background-color, depending on task validation;
function setBackground(str, el) {
    switch (str) {
        case 'validity-1':
            el.style.backgroundColor = 'rgba(200, 20, 0, .8)';
            break;
        case 'validity-2':
            el.style.backgroundColor = 'rgba(0, 20, 200, .8)';
            break;
        case 'validity-3':
            el.style.backgroundColor = 'rgba(50, 100, 50, .8)';
            break;
    }
}
// reset radio buttons;
function resetRadio() {
    let radioList = document.getElementsByName('validity');
    for (let i = 0; i < radioList.length; i++) {
        radioList[i].checked = false;
    }
}
// list's buttons;
function toggleTask() {
    const toggleBtn = document.getElementsByClassName('toggle-btn');

    for (let i = 0; i < toggleBtn.length; i++) {

        toggleBtn[i].addEventListener('mouseup', function (ev) {
            ev = ev.target;
            ev.classList.toggle('checked-btn');
        })
    }
}

function deleteTask() {
    const deleteBtn = document.getElementsByClassName('delete-btn');

    for (let i = 0; i < deleteBtn.length; i++) {

        deleteBtn[i].addEventListener('mouseup', function (ev) {
            const textToRemove = ev.target.previousElementSibling.innerHTML;

            tasksArray.splice(i, 1);
            ev.target.parentElement.remove();
        });
    }
}
// add actual time&date to every new list element;
function addTimeDate() {

}


document.addEventListener('DOMContentLoaded', createList);
document.getElementById('new').addEventListener('mouseup', newTask);
document.getElementById('new').addEventListener('mouseup', addTimeDate);
