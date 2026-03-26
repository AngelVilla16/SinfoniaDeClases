<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'conexion.php';
require_once 'clasealumno.php';

// Crear conexión
$dbconexion = new Conexion();
$pdo = $dbconexion->getConexion();

// Crear servicio
$service = new AlumnoService();

// Ejecutar
$resultado = $service->registrarAlumno($pdo, $_POST['nombre'], $_POST['apellido'], $_POST['id_clase']);

if($resultado === "ok"){
    echo "<script>
        alert('Alumno registrado correctamente');
        window.location.href = '../View/HTML/index.php';
    </script>";
}
elseif($resultado === "Grupo lleno"){
    echo "<script>
        alert('No se puede registrar: grupo lleno');
        window.history.back();
    </script>";
}
else{
    echo "<script>
        alert('Error en el sistema');
        window.history.back();
    </script>";
}
?>