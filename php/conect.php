<?php
function conectarBD( )
{
$conn = new mysqli("localhost","root","","sistema de adopcion");
if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
      }
      return $conn;
    }

    function crearMascota($specie,$edad,$sexo,$raza,$estad,$name, $url, $id_persona)
    {
      $conx = conectarBD();
      $sql = "insert into mascota(tipo, edad, genero, raza, estad, nombre, urlimg, id_persona) Values(?, ?, ?, ?, ?, ?, ?, ?)";
      $comando = $conx->prepare($sql);
      $comando->bind_param("ssissssi",$specie,$edad,$sexo,$raza,$estad,$name, $url, $id_persona);
      if (!$comando)
      {
        die("Error en sql: " . $sql);
      }
      $comando->execute();
      $comando->close();
      $conx->close();
    }
    
    function editarMascota($id, $nombre, $edads, $especie, $image, $sexo, $raza)
    {
      $a = 0;
      $b = 0;
      if($especie == 'Perro'){
        $a=1;
      }else{
        $a=2;
      }

      if($sexo == 'Macho'){
        $b=1;
      }else{
        $b=2;
      }

     $conx= conectarBD( ); 
        print($image);
      $sql = "update mascota set tipo=?, edad=?, genero=?, raza=?, nombre=?, urlimg=? where id_mascota = ?";
      $comando = $conx->prepare($sql);
      if (!$comando)
      {
         
        die("Error en sql: " . $sql);
      }
      $comando->bind_param('isisssi', $a, $edads, $b, $raza, $nombre, $image, $id);
      $comando->execute();
    }

    function borrarMascota($id)
    {
  $conx = conectarBD();
  $sql = "delete from mascota where id_mascota = ?";
  $comando = $conx->prepare($sql);
  if (!$comando)
  {
    die("Error en sql: " . $sql);
  }
  $comando->bind_param('i', $id);
  $comando->execute();
}
?>

