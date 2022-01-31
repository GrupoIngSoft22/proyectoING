<?php

include 'dbconexion.php';


if (!empty($_POST['cedula']) && !empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['correo'])
    && !empty($_POST['direccion']) && !empty($_POST['ciudad']) && !empty($_POST['contrasena'])) {
  
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $apellidos=$_POST['apellidos'];
    $correo=$_POST['correo'];
    $direccion=$_POST['direccion'];
    $ciudad=$_POST['ciudad'];
    $contrasena=$_POST['contrasena'];
    $contrasena= hash('sha512',$contrasena);

    $query = "INSERT INTO usuarios(cedula, nombres, apellidos, correo, direccion, ciudad, contrasena)
            VALUES('$cedula','$nombres','$apellidos','$correo','$direccion','$ciudad','$contrasena')";

    $verficar_correo =mysqli_query ($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
    if(mysqli_num_rows($verficar_correo) > 0){
      echo '
      <script>
          alert("Usuario no almacenado, intentelo de nuevo");
          window.location= "../index.html";
      </script>
      ';
      exit();
    }

    $verficar_correo =mysqli_query ($conexion, "SELECT * FROM usuarios WHERE cedula='$cedula'");
    if(mysqli_num_rows($verficar_correo) > 0){
      echo '
      <script>
          alert("Usuario no almacenado, intentelo de nuevo");
          window.location= "../index.html";
      </script>
      ';
      exit();
    }

    $ejecutar=mysqli_query($conexion, $query);

    if($ejecutar){
      echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location= "../index.html";
            </script>
            ';
    }else{
      echo '
      <script>
          alert("Usuario no almacenado, intentelo de nuevo");
          window.location= "../index.html";
      </script>
      ';
    }

}else{
  echo '
      <script>
          alert("Ingrese todos los datos solicitados");
          window.location= "../Registro.html";
      </script>
      ';
}
  
mysqli_close($conexion);      
?>