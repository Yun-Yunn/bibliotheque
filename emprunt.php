<?php
include "header.php";
require "pdo.php";


try {
    $sql = "SELECT l.auteur, l.titre, e.date_sortie, e.date_rendu
FROM livre l
INNER JOIN emprunt e ON l.id_livre = e.id_livre";
    $statement = $pdo->query($sql);
    $donnees = $statement->fetchAll();

    if (empty($donnees)) {
        $donnees = array();
    }
} catch (Exception $error) {
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
</style>

<div class="container">
    <h1>Emprunt</h1>
    <table class="table table-hover">
        <thead>
            <tr class="table-warning">
                <th scope="row">Auteur</th>
                <td>Titre</td>
                <td>Date de sortie</td>
                <td>Date de rendu</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($donnees)) : ?>
                <?php foreach ($donnees as $donnee) : ?>
                    <tr>
                        <th scope="row"><?= $donnee['auteur'] ?></th>
                        <td><?= $donnee['titre'] ?></td>
                        <td><?= $donnee['date_sortie'] ?></td>
                        <td><?= $donnee['date_rendu'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Aucune donnée disponible</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>