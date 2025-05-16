<?php
if (isset($_POST['checkbox'])) {
    $selected = $_POST['checkbox'];
    $count = count($selected);

    if ($count !== 10) {
        echo "<h3 style='color:red;'>Please select exactly 10 cities. You will be redirected back shortly...</h3>";
        header("Refresh: 2; url=" . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $con = mysqli_connect("localhost", "root", "", "aqi_info"); 

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "
    <style>
        table {
            border: 3px solid aqua;
            border-collapse: collapse;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid aqua;
            padding: 10px 15px;
            text-align: center;
        }
        th {
            background-color: #def;
        }
        #head{
            text-align: center;
        }
    </style>";

    echo "<div >
        <h1 id= 'head'>AQI of 10 selected cities</h1>
        </div>";

    echo "<table>
            <tr>
                <th>City</th>
                <th>Country</th>
                <th>AQI</th>
            </tr>";

    foreach ($selected as $city) {
        $cityEscaped = mysqli_real_escape_string($con, $city);
        $sql = "SELECT city, country, aqi FROM aqi_info WHERE city = '$cityEscaped'";
        $obj = mysqli_query($con, $sql);

        while ($entry = mysqli_fetch_assoc($obj)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($entry['city']) . "</td>";
            echo "<td>" . htmlspecialchars($entry['country']) . "</td>";
            echo "<td>" . htmlspecialchars($entry['aqi']) . "</td>";
            echo "</tr>";
        }
    }

    echo "</table>";


    mysqli_close($con);

} else {
    echo "<h3 style='color:red;'>No cities selected. You will be redirected back shortly...</h3>";
    header("Refresh: 2; url=" . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
