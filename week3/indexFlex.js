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

    const regex = /^[a-z A-Z.\-]+$/;
    let hasNumber = /\d/.test(name);
    let isValidName = regex.test(name);

    if (hasNumber) {
        document.getElementById("alart").innerHTML = "Number in the NAME";
        return false;
    } else if (!isValidName) {
        document.getElementById("alart").innerHTML = "Invalid characters in the NAME";
        return false;
    }

    const validMail = /^[a-zA-Z0-9._-]+@(gmail|hotmail|yahoo)\.com$/;
    let validmail = validMail.test(mail);

    if (!validmail) {
        document.getElementById("alart").innerHTML = "Email must be from Gmail, Hotmail, or Yahoo";
        return false;
    }

    if(pass==''){
        document.getElementById("alart").innerHTML = "Enter your password";
        return false;
    }

    let passRegex = /^(?=.*[a-zA-Z])(?=.*\d).+$/;
    if (!passRegex.test(pass)) {
      document.getElementById('alart').innerText = "Password must contain both letters and numbers.";
      return valid = false;
    } 

    if(c_pass==''){
        document.getElementById("alart").innerHTML = "Enter your conformation password";
        return false;
    }

    if (pass !== c_pass) {
        document.getElementById("alart").innerHTML = "Passwords do not match";
        return false;
    }

    if (dob == "") {
        document.getElementById("alart").innerHTML = "Select your DOB";
        return false;
    }

    if (contry == "") {
        document.getElementById("alart").innerHTML = "Select your Country";
        return false;
    }

    if (!gender_m && !gender_f) {
        document.getElementById("alart").innerHTML = "Please select a gender";
        return false;
    }

    if (!terms) {
        document.getElementById("alart").innerHTML = "Please agree to the terms and conditions";
        return false;
    }

    document.getElementById("flex1").style.backgroundColor = backcolor;

    document.getElementById("alart").innerHTML = "All ok";
    return false;
}
