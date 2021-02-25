// function registerValidation()
// {
//     var form = document.forms["registerForm"];
//     let password1 = form.password1.value
//     let password2 = form.password2.value

//     const numberValidator = /\d/;
    // const specialValidator = /^[A-Za-z0-9 ]+$/;
//     let error = [];

//     if (password1 != password2) error.push("Password does not match!");
//     if (password1.length < 5) error.push("Password must be at least 6 characters long");
//     if (!numberValidator.test(password1)) error.push("Password must have a number");
    // if (specialValidator.test(password1)) error.push("Password must have a special character");

//     document.getElementById("validateMessage").innerHTML = ""; // clears to avoid duplicates
//     error.forEach((e) => document.getElementById("validateMessage").innerHTML += `${e}<br>`);

//     if(error.length != 0) document.getElementById("validateMessage").removeAttribute("hidden");
//     return error.length == 0 ? true : false;
// }

// function validateUsername()
// {
//     var username = document.forms["registerForm"].username.value;

//     var data = new FormData();
//     data.append("function", "checkUsername");
//     data.append("username", username);
//     checkUsernameFromServer(data)
//     .then(res => 
//     {
//         (res.data.fromServer == "True") ? document.getElementById("registerBtn").setAttribute("disabled", true) :  document.getElementById("registerBtn").removeAttribute("disabled");
//         (res.data.fromServer == "True") ? document.getElementById("usernameMessage").innerHTML = "Username already exists!" :  document.getElementById("usernameMessage").innerHTML = "";
//     });
// }