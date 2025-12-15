<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$db = "semestral";

$conn = new mysqli($host, $usuario, $contrasena, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
