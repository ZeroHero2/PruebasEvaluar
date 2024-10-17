<?php

    $id = $_GET["id"];
    $cnx = mysqli_connect("localhost","root","usbw","zapateria2")
    or die ("Error en la Conexion a MySQL");

    $query = "DELETE FROM cambios WHERE id='$id'";

    mysqli_query($cnx, $query);
    mysqli_close($cnx);

    echo "Cambio Eliminado!";
    echo "<a href = 'cambios.php'> Regresar </a>";
    die();

?>