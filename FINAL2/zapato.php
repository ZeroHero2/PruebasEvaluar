<?php
if (isset($_POST["nombre"])) {
    // Conexión a la base de datos
    $cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2")
        or die("Error en la Conexión a MySQL");

    // Obtener los datos enviados por el formulario
    $nombre = $_POST["nombre"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $id_proveedor = $_POST["id_proveedor"];

    // Validaciones del lado del servidor
    if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
        die("El campo 'Nombre' solo puede contener letras.");
    }
    if (!preg_match("/^[0-9]+$/", $stock)) {
        die("El campo 'Stock' solo puede contener números.");
    }
    if (!preg_match("/^[0-9]+$/", $precio)) {
        die("El campo 'Precio' solo puede contener números.");
    }
    if (!preg_match("/^[a-zA-Z0-9]+$/", $id_proveedor)) {
        die("El campo 'ID_PROVEEDOR' solo puede contener letras y números, sin símbolos.");
    }

    // Insertar en la base de datos
    $query = "INSERT INTO productos (nombre, stock, precio, id_proveedor) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "siis", $nombre, $stock, $precio, $id_proveedor);

    if (mysqli_stmt_execute($stmt)) {
        echo "Producto insertado<br>";
        echo "<a href='catalogo.php'>Regresar</a>";
    } else {
        echo "Error al insertar el producto: " . mysqli_error($cnx);
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
    <title>Agregar Producto</title>
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
                const stock = document.querySelector("input[name='stock']").value;
                const precio = document.querySelector("input[name='precio']").value;
                const idProveedor = document.querySelector("input[name='id_proveedor']").value;

                // Validación para 'Nombre' (solo letras)
                const nombreRegex = /^[a-zA-Z\s]+$/;
                if (!nombreRegex.test(nombre)) {
                    alert("El campo 'Nombre' solo puede contener letras.");
                    event.preventDefault();
                    return;
                }

                // Validación para 'Stock' y 'Precio' (solo números)
                const numeroRegex = /^[0-9]+$/;
                if (!numeroRegex.test(stock)) {
                    alert("El campo 'Stock' solo puede contener números.");
                    event.preventDefault();
                    return;
                }
                if (!numeroRegex.test(precio)) {
                    alert("El campo 'Precio' solo puede contener números.");
                    event.preventDefault();
                    return;
                }

                // Validación para 'ID_PROVEEDOR' (letras y números, sin símbolos)
                const idProveedorRegex = /^[a-zA-Z0-9]+$/;
                if (!idProveedorRegex.test(idProveedor)) {
                    alert("El campo 'ID_PROVEEDOR' solo puede contener letras y números, sin símbolos.");
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>
</head>
<body>

<center>
    <a href="catalogo.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" 
        width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-12">
            <label for="validationCustom01" class="form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" id="validationCustom01" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom02" class="form-label">Stock</label>
            <input name="stock" type="number" class="form-control" id="validationCustom02" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom03" class="form-label">Precio</label>
            <input name="precio" type="number" class="form-control" id="validationCustom03" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom04" class="form-label">ID_PROVEEDOR</label>
            <input name="id_proveedor" type="text" class="form-control" id="validationCustom04" required>
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
