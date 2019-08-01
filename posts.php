<?php
    include "db.php";

    $sql = "SELECT * FROM posts ORDER BY created_at DESC;";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $statement->fetchAll();
?>

<?php
    foreach ($posts as $post) {
        $sql = "SELECT * FROM users WHERE users.id = {$post['user_id']}";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $author = $statement->fetch();
?> 
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h2>
        <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <?php echo("{$author['first_name']} {$author['last_name']}") ?></p>
                    <?php echo($post['body']) ?></p>
        <?php echo($post['body']) ?>
    </div>
<?php
    }
?> 
<nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
</nav>
