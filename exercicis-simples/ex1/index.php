<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $cognoms = isset($_POST['cognoms']) ? htmlspecialchars($_POST['cognoms']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $missatge = isset($_POST['missatge']) ? htmlspecialchars($_POST['missatge']) : '';

    if (!empty($nom) && !empty($cognoms) && !empty($email) && !empty($missatge)) {
        echo "Missatge rebut, $nom. Gràcies per contactar. Et respondrem a $email";
        echo "<br><br><a href='index.php'>Enviar un altre missatge</a>";
    } else {
        echo "Error: Tots els camps són obligatoris.";
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>Formulari de Contacte</title>
    </head>
    <body>
        <h1>Formulari de Contacte</h1>
        <form method="POST">
            <label>Nom:</label><br>
            <input type="text" name="nom" required><br><br>

            <label>Cognoms:</label><br>
            <input type="text" name="cognoms" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Missatge:</label><br>
            <textarea name="missatge" required></textarea><br><br>

            <input type="submit" value="Enviar">
        </form>
    </body>
    </html>
    <?php
}
?>
