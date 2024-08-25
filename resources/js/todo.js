window.onload = () => {
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
};


