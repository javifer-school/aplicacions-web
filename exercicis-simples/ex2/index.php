<?php
$rate_eur_to_usd = 1.08;
$rate_usd_to_eur = 1 / $rate_eur_to_usd;

$result_html = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$type = $_POST['type'] ?? '';
		$amount_raw = trim((string)($_POST['amount'] ?? ''));

		if (!((float)($amount_raw)) || $amount_raw === '') {
				$result_html = '<p style="color:red">Si us plau, introdueix una quantitat vàlida.</p>';
		} else {
				$amount = (float)$amount_raw;
				if ($type === 'eur_to_usd') {
						$converted = $amount * $rate_eur_to_usd;
						$result_html = sprintf('<p>%.2f € = %.2f $</p>', $amount, $converted);
				} else {
						$converted = $amount * $rate_usd_to_eur;
						$result_html = sprintf('<p>%.2f $ = %.2f €</p>', $amount, $converted);
				}
		}
}

?>

<!doctype html>
<html lang="ca">
<head>
	<meta charset="utf-8">
	<title>Exercici 2 - Conversor EUR/USD</title>
</head>
<body>
	<h1>Conversor Euros ↔ Dòlars</h1>

	<form method="post" novalidate>
		<label>
			Quantitat:
			<input type="number" name="amount" step="any" required value="<?php echo isset($_POST['amount']) ? htmlspecialchars($_POST['amount']) : '' ?>">
		</label>

		<label>
			Conversió:
			<select name="type">
				<option value="eur_to_usd" <?php echo (isset($_POST['type']) && $_POST['type']==='eur_to_usd') ? 'selected' : '' ?>>Euros → Dòlars</option>
				<option value="usd_to_eur" <?php echo (isset($_POST['type']) && $_POST['type']==='usd_to_eur') ? 'selected' : '' ?>>Dòlars → Euros</option>
			</select>
		</label>

		<p>
			<button type="submit">Convertir</button>
		</p>
	</form>

	<div class="result"><?php echo $result_html; ?></div>

	<p>Tipus de canvi aproximat: 1 EUR = <?php echo $rate_eur_to_usd; ?> USD</p>

</body>
</html>