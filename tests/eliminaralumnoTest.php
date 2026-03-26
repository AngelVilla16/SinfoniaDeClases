<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Model/eliminaralumnoservice.php';

class eliminaralumnoTest extends TestCase {

    public function testEliminarAlumnoExitoso() {

        $pdo = $this->createMock(PDO::class);
        $stmt = $this->createMock(PDOStatement::class);

        // Simular prepare
        $pdo->method('prepare')->willReturn($stmt);

        // Simular execute (no importa mucho aquí)
        $stmt->method('execute')->willReturn(true);

        // Simular que sí eliminó (1 fila afectada)
        $stmt->method('rowCount')->willReturn(1);

        $service = new EliminarService();

        $resultado = $service->eliminarAlumno($pdo, 1);

        $this->assertTrue($resultado);
    }

    public function testEliminarAlumnoNoExiste() {

        $pdo = $this->createMock(PDO::class);
        $stmt = $this->createMock(PDOStatement::class);

        $pdo->method('prepare')->willReturn($stmt);
        $stmt->method('execute')->willReturn(true);

        // Simular que NO eliminó nada
        $stmt->method('rowCount')->willReturn(0);

        $service = new EliminarService();

        $resultado = $service->eliminarAlumno($pdo, 999);

        $this->assertFalse($resultado);
    }
}