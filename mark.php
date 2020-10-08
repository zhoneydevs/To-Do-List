<?php

require_once 'DBStaticFactory.php';
require_once 'TodoService.php';
require_once 'TodoModel.php';

// Chequeando conexion
$conn = new DBStaticFactory;
$conn= $conn->con();

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  exit();
  
}


//Actualizando y tachando items


$todo_service = new TodoService();
$todo_item = $_GET['as'] ?? null;
$todo_id= $_GET['item'];
$todo2= $todo_service->getMarkAsDoneToSql($todo_id);


echo $todo2;


if (!isset($todo_id) || is_int($todo_id)){
	echo "TODO inválido";
} else if (!$todo_service->existsAndIsNotDone($todo_id)){
	echo "Puede que el todo especificado no exista o ya esté marcado" ;
} else if (!$todo_service->markAsDone($todo_id)){
	echo "El todo no pudo ser marcado por otra cosa";
}else if (mysqli_query($conn, $todo2)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

//Quedarse en la misma pagina
header('Location: index.php');

mysqli_close($conn);
