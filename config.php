<?php
$servername = "localhost:3307";
$username = "root";
$password = "1234";
$dbname = "imobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
