const username = document.getElementById('username');
const password = document.getElementById('password');
const success = document.getElementById('success');
const error = document.getElementById('error');
const div = document.getElementById('loginDiv');

document.getElementById('login').onclick = function() {
    let valid = username.checkValidity() && password.checkValidity();

    if (!valid) {
        error.style.display = 'block';
        error.style.animation = 'shake 0.5s 1';
        password.setAttribute('aria-invalid', 'true');
        username.setAttribute('aria-invalid', 'true');
    } else {
        error.style.display = 'none';
        div.style.display = 'none';
        success.style.display = 'block';
    }
}

username.addEventListener('keyup', function (event) {
    let userValid = username.checkValidity();
    let passValid = password.checkValidity();

    if ( passValid ) {
        password.setAttribute('aria-invalid', 'false');
    }
    if ( userValid ) {
        username.setAttribute('aria-invalid', 'false');
    }
});

password.addEventListener('keyup', function (event) {
    let passValid = password.checkValidity();
    let userValid = username.checkValidity();

    if ( passValid ) {
        password.setAttribute('aria-invalid', 'false');
    }
    if ( userValid ) {
        username.setAttribute('aria-invalid', 'false');
    }
});

function closeModal() {
    success.style.display = 'none';
    div.style.display = 'block';
    username.value = '';
    password.value = '';
}