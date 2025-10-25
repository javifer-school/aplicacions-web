<?php
$iva_types = [
    '0' => 'Exclòs (0%)',
    '4' => 'Reduït (4%)',
    '10' => 'Intermedi (10%)',
    '21' => 'General (21%)'
];

$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $preu = isset($_POST['preu']) ? floatval($_POST['preu']) : 0;
    $iva = isset($_POST['iva']) ? floatval($_POST['iva']) : 0;

    if ($preu > 0) {
        $quantitat_iva = $preu * ($iva / 100);
        $total = $preu + $quantitat_iva;
        $result = "Preu: " . number_format($preu, 2, ',', '.') . " €<br>";
        $result .= "IVA (" . $iva . "%): " . number_format($quantitat_iva, 2, ',', '.') . " €<br>";
        $result .= "TOTAL: " . number_format($total, 2, ',', '.') . " €";
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Calculadora d'IVA</title>
</head>
<body>
    <h1>Calculadora d'IVA</h1>

    <?php if (!empty($result)): ?>
        <p><?php echo $result; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Preu base (€):</label><br>
        <input type="number" name="preu" step="0.01" min="0" required><br><br>

        <label>Tipus d'IVA:</label><br>
        <select name="iva" required>
            <option value="">Selecciona el tipus d'IVA...</option>
            <?php foreach ($iva_types as $valor => $label): ?>
                <option value="<?php echo $valor; ?>"><?php echo $label; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Calcular">
    </form>
</body>
</html>
