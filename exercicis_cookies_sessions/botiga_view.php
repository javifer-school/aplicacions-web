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