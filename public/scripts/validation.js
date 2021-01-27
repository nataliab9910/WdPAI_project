const form = document.querySelector('.valid');
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');
const passwordInput = form.querySelector('input[name="password"]');


function isEmailValid(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmailValid(emailInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
            const condition = arePasswordsSame(
                passwordInput.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, condition);
        },
        1000
    );
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

if (emailInput) {
    emailInput.addEventListener('keyup', validateEmail);
}

confirmedPasswordInput.addEventListener('keyup', validatePassword);
