<?php
class AlumnoService {

    public function registrarAlumno($pdo, $nombre, $apellido, $clase) {

        if (empty($nombre) || empty($apellido) || empty($clase)) {
            return false;
        }

        $sql = "INSERT INTO alumnos(nombre, apellido) VALUES(?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $apellido]);

        $id_alumno = $pdo->lastInsertId();

        $sql2 = "INSERT INTO inscripcion(id_alumno, id_clase) VALUES(?, ?)";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([$id_alumno, $clase]);

        return true;
    }
}
?>