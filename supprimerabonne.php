<?php

require "pdo.php";

var_dump($_GET);

try {
    $statement = $pdo->prepare("DELETE FROM abonne WHERE id_abonne = :id");
    $statement->execute([
        "id" => $_GET['id_abonne']
    ]);
    header("location:abonne.php"); exit;

} catch (PDOException $e) {
    echo $e->getMessage();
}  


?>