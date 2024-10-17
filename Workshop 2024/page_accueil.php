<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
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
        
            <!-- Afficher le niveau en haut à droite -->
            <div class="level-display">
                <p>Niveau : <?php echo $level; ?></p>
            </div>
        
            <!-- Photo de profil -->
            <img src="<?php echo $imageSrc; ?>" alt="Profile Photo" class="profile-photo">
            
            <!-- Message de bienvenue avec le nom de l'utilisateur -->
            <h3>Bienvenue, <?php echo $username; ?> !</h3>

            <!-- Conteneur pour les jauges -->
            <div class="gauge-container">
                
                <!-- Jauge Éducation (100%) -->
                <div class="gauge">
                    <h4>Éducation</h4>
                    <div class="progress-bar">
                        <div class="progress" style="width: 100%; background-color: #4caf50;"></div> <!-- Vert -->
                    </div>
                    <p>100% complété</p>
                </div>

                <!-- Jauge Sport (70%) -->
                <div class="gauge">
                    <h4>Sport</h4>
                    <div class="progress-bar">
                        <div class="progress" style="width: 70%; background-color: #ff9800;"></div> <!-- Orange -->
                    </div>
                    <p>70% complété</p>
                </div>

                <!-- Jauge Sensibilisation (10%) -->
                <div class="gauge">
                    <h4>Sensibilisation</h4>
                    <div class="progress-bar">
                        <div class="progress" style="width: 10%; background-color: #f44336;"></div> <!-- Rouge -->
                    </div>
                    <p>10% complété</p>
                </div>
            </div>

            <!-- Boutons ronds en bas -->
            <div class="bottom-buttons">
                <a href="page_educatif.php" class="round-button"><img src=education.png alt="Éducation"></a>
                <a href="page_sport.php" class="round-button"><img src=Sport.png alt="Sport"></a>
                <a href="page_sensibilisation.php" class="round-button"><img src=sensibilisation.png alt="Sensibilisation"></a>
            </div>

        </div>
    </div>
</body>
</html>
