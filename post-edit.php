

<?php
session_start();
require "connect.php";


$titleError = '';
$descriptionError = '';
$title = '';
$description = '';

if(isset($_GET['postId'])) {
    $postIdUpdate = $_GET['postId'];
    
    $statement = $db->query("SELECT * FROM posts WHERE id=$postIdUpdate");
    $postOld = $statement->fetch();

    if($statement->rowCount() ==1) {
        $postOldTitle = $postOld['title'];
        $postOldDescription = $postOld['description'];
    } 
}

if(isset($_POST['update_post_button'])) {
    print_r($_POST);    
    
    

    $title = $_POST['title'];
    $description = $_POST['description'];

    //Update data into database
    $id = $_GET['postId'];
    $sql = "UPDATE posts SET title=:title,description=:description WHERE id = $id";
    $statement = $db->prepare($sql);
    
    //Validation input fields
    if(empty($title)) {
        $postOldTitle='';
        $titleError = "The title field is required";
    }   
    if(empty($description)) {
        $postOldDescription='';
        $descriptionError = "The description field is required";
    }
    

    if(!empty($title) && !empty($description)) {
        $statement->execute([
            ':title' => $title,
            ':description' => $description
        ]);
        $susMsg = 'A post updated successfully';
        $_SESSION["Msg"] = $susMsg;
        header('location:index.php');
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <style>
        body {
            padding: 50px;

        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="row">
                        <div class="col-md-6">
                        <div class="card-title">Posts Creation Form</div>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-secondary   float-end"> << Back</a>
                        </div>
                    </div>                    
                </div>
                <form method="POST">
                <div class="card-body">
                    
                        <div class="pb-4">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php if($titleError != ''): ?> is-invalid<?php endif ?>" placeholder="Enter post title" value="<?php echo $postOldTitle; ?>">
                            <span class="text-danger"><?php echo $titleError ?></span>
                        </div>
                        <div class="pb-4">
                            <label>Description</label>
                            <textarea class="form-control <?php if($descriptionError != ''): ?> is-invalid<?php endif ?>" name="description" placeholder="Description"><?php echo $postOldDescription; ?></textarea>
                            <span class="text-danger"><?php echo $descriptionError ?></span>
                        </div>                                       
                </div>
                <div class="card-footer">
                    <button type="submit" name="update_post_button" class="btn btn-primary">Update</button>    
                </div>
                </form>  
            </div>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
