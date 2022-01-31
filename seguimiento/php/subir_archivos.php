<?php 
if (isset($_POST["submit"])) {
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    $nombres_img = $_FILES['image']['name'];
    $ruta = 'img_seguimiento/';
    $id_usuario = $_POST['id_usuario'];
    $id_mascota = $_POST['id_mascota'];
    $num_vacunas = $_POST['num_vacunas'];
    $estado_esterilizacion = $_POST['estado_esterilizacion'];
    $direccion = $_POST['direccion'];
    $fecha_ultima_vacuna = $_POST['fecha_ultima_vacuna'];
    $novedades = $_POST['novedades'];
    $image=$_FILES["image"]["tmp_name"];

    if ($revisar !== false) {        
        move_uploaded_file($image, $ruta.$nombres_img);
        $Host = 'localhost';
        $Username = 'root';
        $Password = '';
        $dbName = 'sistema de adopcion';

        include "conexion.php";
        //Crear conexion con la abse de datos
        $db = new mysqli($Host, $Username, $Password, $dbName);

        // Cerciorar la conexion
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }

        //Insertar en la base de datos
        $insertar = $db->query("INSERT into formulario_seguimiento (id_persona,id_mascota,estado_vacuna,estado_esterilizacion,direccion_actual,fecha_ultima_vacuna,novedades ,fecha_formulario) VALUES ('$id_usuario','$id_mascota','$num_vacunas','$estado_esterilizacion','$direccion','$fecha_ultima_vacuna','$novedades', now())");
        // COndicional para verificar la subida del fichero
        if($insertar){
            
            echo '<script language="javascript">alert("Se a subido con exito");</script>';
            header("Location: http://127.0.0.1/adoptionpet/seguimiento/seguimiento.php");
        }else{
            echo '<script language="javascript">alert("Error al ingresar datos ");</script>';
            header("Location: http://127.0.0.1/adoptionpet/seguimiento/seguimiento.php");
        } 
        // Sie el usuario no selecciona ninguna imagen
        }else{
            echo "Por favor seleccione imagen a subir.";
    }
}
?>