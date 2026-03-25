<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Model/clasealumno.php';

class AlumnoServiceTest extends TestCase {

    public function testRegistroExitoso() {

        $pdo = $this->createMock(PDO::class);
        $stmt = $this->createMock(PDOStatement::class);

        $pdo->method('prepare')->willReturn($stmt);
        $stmt->method('execute')->willReturn(true);
        $pdo->method('lastInsertId')->willReturn("1");

        $service = new AlumnoService();

        $resultado = $service->registrarAlumno($pdo, "Juan", "Perez", 1);

        $this->assertTrue($resultado);
    }
}
?>