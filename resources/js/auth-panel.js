const authBtn = document.getElementById("top-panel-auth-opener");
const authPanel = document.getElementById("auth-panel");
const authBtnCloser = document.getElementById("auth-panel-closer");

if (authBtn) {
    authBtn.addEventListener('click', function() {
        
        if (authPanel.classList.contains("opened")) {
            authPanel.classList.remove('opened');
        } else {
            authPanel.classList.add('opened');
        }
    });
}

if (authBtnCloser) {
    authBtnCloser.addEventListener('click', function() {
        
        if (authPanel.classList.contains("opened")) {
            authPanel.classList.remove('opened');
        } else {
            authPanel.classList.add('opened');
        }
    });
}