<?php
// Habilitar la visualización de errores para facilitar la depuración
ini_set("display_errors", E_ALL);
error_reporting(E_ALL);

// Conexión a la base de datos "zapateria2"
$cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2") 
or die("Error en la conexión a MySQL");

// Obtener los datos enviados por el formulario
$id_cliente = $_POST['id_cliente'];
$total = $_POST['total'];
$fecha = $_POST['fecha'];

// Validar que los campos no estén vacíos
if (empty($id_cliente) || empty($total) || empty($fecha)) {
    die("Todos los campos son obligatorios.");
}

// Consulta para insertar una nueva venta
$query = "INSERT INTO ventas (id_cliente, total, fecha) VALUES (?, ?, ?)";

// Preparar la consulta
$stmt = mysqli_prepare($cnx, $query);

// Enlazar parámetros (s = string, d = double, i = integer)
mysqli_stmt_bind_param($stmt, "ids", $id_cliente, $total, $fecha);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    echo "Venta agregada exitosamente.";
} else {
    echo "Error al agregar la venta: " . mysqli_error($cnx);
}

// Cerrar la declaración y la conexión
mysqli_stmt_close($stmt);
mysqli_close($cnx);
?>
