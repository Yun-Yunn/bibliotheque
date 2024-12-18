<?php
include "header.php";
require "pdo.php";

/* function valideDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    if ($d && $d->format($format) == $date) {
        return true;
    } else {
        return false;
    }
} */

if (isset($_POST["envoyer"])) {
    if (empty($_POST["nom"])) {
        $error = " <p>le nom est obligatoire</p>";
    } elseif ((strlen($_POST["nom"])) < 2 || (strlen($_POST["nom"])) > 70) {
        $error .= "<p> le nom est obligatoire</p>";
    }

    if (empty($_POST["prenom"])) {
        $error .= "<p> le prenom est obligatoire</p>";
    } elseif ((strlen($_POST["prenom"])) < 2 || (strlen($_POST["prenom"])) > 70) {
        $error .= "<p> le prenom est obligatoire</p>";
    }
    if (empty($_POST["email"])) {
        $error .= "<p> l'email est obligatoire</p>";
    } elseif (!preg_match(" /^[^\W][a-zA-Z0-9]+(.[a-zA-Z0-9]+)@[a-zA-Z0-9]+(.[a-zA-Z0-9]+).[a-zA-Z]{2,4}$/ ", $_POST["email"])) {
        $error .= "<p> l'email n'est pas conforme</p>";
    }

/*     if (empty($_POST["date_naissance"])) {
        $error .= "<p> la date est obligatoire</p>";
    } elseif (($_POST["date_naissance"])) {
        $error .= "<p> la date n'est pas conforme</p>";
    } */
    if (empty($error)) {
        try {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $date_naissance = $_POST["date_naissance"];
            $email = $_POST["email"];
            
            $statement = $pdo->prepare("INSERT INTO abonne(nom,prenom,date_naissance,email) VALUES(:nom,:prenom,:date_naissance,:email)");
            $statement->execute([
                ":nom" => $nom,
                ":prenom" => $prenom,
                ":date_naissance" => $date_naissance,
                ":email" => $email
            ]);
            header("location:index.php");
        } catch (PDOException $e) {
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

    #formulaire div {
        width: 35%;
    }
</style>

<form action="" method="post">

    <div id="formulaire">
        <div>
            <label for="exampleInputEmail1" class="form-label mt-4">Nom</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nom" name="nom" value="<?php echo @$_POST["nom"] ?>">
        </div>
        <div>
            <label for="exampleInputEmail1" class="form-label mt-4">Prenom</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Prenom" name="prenom" value="<?php echo @$_POST["prenom"] ?>">
        </div>
        <div>
            <label for="exampleInputDate" class="form-label mt-4">date</label>
            <input type="date" class="form-control" id="exampleInputDate1" placeholder="date" autocomplete="off " name="date_naissance" value="<?php echo @$_POST["date_naissance"] ?>">
        </div>

        <div>
            <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo @$_POST["email"] ?>">
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
