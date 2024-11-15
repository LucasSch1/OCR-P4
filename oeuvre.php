<?php
    require 'header.php';
    include 'bdd.php';
    $bdd = connexion();

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
    }

    // Préparation de la requete SQL à envoyer
    $requete = $bdd->prepare('SELECT * FROM oeuvres WHERE id = ?');
    $requete->execute([$_GET['id']]); // Envoi de la requete SQL avec l'id recupérer de la variable superglobale $_GET
    
    $oeuvre = $requete->fetch(); //Récupère la prochaine ligne de résultat de la requête

        // Vérification des résultats
    if ($requete->rowCount() === 0) {
        header("Location: index.php");
    }

    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(is_null($oeuvre)) {
        header('Location: index.php');
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
