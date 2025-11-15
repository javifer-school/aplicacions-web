<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar que usuario y contraseña coincidan
    if ($usuario === $password && !empty($usuario)) {
        $_SESSION['usuario'] = $usuario;
        header('Location: pagina1.php');
        exit();
    } else {
        header('Location: index.html?error=1');
        exit();
    }
}
?>
