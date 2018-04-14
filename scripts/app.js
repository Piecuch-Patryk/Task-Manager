// get personalised tasks from data base;
document.addEventListener('DOMContentLoaded', allTasks);
// new task;
document.getElementById('new').addEventListener('mouseup', newTask);
// new task on enter event; prevent submit form on enter event;
document.getElementById('taskText').addEventListener('keypress', function(e){
    if (e.keyCode == 13){
        e.preventDefault();
        newTask();
    } 
});
//reset current task;
document.getElementById('reset').addEventListener('mouseup', resetFaultField);
document.getElementById('reset').addEventListener('mouseup', resetInputBgc);
// listener for task validity buttons;
document.addEventListener('DOMContentLoaded', eventListenerArray);
