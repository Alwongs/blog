// task-item menu
document.querySelectorAll('.todo-item__actions').forEach(item => {
    item.addEventListener('click', function(e) {
        let modal = item.querySelector('.todo-item__modal');
        modal.classList.remove('hidden');

        setTimeout(() => {
            document.addEventListener('click', (e) => {
                if (!modal.contains(e.target) && e.target.id != modal.id) {
                    modal.classList.add('hidden');
                }
            });
            document.addEventListener('keydown', (e) => {
                if ( e.keyCode == 27 ) {
                    modal.classList.add('hidden');
                }
            });
        }, 100);

    });
});

// confirm clear task list
const clearTasksBtn = document.getElementById('clear-tasks-btn');
if (clearTasksBtn) {
    clearTasksBtn.addEventListener('click', function(e) {
        if (confirm("Are you cure?")) {
            return true;
        } else {
            e.preventDefault();
        }
    });
}

