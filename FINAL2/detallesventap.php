<?php
$host = 'localhost';
$user = 'root';
$password = 'usbw';
$database = 'zapateria2';
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selectQuery = "SELECT * FROM ventas WHERE id='$id'";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);
} else {
    header('Location: vp.php');
    exit();
}

// Verificar si se ha solicitado la descarga del PDF
if (isset($_POST['download_pdf'])) {
    require('fpdf/fpdf.php');

    // Crear un nuevo documento PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Detalle de Venta');

    // Añadir los datos de la tabla
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Cliente: ', 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(60, 10, $row['id_cliente'], 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Fecha: ', 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(60, 10, $row['fecha'], 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Total: ', 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(60, 10, $row['total'], 0, 1);


    // Generar y descargar el PDF
    $pdf->Output('D', 'detalle_venta.pdf');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver</title>
    <!-- boostrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
         rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFB516;
        }
    </style>
</head>
<body>
    <center>
        <a href="vp.php"><img src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" 
        width="500px"/></a><br><br><center>

    <table class="table">
      <thead>
        <tr class="table">
          <th scope="col">Id-CLIENTE</th>
          <th scope="col">FECHA</th>
          <th scope="col">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <tr class="table">
          <td><?php echo $row['id_cliente']; ?></td>
          <td><?php echo $row['fecha']; ?></td>
          <td><?php echo $row['total']; ?></td>
        </tr>
      </tbody>
    </table>

    <!-- Botón para descargar el PDF -->
    <form method="post">
        <button type="submit" name="download_pdf" class="btn btn-primary">Descargar PDF</button>
    </form>

    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
