<?php
session_start();

// Procesar logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: botiga.php');
    exit();
}

// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($usuario === $password && !empty($usuario)) {
        $_SESSION['usuario'] = $usuario;
        if (!isset($_SESSION['cistella'])) {
            $_SESSION['cistella'] = [];
        }
        header('Location: botiga.php?view=botiga');
        exit();
    }
}

// Si no está logueado, mostrar login
if (!isset($_SESSION['usuario'])) {
    ?>
    <!DOCTYPE html>
    <html lang="ca">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Botiga</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h1>Login Botiga</h1>
            <form action="botiga.php" method="POST">
                <div class="form-group">
                    <label for="usuario">Usuari:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contrasenya:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </body>
    </html>
    <?php
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
$view = $_GET['view'] ?? 'botiga';

// Vista de botiga (form para añadir productos)
if ($view === 'botiga') {
    ?>
    <!DOCTYPE html>
    <html lang="ca">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Botiga</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Botiga</h1>
                <span>Usuari: <?php echo htmlspecialchars($_SESSION['usuario']); ?> | <a href="botiga.php?logout=1">Desconectar</a></span>
            </div>
            
            <div class="products">
                <form action="botiga.php" method="POST">
                    <div class="product">
                        <div class="form-group">
                            <label for="nom">Nom del producte:</label>
                            <input type="text" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="preu">Preu:</label>
                            <input type="number" id="preu" name="preu" step="0.01" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="quantitat">Quantitat:</label>
                            <input type="number" id="quantitat" name="quantitat" value="1" min="1" required>
                        </div>
                        <button type="submit">Afegir a la cistella</button>
                    </div>
                </form>
            </div>

            <div class="actions">
                <a href="botiga.php?view=cistella" class="btn btn-primary">Veure cistella (<?php echo count($_SESSION['cistella']); ?> productes)</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Vista de cistella (resumen de compra)
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
        <title>Resum de compra</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h1>Resum de compra</h1>
            
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
                    <a href="botiga.php?view=botiga" class="btn btn-secondary">Tornar a la botiga</a>
                    <a href="botiga.php?confirmar=1" class="btn btn-primary">Confirmar compra</a>
                </div>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Procesar confirmación de compra
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
                    <a href="botiga.php?view=botiga" class="btn btn-primary">Tornar a la botiga</a>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        header('Location: botiga.php?view=botiga');
    }
    exit();
}

// Por defecto, redirigir a la vista de botiga
header('Location: botiga.php?view=botiga');
exit();
?>
