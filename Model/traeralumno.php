<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'conexion.php';
$dbconexion = new Conexion();
$pdo = $dbconexion->getConexion();

try{

$sql = "SELECT a.id_alumno as id, a.nombre, a.apellido, c.id_clase, c.clase, c.horario 
FROM inscripcion i
JOIN alumnos a
ON a.id_alumno = i.id_alumno
JOIN clases c
ON c.id_clase= i.id_clase
 ";
$stmt = $pdo->query($sql);
$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $ex){
    echo "Error al consultar alumnos: " . $ex;
}

?>