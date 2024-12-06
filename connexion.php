<?php
include "header.php";
require "pdo.php";

if (isset($_POST["envoyer"])) {

    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/sketchy/bootstrap.css">
    <title>connexion</title>

</head>

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

    .woops {
        display: flex;
        flex-direction: column-reverse;

    }

</style>



    <div class="woops">
        <form action="" method="post">

            <div id="formulaire">
                <label class="form-label mt-4">CONNEXION</label>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off">
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit" class="btn btn-success" name="envoyer">Send</button>
            </div>
        </form>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-dismissible alert-success" id="ahah">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <p>aie aie aie !!! <?php echo $error ?></p>

            </div>
        <?php } ?>
    </div>
