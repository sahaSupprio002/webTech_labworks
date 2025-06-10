<?php
    session_start();

    function verify_login($name, $password){
        $con = mysqli_connect("localhost", "root", "", "aqi");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT mail, password FROM user WHERE mail = '$name'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 0){
            mysqli_close($con);
            return false;
        }

        $row = mysqli_fetch_assoc($result);

        if($password != $row['password']){
            mysqli_close($con);
            return false;
        }

        mysqli_close($con);
        return true;
    }


    function verify_submit($name, $password){
        if($name == ""){
            return false;
        }else if($password == ""){
            return false;
        }
        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname = $_POST['uname'];
        $loginpass = $_POST['logPass'];

        if (verify_submit($uname, $loginpass) && verify_login($uname, $loginpass)) {
            $_SESSION['uname'] = $uname;
            header("Location: request.php");
            exit();
        } else {
            header("Location: index.html?error=" . urlencode("Login failed"));
            exit();
        }

    }else{
        echo "<h3 style='color:red;'>Can't be accessed. Redirecting to index page...</h3>";
        header("Refresh: 3; url=index.html");
        exit();
    }

?>