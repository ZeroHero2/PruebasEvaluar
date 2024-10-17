<?php

    $id = $_GET["id"];
    $cnx = mysqli_connect("localhost","root","usbw","zapateria2")
    or die ("Error en la Conexion a MySQL");

    $query = "DELETE FROM detalle_compras WHERE id='$id'";

    mysqli_query($cnx, $query);
    mysqli_close($cnx);

    echo "Detalle Eliminado!";
    echo "<a href = 'dc.php'> Regresar </a>";
    die();

?>