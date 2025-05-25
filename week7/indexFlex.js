function verify() {
    let name = document.getElementById("fname").value;
    let mail = document.getElementById("mail").value;
    let pass = document.getElementById("pass").value;
    let c_pass = document.getElementById("c_pass").value;
    let contry = document.getElementById("contry").value;
    let dob = document.getElementById("dob").value;
    let gender_m = document.getElementById("gen_m").checked;
    let gender_f = document.getElementById("gen_f").checked;
    let terms = document.getElementById("checkbox").checked;
    let backcolor = document.getElementById("color").value;

    const regex = /^[a-z A-Z]+([.\-][a-z A-Z]+)*$/;
    let hasNumber = /\d/.test(name);
    let isValidName = regex.test(name);

    if (hasNumber) {
        document.getElementById("alert").innerHTML = "Number in the NAME";
        return false;
    } else if (!isValidName) {
        document.getElementById("alert").innerHTML = "Invalid characters in the NAME";
        return false;
    }

    const validMail = /^[a-zA-Z0-9._-]+@(gmail|hotmail|yahoo)\.com$/;
    let validmail = validMail.test(mail);

    if (!validmail) {
        document.getElementById("alert").innerHTML = "Email must be from Gmail, Hotmail, or Yahoo";
        return false;
    }

    let passRegex = /^(?=.*[a-zA-Z])(?=.*\d)/;
    if (pass === '') {
        document.getElementById("alert").innerText = "Enter your password";
        return false;
    }

    if (pass.length < 8) {
        document.getElementById("alert").innerText = "Password must be at least 8 characters long.";
        return false;
    }

    if (!passRegex.test(pass)) {
        document.getElementById("alert").innerText = "Password must contain both letter and number.";
        return false;
    }

    if (c_pass === '') {
        document.getElementById("alert").innerText = "Enter your confirmation password";
        return false;
    }

    if (pass !== c_pass) {
        document.getElementById("alert").innerHTML = "Passwords do not match";
        return false;
    }

    if (dob == "") {
        document.getElementById("alert").innerHTML = "Select your DOB";
        return false;
    }else if(dob<18){
        document.getElementById("alert").innerHTML = "You must be at least 18 years old";
        return false;
    }

    if (contry == "") {
        document.getElementById("alert").innerHTML = "Select your Country";
        return false;
    }

    if (!gender_m && !gender_f) {
        document.getElementById("alert").innerHTML = "Please select a gender";
        return false;
    }

    if (!terms) {
        document.getElementById("alert").innerHTML = "Please agree to the terms and conditions";
        return false;
    }

    document.getElementById("alert").innerHTML = "All ok";
    
    return true;
}
