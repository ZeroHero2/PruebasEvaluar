<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $cnx = mysqli_connect("localhost", "root", "", "zapateria2")
        or die("Error en la conexión a MySQL");

    // Consultar los datos del cliente con el ID proporcionado
    $query = "SELECT nombre, telefono, direccion FROM clientes WHERE id='$id'";
    $result = mysqli_query($cnx, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $cliente = mysqli_fetch_assoc($result);
        $nombre = $cliente['nombre'];
        $telefono = $cliente['telefono'];
        $direccion = $cliente['direccion'];
    } else {
        echo "No se encontró el cliente.<br>";
        exit;
    }

    // Si se envía el formulario
    if (isset($_POST["nombre"])) {
        $nombre = mysqli_real_escape_string($cnx, $_POST["nombre"]);
        $telefono = mysqli_real_escape_string($cnx, $_POST["telefono"]);
        $direccion = mysqli_real_escape_string($cnx, $_POST["direccion"]);

        // Usar una sentencia preparada para evitar inyección SQL
        $query_update = "UPDATE clientes SET nombre=?, telefono=?, direccion=? WHERE id=?";
        $stmt = mysqli_prepare($cnx, $query_update);
        mysqli_stmt_bind_param($stmt, "sssi", $nombre, $telefono, $direccion, $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Cliente Editado correctamente!<br>";
        } else {
            echo "No se realizó ninguna modificación.<br>";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($cnx);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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
    <a href="clientes.php">
        <img class="logo" src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px" alt="Logo" />
    </a>
</center>

<div class="container">
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-12">
            <label for="validationCustom01" class="form-label">NOMBRE</label>
            <input name="nombre" type="text" class="form-control" id="validationCustom01" required value="<?php echo isset($nombre) ? $nombre : ''; ?>">
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-12">
            <label for="validationCustom02" class="form-label">TELÉFONO</label>
            <input name="telefono" type="text" class="form-control" id="validationCustom02" required value="<?php echo isset($telefono) ? $telefono : ''; ?>">
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-12">
            <label for="validationCustom03" class="form-label">DIRECCIÓN</label>
            <input name="direccion" type="text" class="form-control" id="validationCustom03" required value="<?php echo isset($direccion) ? $direccion : ''; ?>">
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


