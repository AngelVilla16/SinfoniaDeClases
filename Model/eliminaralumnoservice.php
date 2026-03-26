<?php
class EliminarService{
    public function eliminarAlumno($pdo,$id){
        $sql = "DELETE FROM inscripcion WHERE id_alumno = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $sql2 = "DELETE FROM alumnos WHERE id_alumno = ?";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([$id]);

        return $stmt2->rowCount() > 0;

    }
}
?>