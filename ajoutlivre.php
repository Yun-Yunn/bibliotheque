<?php
include "header.php";
require "pdo.php";

$error = null;
$message = "";
@$auteur = strip_tags($_POST["auteur"]);
@$titre = strip_tags($_POST["titre"]);


if (isset($_POST["envoyer"])) {
    if (empty($auteur)) {
        $error = "<p>veuillez entrer un auteur</p>";
    } elseif (strlen($auteur) < 2 || strlen($auteur) > 50) {
        $error .= "<p>veuillez entrer un auteur valide</p>";
    }
    if (empty($titre)) {
        $error .= "<p>veuillez entrer un titre</p>";
    } elseif (strlen($titre) < 2 || strlen($titre) > 50) {
        $error .= "<p>veuillez entrer un titre valide</p>";
    }
    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO livre (auteur, titre) VALUES (:auteur, :titre)");
            $stmt->execute(
                [
                    ":auteur" => $auteur,
                    ":titre" => $titre,
                ]
            );
            $message = "L'auteur '$auteur' et le titre '$titre' ont bien été ajoutés à la base de données.";
        } catch (PDOException $error) {
            echo $e->getMessage();
        }
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
    <form action="ajoutlivre.php" method="post">
        <div id="formulaire">
            <div>
                <label for="exampleInputauteur1" class="form-label mt-4">Auteur</label>
                <input type="text" class="form-control" id="exampleInputauteur1" aria-describedby="auteurlHelp" placeholder="Nom" name="auteur" value="<?php echo @$_POST["auteur"] ?>">
            </div>
            <div>
                <label for="exampleInputtitre1" class="form-label mt-4">Titre</label>
                <input type="text" class="form-control" id="exampleInputtitre1" aria-describedby="titreHelp" placeholder="Nom" name="titre" value="<?php echo @$_POST["titre"] ?>">
            </div>
            <button type="submit" class="btn btn-success" name="envoyer">Send</button>

        </div>
    </form>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p>aie aie aie !!! <?php echo $error ?></p>

        </div>

    <?php } ?>

    <?php if (!empty($message)) { ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p><?php echo $message ?></p>
        </div>
    <?php } ?>
</div>