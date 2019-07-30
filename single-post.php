<?php
    include "db.php";
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
</head>

<body>

<?php include "header.php" ?>


<main role="main" class="container">

    <div class="row">
    
        <div class="col-sm-8 blog-main">


            <?php
                if (isset($_GET['post_id'])) {
                    $sql = "SELECT * FROM posts WHERE posts.id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $post = $statement->fetch(); 

                    $sql = "SELECT * FROM comments WHERE comments.post_id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $comments = $statement->fetchAll(); 

            ?>

                <div class="blog-post">
                    <h2 class="blog-post-title"><?php echo($post['title']) ?></h2>
                    <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <?php echo($post['author']) ?></p>
                    <?php echo($post['body']) ?>
                </div><!-- /.blog-post -->
                
                <?php
                    if(!empty($comments)){
                        foreach ($comments as $comment) {
                ?> 
                            <ul>
                                <li>
                                <div>Author: <?php echo $comment['author'] ?></div>
                                <div>Comment: <?php echo $comment['text'] ?> </div>
                                </li>
                                <hr>
                            </ul>
                <?php 
                        }
                    } 
                ?>
            <?php 
                } 
            ?>

        </div><!-- /.blog-main -->

        <?php include "sidebar.php" ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include "footer.php" ?>

</body>
</html>
