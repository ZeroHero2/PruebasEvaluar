<?php
// Validar si el parámetro 'id' está en la URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    die("El parámetro 'id' no fue proporcionado en la URL.");
}

// Conexión a la base de datos
$cnx = mysqli_connect("localhost", "root", "", "zapateria2")
    or die("Error en la conexión a MySQL");

// Inicializar variables
$nombre = '';
$telefono = '';
$direccion = '';

// Recuperar los datos del proveedor si no se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT nombre, telefono, direccion FROM proveedores WHERE id=?";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nombre, $telefono, $direccion);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos enviados por el formulario
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    // Validaciones del lado del servidor
    if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
        die("El campo 'Nombre' solo puede contener letras.");
    }
    if (!preg_match("/^[0-9]+$/", $telefono)) {
        die("El campo 'Teléfono' solo puede contener números.");
    }
    if (!preg_match("/^[\w\s.,#-]+$/", $direccion)) {
        die("El campo 'Dirección' contiene caracteres no permitidos.");
    }

    // Actualización en la base de datos
    $query = "UPDATE proveedores SET nombre=?, telefono=?, direccion=? WHERE id=?";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $nombre, $telefono, $direccion, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Proveedor Editado!<br>";
        echo "<a href='proveedor.php'>Regresar</a>";
    } else {
        echo "Error al editar el proveedor: " . mysqli_error($cnx);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($cnx);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #f3f3f3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            margin: 20px auto;
            display: block;
            max-width: 50%;
            height: auto;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector("form").addEventListener("submit", function (event) {
                const nombre = document.querySelector("input[name='nombre']").value;
                const telefono = document.querySelector("input[name='telefono']").value;
                const direccion = document.querySelector("input[name='direccion']").value;

                // Validación para 'Nombre' (solo letras)
                const nombreRegex = /^[a-zA-Z\s]+$/;
                if (!nombreRegex.test(nombre)) {
                    alert("El campo 'Nombre' solo puede contener letras.");
                    event.preventDefault();
                    return;
                }

                // Validación para 'Teléfono' (solo números)
                const telefonoRegex = /^[0-9]+$/;
                if (!telefonoRegex.test(telefono)) {
                    alert("El campo 'Teléfono' solo puede contener números.");
                    event.preventDefault();
                    return;
                }

                // Validación para 'Dirección' (números, símbolos y caracteres)
                const direccionRegex = /^[\w\s.,#-]+$/;
                if (!direccionRegex.test(direccion)) {
                    alert("El campo 'Dirección' contiene caracteres no permitidos.");
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>
</head>
<body>

<center>
    <a href="proveedor.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-12">
            <label for="validationCustom01" class="form-label">NOMBRE</label>
            <input name="nombre" type="text" class="form-control" id="validationCustom01" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom02" class="form-label">TELÉFONO</label>
            <input name="telefono" type="text" class="form-control" id="validationCustom02" value="<?php echo htmlspecialchars($telefono); ?>" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom03" class="form-label">DIRECCIÓN</label>
            <input name="direccion" type="text" class="form-control" id="validationCustom03" value="<?php echo htmlspecialchars($direccion); ?>" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>


