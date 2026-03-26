    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'conexion.php';
    require_once 'eliminaralumnoservice.php';

    $dbconexion = new Conexion();
    $pdo = $dbconexion->getConexion();

    $service = new EliminarService();

    $resultado = $service->eliminarAlumno($pdo, $_POST['id']);

    if($resultado){
        echo "<script>
            alert('Alumno eliminado correctamente');
            window.location.href = '../View/HTML/index.php';
            </script>
        ";
    }
    else{
        echo "error";
    }
    ?>