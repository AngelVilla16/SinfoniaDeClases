<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'conexion.php';
$dbconexion = new Conexion();
$pdo = $dbconexion-> getConexion();
try{
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$clase = $_POST['id_clase'];
$horario = $_POST['horario'];

$sql = "INSERT INTO alumnos(nombre, apellido) VALUES(?,?)";
$stmt = $pdo->prepare($sql);

$sql2 = "INSERT INTO clase(clase, horario) VALUES(?,?)";
$stmt2= $pdo->prepare($sql2);
if($stmt->execute([$nombre,$apellido])|| $stmt2->execute([$clase,$horario])){
    echo"<script>
    alert('alumno registrado correctamente');
    window.location.href = '../View/HTML/index.html';
    </script>
    ";
}

}   
catch(PDOException $ex){
    echo "Error en la base de datos: ". $e->getMessage();
}

?>