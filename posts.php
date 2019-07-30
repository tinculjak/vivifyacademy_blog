<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog";
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    $sql = "SELECT * FROM posts ORDER BY created_at DESC;";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $statement->fetchAll();
?>

<?php
    foreach ($posts as $post) {
?> 
    <div class="blog-post">
        <h2 class="blog-post-title"><a href=""><?php echo($post['title']) ?></a></h2>
        <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <?php echo($post['author']) ?></p>
        <?php echo($post['body']) ?>
    </div>
<?php
    }
?> 
<nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
</nav>
