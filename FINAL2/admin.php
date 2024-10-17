<html>
<head>
    <title>Inicio</title>
    <style>
        body {
            background-image: url('https://cdn.pixabay.com/photo/2016/08/31/22/36/background-1634817_640.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        h3 {
            color: #f4f4f4;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
            font-size: 2em;
            text-align: center;
            margin-top: 30px;
        }

        table {
            margin: 40px auto;
            border-collapse: separate;
            border-spacing: 30px;
        }

        td {
            text-align: center;
            vertical-align: top;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            color: #b28d4c;
        }

        img {
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        img:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5);
        }

        td center {
            font-size: 1.1em;
            color: #f4f4f4;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
        }

        .cerrar-sesion {
            display: inline-block;
            margin: 40px auto;
            text-align: center;
            padding: 12px 25px;
            background-color: #b28d4c;
            color: white;
            width: 200px;
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .cerrar-sesion:hover {
            background-color: #8e6f3e;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <h3>Elija una</h3>

    <table>
        <tr>
            <td>
                <a href="catalogo.php">
                    <img src="images/computadora.jpg" width="200" height="150">
                </a>
            </td>
            <td>
                <a href="Ventas.php">
                    <img src="images/venta.jpg" width="200" height="150">
                </a>
            </td>
            <td>
                <a href="proveedor.php">
                    <img src="images/calzadotenis.jpg" width="200" height="150">
                </a>
            </td>
            <td>
                <a href="dc.php">
                    <img src="images/dc.jpg" width="200" height="150">
                </a>
            </td>
        </tr>
        <tr>
            <td><center>PRODUCTOS</center></td>
            <td><center>VENTAS</center></td>
            <td><center>PROVEEDORES</center></td>
            <td><center>DETALLE DE COMPRA</center></td>
        </tr>
        <tr>
            <td>
                <a href="dv.php">
                    <img src="images/cambio.jpg" width="200" height="150">
                </a>
            </td>
            <td>
                <a href="compras.php">
                    <img src="images/compras.jpg" width="200" height="150">
                </a>
            </td>
            <td>
                <a href="clientes.php">
                    <img src="images/clientes.jpg" width="200" height="150">
                </a>
            </td>
            <td>
                <a href="cambios.php">
                    <img src="images/changes.jpg" width="200" height="150">
                </a>
            </td>
        </tr>
        <tr>
            <td><center>DETALLE DE VENTAS</center></td>
            <td><center>COMPRAS</center></td>
            <td><center>CLIENTES</center></td>
            <td><center>CAMBIOS</center></td>
        </tr>
    </table>

    <center>
        <a href="PRINCIPAL.php" class="cerrar-sesion">CERRAR SESION</a>
    </center>
</body>
</html>

