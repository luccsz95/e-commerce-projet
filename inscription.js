const email = document.getElementById('email');
const password = document.getElementById('password');
const confirm_password = document.getElementById('confirm-password');
const validate_form = document.getElementById('validate_form');
const lastname = document.getElementById('lastname');
const firstname = document.getElementById('firstname');

const checks = [
    [/.{8,}/, "caracteres"],
    [/[A-Z]/, "maj"],
    [/[0-9]/, "chiffre"],
    [/[!@#$%^&*(),.?":{}|<>]/, "special"]
];

password.addEventListener("input", () => {
    checks.forEach(([regex, id_liste_obligation]) => {
        const element = document.getElementById(id_liste_obligation);
        const isValid = regex.test(password.value);
        element.classList.toggle("valid", isValid);
        element.classList.toggle("invalid", !isValid);
    });
});
validate_form.addEventListener('submit', function(event) {
    let isValid = true;

    if (firstname.value.length < 2) {
        event.preventDefault();
        document.getElementById('error-msg').innerHTML = "Le prénom doit comporter au moins 2 caractères.";
        let errorMSG = document.getElementById('error-msg');
        errorMSG.style.color = "red";
        return false;
    }

    if (lastname.value.length < 2) {
        event.preventDefault();
        document.getElementById('error-msg').innerHTML = "Le nom doit comporter au moins 2 caractères.";
        let errorMSG = document.getElementById('error-msg');
        errorMSG.style.color = "red";
        return false;
    }



    if (!(password.value.length >= 8 && /[A-Z]/.test(password.value) && /\d/.test(password.value) && /[\W_]/.test(password.value))) {
        isValid = false;
        alert("Le mot de passe doit être fort (au moins 8 caractères, avec des majuscules, des chiffres et des caractères spéciaux).");
    }

    if (password.value !== confirm_password.value) {
        isValid = false;
        alert("Les mots de passe ne correspondent pas.");
    }

    if (!isValid) {
        event.preventDefault();
    }
});

