<?php
if (isset($_POST["id_venta"])) {
    // Conexión a la base de datos
    $cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2")
        or die("Error en la Conexión a MySQL");

    // Obtener los datos enviados por el formulario
    $id_venta = $_POST["id_venta"];
    $id_producto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];

    // Validaciones del lado del servidor
    if (!preg_match("/^[0-9]+$/", $cantidad)) {
        die("El campo 'Cantidad' solo puede contener números.");
    }
    if (!preg_match("/^[0-9.,]+$/", $precio)) {
        die("El campo 'Precio' solo puede contener números, comas y puntos.");
    }

    // Insertar en la base de datos
    $query = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "ssis", $id_venta, $id_producto, $cantidad, $precio);

    if (mysqli_stmt_execute($stmt)) {
        echo "Detalle insertado <br>";
        echo "<a href='dv.php'>Regresar</a>";
    } else {
        echo "Error al insertar el detalle: " . mysqli_error($cnx);
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
    <title>Agregar Cliente</title>
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
                const cantidad = document.querySelector("input[name='cantidad']").value;
                const precio = document.querySelector("input[name='precio']").value;

                // Validación para 'Cantidad' (solo números)
                const cantidadRegex = /^[0-9]+$/;
                if (!cantidadRegex.test(cantidad)) {
                    alert("El campo 'Cantidad' solo puede contener números.");
                    event.preventDefault();
                    return;
                }

                // Validación para 'Precio' (solo números, comas y puntos)
                const precioRegex = /^[0-9.,]+$/;
                if (!precioRegex.test(precio)) {
                    alert("El campo 'Precio' solo puede contener números, comas y puntos.");
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>
</head>
<body>

<center>
    <a href="dv.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
            <label for="id_venta" class="form-label">id_venta</label>
            <input name="id_venta" type="text" class="form-control" id="id_venta" required>
        </div>
        <div class="col-md-6">
            <label for="id_producto" class="form-label">id_producto</label>
            <input name="id_producto" type="text" class="form-control" id="id_producto" required>
        </div>
        <div class="col-md-6">
            <label for="cantidad" class="form-label">cantidad</label>
            <input name="cantidad" type="text" class="form-control" id="cantidad" required>
        </div>
        <div class="col-md-6">
            <label for="precio" class="form-label">precio</label>
            <input name="precio" type="text" class="form-control" id="precio" required>
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

