<?php
if (isset($_POST["total"])) {
    // Conexión a la base de datos
    $cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2")
        or die("Error en la Conexión a MySQL");

    // Obtener los datos enviados por el formulario
    $id_proveedor = $_POST["id_proveedor"];
    $fecha = $_POST["fecha"];
    $total = $_POST["total"];

    // Validación del lado del servidor para el campo 'total'
    if (!preg_match("/^[0-9.,]+$/", $total)) {
        die("El campo 'TOTAL' solo puede contener números, comas y puntos.");
    }

    // Insertar en la base de datos
    $query = "INSERT INTO compras (id_proveedor, fecha, total) VALUES ('$id_proveedor', '$fecha', '$total')";
    mysqli_query($cnx, $query);
    mysqli_close($cnx);

    echo "Compra insertada <br>";
    echo "<a href='compras.php'> Regresar </a>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Compra</title>
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
                const total = document.querySelector("input[name='total']").value;

                // Validación para 'TOTAL' (solo números, comas y puntos)
                const totalRegex = /^[0-9.,]+$/;
                if (!totalRegex.test(total)) {
                    alert("El campo 'TOTAL' solo puede contener números, comas y puntos.");
                    event.preventDefault();
                }
            });
        });
    </script>
</head>
<body>

<center>
    <a href="compras.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-4">
            <label for="id_proveedor" class="form-label">ID-PROVEEDOR</label>
            <input name="id_proveedor" type="text" class="form-control" id="id_proveedor" required>
        </div>
        <div class="col-md-4">
            <label for="fecha" class="form-label">Fecha</label>
            <input name="fecha" type="date" class="form-control" id="fecha" required>
        </div>
        <div class="col-md-4">
            <label for="total" class="form-label">TOTAL</label>
            <input name="total" type="text" class="form-control" id="total" required>
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


