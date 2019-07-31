<?php
    include "db.php";
    
    if(!empty($_POST['id'])){
        $sql = "DELETE FROM comments WHERE id = {$_POST['id']};";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
    }

    header("Location: single-post.php?post_id={$_POST['post_id']}");
?>