<?php
include("php/conect.php");
if (isset($_POST['register'])) {
    if (strlen($_POST['nameM']) > 1 && strlen($_POST["edad"]) > 1 && strlen($_POST["raza"]) > 1 && strlen($_POST["specie"]) >= 1 && strlen($_POST["sexo"]) >= 1 && file_exists($_FILES['image']['tmp_name'])) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], './img/' . $_FILES['image']['name']))
            print($_POST["specie"]);
        $estad = 1;
        $name = trim($_POST['nameM']);
        $edad = trim($_POST['edad']);
        $raza = trim($_POST['raza']);
        $specie = trim($_POST['specie']);
        $sexo = trim($_POST['sexo']);
        $url = './img/' . $_FILES['image']['name'];
        $id_persona = 2;
        crearMascota($specie, $edad, $sexo, $raza, $estad, $name, $url, $id_persona);
        header('Location:registroMascota.php');
    } else {
?>
        <h3>¡Completa todos los campos!</h3>
<?php
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Buscador en Tiempo Real con AJAX</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/styles.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div class="container  text-center">
        <h1 class=" text-uppercase my-4">Registro de mascotas</h1>
    </div>
    <div class="container justify-content-center ">
        <div class="bg-light justify-content-center ">
            <form class="row justify-content-center  col-md-12 " id="regist" action="#" method="post" enctype="multipart/form-data">
                <div class="col-md-4 ">
                    <div class="form-group ">
                        <label class="text-success fw-lighter fst-italic text fw-bold" for="apellidousuario">Nombre de tu mascota</label>
                        <input type="text" class="form-control " name="nameM" placeholder="Nombre de la mascota">
                        </br>
                    </div>
                    <div class="form-group">
                        <label class="text-success fw-lighter fst-italic text fw-bold" for="Edad">Edad</label>
                        <input type="text" class="form-control" name="edad" placeholder="Edad de la mascota">
                        </br>
                    </div>
                    <div class="form-group">
                        <label class="text-success fw-lighter fst-italic text fw-bold" for="apellidousuario">Raza</label>
                        <input type="text" class="form-control" name="raza" placeholder="raza">
                        </br>
                    </div>
                    <label class="text-success fw-lighter fst-italic text fw-bold" for="Specie">Especie</label>
                    <div>
                        <label for="dog" class="radio-inline">
                            <input type="radio" name="specie" value="1" id="dog" checked />Perro</label>

                        <label for="cat" class="radio-inline">
                            <input type="radio" name="specie" value="2" id="cat" />Gato</label>
                    </div>
                    </br>
                    <label class="text-success fw-lighter fst-italic text fw-bold" for="Sexo">Sexo</label>
                    <div>
                        <label for="male" class="radio-inline">
                            <input type="radio" name="sexo" value="1" id="male" checked />Macho</label>

                        <label for="female" class="radio-inline">
                            <input type="radio" name="sexo" value="2" id="female" />Hembra</label>
                    </div>
                    </br>
                    <div class="form-group col-md-12">

                    </div>
                    </br>
                    <button type="submit" name="register" class="mb-3 g-5 btn btn-success">Guardar Mascota</button>
                </div>
                <div class="col-md-1">
                </div>

                <div class="form-file row  col-md-2 ">
                    <div class="form-file__action">
                        <label class="text-success fw-lighter fst-italic text fw-bold" for="image" class="title">Foto de publicación</label>

                        <input type="file" name="image" id="image" />
                    </div>
                    <div class="form-file__result" id="result-image">
                        <img id="img-result" alt="" />
                    </div>
                </div>
        </div>

        </form>
    </div>
    </div>
    <script src="img.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
    document.getElementById('regist').reset();
</script>
<?php include 'header.php' ?>

</html>