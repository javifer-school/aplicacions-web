<?php
session_start();

// Inicializar cistella si no existe
if (!isset($_SESSION['cistella'])) {
    $_SESSION['cistella'] = [];
}

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'afegir_1') {
        $quantitat = (int)($_POST['quantitat1'] ?? 0);
        if ($quantitat > 0) {
            $quantitat += (int)($_SESSION['cistella']['producte_1']['quantitat'] ?? 0);
            $_SESSION['cistella']['producte_1'] = [
                'nom' => 'Producte 1',
                'preu' => 10,
                'quantitat' => $quantitat
            ];
        }
    } elseif ($action === 'afegir_2') {
        $quantitat = (int)($_POST['quantitat2'] ?? 0);
        if ($quantitat > 0) {
            $quantitat += (int)($_SESSION['cistella']['producte_2']['quantitat'] ?? 0);
            $_SESSION['cistella']['producte_2'] = [
                'nom' => 'Producte 2',
                'preu' => 20,
                'quantitat' => $quantitat
            ];
        }
    }
    
    header('Location: index.html');
    exit();
}

// Ver cistella o finalitzar compra
$view = $_GET['view'] ?? '';

if ($view === 'cistella') {
    $total = 0;
    foreach ($_SESSION['cistella'] as $producte) {
        $total += $producte['preu'] * $producte['quantitat'];
    }
    ?>
    <!DOCTYPE html>
    <html lang="ca">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cistella</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h1>Cistella de compra</h1>
            
            <?php if (empty($_SESSION['cistella'])): ?>
                <p class="empty">La cistella és buida</p>
            <?php else: ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Producte</th>
                            <th>Preu unitari</th>
                            <th>Quantitat</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cistella'] as $producte): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producte['nom']); ?></td>
                                <td><?php echo $producte['preu']; ?>€</td>
                                <td><?php echo $producte['quantitat']; ?></td>
                                <td><?php echo $producte['preu'] * $producte['quantitat']; ?>€</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="total">
                    <h2>Total: <?php echo $total; ?>€</h2>
                </div>
                
                <div class="actions">
                    <a href="index.html" class="btn btn-secondary">Tornar a la botiga</a>
                    <a href="cistella_compra.php?confirmar=1" class="btn btn-primary">Confirmar compra</a>
                </div>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Confirmar compra
if (isset($_GET['confirmar'])) {
    if (!empty($_SESSION['cistella'])) {
        $_SESSION['cistella'] = [];
        ?>
        <!DOCTYPE html>
        <html lang="ca">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Compra confirmada</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <div class="container">
                <h1>Compra confirmada!</h1>
                <p class="success">La vostra compra s'ha realitzat correctament. Gràcies!</p>
                <div class="actions">
                    <a href="index.html" class="btn btn-primary">Tornar a la botiga</a>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        header('Location: index.html');
    }
    exit();
}

// Si no hay vista específica, redirigir a index.html
header('Location: index.html');
exit();
?>
