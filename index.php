<?php
$petData = file_get_contents("mascota.json");
$pets = json_decode($petData, true);

$userData = file_get_contents("usuario.json");
$users = json_decode($userData, true);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <?php 
        include("barra.php"); 
    ?>

    <main class="container">
        <h1 class="text-center text-uppercase my-5">Mascotas disponibles para Adopción</h1>
        <section>
            <div class="container">
                <div class="row">
                    <!-- PETS -->
                    <?php foreach ($pets as $pos => $pet) { ?>
                        <div class="col-3">
                            <article>
                                <div class="pet shadow mb-5 rounded">
                                    <div class="m-0 position-relative rounded">
                                        <img src="img/<?= $pet["imagen"]; ?>" alt="<?= $pet["nombre"]; ?>"
                                            class="img-responsive rounded-top">
                                        <span class="bi bi-suit-heart-fill pst" aria-hidden="true"></span>
                                        <div class="text-center pt-5 px-2 pb-2">
                                            <h3 class="descriptionPet fw-light"><?= $pet["nombre"]; ?></h3>
                                            <p class="descriptionPet">
                                                <?= $pet["nombre"]; ?> es un <?= $pet["tipo"]; ?> <?= $pet["genero"]; ?> de raza <?= $pet["raza"]; ?> tiene <?= $pet["edad"]; ?> años de edad y se encuentra <?= $pet["estado"]; ?> para adopción.
                                            </p>
                                            <button type="button" class="mb-3 btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $pet["id_mascota"]; ?>">
                                                Solicitar Adopción
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Solictud de Adopción de
                        Mascota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    $id = "id";
                    ?>
                    <form action="" method="post">
                        <h5 class="mb-3 border-bottom text-success fw-lighter fst-italic">Información de Mascota <?= $id; ?></h5>
                        <div class="row g-3">
                            <div class="col-md-4 form-floating">
                                <input type="text" class="form-control" id="tipomascota" name="tipomascota" placeholder="Tipo de Mascota" value="Tipo de Mascota" disabled readonly>
                                <label for="tipomascota">Especie</label>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="text" class="form-control" id="edadmascota" name="edadmascota" placeholder="2 Años" value="2 Años" disabled readonly>
                                <label for="apellidousuario">Edad</label>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="text" class="form-control" id="generomascota" name="generomascota" placeholder="Género Mascota" value="Género Mascota" disabled readonly>
                                <label for="generomascota">Género</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="email" class="form-control" id="raza" name="raza" placeholder="Raza Mascota" value="Raza Mascota" disabled readonly>
                                <label for="raza">Raza</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="estadomascota" name="estadomascota" placeholder="Disponible para adopción" value="Disponible para adopción" disabled readonly>
                                <label for="estadomascota">Estado</label>
                            </div>
                        </div>
                        <h5 class="mt-5 mb-3 border-bottom text-success fw-lighter fst-italic">Información de Usuario</h5>
                        <div class="row g-3">
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="nombreusuario" name="nombreusuario" placeholder="Nombres Usuario" value="Nombres Usuario" disabled readonly>
                                <label for="nombreusuario">Nombres</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="apellidousuario" name="apellidousuario" placeholder="Apellido Usuario" value="Apellido Usuario" disabled readonly>
                                <label for="apellidousuario">Apellidos</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="cedulausuario" name="cedulausuario" placeholder="1213141516" value="1213141516" disabled readonly>
                                <label for="cedulausuario">Cédula</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="email" class="form-control" id="emailusuario" name="emailusuario" placeholder="usuario@correo.com" value="usuario@correo.com" disabled readonly>
                                <label for="cedulausuario">Cédula</label>
                            </div>
                            <div class="col-md-8 form-floating">
                                <input type="text" class="form-control" id="direccionusuario" name="direccionusuario" placeholder="Dirección de usuario" value="Dirección de usuario" disabled readonly>
                                <label for="direccionusuario">Dirección</label>
                            </div>
                            <div class="col-md-4 form-floating">
                                <input type="text" class="form-control" id="ciudadusuario" name="ciudadusuario" placeholder="Ciudad de usuario" value="Ciudad de usuario" disabled readonly>
                                <label for="ciudadusuario" class="form-label">Ciudad</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success">Enviar solicitud</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>