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