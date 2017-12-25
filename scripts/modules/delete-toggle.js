// toggle done task button;
function toggleTask() {
    const toggleBtn = document.getElementsByClassName('toggle-btn');
    for (let i = 0; i < toggleBtn.length; i++) {
        toggleBtn[i].addEventListener('mouseup', function (ev) {
            ev = ev.target;
            ev.parentElement.parentElement.classList.toggle('line-throught');
            ev.classList.toggle('checked-btn');
        })
    }
}
// delete chosen task;
function deleteTask() {
    const deleteBtn = document.getElementsByClassName('delete-btn');
    for (let i = 0; i < deleteBtn.length; i++) {
        deleteBtn[i].addEventListener('mouseup', function (ev) {
            const textToRemove = ev.target.parentElement.parentElement.innerHTML,
                elToRemove = ev.target.parentElement.parentElement;
            tasksArray.splice(i, 1);
            elToRemove.remove();
        });
    }
}
