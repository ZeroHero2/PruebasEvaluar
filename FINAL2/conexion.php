<?php
// conexion.php

$servername = "localhost"; // 
$username = "root"; // 
$password = ""; // 
$database = "zapateria2"; // 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>