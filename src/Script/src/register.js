import RegisterController from "../Controller/RegisterController.js";
import DataTypeUtility from "../Utility/DataTypeUtility.js";
import Validator from "../Utility/Validator.js";

//Submit Register Form
$("#registerForm").submit(function() {

    let registerData = DataTypeUtility.SerializedArrayToJSON($(this).serializeArray());
    let error = [];

    if (registerData.password1 != registerData.password2) error.push("Password does not match!");
    if (!Validator.validateMinimumLength(registerData.password1, 5)) error.push("Password must be at least 6 characters long");
    if (!Validator.validateNumber(registerData.password1)) error.push("Password must have a number");
    if (!zValidator.validateSpecialCharacter(registerData.password1)) error.push("Password must have a special character");
    
     $("#validateMessage").html(""); // clears to avoid duplicates
     error.forEach((e) => document.getElementById("validateMessage").innerHTML += `${e}<br>`);
     if(error.length != 0) document.getElementById("validateMessage").removeAttribute("hidden");
     return error.length == 0 ? true : false;
});