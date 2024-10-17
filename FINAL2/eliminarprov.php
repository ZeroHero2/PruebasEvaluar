<?php

    $id = $_GET["id"];
    $cnx = mysqli_connect("localhost","root","usbw","zapateria2")
    or die ("Error en la Conexion a MySQL");

    $query = "DELETE FROM proveedores WHERE id='$id'";

    mysqli_query($cnx, $query);
    mysqli_close($cnx);

    echo "Proveedor Eliminado!";
    echo "<a href = 'Proveedor.php'> Regresar </a>";
    die();

?>