<?

class Conexion{
    private $servidor = "localhost";
    private $bd = "musica";
    private $user = "root";
    private $pass = "2007";

    protected $pdo;

    public function __construct()
    {
        try{
            $dsn = "mysl:host={$this->servidor};dbname={$this->bd}; charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex){
            die("Error al conectar");
        }
    }

    public function getConexion(){
        return $this->pdo;
    }
}

?>