<?php
$conexion = mysqli_connect("localhost","root","","petstation");
if ($conexion->connect_error) {
    die("Ha fallado la conexion: " . $conexion->connect_error);
}
echo "Conectado correctamente";
?>