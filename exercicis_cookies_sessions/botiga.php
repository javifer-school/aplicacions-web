<?php
session_start();

// Procesar logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: botiga.php');
    exit();
}

// Si no está logueado, mostrar login
if (!isset($_SESSION['usuario'])) {
    header('Location: login/login.php');
    exit();
}

// Inicializar cistella si no existe
if (!isset($_SESSION['cistella'])) {
    $_SESSION['cistella'] = [];
}

// Procesar agregar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = $_POST['nom'] ?? '';
    $preu = (float)($_POST['preu'] ?? 0);
    $quantitat = (int)($_POST['quantitat'] ?? 1);
    
    if (!empty($nom) && $preu > 0 && $quantitat > 0 && count($_SESSION['cistella']) < 2) {
        $producte_id = 'producte_' . (count($_SESSION['cistella']) + 1);
        $_SESSION['cistella'][$producte_id] = [
            'nom' => $nom,
            'preu' => $preu,
            'quantitat' => $quantitat
        ];
    }
    
    header('Location: botiga.php?view=botiga');
    exit();
}

// Ver vistas
$view = $_GET['view'];

// Vista de botiga (form para añadir productos)
if ($view === 'botiga') {
    include 'botiga_view.php';
    exit();
}

// Vista de cistella (resumen de compra)
if ($view === 'cistella') {
    $total = 0;
    foreach ($_SESSION['cistella'] as $producte) {
        $total += $producte['preu'] * $producte['quantitat'];
    }
    include 'cistella_view.php';
    exit();
}

// Procesar confirmación de compra
if (isset($_GET['confirmar'])) {
    if (!empty($_SESSION['cistella'])) {
        $_SESSION['cistella'] = [];
        include 'confirmacio_view.php';
    } else {
        header('Location: botiga.php?view=botiga');
    }
    exit();
}

// Por defecto, redirigir a la vista de botiga
header('Location: botiga.php?view=botiga');
exit();
?>
