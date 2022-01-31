<!DOCTYPE html>
	<html>
		<head>

			<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link rel="stylesheet" href="../css/styles.css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
			<?php
				include "php/conexion.php";
				include('../barra.php');
			?>
		</head>
		<body>
			<title>
				Seguimiento
			</title>
			<main class="container">
				<h3><center> Formulario de Seguimiento</center></h3>
				<form name="MiForm" id="MiForm" method="post" action="php/subir_archivos.php" enctype="multipart/form-data">
				<div>
					<br><br><br>
					<input type="text" name="cedula" placeholder="Cedula" id="cedula" kr-icon="fas fa-envelope"	onchange="myFunction()"	required/>
					<input type="text" id="nombres" name="nombres">
					<input type="text" id="apellidos" name="apellidos">
					<input type="text" id="correo" name="correo">
					<input type="text" id="direccion" name="direccion">
					<input type="text" id="mascota" name="mascota">
					<input type="text" id="estado_esterilizacion" name="estado_esterilizacion" placeholder="Estado Esterilizacion">
					<input type="text" id="num_vacunas" name="num_vacunas" placeholder="Numero de Vacunas">
					<input type="text" id="direccion_actual" name="direccion_actual" placeholder="Direccion Actual">
					<input type="date" id="fecha_ultima_vacuna" name="fecha_ultima_vacuna">
					<input type="hidden" id="id_usuario" name="id_usuario">
					<input type="hidden" id="id_mascota" name="id_mascota">
					<br>
					<br>
				</div>
				<div>
					<textarea name="novedades" rows="10" cols="50"  placeholder="Novedades"></textarea>
					</textarea>
					<br><br>
					<div class="form-group">
					<label class="col-sm-2 control-label">Imagen Actualizada</label>
					<div class="col-sm-8">
					<input type="file" class="form-control" id="image" name="image" multiple required>
					</div><br>
					<button name="submit" class="btn btn-primary">Guardar Formulario</button>
					</div>
				</div>
			</main>
			</form>
				<script type="text/javascript">
					function myFunction() {
						var x = document.getElementById("cedula");
						x.value = x.value.toUpperCase();
						console.log(x.value)
						$.ajax({
							data: {"dato" : x.value},
							url: "php/metodos.php",
							type: "post",
							success:  function (response) {
								//var s = response; 
								//var obj = JSON.parse(s);

								console.log(response); //Arrojara un alert colocando el input + ' de 
								var json_object = JSON.parse(response)
								console.log(json_object["nombres"]);
								document.getElementById('nombres').value=json_object["nombres"]
								document.getElementById('apellidos').value=json_object["apellidos"]
								document.getElementById('mascota').value=json_object["nombre"]
								document.getElementById('direccion').value=json_object["direccion"]
								document.getElementById('correo').value=json_object["correo"]
								document.getElementById('id_usuario').value=json_object["id"]
								document.getElementById('id_mascota').value=json_object["id_mascota"]
							}
						});
					}
				</script>
		</tbody>
	</body>
</html>