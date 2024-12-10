<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Conexión a la base de datos
    $cnx = mysqli_connect("localhost", "root", "", "zapateria2")
        or die("Error en la conexión a MySQL");

    // Consulta para obtener los datos del producto
    $query = "SELECT nombre, precio, stock, id_proveedor FROM productos WHERE id = ?";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nombre, $precio, $stock, $id_proveedor);
    mysqli_stmt_fetch($stmt);

    // Cerrar la conexión a la base de datos
    mysqli_stmt_close($stmt);
    mysqli_close($cnx);
}

if (isset($_POST["nombre"])) {
    // Conexión a la base de datos
    $cnx = mysqli_connect("localhost", "root", "usbw", "zapateria2")
        or die("Error en la conexión a MySQL");

    // Obtener los datos enviados por el formulario
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $id_proveedor = $_POST["id_proveedor"];

    // Validaciones del lado del servidor
    if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
        die("El campo 'Nombre' solo puede contener letras.");
    }
    if (!preg_match("/^[0-9.,]+$/", $precio)) {
        die("El campo 'Precio' solo puede contener números, comas y puntos.");
    }
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $stock)) {
        die("El campo 'Stock' solo puede contener números o letras, sin símbolos.");
    }
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $id_proveedor)) {
        die("El campo 'ID_PROVEEDOR' solo puede contener números o letras, sin símbolos.");
    }

    // Actualización en la base de datos
    $query = "UPDATE productos SET nombre=?, precio=?, stock=?, id_proveedor=? WHERE id=?";
    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, "ssdsi", $nombre, $precio, $stock, $id_proveedor, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Producto Editado!<br>";
        echo "<a href='catalogo.php'> Regresar </a>";
    } else {
        echo "Error al editar el producto: " . mysqli_error($cnx);
    }

    // Cerrar la declaración y conexión
    mysqli_stmt_close($stmt);
    mysqli_close($cnx);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script>
        document.querySelector("form").addEventListener("submit", function (event) {
            const nombre = document.querySelector("input[name='nombre']").value;
            const precio = document.querySelector("input[name='precio']").value;
            const stock = document.querySelector("input[name='stock']").value;
            const idProveedor = document.querySelector("input[name='id_proveedor']").value;

            // Validación para el campo "Nombre"
            const nombreRegex = /^[a-zA-Z\s]+$/;
            if (!nombreRegex.test(nombre)) {
                alert("El campo 'Nombre' solo puede contener letras.");
                event.preventDefault();
                return;
            }

            // Validación para el campo "Precio"
            const precioRegex = /^[0-9.,]+$/;
            if (!precioRegex.test(precio)) {
                alert("El campo 'Precio' solo puede contener números, comas y puntos.");
                event.preventDefault();
                return;
            }

            // Validación para el campo "Stock"
            const stockRegex = /^[a-zA-Z0-9\s]+$/;
            if (!stockRegex.test(stock)) {
                alert("El campo 'Stock' solo puede contener números o letras, sin símbolos.");
                event.preventDefault();
                return;
            }

            // Validación para el campo "ID_PROVEEDOR"
            const idProveedorRegex = /^[a-zA-Z0-9\s]+$/;
            if (!idProveedorRegex.test(idProveedor)) {
                alert("El campo 'ID_PROVEEDOR' solo puede contener números o letras, sin símbolos.");
                event.preventDefault();
                return;
            }
        });
    </script>
</head>
<body>
<div class="container">
    <h2>Editar Producto</h2>
    <form method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-12">
            <label for="validationCustom01" class="form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" id="validationCustom01" value="<?php echo $nombre; ?>" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom02" class="form-label">Precio</label>
            <input name="precio" type="text" class="form-control" id="validationCustom02" value="<?php echo $precio; ?>" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom03" class="form-label">Stock</label>
            <input name="stock" type="text" class="form-control" id="validationCustom03" value="<?php echo $stock; ?>" required>
        </div>
        <div class="col-md-12">
            <label for="validationCustom04" class="form-label">ID_PROVEEDOR</label>
            <input name="id_proveedor" type="text" class="form-control" id="validationCustom04" value="<?php echo $id_proveedor; ?>" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Guardar cambios</button>
        </div>
    </form>
</div>
</body>
</html>
