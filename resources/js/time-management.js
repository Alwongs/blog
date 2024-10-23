
// item menu modal open and close 
const todoList = document.querySelector('.manage-day');
if (todoList) {
    todoList.addEventListener('click', function(e) {
        console.log('hi');
        let modals = document.querySelectorAll('.manage-day-item__modal');
        if (e.target.classList.contains('three-dots-icon')) {
            modals.forEach(element => {
                if (!element.classList.contains('hidden')) {
                    element.classList.add('hidden');
                }
            })
            e.target.nextElementSibling.classList.toggle('hidden');
        }
    });
}
document.addEventListener('click', (e) => {
    let modal = document.querySelector('.manage-day-item__modal:not(.hidden)')
    if (modal && !e.target.classList.contains('three-dots-icon') && e.target.dataset.type != 'color-label') {
        modal.classList.add('hidden');
    }
});
document.addEventListener('keydown', (e) => {
    let modal = document.querySelector('.manage-day-item__modal:not(.hidden)')
    if (modal && e.keyCode == 27) {
        modal.classList.add('hidden');
    }
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





// item menu modal open and close 
const prodList = document.querySelector('.prod-list');
if (prodList) {
    prodList.addEventListener('click', function(e) {
        let modals = document.querySelectorAll('.prod-list-item__modal');
        if (e.target.classList.contains('three-dots-icon')) {
            modals.forEach(element => {
                if (!element.classList.contains('hidden')) {
                    element.classList.add('hidden');
                }
            })
            e.target.nextElementSibling.classList.toggle('hidden');
        }
    });
}
document.addEventListener('click', (e) => {
    let modal = document.querySelector('.prod-list-item__modal:not(.hidden)')
    if (modal && !e.target.classList.contains('three-dots-icon') && e.target.dataset.type != 'color-label') {
        modal.classList.add('hidden');
    }
});
document.addEventListener('keydown', (e) => {
    let modal = document.querySelector('.prod-list-item__modal:not(.hidden)')
    if (modal && e.keyCode == 27) {
        modal.classList.add('hidden');
    }
});
