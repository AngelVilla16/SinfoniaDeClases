<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'conexion.php';

$dbconexion = new Conexion();
$pdo = $dbconexion->getConexion();

try {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $clase = $_POST['id_clase'];

    
    $sql = "INSERT INTO alumnos(nombre, apellido) VALUES(?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellido]);

    
    $id_alumno = $pdo->lastInsertId();

   
    $sql2 = "INSERT INTO inscripcion(id_alumno, id_clase) VALUES(?, ?)";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$id_alumno, $clase]);

    echo "<script>
    alert('Alumno registrado correctamente');
    window.location.href = '../View/HTML/index.php';
    </script>";

} catch (PDOException $ex) {
    echo "Error en la base de datos: " . $ex->getMessage();
}
?>