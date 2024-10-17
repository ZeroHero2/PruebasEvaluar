<?php
// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'usuario', 'contraseña', 'nombre_base_datos');

// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta SQL
$sql = "SELECT * FROM nombre_tabla";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta tuvo éxito
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Usar el resultado si no hay error
while ($fila = mysqli_fetch_row($resultado)) {
    print_r($fila);
}

mysqli_close($conexion);
?>
