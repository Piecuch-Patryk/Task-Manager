// create DOM elements;
const createDOMel = function(el, type){
    // buttons toggle/delete;
    if(el == 'btn'){
        const btn = document.createElement('button');
        if(type == 'toggle'){
            btn.classList.add('btn','btn-link', 'btn', 'col-1', 'toggle-btn');
            btn.setAttribute('type', 'button');
            btn.innerHTML = '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
            return btn;
        }
        if(type == 'delete'){
            btn.classList.add('btn', 'btn-link', 'text-light', 'col-1', 'delete-btn');
            btn.setAttribute('type', 'button');
            btn.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
            return btn;
        }
    }
    if(el == 'span'){
        const span = document.createElement('span')
        if(type == 'spanHidden'){
            span.classList.add('taskID');
            span.style.display = 'none';
            return span;
        }else {
            return span;
        }
    }
    if(el == 'p'){
        const p = document.createElement('input');
        p.setAttribute('readonly', true);
        p.classList.add('col-10', 'm-0', 'p-0');
        return p;
    }
    // task text;
    if(el == 'textNodeP'){
        const textNodeP = document.createTextNode(type.task);
        return textNodeP;
    }
    if(el == 'textNodeDate'){
        const textNodeDate = document.createTextNode(type.date);
        return textNodeDate;
    }
    if(el == 'checkbox'){
        const checkbox = type.checkbox;
        return checkbox;
    }
    if(el == 'validity'){
        const validity = type.validity;
        return validity;
    }
    if(el == 'id'){
        const taskID = document.createTextNode(type.id);
        return taskID;
    }
}
// create list (inner html)
function createList(tasksArray) {
    const container = document.querySelector('.tasks-list'),
          ul = document.createElement('ul');
    
    ul.classList.add('list-group');
    container.appendChild(ul).setAttribute('id', 'tasks');
    if(typeof tasksArray != 'string'){
        for (let i = 0; i < tasksArray.length; i++) {
            const li = document.createElement('li'),
                  divRow = document.createElement('div'),
                toggleBtn = createDOMel('btn', 'toggle'),
                deleteBtn = createDOMel('btn', 'delete'),
                spanHidden = createDOMel('span', 'spanHidden'),
                p = createDOMel('p'),
                textNodeP = createDOMel('textNodeP', tasksArray[i]),
                checkbox = tasksArray[i].checkbox,
                validity = createDOMel('validity', tasksArray[i]),
                taskID = createDOMel('id', tasksArray[i]);
            // add bootstrap styles;
            li.classList.add('list-group-item', 'my-1', 'p-1', 'border-0');
            divRow.classList.add('row');
            // build up task list;
            li.appendChild(divRow);
            divRow.appendChild(toggleBtn);
            divRow.appendChild(p);
            p.value = tasksArray[i].task;
            divRow.appendChild(deleteBtn);
            // append hidden element with task ID;
            spanHidden.appendChild(taskID);
            divRow.appendChild(spanHidden);
            ul.appendChild(li);
            // toggle complete tasks;
            if(checkbox == 1){
                p.classList.add('line-through');
                toggleBtn.firstChild.classList.add('text-success');
            }
            // set background depending on validity;
            setBackground(validity, li);
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
    }else {
        showMessage(true);
        return;
    }
}

// set background-color, depending on task validation;
function setBackground(str, el) {
    switch (str) {
        case 'validity-1':
            el.style.backgroundImage = 'linear-gradient(90deg,rgba(255,255,255,.8)50%, rgba(200, 20, 0, .8)80%)';
            break;
        case 'validity-2':
            el.style.backgroundImage = 'linear-gradient(90deg,rgba(255,255,255,.8)50%, rgba(0, 20, 200, .8)80%)';
            break;
        case 'validity-3':
            el.style.backgroundImage = 'linear-gradient(90deg, rgba(255,255,255,.8)50%, rgba(40,150,10,.8)80%)';
            break;
    }
    return;
}
// show message if no tasks in db;
function showMessage(bool){
    const el = document.querySelector('.tasks-list'),
          h4 = document.createElement('h4');
    h4.classList.add('text-light', 'text-center', 'py-2');
    if (bool){
        if (el.getElementsByClassName('list-group-item').length <= 0){
            el.appendChild(h4).innerHTML = 'No tasks in data base. You can simply add new task above.';
        }
    }
    if (!bool){
        if (el.getElementsByClassName('list-group-item').length > 0){  
            if (el.querySelector('h4')){   
                el.querySelector('h4').remove();
            }
        }
    }
}






