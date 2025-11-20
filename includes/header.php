<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Tema3: Blog</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <?php
                    if ($user && $user->getLevel()==="admin") {
                        echo '<li><a href="users.php">Usuarios</a></li>';
                    }
                ?>
                <li><a href="posts.php">Artículos</a></li>
                <?php if ($user): ?>
                    <li>Usuario: <?= $user->getName(); ?> | <a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <h2><?= $pageTitle ?></h2>
        <div class="content">
