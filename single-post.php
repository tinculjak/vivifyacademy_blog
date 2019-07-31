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

                <?php if (!empty($_GET['error'])) {?>
                    <div class="alert alert-danger">
                        Please fill in all the fields
                    </div>
                <?php } ?>

                <form class="form" method="POST" action="create-comment.php" >
                    <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>"/>
                    <input name="author" type="text" placeholder="Author" class="form-control"/>
                    <textarea name="comment" rows="7" cols="45" placeholder="Comment" class="form-control"></textarea>
                    <input class="btn btn-default" type="submit" value="Add Comment">
                </form>
                <hr>

                <div class="row">
                    <div class="col-12">
                        <button id="comments_btn" onclick="showHideComments()" class="btn btn-default">Hide comments</button>
                    </div>
                </div>

                <script>
                    var comments_btn = document.getElementById('comments_btn');

                    function showHideComments(){
                        var comments = document.getElementById('comments');
                        if(comments.className == 'd-none'){
                            comments.classList.remove('d-none');
                            comments_btn.innerHTML = "Hide Comments"
                        }else{
                            comments.className = 'd-none';
                            comments_btn.innerHTML = "Show Comments";
                        }
                    }

                </script>
                
                <?php
                    if(!empty($comments)){
                ?>
                        <ul id="comments">
                <?php
                            foreach ($comments as $comment) {
                ?> 
                                <li>
                                    <div>Author: <?php echo $comment['author'] ?></div>
                                    <div>Comment: <?php echo $comment['text'] ?> </div>
                                    <div>
                                        <form method="POST" action="delete-comment.php" >
                                            <input class="btn btn-default" type="submit" value="Delete">
                                            <input type="hidden" name="id" value="<?php echo $comment['id']; ?>"/>
                                            <input type="hidden" name="post_id" value="<?php echo $comment['post_id']; ?>"/>
                                        </form>
                                    </div>
                                </li>
                                <hr>
                            
                <?php 
                            }
                ?>
                        </ul>
                <?php
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
