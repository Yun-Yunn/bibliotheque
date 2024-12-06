<?php
include "header.php";
require "pdo.php";

try {
    $statement = $pdo->query("SELECT * FROM abonne");
    $abonnes = $statement->fetchAll();
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
    <h1>Abonnés</h1>
    <table class="table table-hover">
        <thead>
            <tr class="table-warning">
                <th scope="row">prenom</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($abonnes as $abonne) : ?>
                <tr>
                    <th scope="row"><?= $abonne['prenom'] ?></th>
                    <th><a href="modifierabonne.php?id_abonne=<?php echo $abonne['id_abonne'] ?>">Modifier</a></th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>