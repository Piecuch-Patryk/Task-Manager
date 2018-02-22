// toggle done task button;
function toggleTask() {
        const toggleBtn = document.getElementsByClassName('toggle-btn'); 
        for (let i = 0; i < toggleBtn.length; i++) {
            toggleBtn[i].addEventListener('mouseup', function (ev) {
                ev = ev.target;
                ev.parentElement.parentElement.classList.toggle('line-throught');
                ev.classList.toggle('checked-btn');
                // current task id from data base;
                const currentEl = ev.parentElement.parentElement,
                      currentId = ev.parentElement.parentElement.getElementsByClassName('taskID')[0].innerHTML;
                if(currentEl.classList.contains('line-throught')){
                    const checkbox = '1';
                    updateCheckboxDb(currentId, checkbox);
                }else {
                    const checkbox = '0';
                    updateCheckboxDb(currentId, checkbox);
                }
            });
        }
}
// update checkbox value in data base;
function updateCheckboxDb(id, checkbox){
    $.ajax({
            url: "update-task.php",
            type: "POST",
            data: { 'id': id, 'checkbox': checkbox },                   
            success: function(){
                // callback!
                console.log('Changed');
            }
        });
}
// delete chosen task;
function deleteTask() {
    const deleteBtn = document.getElementsByClassName('delete-btn');
    for (let i = 0; i < deleteBtn.length; i++) {
        deleteBtn[i].addEventListener('mouseup', function (ev) {
            const currentEl = ev.target.parentElement.parentElement,
                  textToRemove = currentEl.innerHTML,
                  currentId = currentEl.getElementsByClassName('taskID')[0].innerHTML;
            currentEl.remove();
            deleteTaskDb(currentId);
        });
    }
}
// delete current task from data base;
function deleteTaskDb(id){
        $.ajax({
            url: "delete-task.php",
            type: "POST",
            data: { 'id': id},                   
            success: function(){
                // callback!
                console.log('Changed');
            }
        });
}


