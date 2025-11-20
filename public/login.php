<?php

use Dsw\Blog\DAO\UserDAO;

require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $userDAO = new UserDAO($conn);
    $user = $userDAO->login($username, $password);

    if ($user) {
        $_SESSION['user_id'] = $user->getId();
        header('Location: index.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}

$pageTitle = "Iniciar sesión";
include '../includes/header.php';

if (isset($error)) {
    printf('<span class="error">%s</span>', $error);
}
?>



<form method="POST" action="login.php">
    <div>
        <label for="username">Usuario</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Entrar</button>
</form>

<?php
include '../includes/footer.php';
?>
