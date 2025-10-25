<?php
$messages = [
    'rock' => 'Rock! Ets una persona amb energia i actitud!',
    'pop' => 'Pop! Ets una persona alegre i sociable!',
    'jazz' => 'Jazz! Ets una persona sofisticada i culta!',
    'clàssica' => 'Música Clàssica! Ets una persona elegant i reflexiva!',
    'reggae' => 'Reggae! Ets una persona relaxada i pacífica!'
];

$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estil'])) {
    $estil = $_POST['estil'];
    if (array_key_exists($estil, $messages)) {
        $result = $messages[$estil];
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Enquesta de Música</title>
</head>
<body>
    <h1>Enquesta de Música</h1>

    <?php if (!empty($result)): ?>
        <p><strong><?php echo $result; ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <p>Quin estil de música t'agrada més?</p>

        <input type="radio" id="rock" name="estil" value="rock" required>
        <label for="rock">Rock</label><br>

        <input type="radio" id="pop" name="estil" value="pop">
        <label for="pop">Pop</label><br>

        <input type="radio" id="jazz" name="estil" value="jazz">
        <label for="jazz">Jazz</label><br>

        <input type="radio" id="clàssica" name="estil" value="clàssica">
        <label for="clàssica">Música Clàssica</label><br>

        <input type="radio" id="reggae" name="estil" value="reggae">
        <label for="reggae">Reggae</label><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
