<?php
// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['majoredat'], $_POST['idioma'], $_POST['moneda'])) {
        $majoredat = $_POST['majoredat'];
        $idioma = $_POST['idioma'];
        $moneda = $_POST['moneda'];

        // Validar datos
        if (in_array($majoredat, ['si', 'no']) && 
            in_array($idioma, ['ca', 'es', 'en']) && 
            in_array($moneda, ['eur', 'gbp', 'usd'])) {
            
            // Guardar en cookies (365 días)
            setcookie('majoredat', $majoredat, time() + (365 * 24 * 60 * 60));
            setcookie('idioma', $idioma, time() + (365 * 24 * 60 * 60));
            setcookie('moneda', $moneda, time() + (365 * 24 * 60 * 60));

            // Redirigir a la página de información
            header('Location: informacio.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodega</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h1>Bodega</h1>

    <form method="POST" action="">
        <div class="form-group">
            <label for="majoredat">Ets major d'edat?</label>
            <select id="majoredat" name="majoredat" required>
                <option value="">Selecciona una opció</option>
                <option value="si">Sí</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="idioma">Idioma:</label>
            <select id="idioma" name="idioma" required>
                <option value="">Selecciona un idioma</option>
                <option value="ca">Català</option>
                <option value="es">Espanyol</option>
                <option value="en">Anglès</option>
            </select>
        </div>

        <div class="form-group">
            <label for="moneda">Moneda:</label>
            <select id="moneda" name="moneda" required>
                <option value="">Selecciona una moneda</option>
                <option value="eur">Euros (€)</option>
                <option value="gbp">Lliures (£)</option>
                <option value="usd">Dòlars ($)</option>
            </select>
        </div>

        <button type="submit">Accedir</button>
    </form>
</body>
</html>
