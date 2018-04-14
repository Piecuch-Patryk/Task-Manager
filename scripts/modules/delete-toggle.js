// toggle done task button;
function toggleTask() {
        const toggleBtn = document.getElementsByClassName('toggle-btn'); 
        for (let i = 0; i < toggleBtn.length; i++) {
            toggleBtn[i].addEventListener('mouseup', function (ev) {
                const p = this.nextElementSibling;
                p.classList.toggle('line-through');
                this.classList.toggle('text-success');
                
                console.log(ev);
                
                // current task id from data base;
                let currentId = this.parentElement.parentElement.getElementsByClassName('taskID')[0].innerHTML;
                currentId = parseInt(currentId);
                if(this.classList.contains('text-success')){
                    const checkbox = 1;
                    updateCheckboxDb(currentId, checkbox);
                }else {
                    const checkbox = 0;
                    updateCheckboxDb(currentId, checkbox);
                }
            });
        }
}
// update checkbox value in data base;
function updateCheckboxDb(id, checkbox){
    if($('#login-title').text() !== 'DemoUser'){
        $.ajax({
                url: "../logged-in/update-task.php",
                type: "POST",
                data: { 'id': id, 'checkbox': checkbox },                   
                success: function(){
                    // callback!
                    console.log('Changed');
                }
            });
    }
}
// delete chosen task;
function deleteTask() {
    const deleteBtn = document.getElementsByClassName('delete-btn');
    for (let i = 0; i < deleteBtn.length; i++) {
        deleteBtn[i].addEventListener('mouseup', function (ev) {
            const currentEl = this.parentElement.parentElement;
            let currentId = currentEl.getElementsByClassName('taskID')[0].innerHTML;
            currentId = parseInt(currentId);
            currentEl.remove();
            deleteTaskDb(currentId);
        });
    }
}
// delete current task from data base;
function deleteTaskDb(id){
    if($('#login-title').text() !== 'DemoUser'){
        $.ajax({
            url: "../logged-in/delete-task.php",
            type: "POST",
            data: { 'id': id},                   
            success: function(){
                // callback!
                showMessage(true);
            }
        });
    }
}


