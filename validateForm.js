function validateform() {
    var lastname = document.getElementById('lastname').value;
    var firstname = document.getElementById('firstname').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm-password').value;
    var phonenumber = document.getElementById('phonenumber').value;
    var errorMSG = document.getElementById('error-msg');

    if (lastname == "" || firstname == "" || email == "" || password == "" || confirm_password == "" || phonenumber == "") {
        document.getElementById('error-msg').innerHTML = "Tous les champs sont obligatoires";
        return false;
    }

    if (password != confirm_password) {
        document.getElementById('error-msg').innerHTML = "Les mots de passe ne correspondent pas";
        errorMSG.style.color = "red";
        return false;
    }



    return true;
}