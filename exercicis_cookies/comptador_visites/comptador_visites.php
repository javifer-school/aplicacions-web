<?php
// Inicializar o incrementar el contador de visitas solo en GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_COOKIE['visitas'])) {
        setcookie('visitas', 1, time() + (365 * 24 * 60 * 60));
        $visitas = 1;
    } else {
        $visitas = $_COOKIE['visitas'] + 1;
        setcookie('visitas', $visitas, time() + (365 * 24 * 60 * 60));
    }
} else {
    $visitas = isset($_COOKIE['visitas']) ? $_COOKIE['visitas'] : 1;
}

// Determinar descuento
$descuento = '';
if ($visitas >= 5 && $visitas < 10 && !isset($_COOKIE['compra_realizada'])) {
    $descuento = "Oferta exclusiva! Utilitza el codi BOTIGA20 per obtenir un 20% de descompte en les teves primeres compres a la botiga";
}
if ($visitas >= 10 && !isset($_COOKIE['compra_realizada'])) {
    $descuento = "Oferta exclusiva sols per a tu! Utilitza el codi BOTIGA50 per obtenir un 50% de descompte en les teves primeres compres a la botiga";
}

// Procesar compra
$mensaje_compra = '';
$mensaje_error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['precio'])) {
    $precio = floatval($_POST['precio']);
    $codigo_descuento = isset($_POST['codigo_descuento']) ? trim($_POST['codigo_descuento']) : '';

    if ($codigo_descuento !== '' && $visitas >= 5 && !isset($_COOKIE['compra_realizada'])) {
        if ($codigo_descuento == 'BOTIGA50' && $visitas >= 10) {
            $precio = $precio - $precio * 0.5;
        } else if ($codigo_descuento == 'BOTIGA20' && $visitas >= 5) {
            $precio = $precio - $precio * 0.2;
        } else {
            $mensaje_error = "Código de descuento inválido";
        }
    } else if ($codigo_descuento !== '') {
        $mensaje_error = "Código de descuento inválido";
    }
    if ($precio > 0 && !$mensaje_error) {
        setcookie('compra_realizada', 1, time() + (365 * 24 * 60 * 60));
        $mensaje_compra = "Compra realizada! Total: $precio €";
    } else if (!$mensaje_error) {
        $mensaje_error = "El precio debe ser mayor a 0";
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comptador de Visites</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Comptador de Visites</h1>
    <div class="contador">
        Visites: <?php echo $visitas; ?>
    </div>

    <?php if ($descuento): ?>
        <div class="descuento codi-descompte">
            <?php echo $descuento; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="preu">
            <label for="precio">Preu del producte (€):</label>
            <input type="number" id="precio" name="precio" step="0.01" min="0" required>
        </div>
        <div class="codi-descompte">
            <label for="codigo_descuento">Codi de descompte (si en tens):</label>
            <input type="text" id="codigo_descuento" name="codigo_descuento">
        </div>
        <button type="submit">Comprar</button>
    </form>

    <?php if ($mensaje_error): ?>
        <div class="mensaje_error">
            <?php echo $mensaje_error; ?>
        </div>
    <?php endif; ?>
    <?php if ($mensaje_compra): ?>
        <div class="mensaje">
            <?php echo $mensaje_compra; ?>
        </div>
    <?php endif; ?>

    <p><a href="">Recarregar pàgina</a></p>
</body>
</html>
