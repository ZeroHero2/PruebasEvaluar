<?php
if (isset($_GET["id"])) {
    // Conexión a la base de datos
    $cnx = mysqli_connect("localhost", "root", "", "zapateria2")
        or die("Error en la Conexión a MySQL");

    // Obtener el ID de la venta desde la URL
    $id = $_GET["id"];

    // Consultar los datos de la venta
    $query = "SELECT id_cliente, fecha, total FROM ventas WHERE id = ?";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_cliente, $fecha, $total);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($cnx);
}

if (isset($_POST["fecha"])) {
    // Validar si el parámetro 'id' está en la URL
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        die("El parámetro 'id' no fue proporcionado en la URL.");
    }

    // Conexión a la base de datos
    $cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2")
        or die("Error en la Conexión a MySQL");

    // Obtener los datos enviados por el formulario
    $id_cliente = $_POST["id_cliente"];
    $fecha = $_POST["fecha"];
    $total = $_POST["total"];

    // Validaciones del lado del servidor
    if (!preg_match("/^[a-zA-Z0-9]+$/", $id_cliente)) {
        die("El campo 'id-CLIENTE' solo puede contener letras y números, sin símbolos.");
    }
    if (!preg_match("/^[0-9.]+$/", $total)) {
        die("El campo 'Total' solo puede contener números.");
    }

    // Actualización en la base de datos
    $query = "UPDATE ventas SET id_cliente=?, fecha=?, total=? WHERE id=?";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "ssdi", $id_cliente, $fecha, $total, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Venta Editada<br>";
        echo "<a href='Ventas.php'> Regresar </a>";
    } else {
        echo "Error al editar la venta: " . mysqli_error($cnx);
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
    <title>Editar Venta</title>
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
                const idCliente = document.querySelector("input[name='id_cliente']").value;
                const total = document.querySelector("input[name='total']").value;

                // Validación para 'id-CLIENTE' (solo letras y números, sin símbolos)
                const idClienteRegex = /^[a-zA-Z0-9]+$/;
                if (!idClienteRegex.test(idCliente)) {
                    alert("El campo 'id-CLIENTE' solo puede contener letras y números, sin símbolos.");
                    event.preventDefault();
                    return;
                }

                // Validación para 'Total' (solo números)
                const totalRegex = /^[0-9.]+$/;
                if (!totalRegex.test(total)) {
                    alert("El campo 'Total' solo puede contener números.");
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>
</head>
<body>

<center>
    <a href="Ventas.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-12">
            <label for="validationCustom01" class="form-label">id-CLIENTE</label>
            <input name="id_cliente" type="text" class="form-control" id="validationCustom01" value="<?php echo isset($id_cliente) ? $id_cliente : ''; ?>" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom02" class="form-label">FECHA</label>
            <input name="fecha" type="date" class="form-control" id="validationCustom02" value="<?php echo isset($fecha) ? $fecha : ''; ?>" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom03" class="form-label">Total</label>
            <input name="total" type="text" class="form-control" id="validationCustom03" value="<?php echo isset($total) ? $total : ''; ?>" required>
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

