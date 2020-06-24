function checkPassword(form) 
{ 
    password1 = form.password1.value; 
    password2 = form.password2.value; 

    if (password1 != password2)
    document.getElementById("validateMessage").removeAttribute("hidden");
    document.getElementById("validateMessage").innerHTML = "Password does not match, please try again!";
    return false;
};