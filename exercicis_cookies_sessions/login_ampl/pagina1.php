<?php
session_start();

// Procesar deslogueo
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.html');
    exit();
}

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pàgina 1</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Benvingut, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
            <a href="pagina1.php?logout=1" class="logout-btn">Desconectar</a>
        </div>
        <p>Aquesta és la pàgina 1 de contingut.</p>
        <nav>
            <a href="pagina1.php">Pàgina 1</a>
            <a href="pagina2.php">Pàgina 2</a>
        </nav>
    </div>
</body>
</html>
