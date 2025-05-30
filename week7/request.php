<?php
session_start();

if (empty($_SESSION['uname'])) {
    echo "<h3 style='color:red;'>Unauthorized access. Redirecting to login page...</h3>";
    header("Refresh: 3; url=index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Cities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ddd;
        }

        #head {
            text-align: center;
            margin-top: 20px;
        }

        #option {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        #info {
            background-color: rgb(172, 226, 209);
            border: 2px solid black;
            border-radius: 5px;
            padding: 20px 30px;
            width: fit-content;
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
            background-color: rgb(79, 75, 186);
            color: white;
            font-weight: bold;
            padding: 10px 70px;
            border-radius: 5px;
            margin-left: 30px;
        }

        #logout {
            background-color: rgb(206, 64, 64);
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #logout-container {
            
            text-align: right;
            margin-right: 300px;
        }
        #top-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 200px;                 
            transform: translateX(120px);
        }

    </style>
</head>
<body>

    <div id="head">
        <h1>Select 10 Cities</h1>
    </div>

    <div id="top-bar">
        <div id="user">
            <?php
            echo "<h4>Welcome, " . $_SESSION['uname'] . "!</h4>";
            ?>
        </div>
        <div id="logout-container">
            <form action="logout.php" method="post">
                <button type="submit" name='logout' id="logout">Logout</button>
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

        echo "<button type='submit' id='show'>Show</button>";
        echo "</div>";
        echo "</form>";

        mysqli_close($con);
        ?>
    </div>

</body>
</html>
