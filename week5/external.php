<?php 
    echo "<div style='text-align: center; font-size: 30px; margin-top: 100px; background-color: rgb(206, 185, 185); blo'>";
    echo "Name: " . htmlspecialchars($_POST['fname']) . "<br>";
    echo "Gmail: " . htmlspecialchars($_POST['mail']) . "<br>";
    echo "DOB: " . htmlspecialchars($_POST['dob']) . "<br>";
    echo "Country: " . htmlspecialchars($_POST['contry']) . "<br>";
    echo "Gender: " . htmlspecialchars($_POST['gen']) . "<br>";
    echo "</div>";
?>
