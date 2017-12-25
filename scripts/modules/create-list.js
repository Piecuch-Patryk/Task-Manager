// create list (inner html)
function createList() {
    const container = document.querySelector('.tasks-list'),
        ul = document.createElement('ul');
    // clear container, before new list is implemented; 
    container.innerHTML = '';

    container.appendChild(ul);
    let ulList = ul;
    for (let i = 0; i < tasksArray.length; i++) {
        const li = document.createElement('li'),
            toggleBtn = document.createElement('button'),
            deleteBtn = document.createElement('button'),
            span = document.createElement('span'),
            p = document.createElement('p'),
            textNodeP = document.createTextNode(tasksArray[i].id),
            textNodeDate = document.createTextNode(tasksArray[i].date),
            validity = tasksArray[i].validity;
        // build up buttons;
        toggleBtn.classList.add('toggle-btn');
        toggleBtn.setAttribute('type', 'button');
        toggleBtn.innerHTML = '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
        deleteBtn.classList.add('delete-btn');
        deleteBtn.setAttribute('type', 'button');
        deleteBtn.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
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
    // clear fault field;
    resetFaultField();
    // clear input field;
    clearInputField();
    // task buttons;
    toggleTask();
    deleteTask();
    // reset radio input;
    resetRadio();

    // drag single task up and down;
    dragTask(container);
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
