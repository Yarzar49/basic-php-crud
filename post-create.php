<?php
session_start();
require "connect.php";


$titleError = '';
$descriptionError = '';
$title = '';
$description = '';



if(isset($_POST['create_post_button'])) {
     

    $title = $_POST['title'];
    $description = $_POST['description'];

    //Insert data into database
    $sql = "INSERT INTO posts (title,description) VALUES(:title,:description)";
    $statement = $db->prepare($sql);
    
    //Validation input fields
    if(empty($title)) {
        $titleError = "The title field is required";
    }   
    if(empty($description)) {
        $descriptionError = "The description field is required";
    }
    

    if(!empty($title) && !empty($description)) {
        $statement->execute([
            ':title' => $title,
            ':description' => $description,
        ]);
        $susMsg = 'A post created successfully';
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
                            <input type="text" name="title" class="form-control <?php if($titleError != ''): ?> is-invalid<?php endif ?>" placeholder="Enter post title" value="<?php echo $title; ?>">
                            <span class="text-danger"><?php echo $titleError ?></span>
                        </div>
                        <div class="pb-4">
                            <label>Description</label>
                            <textarea class="form-control <?php if($descriptionError != ''): ?> is-invalid<?php endif ?>" name="description" placeholder="Description"><?php echo $description; ?></textarea>
                            <span class="text-danger"><?php echo $descriptionError ?></span>
                        </div>                                       
                </div>
                <div class="card-footer">
                    <button type="submit" name="create_post_button" class="btn btn-primary">Create</button>    
                </div>
                </form>  
            </div>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>