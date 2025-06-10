<?php

session_start(); // Start session at the top before any output

// Check if form is submitted with checkbox data
if (isset($_POST['checkbox'])) {
    $selectedCities = $_POST['checkbox'];
    $selectedCount = count($selectedCities);

    // Validate that exactly 10 cities were selected
    if ($selectedCount !== 10) {
        echo "<h3 style='color:red;'>Please select exactly 10 cities. You will be redirected back shortly...</h3>";
        header("Refresh: 3; url=" . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Connect to the database
    $connection = mysqli_connect("localhost", "root", "", "aqi");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    $bg_color = isset($_COOKIE['bg_color']) ? $_COOKIE['bg_color'] : "#ffffff";
    // HTML & styles
    echo "
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel='stylesheet'>

    <style>

        body {
            margin: 0;
            background-color:  {$bg_color};
            font-family:'Poppins', sans-serif;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
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



        table {
            border-collapse: collapse;
            margin: 40px auto;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
        }
        th, td {
            padding: 10px 15px;
            text-align: center;
        }
        th {
            background-color: #def;
        }
        tr:nth-child(even) {
            background-color: #BEC3EB ;
        }
        tr:nth-child(odd) {
            background-color: #CCC7E6 ;
        }
        #head {
            text-align: center;
        }
    </style>";

    // Header and session display
    echo '
    <div class="top-container">
        <div class="left-group">
            <img src="aqi.jpg" alt="AQI" class="logo">
            <div class="logo-text">AQI</div>
        </div>

        <div class="center-title">
            <h1>AQI of your </h1>
            <h1>Selected Cities</h1>
        </div>

        <div class="right-group">
            <div class="user">
                <h4>Welcome, ' . htmlspecialchars($_SESSION["uname"]) . '!</h4>
            </div>
            <form action="logout.php" method="post">
                <button type="submit" name="logout" id="logout">Logout</button>
            </form>
        </div>
    </div>';


    
    echo "<table>
            <tr>
                <th>City</th>
                <th>Country</th>
                <th>AQI</th>
            </tr>";


    foreach ($selectedCities as $cityName) {
        $cityEscaped = mysqli_real_escape_string($connection, $cityName);
        $query = "SELECT city, country, aqi FROM info WHERE city = '$cityEscaped'";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['city']) . "</td>
                    <td>" . htmlspecialchars($row['country']) . "</td>
                    <td>" . htmlspecialchars($row['aqi']) . "</td>
                  </tr>";
        }
    }

    echo "</table>";

    mysqli_close($connection);

} else {

    echo "<h3 style='color:red;'>No cities selected. You will be redirected back shortly...</h3>";
    header("Refresh: 2; url=request.php");
    exit();
}
?>
