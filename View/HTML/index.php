<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../Model/conexion.php';
$conexion = new Conexion();
$pdo = $conexion->getConexion();
$sql = "SELECT id_clase, clase, horario FROM clases";
$stmt = $pdo->query($sql);
$clases = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <meta name="description" content="Una aplicación para gestionar usuarios de una escuela de musica">
    <meta name="keywords" content="HTML, CSS, JAVASCRIPT, UNIVERSITY">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<header>
    <div class="image">
        <img>
    </div>
    <div class="content-header">
        <h1>Sinfonia de clases. Armonia en tus grupos</h1>
    </div>
</header>
<main>
    <div class="options">
        <button type="button" class="agregaralumno" onclick="document.querySelector('.agregar').classList.add('active')">
            Registrar alumno
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
            <?php foreach($clases as $fila): ?>
                <option value="<?= $fila['id_clase'] ?>">
                    <?= $fila['clase'] ?> - <?= $fila['horario'] ?>
                </option>
            <?php endforeach; ?>
          </select>
            <button class="enviar" type="submit">Agregar alumno</button>
            <button class="cancelar" type="button" onclick="this.closest('.agregar').classList.remove('active')">Cancelar </button>
        </form>
    </div>
</main>
<footer>
    <p>© Producto de Astrosoft 2026</p>
    <p>Un sistema de: Ámbar Azul Ronquillo Lopez, Itzuri Delgado Gutierrez y José Ángel Villa Ramirez</p>
</footer>
</body>
</html>