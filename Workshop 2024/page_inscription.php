<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        // Traitement du formulaire d'inscription
        $message = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $username = $_POST['pseudo'];
            $password = $_POST['password'];
            $level = 0;

            // Connexion à la base de données
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "workshop";

            // Créer une connexion
            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("Connexion échouée : " . $conn->connect_error);
            }

            // Insérer l'utilisateur
            $sql_utilisateurs = "INSERT INTO utilisateurs (nom, prenom, mail, date_creation_compte, pseudo, password, level) VALUES (?, ?, ?, NOW(), ?, ?, ?)";
            $stmt_utilisateurs = $conn->prepare($sql_utilisateurs);
            $stmt_utilisateurs->bind_param("sssssi", $nom, $prenom, $mail, $username, $password, $level);

            if ($stmt_utilisateurs->execute()) {
                $message = "Le compte a été créé avec succès !"; // Message de succès
            } else {
                die("Échec de l'exécution de la requête : " . $stmt_utilisateurs->error);
            }

            // Fermer les déclarations et la connexion
            $stmt_utilisateurs->close();
            $conn->close();
        }
    ?>
    
    <div class="iphone">
        <div class="notch"></div>
        <div class="screen">
            <h2>Inscription</h2>
            <form action="page_inscription.php" method="post">
                <label for="username">NOM :</label>
                <input type="text" id="nom" name="nom" required>

                <label for="username">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>

                <label for="email">Email :</label>
                <input type="email" id="mail" name="mail" required>

                <label for="pseudo">Nom d'utilisateur :</label>
                <input type="text" id="pseudo" name="pseudo" required><br><br>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm-password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm-password" name="password" required>

                <button type="submit">S'inscrire</button>
            </form>
            <?php if (!empty($message)) { ?>
                <p class="success-message"><?php echo $message; ?></p>
            <?php } ?>
            <p>Déjà un compte ? <a href="page_connexion.php">Connectez-vous ici</a></p>
        </div>
    </div>
</body>
</html>
