<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #option{
            justify-items: center;
        }
        #head{
            text-align: center;
        }
        .checkbox-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 300px;
            margin-bottom: 8px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <div id="head">
        <h1>Select 10 cities</h1>
    </div>

    <div id="option">
    <?php
    $con = mysqli_connect("localhost", "root", "", "aqi_info"); 

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT city, country FROM aqi_info";
    $obj = mysqli_query($con, $sql);

    echo "<form action='showaqi.php' method='post' style='background-color: rgb(172, 226, 209); border: 2px solid black; border-radius: 5px; padding: 10px'>";
    if (mysqli_num_rows($obj) > 0) {
        $i = 1;
        while ($entry = mysqli_fetch_assoc($obj)) {
        echo "<div class='checkbox-row'>
                <span>" . $i . ". " . $entry['city'] . ", " . $entry['country'] . "</span>
                <input type='checkbox' value='" . htmlspecialchars($entry['city']) . "' class='checkbox' name='checkbox[]'>
              </div>";
        $i++;
        }
    } else {
        echo "No data found.";
    }

    echo "<input type='submit' value='submit' style = 'border-radius: 5px; padding: 10px; font-weight: bold'></form>";

    mysqli_close($con);
    ?>
    </div>

</body>
</html>