<?php 
require_once '../connection.php';
session_start();

if(!isset($_SESSION['blogger'])){
    header('location: index.php');
}

if(isset($_POST['submit'])){
    $title = filter_var($_POST['blog_title'], FILTER_SANITIZE_STRING);
    $description = addslashes($_POST['editor1']);
    $created = new DateTime();
    $created = $created->format('l d M Y');	
    if(!isset($_POST['blog_title'])){
        echo "Please enter a blog title";
        // Add better styling for the error
    } else {
        try {
            $statement = $connection->prepare("INSERT INTO blogs (title,description,createdAt) VALUES (:title,:desc,:created)");
            $statement->execute([
                ':title' => $title,
                ':desc' => $description,
                ':created' => $created,
            ]);
        } catch(PDOException $e) {
            echo $e;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ethereal Blog</title>
    <link rel="icon" type="image/png" href="../assets/img/ethereal-notext.svg">
    <meta name="title" content="Ethereal Blog">
    <meta name="description" content="Get all the up to date information on the Ethereal Blogging system!">
    <meta name="keywords" content="blog, technology, cool, php, template">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.6.1/ckeditor.js"></script>
</head>

<body>
    <div class="container" style="margin-top: 3rem;padding: 0px;max-width: 960px;">
        <div class="row">
            <div class="col-md-12" style="padding: 0px;"><a href="/dashboard/index.html"><button class="btn btn-primary goback" type="button" style="margin-bottom: 4rem;">Go Back</button></a>
                <h1 class="index-heading">Blog Creation<br></h1>
                <h1 class="index-desc grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Leo sollicitudin eu volutpat aliquam mauris, pellentesque sit placerat urna. Vitae dictum tincidunt ut ornare facilisis sed magna pulvinar elementum.<br></h1>
                <hr class="create-hr">
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 1rem;padding: 0px;max-width: 960px;">
    <form method="post" style="padding: 0px; display: inline-flex;">
        <div class="row">
            <div class="col-md-12 col-xxl-5" style="padding: 0px;margin-right: 40px;"><label class="form-label blog-lbel">Blog Title</label><input type="text" name="blog_title" class="blog-creation-input"></div>
            <div class="col-md-12 col-xxl-5" style="padding: 0px;margin-right: 40px;"><label class="form-label blog-lbel">Blog Picture</label><input name="image" type="file"></div>
            <div class="col-md-12 col-xxl-12" style="padding: 0px;margin-right: 40px; margin-top: 2rem;"><textarea name="editor1" style="width: 100%;" id="editor1"></textarea>    </div>
      
            <script>
            CKEDITOR.replace( 'editor1' );
            </script>
            <div style="text-align: right">
            <button class="submit-btn" name="submit" type="submit">Submit</button>
            </div>
            <!-- 
                To do tomorrow:
                    - Test input for all of them
                    - Create database insert
             -->
        </div>
        </form>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
</body>

</html>