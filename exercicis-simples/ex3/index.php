<?php
$hora = (int)date('H');
$hora_formatada = date('H:i');

if ($hora >= 5 && $hora < 14) {
    $salutacio = "Bon dia";
} elseif ($hora >= 14 && $hora < 19) {
    $salutacio = "Bona tarda";
} else {
    $salutacio = "Bona nit";
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Salutació per hora</title>
</head>
<body>
    <h1><?php echo $salutacio; ?></h1>
    <p>Hora del servidor: <?php echo $hora_formatada; ?></p>
</body>
</html>