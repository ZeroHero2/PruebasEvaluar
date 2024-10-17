<?php
session_start(); // Iniciar la sesión
include 'conexion.php'; // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Prevenir inyección SQL utilizando prepared statements
    $stmt = $conn->prepare("SELECT id_usuario, password FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario); // "s" significa string

    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Si se encuentra el usuario, obtenemos la contraseña
        $stmt->bind_result($id_usuario, $password_db);
        $stmt->fetch();

        // Verificar si la contraseña ingresada coincide con la almacenada en la base de datos
        if ($password === $password_db) { // Comparación sin hash
            // Iniciar sesión y guardar el usuario en la sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id_usuario'] = $id_usuario;

            // Redirigir al usuario a la página correcta
            if ($usuario === "admin") {
                header("Location: admin.php"); // Redirigir al admin
            } elseif ($usuario === "gerven") {
                header("Location: personal.php"); // Redirigir al vendedor
            } else {
                header("Location: principal.php"); // pagina principal sin error
            }
            exit;
        } else {
            // Contraseña incorrecta
            header("Location: principal.php?error=password incorrect"); // Redirigir a principal.php con error
            exit;
        }
    } else {
        // Usuario no encontrado
        header("Location: principal.php?error=user not found"); // Redirigir a principal.php con error
        exit;
    }

    $stmt->close(); // Cerrar la consulta
}

$conn->close(); // Cerrar la conexión a la base de datos
?>