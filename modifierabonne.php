<?php
include "header.php";
require "pdo.php";

$error = null;
@$nom = strip_tags($_POST["nom"]);
@$prenom = strip_tags($_POST["prenom"]);
@$date_naissance = strip_tags($_POST["date_naissance"]);
@$email = strip_tags($_POST["email"]);

$statement = $pdo->prepare("SELECT * from abonne where id_abonne = :id");
$statement->execute([
    "id" => $_GET['id_abonne']
]);

$abonne = $statement->fetch();


if (isset($_POST["modifier"])) {
    if (empty($nom)) {
        $error = "<p>veuillez entrer votre nom</p>";
    } elseif (strlen($nom) < 2 || strlen($nom) > 50) {
        $error .= "<p>veuillez entrer un nom valide</p>";
    }
    if (empty($prenom)) {
        $error .= "<p>veuillez entrer votre prenom</p>";
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 50) {
        $error .= "<p>veuillez entrer un prenom valide</p>";
    }
    if (empty($email)) {
        $error .= "<p>veuillez entrer votre email</p>";
    }
    if (empty($error)) {
        $sql = "UPDATE abonne SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, email = :email WHERE id_abonne = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            "nom" => $_POST["nom"],
            "prenom" => $_POST["prenom"],
            "date_naissance" => $_POST["date_naissance"],
            "email" => $_POST["email"],
            "id" => $_GET['id_abonne']
        ]);
        header("location:abonne.php");
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
    <?php if (isset($abonne)) { ?>
        <form action="" method="post">
            <div id="formulaire">
                <div>
                    <label for="exampleInputauteur1" class="form-label mt-4">Nom</label>
                    <input type="text" class="form-control" id="exampleInputauteur1" aria-describedby="auteurlHelp" placeholder="Nom" name="nom" value="<?php echo $abonne['nom'] ?>">
                </div>
                <div>
                    <label for="exampleInputauteur1" class="form-label mt-4">Prenom</label>
                    <input type="text" class="form-control" id="exampleInputauteur1" aria-describedby="auteurlHelp" placeholder="Nom" name="prenom" value="<?php echo $abonne['prenom'] ?>">
                </div>
                <div>
                    <label for="exampleInputauteur1" class="form-label mt-4">Date de Naissance</label>
                    <input type="date" class="form-control" id="exampleInputauteur1" aria-describedby="auteurlHelp" placeholder="Nom" name="date_naissance" value="<?php echo $abonne['date_naissance'] ?>">
                </div>
                <div>
                    <label for="exampleInputauteur1" class="form-label mt-4">Email</label>
                    <input type="text" class="form-control" id="exampleInputauteur1" aria-describedby="auteurlHelp" placeholder="Nom" name="email" value="<?php echo $abonne['email'] ?>">
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