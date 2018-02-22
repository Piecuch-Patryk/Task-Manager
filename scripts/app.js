// get personalised tasks from data base;
document.addEventListener('DOMContentLoaded', allTasks);
// new task;
document.getElementById('new').addEventListener('mouseup', newTask);
//reset current task;
document.getElementById('reset').addEventListener('mouseup', resetFaultField);
document.getElementById('reset').addEventListener('mouseup', resetInputBgc);
// prevent default form action on enter;
/*
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.app-container form').onsubmit = function () {
        return false;
    };
});
*/
// listener for task validity buttons;
document.addEventListener('DOMContentLoaded', eventListenerArray);
