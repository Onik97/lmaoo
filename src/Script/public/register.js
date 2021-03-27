import RegisterController from "../Controller/RegisterController.js";
import Constant from "../Utility/Constant.js";
import DataTypeUtility from "../Utility/DataTypeUtility.js";
import Validator from "../Utility/Validator.js";

$(document).ready(() => { Navbar.accountActiveTab(); });

//Submit Register Form
$("#registerForm").submit(function() {

    let registerData = DataTypeUtility.SerializedArrayToJSON($(this).serializeArray());
    let error = [];

    if (registerData.password1 != registerData.password2) error.push("Password does not match!");
    if (!Validator.validateMinimumLength(registerData.password1, Constant.USER_PASSWORD_MINIMUM_LENGTH)) error.push("Password must be at least 6 characters long");
    if (!Validator.validateNumber(registerData.password1)) error.push("Password must have a number");
    if (!Validator.validateSpecialCharacter(registerData.password1)) error.push("Password must have a special character");
    
    $("#validateMessage").html(""); // clears to avoid duplicates
    error.forEach((e) => document.getElementById("validateMessage").innerHTML += `${e}<br>`);
    if(error.length != 0) document.getElementById("validateMessage").removeAttribute("hidden");
    return error.length == 0 && $("#usernameMessage").html() == "" ? true : false;
});

// Checks for Username Dupliates
$("#usernameRegister").keyup(async function() {
    let usernameDuplication = await RegisterController.validateUsername($(this).val());

    if(usernameDuplication.data.fromServer == "True") {
        $("#usernameMessage").html("Username already exist!");
        $("#registerBtn").prop("disabled", true);
    }
    else {
        $("#usernameMessage").html("");
        $("#registerBtn").prop("disabled", false);
    }

})