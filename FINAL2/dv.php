<?php
    ini_set("display_errors", E_ALL);
    $datos = [];

    include 'conexion.php';

    $query = "SELECT id, id_venta, id_producto, cantidad, precio FROM detalle_ventas ORDER BY id";

    $res = mysqli_query($conn, $query);

    while ($registro = mysqli_fetch_row($res)) {
        $datos[] = $registro;
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    if (isset($_POST['download_pdf'])) {
        require('fpdf/fpdf.php');
    
        // Obtener los datos de la fila seleccionada
        $id = $_POST['id'];
        $id_venta = $_POST['id_venta'];
        $id_producto= $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
    
        // Crear un nuevo documento PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Detalle de Venta');
    
        // Añadir los datos de la tabla
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Id : ', 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, $id, 0, 1);

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Id venta: ', 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, $id_venta, 0, 1);
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'id_producto: ', 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, $id_producto, 0, 1);
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Cantidad: ', 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, $cantidad, 0, 1);
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Precio: ', 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, $precio, 0, 1);
    
        // Generar y descargar el PDF
        $pdf->Output('D', 'detalle de venta.pdf');
        exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Compras</title>

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
        <a class="btn btn-primary" href="agregardv.php" role="button">Agregar detalle de venta</a>
    </center>

    <div class="table-container">
        <div class="row">
            <div class="col-12">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>ID-venta</th>
                            <th>ID-producto</th>
                            <th>cantidad</th>
                            <th>precio</th>
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
                                <td><?php echo $datos[$i][4]; ?></td>
                                <td>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $datos[$i][0]; ?>">
                                        <input type="hidden" name="id_venta" value="<?php echo $datos[$i][1]; ?>">
                                        <input type="hidden" name="id_producto" value="<?php echo $datos[$i][2]; ?>">
                                        <input type="hidden" name="cantidad" value="<?php echo $datos[$i][3]; ?>">
                                        <input type="hidden" name="precio" value="<?php echo $datos[$i][4]; ?>">
                                        <button type="submit" name="download_pdf" class="btn btn-primary">Generar PDF</button>
                                    </form>
                                    <a class="btn btn-danger" href="eliminardv.php?id=<?php echo $datos[$i][0]; ?>" role="button">Eliminar</a>
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
