<?php
// Conexión
$var = $_POST['dato'];
$link = mysqli_connect("localhost", "root", "", "sistema de adopcion") or die($link);

// Consulta
$accion_nm = "SELECT usu.id,usu.nombres,usu.apellidos,usu.direccion,usu.correo,masc.nombre,masc.raza,IF(masc.genero=1,'Macho','Hembra') as genero,masc.tipo,masc.id_mascota FROM usuario usu left JOIN mascota masc on masc.id_persona=usu.id where usu.cedula='{$var}'";
$consulta_nm=mysqli_query($link,$accion_nm);
$datos_nm=mysqli_fetch_assoc($consulta_nm);

//Cantidad de registros
$cantidad_nm=mysqli_num_rows($consulta_nm);
//Sacar datos con $datos;


$nombres=$datos_nm['nombres']; //se  sacan variables
$apellidos=$datos_nm['apellidos'];
$correo=$datos_nm['correo'];
$correo=$datos_nm['nombre'];
$correo=$datos_nm['direccion'];
$correo=$datos_nm['id'];
$correo=$datos_nm['id_mascota'];

//echo $correo;
return print(json_encode($datos_nm));
?>