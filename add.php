<?php

require_once 'DBStaticFactory.php';
require_once 'TodoService.php';
require_once 'TodoModel.php';

$conn = new DBStaticFactory;
$conn= $conn->con();

// Chequeando conexion
if (!$conn) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$id=0;
$name= $_POST['name'];
$user= 1;
$done= 0;

$todo= new TodoModel($id,$name,$user,$done,gmdate('Y-m-d h:i:s \G\M\T'));

//Insertando items
$insert = "INSERT INTO items (name,user,done,created)
          VALUES ('{$todo->getName()}','{$todo->getUser()}',
          {$todo->getDone()},'{$todo->getCreated()}')";

//Verificando si los datos fueron agregados 
if (mysqli_query($conn, $insert)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $insert . "<br>" . mysqli_error($conn);
}


//Quedarse en la misma pagina
header('Location: index.php');

mysqli_close($conn);


