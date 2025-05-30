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

    // HTML & styles
    echo "
    <style>
        body {
            background-color: #ddd;
            font-family: Arial, sans-serif;
            background-color:".$_COOKIE['bg_color'].";
        }
        #top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px auto;
            width: 80%;
        }
        #user h4 {
            margin: 0;
        }
        #logout-container {
            text-align: right;
        }
        #logout {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        table {
            border: 3px solid aqua;
            border-collapse: collapse;
            background-color: #f0f8ff;
            margin: 20px auto;
            font-family: Arial, sans-serif;
            width: 80%;
        }
        th, td {
            border: 1px solid aqua;
            padding: 10px 15px;
            text-align: center;
        }
        th {
            background-color: #def;
        }
        #head {
            text-align: center;
        }
    </style>";

    // Header and session display
    echo "
    <div>
        <h1 id='head'>AQI of 10 Selected Cities</h1>
    </div>

    <div id='top-bar'>
        <div id='user'>
            <h4>Welcome, " . htmlspecialchars($_SESSION['uname']) . "!</h4>
        </div>
        <div id='logout-container'>
            <form action='logout.php' method='post'>
                <button type='submit' name='logout' id='logout'>Logout</button>
            </form>
        </div>
    </div>";

    // Start table
    echo "<table>
            <tr>
                <th>City</th>
                <th>Country</th>
                <th>AQI</th>
            </tr>";

    // Loop through each selected city and fetch data
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
    // If no checkboxes were selected
    echo "<h3 style='color:red;'>No cities selected. You will be redirected back shortly...</h3>";
    header("Refresh: 2; url=request.php");
    exit();
}
?>
