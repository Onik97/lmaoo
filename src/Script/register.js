function registerValidation()
{
    var form = document.forms["registerForm"];
    let username = form.username.value
    let password1 = form.password1.value
    let password2 = form.password2.value

    var data = new FormData();
    data.append('function', "checkUsername");
    data.append('username', username);

    const numberValidator = /\d/;
    const specialValidator = /^[A-Za-z0-9 ]+$/;
    let error = [];

    if (password1 != password2) error.push("Password does not match!");
    if (password1.length < 5) error.push("Password must be at least 6 characters long");
    if (!numberValidator.test(password1)) error.push("Password must have a number");
    if (specialValidator.test(password1)) error.push("Password must have a special character");

    document.getElementById("validateMessage").innerHTML = ""; // clears to avoid duplicates
    error.forEach((e) => document.getElementById("validateMessage").innerHTML += `${e}<br>`);

    if(error.length != 0) document.getElementById("validateMessage").removeAttribute("hidden");
    return error.length == 0 ? true : false;
}
