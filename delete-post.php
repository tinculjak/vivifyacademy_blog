<?php
    include "db.php";

    $sql = "DELETE FROM posts WHERE id = {$_POST['id']};";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $sql = "DELETE FROM comments WHERE post_id = {$_POST['id']};";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    
    header("Location: index.php");
?>