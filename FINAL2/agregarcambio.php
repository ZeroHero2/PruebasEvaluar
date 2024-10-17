<?php
if (isset($_POST["cantidad"])) {
    $cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2")
        or die("Error en la Conexión a MySQL");

    $id_venta = $_POST["id_venta"];
    $id_producto = $_POST["id_producto"];
    $fecha = $_POST["fecha"];
    $cantidad = $_POST["cantidad"];

    $query = "INSERT INTO cambios (id_venta,id_producto,fecha,cantidad) VALUES ('$id_venta',$id_producto,$fecha,$cantidad)";
    mysqli_query($cnx, $query);
    mysqli_close($cnx);

    echo "Cambio insertado <br>";
    echo "<a href='cambios.php'> Regresar </a>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cambio</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #f3f3f3; /* Fondo claro */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 600px; /* Ancho máximo del formulario */
            margin: 30px auto; /* Centrar el formulario */
            padding: 20px;
            background-color: white; /* Fondo blanco para el formulario */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
        }

        .logo {
            margin: 20px auto;
            display: block;
            max-width: 50%;
            height: auto;
        }
    </style>
</head>
<body>

<center>
    <a href="cambios.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-12">
            <label for="id_venta" class="form-label">ID_VENTA</label>
            <input name="id_venta" type="text" class="form-control" id="id_venta" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-12">
            <label for="id_producto" class="form-label">ID_PRODUCTO</label>
            <input name="id_producto" type="text" class="form-control" id="id_producto" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-12">
            <label for="fecha" class="form-label">FECHA</label>
            <input name="fecha" type="date" class="form-control" id="fecha" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-12">
            <label for="cantidad" class="form-label">CANTIDAD</label>
            <input name="cantidad" type="text" class="form-control" id="cantidad" required>
            <div class="valid-feedback">
                Looks good!
            </div>
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
