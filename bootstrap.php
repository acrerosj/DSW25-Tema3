<?php
session_start();

use Dsw\Blog\DAO\UserDAO;
use Dsw\Blog\Database;

require_once '../vendor/autoload.php';

try {
    $conn = Database::getConnection();
} catch (Exception $e) {
    die('Error de conexión con BD: ' . $e->getMessage());
}

$user = null;
if (isset($_SESSION['user_id'])) {
    $userDAO = new UserDAO($conn);
    $user = $userDAO->get($_SESSION['user_id']);
}