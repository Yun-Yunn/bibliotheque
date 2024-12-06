<?php

require "pdo.php";

var_dump($_GET);

try {
    $statement = $pdo->prepare("DELETE FROM livre WHERE id_livre = :id");
    $statement->execute([
        "id" => $_GET['id_livre']
    ]);
    header("location:livre.php"); exit;

} catch (PDOException $e) {
    echo $e->getMessage();
}  


?>