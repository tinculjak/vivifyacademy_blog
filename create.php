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
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

<?php include "header.php" ?>


<main role="main" class="container">

    <div class="row">
    
        <div class="col-sm-8 blog-main">

            <?php if (!empty($_GET['error'])) {?>
                <div class="alert alert-danger">
                    Please fill in all the fields
                </div>
            <?php } ?>

            <form class="form" method="POST" action="create-post.php" >
                <input name="author" type="text" placeholder="Author" class="form-control"/>
                <input name="title" type="text" placeholder="Title" class="form-control"/>
                <textarea name="body" rows="7" cols="45" placeholder="Body" class="form-control"></textarea>
                <input class="btn btn-default" type="submit" value="Create post">
            </form>

        </div><!-- /.blog-main -->

        <?php include "sidebar.php" ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include "footer.php" ?>

</body>
</html>
