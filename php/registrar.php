<?php
include("conect.php");
if (isset($_POST['register'])) {
    if (strlen($_POST['nameM']) > 1 && strlen($_POST["edad"]) > 1 && strlen($_POST["raza"]) > 1 && strlen($_POST["specie"]) > 1 && strlen($_POST["sexo"]) > 1 && strlen($_POST["descrip"]) > 1 && file_exists($_FILES['image']['tmp_name'])) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], './img/' . $_FILES['image']['name']))
            print($_POST["specie"]);
        $estad = "disponible";
        $name = trim($_POST['nameM']);
        $edad = trim($_POST['edad']);
        $raza = trim($_POST['raza']);
        $specie = trim($_POST['specie']);
        $sexo = trim($_POST['sexo']);
        $descrip = trim($_POST['descrip']);
        $url = './img/' . $_FILES['image']['name'];
        $id_persona = 1;
        $stmt = $conn->prepare("insert into mascota(tipo, edad, genero, raza, estad, nombre, urlimg, id_persona) Values(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $specie, $edad, $sexo, $raza, $estad, $name, $url, $id_persona);
        $resultado = $stmt->execute();
        $stmt->close();
        $conn->close();
        if ($resultado) {
?>
            <div class="alert alert-success" role="alert">
                A simple success alert—check it out!

            </div>

        <?php

        } else {
        ?>
            <h3>¡Upss, ha ocurrido un error!</h3>
        <?php
        }
    } else {
        ?>
        <h3>¡Completa todos los campos!</h3>
<?php
    }
}

?>
window.location.href="registroMascota.php";