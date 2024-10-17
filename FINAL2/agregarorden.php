<?php
if (isset($_POST["id_cliente"])) {
    $cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2")
        or die("Error en la Conexión a MySQL");

    $id_cliente = $_POST["id_cliente"];
    $fecha = $_POST["fecha"];
    $total = $_POST["total"];
    
    $query = "INSERT INTO ventas (id_cliente, fecha, total) VALUES ('$id_cliente', '$fecha', '$total')";
    mysqli_query($cnx, $query);
    mysqli_close($cnx);

    echo "Venta insertada <br>";
    echo "<a href='Ventas.php'> Regresar </a>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Venta</title>
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
    <a href="Ventas.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
            <label for="id_cliente" class="form-label">Id-Cliente</label>
            <input name="id_cliente" type="text" class="form-control" id="id_cliente" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="fecha" class="form-label">Fecha</label>
            <input name="fecha" type="date" class="form-control" id="fecha" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="total" class="form-label">Total</label>
            <input name="total" type="text" class="form-control" id="total" required>
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
