const email = document.getElementById('email');
const password = document.getElementById('password');
const phonenumber = document.getElementById('phonenumber');
const confirm_password = document.getElementById('confirm-password');
const validate_form = document.getElementById('validate_form');
const lastname = document.getElementById('lastname');
const firstname = document.getElementById('firstname');
const captcha = document.getElementById('captcha');

const lastname_error = document.createElement('div');
lastname_error.style.color = "red";
lastname.insertAdjacentElement('afterend', lastname_error);

const firstname_error = document.createElement('div');
firstname_error.style.color = "red";
firstname.insertAdjacentElement('afterend', firstname_error);

const email_error = document.createElement('div');
email_error.style.color = "red";
email.insertAdjacentElement('afterend', email_error);

const phonenumber_error = document.createElement('div');
phonenumber_error.style.color = "red";
phonenumber.insertAdjacentElement('afterend', phonenumber_error);

const password_error = document.createElement('div');
password_error.style.color = "red";
password.insertAdjacentElement('afterend', password_error);

const confirm_password_error = document.createElement('div');
confirm_password_error.style.color = "red";
confirm_password.insertAdjacentElement('afterend', confirm_password_error);

const captcha_error = document.createElement('div');
captcha_error.style.color = "red";
captcha.insertAdjacentElement('afterend', captcha_error);

const checks = [
    [/.{8,}/, "caracteres"],
    [/[A-Z]/, "maj"],
    [/[0-9]/, "chiffre"],
    [/[!@#$%^&*(),.?":{}|<>]/, "special"]
];

password.addEventListener("input", () => {
    checks.forEach(([regex, id_liste_obligation]) => {
        const element = document.getElementById(id_liste_obligation);
        if (element) {
            const isValid = regex.test(password.value);
            element.classList.toggle("valid", isValid);
            element.classList.toggle("invalid", !isValid);
        }
    });
});

validate_form.addEventListener('submit', function(event) {
    let isValid = true;
    firstname_error.textContent = "";
    lastname_error.textContent = "";
    email_error.textContent = "";
    password_error.textContent = "";
    confirm_password_error.textContent = "";
    phonenumber_error.textContent = "";
    captcha_error.textContent = "";

    if (firstname.value.length < 2) {
        firstname_error.textContent = "Saisissez au moins 2 caractères";
        isValid = false;
    }

    if (lastname.value.length < 2) {
        lastname_error.textContent = "Saisissez au moins 2 caractères";
        isValid = false;
    }

    if (!email.value.includes('@')) {
        email_error.textContent = "Adresse e-mail invalide";
        isValid = false;
    }

    if (phonenumber.value.length < 10) {
        phonenumber_error.textContent = "Numéro de téléphone invalide";
        isValid = false;
    }

    const captchaClient = captcha.value.trim();
    const captchaSession= "<?= $_SESSION['captcha'] ?>";

    if (captchaClient.value !== captchaSession.value) {
        captcha_error.textContent = "Captcha invalide";
        isValid = false;
    }

    if (password.value.length < 8) {
        password_error.textContent = "Le mot de passe doit contenir au moins 8 caractères";
        isValid = false;
    }

    if (password.value !== confirm_password.value) {
        confirm_password_error.textContent = "Les mots de passe ne correspondent pas";
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault(); 
    }
});
