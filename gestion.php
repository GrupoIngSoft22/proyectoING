<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<?php
include("php/conect.php");
$id_Usuario = 2;
$grid = "";
$conn = conectarBD();
$q = $conn->real_escape_string($id_Usuario);
$query = " SELECT id_mascota, edad, raza, nombre, urlimg, id_persona, IF(genero=1, 'Macho', 'Hembra')as genero, IF(estad=1, 'disponible', 'no esta disponible')as estad, IF(tipo=1, 'Perro', 'Gato')as tipo FROM mascota WHERE id_persona LIKE '%" . $q . "%'";  
$buscarAlumnos = $conn->query($query);

if (isset($_POST['nombre'])) {
    $estado = (isset($_POST['edad'])) ? '1' : '0';

    //Algunas validaciones....
    if ($_POST['raza'] == '') {
        $error = 'El campo raza no puede quedar vacio';
    }

    if ($_POST['edad'] == '') {
        $error = 'El campo edad no puede quedar vacia';
    }
    if (empty($_FILES['image']['tmp_name'])) {
        if (isset($_POST['rut'])) {
            $error = 'Tiene que adjuntar una imagen';
        }
        editarMascota($_POST['id'], $_POST['nombre'], $_POST['edad'], $_POST['specie'], $_POST['rut'], $_POST['sexo'], $_POST['raza']);
        header('Location: index.php');
    } else {
        if (move_uploaded_file($_FILES['image']['tmp_name'], './img/' . $_FILES['image']['name']))
            if (!isset($error)) //no hay error
            {
                $url = './img/' . $_FILES['image']['name'];
                editarMascota($_POST['id'], $_POST['nombre'], $_POST['edad'], $_POST['specie'], $url, $_POST['sexo'], $_POST['raza']);
                header('Location: index.php');
            }
    }
}

if (!isset($_POST['ida'])) {
    $error = 'Tiene que adjuntar una imagen';
} else {
    borrarMascota($_POST['ida']);
    header('Location: gestion.php');
}
?>


<main class="container">
    <h1 class="text-center text-uppercase my-5">Has registrado estas mascotas</h1>
    <section>
        <div class="container">
            <div class="row">
                <!-- PETS -->
                <?php foreach ($buscarAlumnos as $pos => $pet) { ?>
                   
                    <div class="col-3">
                        <article>
                            <div class="pet shadow mb-5 rounded">
                                <div class="m-0 position-relative rounded">
                                    <img src="<?= $pet["urlimg"]; ?>" class="img-responsive rounded-top" />
                                    <span class="bi bi-suit-heart-fill pst" aria-hidden="true"></span>
                                    <div class="text-center pt-5 px-2 pb-2">
                                        <h3 class="descriptionPet fw-light"><?= $pet["nombre"]; ?></h3>
                                        <p class="descriptionPet">
                                            <?= $pet["nombre"]; ?> es un <?= $pet["tipo"]; ?> <?= $pet["genero"]; ?>
                                             de raza <?= $pet["raza"]; ?> tiene <?= $pet["edad"]; ?> de edad y se encuentra
                                              <?= $pet["estad"]; ?> para adopción.  
                                        </p>
                                        <button type="button" class="mb-3 btn btn-outline-success btn-sm" id="btnmod" 
                                        data-bs-toggle="modal" data-bs-target="#exampleModal" data-id=<?= $pet["id_mascota"]; 
                                        ?> data-nom="<?= $pet["nombre"]; ?>" data-tip="<?= $pet["tipo"]; ?>" data-gen="<?= $pet["genero"]; 
                                        ?>" data-eda="<?= $pet["edad"]; ?>" data-raz="<?= $pet["raza"]; ?>" data-std="<?= $pet["estad"]; ?>" data-img="<?= $pet["urlimg"]; ?>">
                                            Modificar
                                        </button>
                                        <button type="button" class="mb-3 btn btn-outline-danger btn-sm" id="btnalert" 
                                        data-bs-toggle="modal" data-bs-target="#alertModal" data-ida="<?= $pet["id_mascota"]; ?>">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php } ?>
                <!-- END PETS -->
            </div>
        </div>
    </section>
</main>
<script>
    $(document).on("click", "#btnmod", function() {
        var id = $(this).data("id");
        var edad = $(this).data("eda");
        var sexo = $(this).data("gen");
        var raza = $(this).data("raz");
        var nombre = $(this).data("nom");
        var especie = $(this).data("tip");
        var estado = $(this).data("std");
        var imagen = $(this).data("img");

        $("#id").val(id);
        $("#nombre").val(nombre);
        $("#edad").val(edad);
        $("#" + especie).prop("checked", true);
        $("#" + sexo).prop("checked", true);
        $("#genero").val(sexo);
        $("#raza").val(raza);
        $("#estado").val(estado);
        $("#img-result").attr('src', "" + imagen);
        $("#rut").val(imagen);
    })
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Modificar Registro de Mascota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" modal-body">

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="rut" id="rut" />
                    <div class="container">
                        <div class="row row-cols-2 row-cols-lg-3">
                            <div class="col"></div>
                            <div class="col">
                                <h5 class="mb-3 border-bottom text-success fw-lighter fst-italic">Información de Mascota </h5>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="">
                                    <div class="form-file__action">
                                        <label class="text-success fw-lighter fst-italic text fw-bold" for="image" class="title">&nbsp &nbsp &nbsp &nbsp &nbspFoto de publicación</label>

                                        <input type="file" name="image" id="image" />
                                    </div>
                                    <div class="form-file__result" id="result-image">
                                        <img src="" id="img-result" name="img-result">
                                    </div></br></br>
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col-4 d-flex justify-content-end col-lg-6">
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                    <label for="estadomascota">Nombre</label>
                                </div>
                            </div>
                            <div class="col-4 d-flex col-lg-6">
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="raza" name="raza">
                                    <label for="raza">Raza</label></br>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end col-lg-6">
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="edad" name="edad">
                                    <label for="estadomascota">Edad</label>
                                </div>
                            </div>
                            <div class="col-4 col-lg-6">
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="estado" name="estado">
                                    <label for="nombreusuario">Estado de adopcion</label>
                                    </br>
                                </div>
                            </div>
                            <div class="row  col-4 col-lg-6">
                                <div class="d-flex justify-content-center"><label class="text-success  fw-lighter fst-italic text fw-bold" for="Sexo">Sexo</label></div>
                                <div class="d-flex justify-content-center">
                                    <label for="male" class="radio-inline ">
                                        <input type="radio" name="sexo" value="Macho" id="Macho" checked />Macho&nbsp &nbsp</label>

                                    <label for="female" class="radio-inline">
                                        <input type="radio" name="sexo" value="Hembra" id="Hembra" />Hembra </label> </br> </br>
                                </div>
                            </div>
                            <div class="row col-4 col-lg-6">
                                <div class="d-flex justify-content-center"><label class="text-success fw-lighter fst-italic text fw-bold" for="Specie">Especie</label></div>
                                <div class="d-flex justify-content-center"></br>
                                    <label for="dog" class="radio-inline">
                                        <input type="radio" name="specie" value="Perro" id="Perro" checked />Perro&nbsp &nbsp</label>

                                    <label for="cat" class="radio-inline">
                                        <input type="radio" name="specie" value="gato" id="Gato" />Gato</label>
                                </div>
                                </br> </br>
                            </div> </br>
                            <div class="col-4 d-flex justify-content-end col-lg-6"> <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                            <div class="col-4 col-lg-6"> <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button></div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<script>
    $(document).on("click", "#btnalert", function() {
        var ida = $(this).data("ida");
        $("#ida").val(ida);
    })
</script>

<!-- ModalAlert -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form method="post">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body">
                <p class="text-danger text-uppercase modal-title">¡¡Desea continuar con la eliminacion del registro!!</p>
                <input type="hidden" name="ida" id="ida" />
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                <button type="submit" class="btn btn-danger">SI</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="img.js"></script>
</body>
<?php include 'header.php' ?>

</html>