<?php
// Página de prueba. Se debe eliminar de producción. 

use Dotenv\Dotenv;

require_once '../vendor/autoload.php';

// Leer variables de entono

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$host = $_ENV['DB_HOST'];
//$host = '127.0.0.1';
$db = $_ENV['DB_NAME'];
//$db = 'tabla';
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
//$password = '1234';
$charset = $_ENV['DB_CHARSET'];

// Hacer la conexión a la BD. 
// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

} catch (PDOException $e) {
    echo "<h1>Error en la conexión</h1>";
    printf("<p>%s</p>", $e->getMessage());
    die();
}

//echo "Conexión correcta";


// Consulta SQL o manipulación del a base de datos.

// Usuario por ID.
$userId = '2';

$sql = "SELECT id, name, email, register_date FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);

$stmt->execute(['id' => $userId]);

$user = $stmt->fetch();

echo "<pre>";
print_r($user);
echo "</pre>";
printf('<p>Id: %s</p>', $user['id']);
printf('<p>Nombre: %s</p>', $user['name']);
printf('<p>Email: %s</p>', $user['email']);
printf('<p>Fecha registro: %s</p>', $user['register_date']);

// Desconexión
$stmt = null;
$pdo = null;