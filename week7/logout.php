<?php

//setcookie('bg_color', '', time() - 3600); session_start();
session_unset();
session_destroy();

header("Location: index.html");
exit();
?>
