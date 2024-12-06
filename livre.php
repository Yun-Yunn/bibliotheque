<?php
include "header.php";
require "pdo.php";

try {
    $statement = $pdo->query("SELECT * FROM livre");
    $livres = $statement->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
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
</style>


<div class="container">
    <h1>Livre</h1>
    <table class="table table-hover">
        <thead>
            <tr class="table-warning">
                <th scope="row">Auteur</th>
                <td>Titre</td>
                <td>Modifier</td>
                <td>Supprimer</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $livre) : ?>
                <tr>
                    <th scope="row"><?= $livre['auteur'] ?></th>
                    <td><?= $livre['titre'] ?></td>
                    <td><a href="./modifier.php?id_livre=<?php echo $livre['id_livre'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir modfier les informations ?');">Modifier</a></td>
                    <td><a href="./supprimer.php?id_livre=<?php echo $livre['id_livre'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>