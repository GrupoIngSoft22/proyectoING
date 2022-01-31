<?php
session_start();
include 'dbconexion.php';

if (!empty($_POST['correo']) && !empty($_POST['contrasena'])) {
  
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512',$contrasena);


$validar_login = mysqli_query($conexion, "SELECT* FROM usuarios WHERE correo='$correo'
and contrasena = '$contrasena'");

if (mysqli_num_rowa($validar_login) > 0){
        $_SESSION['usuario'] = $correo;
        header("location: ");
    exit;
}else{
    echo '
            <script>
                alert("Usuario no existe, debe registrase");
                window.location= "../index.html";
            </script>
            ';
            exit;
}
}else{
    echo '
            <script>
                alert("Ingrese datos.");
                window.location= "../index.html";
            </script>
            ';
            exit;
}
?>