<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="modera.png">
</head>
<body>

    <div class="iphone">
        <div class="notch"></div>
        <div class="screen">
            <h2>Connexion</h2>
            <img src="modera.png" width=65% height=35%>
            <form action="page_connexion.php" method="post">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="pseudo" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Se connecter</button>
            </form>
            <p>Vous n'avez pas de compte ? <a href="page_inscription.php">Créer un compte</a></p>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                    // Récupérer les informations du formulaire de connexion
                    $username = $_POST['pseudo'];
                    $password = $_POST['password'];

                    // Vérifier les informations d'identification dans la base de données
                    $sql = "SELECT * FROM utilisateurs WHERE pseudo='$username' AND password='$password'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // L'utilisateur est authentifié avec succès
                        session_start();
                        $_SESSION['pseudo'] = $username;
                        // Redirection vers la page d'accueil par exemple
                        header("Location: page_accueil.php");
                        exit;
                    } else {
                        // L'utilisateur n'est pas authentifié
                        echo "<p class='error'>Nom d'utilisateur ou mot de passe incorrect.</p>";
                    }

                    $conn->close();
                }
            ?>
        </div>
    </div>
</body>
</html>
