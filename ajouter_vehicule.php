<?php
// Configuration de la base de données
$host = "localhost";
$dbname = "TPSI";
$username = "root"; // Remplacez par le nom d'utilisateur de votre base de données
$password = ""; // Remplacez par le mot de passe de votre base de données

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les données du formulaire sont envoyées
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $numero_identification = $_POST["numero_identification"];
        $type_vehicule = $_POST["type_vehicule"];
        $nombre_max_passagers = $_POST["nombre_passagers"];
        $etat = $_POST["etat"];
        $marque = $_POST["marque"];
        $modele = $_POST["modele"];
        $annee_fabrication = $_POST["annee_fabrication"];
        $documents_validite = $_POST["documents_validite"];

        // Préparer la requête SQL
        $sql = "INSERT INTO Vehicule (
                    numero_identification, 
                    type_vehicule, 
                    nombre_max_passagers, 
                    etat, 
                    marque, 
                    modele, 
                    annee_fabrication, 
                    documents_validite
                ) VALUES (
                    :numero_identification, 
                    :type_vehicule, 
                    :nombre_max_passagers, 
                    :etat, 
                    :marque, 
                    :modele, 
                    :annee_fabrication, 
                    :documents_validite
                )";

        $stmt = $pdo->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(":numero_identification", $numero_identification);
        $stmt->bindParam(":type_vehicule", $type_vehicule);
        $stmt->bindParam(":nombre_max_passagers", $nombre_max_passagers);
        $stmt->bindParam(":etat", $etat);
        $stmt->bindParam(":marque", $marque);
        $stmt->bindParam(":modele", $modele);
        $stmt->bindParam(":annee_fabrication", $annee_fabrication);
        $stmt->bindParam(":documents_validite", $documents_validite);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Le véhicule a été ajouté avec succès.<a href='formulaire.html'> retourner au formulaire</a>";
        } else {
            echo "Une erreur s'est produite lors de l'ajout du véhicule.";
        }
    }
} catch (PDOException $e) {
    // Gérer les erreurs de connexion
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
