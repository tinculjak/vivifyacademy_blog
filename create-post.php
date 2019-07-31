<?php
    include "db.php";

    if(!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['body'])) {
        $date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO posts (author, title, body, created_at) VALUES ('{$_POST['author']}', '{$_POST['title']}', '{$_POST['body']}','$date');";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
    
        header("Location: index.php");
    } else {
        header("Location: create.php?&error=1");
    }
?>

            