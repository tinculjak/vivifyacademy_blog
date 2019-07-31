<?php
    include "db.php";

    if(!empty($_POST['comment']) || !empty($_POST['author'])) {
        $sql = "INSERT INTO comments (author, text, post_id) VALUES ('{$_POST['author']}', '{$_POST['comment']}', {$_POST['post_id']});";
        $statementInsert = $connection->prepare($sql);
        $statementInsert->execute();
        $statementInsert->setFetchMode(PDO::FETCH_ASSOC);
    
        header("Location: single-post.php?post_id={$_POST['post_id']}");
    } else {
        header("Location: single-post.php?post_id={$_POST['post_id']}&error=1");
    }
?>

            