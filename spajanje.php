<?php
$servername = "localhost";
$username = "root";
$password = "";
$basename = "eurotrails";

$dbc = @mysqli_connect($servername, $username, $password, $basename);

if (!$dbc) {
    die("Spajanje nije uspjelo: " . mysqli_connect_error());
}

mysqli_set_charset($dbc, "utf8mb4");
?>