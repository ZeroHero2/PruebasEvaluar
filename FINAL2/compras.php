<?php
    ini_set("display_errors", E_ALL);
    $datos = [];

    // Incluir la conexión desde el archivo 'conexion.php'
    include 'conexion.php';  // Asegúrate de que '$conn' esté definido en conexion.php

    // Consulta SQL corregida para obtener todos los detalles de compras
    $query = "SELECT id, id_proveedor, fecha, total FROM compras ORDER BY fecha";

    // Ejecutar la consulta SQL
    $res = mysqli_query($conn, $query);

    // Recoger los resultados y almacenarlos en el array $datos
    while ($registro = mysqli_fetch_row($res)) {
        $datos[] = $registro;
    }

    // Liberar el resultado y cerrar la conexión (opcional si no la vas a reutilizar)
    mysqli_free_result($res);
    mysqli_close($conn);  // Cierra la conexión si no la vas a reutilizar
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
         rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    
    <style>
        body {
            background-color: #f3f3f3; /* Fondo claro */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .table-container {
            max-width: 900px; /* Ancho máximo de la tabla */
            margin: 30px auto; /* Centrar la tabla */
            padding: 20px;
            background-color: white; /* Fondo blanco para el contenedor */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
        }

        table {
            width: 100%; /* Hacer la tabla ocupar todo el contenedor */
            border-collapse: collapse;
            text-align: center;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #b28d4c; /* Color dorado */
            color: white;
            text-transform: uppercase;
        }

        td {
            background-color: #fff; /* Fondo blanco */
            color: #333; /* Color de texto negro en las celdas */
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <a href="admin.php">
            <img src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px"/>
        </a>
        <br>
        <a class="btn btn-primary" href="agregarordenc.php" role="button">Agregar compra</a>
    </center>

    <div class="table-container">
        <div class="row">
            <div class="col-12">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Id Proveedor</th>
                            <th>fecha</th>
                            <th>TOTAL</th>
                            <th>Operación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($datos); $i++): ?>
                            <tr>
                                <td><?php echo $datos[$i][0]; ?></td>
                                <td><?php echo $datos[$i][1]; ?></td>
                                <td><?php echo $datos[$i][2]; ?></td>
                                <td><?php echo $datos[$i][3]; ?></td>
                                <td>
                                    <a class="btn btn-danger" href="eliminarcompra.php?id=<?php echo $datos[$i][0]; ?>" role="button">Eliminar Orden</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script>
        let table = new DataTable('#table_id');
    </script>
</body>
</html>

