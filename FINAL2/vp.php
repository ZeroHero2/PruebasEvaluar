<?php
    ini_set("display_errors", E_ALL);
    $datos = [];

    include 'conexion.php';


    $query = $query = "SELECT id, id_cliente, fecha, total FROM ventas ORDER BY fecha";

    $res = mysqli_query($conn, $query);

    while ($registro = mysqli_fetch_row($res)) {
        $datos[] = $registro;
    }

    mysqli_free_result($res);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>

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
            max-width: 800px; /* Ancho máximo de la tabla */
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
            padding: 8px;
            border-bottom: 1px solid #ddd;
            background-color: #fff; /* Fondo blanco */
            color: black; /* Texto negro en las celdas */
        }
        th {
            background-color: #e9ecef; /* Fondo gris claro para encabezados */
            color: black; /* Color de texto negro para encabezados */
            text-transform: uppercase;
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
        <a href="personal.php">
            <img src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" width="500px"/>
        </a>
        <br>
        <a class="btn btn-primary" href="agregardvp.php" role="button">Agregar detalle de venta</a>
    </center>

    <div class="table-container">
        <div class="row">
            <div class="col-12">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th><p style="color: purple;">Id-venta</p></th>
                            <th><p style="color: purple;">Id-cliente</p></th>
                            <th><p style="color: purple;">Fecha</p></th>
                            <th><p style="color: purple;">Total</p></th>
                            <th><p style="color: purple;">Acciones</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($datos); $i++): ?>
                            <tr>
                                <td><?php echo $datos[$i][0]; ?></td>
                                <td><?php echo $datos[$i][1]; ?></td>
                                <td><?php echo $datos[$i][2]; ?></td>
                                <td><?php echo $datos[$i][3]; ?></td>
                                <td>
                                    <a class="btn btn-primary" href="detallesventap.php?id=<?php echo $datos[$i][0]; ?>" role="button">Visualizar</a>
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

