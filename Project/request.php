<?php
session_start();

if (empty($_SESSION['uname'])) {
    echo "<h3 style='color:red;'>Unauthorized access. Redirecting to login page...</h3>";
    header("Refresh: 3; url=index.html");
    exit();
}

$bg_color = isset($_COOKIE['bg_color']) ? $_COOKIE['bg_color'] : "#ffffff";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Cities</title>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel='stylesheet'>

    <style>

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f2f9f7;
        }

        .top-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            position: relative;
        }

        .left-group {
            display: flex;
            align-items: center;
        }

        .logo {
            height: 70px;
            width: 70px;
            border-radius: 60%;
        }

        .logo-text {
            margin-left: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .center-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            color: #333;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .center-title h1 {
            margin: 0;
            font-size: 28px;
        }

        .right-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        #logout {
            background-color: rgb(206, 64, 64);
            color: white;
            font-weight: bold;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #option {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        #info {
            background-color:  #dbcae0;
            /* border: 2px solid black; */
            border-radius: 5px;
            padding: 20px 30px;
            width: fit-content;
            columns: 2;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .checkbox-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 250px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            margin-top: 15px;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
        }

        #show {
            background-color: #a0bcf6 ;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        #opt {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        
        


    </style>
</head>
<body style="background-color: <?= $bg_color ?>">
    <div class="top-container">
        <div class="left-group">
            <img src="aqi.jpg" alt="AQI" class="logo">
            <div class="logo-text">AQI</div>
        </div>

        <div class="center-title">
            <h1>Select 10 Cities</h1>
            <h1>to view their AQI</h1>
        </div>

        <div class="right-group">
            <div class="user">
                <?php echo "<h4>Welcome, " . $_SESSION['uname'] . "!</h4>"; ?>
            </div>
            <form action="logout.php" method="post">
                <button type="submit" name="logout" id="logout">Logout</button>
            </form>
        </div>
    </div>



    <div id="option">
        <?php
        $con = mysqli_connect("localhost", "root", "", "aqi");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT city, country FROM info";
        $result = mysqli_query($con, $sql);

        echo "<form action='showaqi.php' method='post'>";
        echo "<div id='info'>";

        if (mysqli_num_rows($result) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $city = htmlspecialchars($row['city']);
                $country = htmlspecialchars($row['country']);
                echo "
                    <div class='checkbox-row'>
                        <span>{$i}. {$city}, {$country}</span>
                        <input type='checkbox' name='checkbox[]' value='{$city}'>
                    </div>
                ";
                $i++;
            }
        } else {
            echo "<p>No data found.</p>";
        }

        echo "</div>";
        echo "<div id='opt'><button type='submit' id='show'>Show</button></div>";
        echo "</form>";

        mysqli_close($con);
        ?>
    </div>

    

</body>
</html>
