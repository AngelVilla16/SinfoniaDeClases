<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../Model/conexion.php';
require_once '../../Model/traeralumno.php';
$conexion = new Conexion();
$reporte = $_POST['reporte'] ?? '';
$pdo = $conexion->getConexion();
$sqlBase = "SELECT a.id_alumno as id, a.nombre, a.apellido, c.id_clase, c.clase, c.horario
            FROM alumnos a
            JOIN inscripcion i ON a.id_alumno = i.id_alumno
            JOIN clases c ON i.id_clase = c.id_clase";
switch ($reporte) {

    case 'grupo':
        $sql = $sqlBase . " ORDER BY c.id_clase";
        break;

    case 'turno':
        $sql = $sqlBase . " ORDER BY c.horario";
        break;

    case 'nombre':
        $sql = $sqlBase . " ORDER BY a.nombre ASC";
        break;

    default:
        $sql = $sqlBase;
        break;
}

$stmt = $pdo->query($sql);
$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sqlclases = "SELECT id_clase,clase, horario FROM clases";
$stmt2 = $pdo->query($sqlclases);

$clases = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <meta name="description" content="Una aplicación para gestionar usuarios de una escuela de musica">
    <meta name="keywords" content="HTML, CSS, JAVASCRIPT, UNIVERSITY">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" type="image/png" href="../images/icon.png" sizes="32x32">
</head>
<body>
<header>
    <div class="image">
        <img class="icono" src="../images/icon.png" alt="icono">
    </div>
    <div class="content-header">
        <h1>Sinfonia de clases. Armonia en tus grupos</h1>
    </div>
</header>
<main>
    <form class="form-reporte" method="POST">
    <label>Generar reporte:</label>
    
    <select name="reporte">
        <option value="">-- Selecciona --</option>
        <option value="grupo">Por grupo</option>
        <option value="turno">Por turno</option>
        <option value="nombre">Por nombre</option>
    </select>

    <button type="submit">Generar</button>
    </form>
    <div class="alumnosdgv">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Grupo</th>
                    <th>Clase</th>
                    <th>Horario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($alumnos as $fila): ?>
                    <tr>
                        <td><?= $fila['id'] ?></td>
                        <td><?= $fila['nombre'] ?></td>
                        <td><?= $fila['apellido'] ?></td>
                        <td><?= $fila['id_clase'] ?></td>
                        <td><?= $fila['clase'] ?></td>
                        <td><?= $fila['horario'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="options">
        <button type="button" class="agregaralumno" onclick="document.querySelector('.agregar').classList.add('active')">
            Registrar alumno
        </button>
        <button type="button" class="eliminaralumno" onclick="document.querySelector('.eliminar').classList.add('active')">
            Eliminar alumno 
        </button>
    </div>
    <div class="agregar" onclick="this.classList.remove('active')">
        <form action="../../Model/agregaralumno.php" method="POST" onclick="event.stopPropagation()" class="agregarAlumno">
            <label for="nombre">
                Nombre del alumno:
            </label>
            <input name="nombre" type="text" required>
            <label for="apellido"> Apellido del alumno: </label>
            <input name="apellido" type="text" required>
          <select name="id_clase">
            <?php var_dump($clases); ?>
            <?php foreach($clases as $clase): ?>
                <option value="<?= $clase['id_clase'] ?>">
                    <?= $clase['clase'] ?> - <?= $clase['horario'] ?>
                </option>
            <?php endforeach; ?>
          </select>
            <button class="enviar" type="submit">Agregar alumno</button>
            <button class="cancelar" type="button" onclick="this.closest('.agregar').classList.remove('active')">Cancelar </button>
        </form>
    </div>
    <div class="eliminar" onclick="this.classList.remove('active')">
        <form action="../../Model/eliminaralumno.php" method="POST" onclick="event.stopPropagation()" class="eliminarAlumno">
            <label for="id">Id de alumno que desea eliminar: </label>
            <input class="idalumno" type="text" required name="id">
            <button class="confirmar" type="submit">Confirmar eliminacion</button>
            <button class="cancelar" type="button" onclick="this.closest('.eliminar').classList.remove('active')">Cancelar</button>
        </form>
    </div>
</main>
<footer>
    <p>© Producto de Astrosoft 2026</p>
    <p>Un sistema de: Ámbar Azul Ronquillo Lopez, Itzuri Delgado Gutierrez y José Ángel Villa Ramirez</p>
</footer>
<script src="../JS/cerrar.js"> </script>
</body>
</html>