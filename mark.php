<?php


// Chequeando conexion
$conn = mysqli_connect("localhost:3308","root","","to_do");
$name=$_GET['as'];
$id=$_GET['item'];

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  exit();
}


//Actualizando y tachando items
$sql = "UPDATE items SET done=1 WHERE name=$name and id=$id";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

//Quedarse en la misma pagina
header('Location: index.php');

mysqli_close($conn);