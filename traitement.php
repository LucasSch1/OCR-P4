<?php
    
if(empty($_POST['titre']) 
    || empty($_POST['artiste']) 
    || empty($_POST['description']) 
    || empty($_POST['image']) 
    || strlen($_POST['description']) <3 
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL) ) {
    header('Location: ajouter.php?erreur=true');
}else{
    //Conversion des caractères spéciaux en entités HTML pour éviter leurs affichage (Faille XSS)
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);

    //Inclut la connexion a la base de données
    include 'bdd.php';
    $bdd = connexion();

    // Préparation de la requete pour inserer dans la base de données 
    $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste , image) VALUES (?, ?, ?, ?)');
    $requete->execute([$titre , $description, $artiste, $image]); // Exécution de la requete avec les entrées stockées dans des

    header('Location: oeuvre.php?id=' .$bdd->lastInsertId());  //Redirection vers la dernière oeuvre créer 
}
