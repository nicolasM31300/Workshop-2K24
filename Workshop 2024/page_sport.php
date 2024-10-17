<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport</title>
    <link rel="stylesheet" href="sport.css">
    <link rel="icon" type="image/png" href="modera.png">
</head>
<body>

    <div class="iphone">
        <div class="notch"></div>
        <div class="screen">

        <?php
            if(isset($_SESSION['pseudo'])) {

                // Connectez-vous à votre base de données
                // Assurez-vous de remplacer les valeurs de connexion à la base de données par les vôtres
                // Connexion à la base de données
                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "workshop";

                // Créer une connexion
                $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                // Vérifiez la connexion
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Requête SQL pour récupérer les colonnes en fonction du pseudo
                $pseudo = $_SESSION['pseudo'];
                $sql = "SELECT nom, prenom, level FROM utilisateurs WHERE pseudo = '$pseudo'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Récupérer les données de la première ligne
                    $row = $result->fetch_assoc();
                    // Récupérer les colonnes
                    $prenom = $row["prenom"];
                    $nom = $row["nom"];
                    $level = $row["level"];
                    // Affectez prenom et nom à la variable $username
                    $username = $prenom . " " . $nom;

                    if ($level >= 0 && $level < 5) {
                        $imageSrc = "pokemon0.png";
                    } elseif ($level >= 5 && $level < 30) {
                        $imageSrc = "pokemon1.png";
                    } elseif ($level >= 30 && $level < 60) {
                        $imageSrc = "pokemon2.png";
                    } elseif ($level >= 60) {
                        $imageSrc = "pokemon3.png";
                    }

                    // Ajoutez d'autres informations de profil ici
                } else {
                    echo "Aucun résultat trouvé";
                }

                // Fermez la connexion à la base de données
                $conn->close();
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
                header("Location: page_connexion.php");
                exit;
            }
        ?>

        <h2>Objectif Sport</h2>    
            <div class="gauge">
                <div class="progress-bar">
                    <div class="progress" style="width: 70%; background-color: #ff9800;"></div>
                </div>
                <h4>Progression : 70%</h4>
            </div>
            <img src="maps.png" style="max-width: 100%; height: auto; margin-top: -400px;">
            <p>Distance parcourue : 2km / 2km</p> <!-- Ce texte doit être espacé au-dessus du bouton -->
            <div class="home-button">
                <a href="page_accueil.php" class="round-button"><img src="home.png" alt="Accueil"></a>
            </div>
        </div>
    </div>
</body>
</html>
