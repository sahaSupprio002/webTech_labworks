<?php 
function add_to_db($name, $email, $dob, $country, $gender, $pass) {
    $con = mysqli_connect("localhost", "root", "", "aqi");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO user (name, mail, password, dob, country, gender)
            VALUES ('$name', '$email', '$pass', '$dob', '$country', '$gender')";
    $obj = mysqli_query($con, $sql);

    mysqli_close($con);
}

function verify($email){
  $con = mysqli_connect("localhost", "root", "", "aqi");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT mail FROM user WHERE mail = '$email'";

    $obj = mysqli_query($con, $sql);

    if (mysqli_num_rows($obj) > 0){
      mysqli_close($con);
      return false;
    }
    else{
      mysqli_close($con);
      return true;
    }
}

function add_cookie($color){
    setcookie("bg_color", $color, time() + (30 * 24 * 60 * 60));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['fname'];
        $email = $_POST['mail'];
        $dob = $_POST['dob'];
        $country = $_POST['contry'];
        $gender = $_POST['gen'];
        $color = $_POST['color'];
        $pass = $_POST['pass'];
        //$feedback = $_POST['feedback'];
        $feedback = $_POST['feedback'] ?? ''; 

    // Check if 'done' or 'cancel' was pressed
    if (isset($_POST['done'])) {
        if(!verify($email)){
          echo "<h3 style='color:red;'>This email is already registered. Please use a different email.</h3>";
          header("Refresh: 2; url='index.html'");
          exit();
        }

        add_to_db($name, $email, $dob, $country, $gender, $pass);
        header("Refresh: 2; url='index.html'");
        add_cookie($color);
        exit();

    } elseif (isset($_POST['cancel'])) {
        header("Location: index.html");
        exit();

    } else {
        // First submission - show confirmation form

        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Confirm Details</title>
            <style>
                body {
                    height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background-color: #ddd;
                }
                .form-box {
                    font-size: 20px;
                    height: auto;
                    width: 400px;
                    background-color: rgb(161, 225, 206);
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
                }
                .button {
                    background-color: rgb(206, 64, 64);
                    color: white;
                    padding: 10px;
                    border-radius: 5px;
                    cursor: pointer;
                    font-weight: bold;
                    font-size: 16px;
                    border: none;
                }
                #first_btn {
                    background-color: rgb(114, 110, 224);
                }
                #sec_btn {
                    margin-right: 100px;
                    margin-left: 70px;
                }
                #details {
                    text-align: center;
                }
                .label {
                    width: 160px;
                    display: inline-block;
                    padding-left: 40px;
                }
                #feedback {
                    padding: 20px;
                    border: 1px solid #ccc;
                    background-color: #f9f9f9;
                    border-radius: 8px; /* Optional: rounded corners */
                    max-width: 400px;   /* Optional: control width */
                }
                #feedback-box {
                    
                    border: 2px solid black;
                    background-color: #f9f9f9;
                    border-radius: 8px;
                    margin-top: 20px;
                    margin-left: 30px;
                    width: 300px; 
                    font-family: sans-serif; 
                }
            </style>
        </head>
        <body>";

        echo <<<HTML
        <form method='post' class='form-box'>
            <div id='details'><h2>Confirm your details</h2></div>

            <div class='label'>Name: </div>$name<br><br>
            <div class='label'>Gmail: </div>$email<br><br>
            <div class='label'>DOB: </div>$dob<br><br>
            <div class='label'>Country: </div>$country<br><br>
            <div class='label'>Gender: </div>$gender<br><br>
            <div class='label'>Selected Colour: </div>$color<br><br>
            <div class="label">Feedback:</div><br>
            <div id="feedback-box">$feedback</div><br><br>

            <input type='hidden' name='fname' value='$name'>
            <input type='hidden' name='mail' value='$email'>
            <input type='hidden' name='dob' value='$dob'>
            <input type='hidden' name='contry' value='$country'>
            <input type='hidden' name='gen' value='$gender'>
            <input type='hidden' name='color' value='$color'>
            <input type='hidden' name='pass' value='$pass'>

            <input type='submit' class='button' id='sec_btn' name='cancel' value='Cancel'>
            <input type='submit' class='button' id='first_btn' name='done' value='Submit'>
        </form>
        </body>
        </html>
        HTML;
        exit();

    }

} else {
    echo "<h3 style='color:red;'>This page can't be accessed directly....</h3>";
    header("Refresh: 2; url='FFlex.php'");
    exit();
}
?>
