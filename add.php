<?php




$mysqli = new mysqli("localhost:3308","root","","to_do");

// Chequeando conexion
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

//Insertando items
$sql = "INSERT INTO items (name,user,done)
VALUES ('".$_POST['name']."',1,0)";


//Verificando si se agrego los datos 
if (mysqli_query($mysqli, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
}


//Quedarse en la misma pagina
header('Location: index.php');

mysqli_close($mysqli);

