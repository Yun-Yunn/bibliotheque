<?php
include "header.php";
require "pdo.php";

$error = null;
@$auteur = strip_tags($_POST["auteur"]);
@$titre = strip_tags($_POST["titre"]);

$statement = $pdo->prepare("SELECT * FROM livre WHERE id_livre = :id");
$statement->execute([
    "id" => $_GET['id_livre']
]);

$livre = $statement->fetch();

if (isset($_POST["modifier"])) {
    if (empty($auteur)) {
        $error .= "<p>veuillez entrer un auteur</p>";
    } elseif (strlen($auteur) < 2 || strlen($auteur) > 50) {
        $error .= "<p>veuillez entrer un auteur valide</p>";
    }
    if (empty($titre)) {
        $error .= "<p>veuillez entrer un titre</p>";
    } elseif (strlen($titre) < 2 || strlen($titre) > 50) {
        $error .= "<p>veuillez entrer un titre valide</p>";
    }
    if (empty($error)) {
        $sql = "UPDATE livre SET auteur = :auteur, titre = :titre WHERE id_livre = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            "auteur" => $_POST["auteur"],
            "titre" => $_POST["titre"],
            "id" => $_GET['id_livre']
        ]);
        header("location:livre.php");
    }
}

?>

<style>
    .connect {
        display: flex;
        padding-right: 1rem;
    }

    body {
        width: 100%;
        height: 100vh;
        background-image: url("https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80");
        background-size: cover;
        background-repeat: no-repeat;
    }

    #formulaire {
        display: flex;
        flex-direction: column;
        padding: 1rem;
        align-items: center;
    }

    .woops {
        display: flex;
        flex-direction: column-reverse;

    }
</style>

<div class="woops">
    <?php if (isset($livre)) { ?>
        <form action="" method="post">
            <div id="formulaire">
                <div>
                    <label for="exampleInputauteur1" class="form-label mt-4">Auteur</label>
                    <input type="text" class="form-control" id="exampleInputauteur1" aria-describedby="auteurlHelp" placeholder="Nom" name="auteur" value="<?php echo $livre['auteur'] ?>">
                </div>
                <div>
                    <label for="exampleInputtitre1" class="form-label mt-4">Titre</label>
                    <input type="text" class="form-control" id="exampleInputtitre1" aria-describedby="titreHelp" placeholder="Nom" name="titre" value="<?php echo $livre['titre'] ?>">
                </div>
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    <?php } ?>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p>aie aie aie !!! <?php echo $error ?></p>

        </div>

    <?php } ?>
</div>