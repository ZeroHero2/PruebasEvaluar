<!doctype html>
<?php
    ini_set("display_errors", E_ALL);
    $datos = [];
    // Cambiar la conexión a la base de datos "zapateria2"
    $cnx = mysqli_connect("localhost","root","usbw","zapateria2")
    or die ("Error en la Conexion a MySQL");

    // Seleccionar id, nombre, precio, stock en lugar de id, codigo, nombre, stock, precio
    $query = "SELECT id, nombre, precio, stock FROM productos ORDER BY id";

    $res = mysqli_query($cnx, $query);
    while($registro = mysqli_fetch_row($res)) {
        $datos[] = $registro;
    }

    mysqli_free_result($res);
    mysqli_close($cnx);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Catálogo de Productos</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <!-- DataTable CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

        <style>
            body {
                background-color: orange;
            }
            /* Estilos para que el formulario se sobreponga y esté centrado */
            .form-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #28a745;
                padding: 20px;
                border-radius: 10px;
                width: 400px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                color: white;
                display: none;
                z-index: 10;
            }
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: none;
                z-index: 5;
            }
            .confirmation-box {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
            }
            .confirmation-box button {
                margin: 5px;
            }
            table {
                margin: 0 auto;
                border-collapse: collapse;
                padding: 1px;
                border-style: solid;
                border-width: 2px;
                border-color: white;
                background-color: black;
                color: plum;
                text-align: center;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            a {
                display: block;
                margin-top: 10px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <center>
                <a href="PRINCIPAL.php">
                    <img src="https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/Negro3x-1.png?fit=949%2C295&ssl=1" 
                    width="500px"/>
                </a>
            </center>

            <!-- Botón para mostrar el formulario -->
            <center>
                <button class="btn btn-primary mt-4" onclick="showForm()">Agregar venta</button>
                <a class="btn btn-primary" href="vp.php" role="button">Ver ventas</a>
            </center>

            <!-- Tabla de productos -->
            <div class="row mt-4">
                <div class="col-sn-12 col-md-12 col-lg-12 col-xl-12">
                    <table id="table_id" class="table-dark">
                        <thead>
                            <tr class="table-dark">
                                <th><p style="color:PURPLE;">Id</p></th>
                                <th><p style="color:PURPLE;">Nombre</p></th>
                                <th><p style="color:PURPLE;">Precio</p></th>
                                <th><p style="color:PURPLE;">Stock</p></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i=0; $i<count($datos); $i++): ?>
                            <tr class="table-dark">
                                <td><?php echo $datos[$i][0];?></td>
                                <td><?php echo $datos[$i][1];?></td>
                                <td><?php echo $datos[$i][2];?></td>
                                <td><?php echo $datos[$i][3];?></td>
                            </tr>
                            <?php endfor?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Formulario sobrepuesto centrado con fondo verde -->
            <div class="form-container mt-4" id="formulario">
                <form id="ventaForm">
                    <div class="mb-3">
                        <label for="id_cliente" class="form-label">ID Cliente:</label>
                        <input type="text" class="form-control" id="id_cliente" name="id_cliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total:</label>
                        <input type="number" class="form-control" id="total" name="total" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <button type="button" class="btn btn-success" onclick="confirmSubmit()">Enviar</button>
                    <button type="button" class="btn btn-secondary" onclick="closeForm()">Cerrar</button>
                </form>
            </div>

            <!-- Caja de confirmación sobrepuesta -->
            <div class="overlay" id="confirmOverlay">
                <div class="confirmation-box">
                    <p>¿Agregar venta?</p>
                    <button class="btn btn-success" onclick="submitForm()">Sí</button>
                    <button class="btn btn-danger" onclick="hideConfirmation()">No</button>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <!-- DataTable JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

        <!-- Script para mostrar el formulario y el mensaje de confirmación -->
        <script>
            let table = new DataTable('#table_id');

            function showForm() {
                document.getElementById("formulario").style.display = "block";
            }

            function confirmSubmit() {
                document.getElementById("confirmOverlay").style.display = "flex";
            }

            function hideConfirmation() {
                document.getElementById("confirmOverlay").style.display = "none";
            }
            function closeForm() {
            document.getElementById("formulario").style.display = "none";
            }

            function submitForm() {
                // Obtener los datos del formulario
                var id_cliente = document.getElementById('id_cliente').value;
                var total = document.getElementById('total').value;
                var fecha = document.getElementById('fecha').value;

                // Enviar los datos a través de una petición POST usando fetch
                fetch('agregar_venta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_cliente=' + id_cliente + '&total=' + total + '&fecha=' + fecha,
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);  // Mostrar mensaje de éxito o error
                    hideConfirmation();  // Ocultar el cuadro de confirmación
                    document.getElementById("formulario").reset();  // Limpiar el formulario
                    document.getElementById("formulario").style.display = "none";  // Ocultar el formulario
                })
                .catch(error => console.error('Error:', error));
            }
        </script>
    </body>
</html>
