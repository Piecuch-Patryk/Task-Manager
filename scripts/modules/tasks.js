// get tasks if there is any;
const allTasks = function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // return array;
            const tasks = JSON.parse(this.responseText);
            let tasksArray = tasks;
            createList(tasks);
        }
    };
    xmlhttp.open("GET", "./getTasks.php", true);
    xmlhttp.send();
}