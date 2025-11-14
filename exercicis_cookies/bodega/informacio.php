<?php
// Obtener datos de las cookies
$majoredat = isset($_COOKIE['majoredat']) ? $_COOKIE['majoredat'] : null;
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : null;
$moneda = isset($_COOKIE['moneda']) ? $_COOKIE['moneda'] : null;

// Redireccionar si no hay cookies
if (!$majoredat || !$idioma || !$moneda) {
    header('Location: bodega.php');
    exit;
}

// Definir los textos según idioma y moneda
$textos = [
    'ca' => [
        'titulo' => 'Bodega',
        'sin_alcohol' => 'No et podem vendre alcohol si ets menor d\'edat.',
        'vino1' => 'T\'oferim el vi "Les Terrasses"',
        'precio_vino1' => ['eur' => '39 €', 'gbp' => '35 £', 'usd' => '42 $'],
        'vino2' => 'Cervesa "Damm"',
        'precio_vino2' => ['eur' => '12 €', 'gbp' => '10 £', 'usd' => '13 $'],
    ],
    'es' => [
        'titulo' => 'Bodega',
        'sin_alcohol' => 'No podemos vender alcohol si eres menor de edad.',
        'vino1' => 'Te ofrecemos el vino "Les Terrasses"',
        'precio_vino1' => ['eur' => '39 €', 'gbp' => '35 £', 'usd' => '42 $'],
        'vino2' => 'Cerveza "Damm"',
        'precio_vino2' => ['eur' => '12 €', 'gbp' => '10 £', 'usd' => '13 $'],
    ],
    'en' => [
        'titulo' => 'Winery',
        'sin_alcohol' => 'We cannot sell alcohol if you are underage.',
        'vino1' => 'We offer you the wine "Les Terrasses"',
        'precio_vino1' => ['eur' => '39 €', 'gbp' => '35 £', 'usd' => '42 $'],
        'vino2' => 'Beer "Damm"',
        'precio_vino2' => ['eur' => '12 €', 'gbp' => '10 £', 'usd' => '13 $'],
    ],
];

// Obtener los textos para el idioma seleccionado
$texto = $textos[$idioma];
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $texto['titulo']; ?></title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h1><?php echo $texto['titulo']; ?></h1>

    <div class="contenido">
        <?php if ($majoredat == 'no'): ?>
            <div class="no_acceso">
                <?php echo $texto['sin_alcohol']; ?>
            </div>
        <?php else: ?>
            <div class="producto">
                <p><?php echo $texto['vino1']; ?> a <?php echo $texto['precio_vino1'][$moneda]; ?></p>
            </div>
            <div class="producto">
                <p><?php echo $texto['vino2']; ?> a <?php echo $texto['precio_vino2'][$moneda]; ?></p>
            </div>
        <?php endif; ?>

        <div class="link">
            <a href="bodega.php">Canviar preferències</a>
        </div>
    </div>
</body>
</html>
