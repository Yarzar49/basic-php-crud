<?php
    session_start();
    require 'connect.php';   

    // if(isset($_GET['postIdDelete'])) {
    //     $idDelete = $_GET['postIdDelete'];
    //     $sql = "DELETE FROM posts WHERE id=$idDelete";

    //     $statement = $db->prepare($sql);
    //     $statement->execute();                         
           
    //     $susMsg = 'A post deleted successfully';
    //     $_SESSION["Msg"] = $susMsg;
    //     header('location:index.php');  

    // }
    
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
                            <div class="card-title">Posts List</div>
                        </div>
                        <div class="col-md-6">
                            <a href="post-create.php" class="btn btn-primary float-end"> + Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php     
                    
                    if(isset($_SESSION["Msg"])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>
                            <?php echo $_SESSION["Msg"]; ?>
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION["Msg"]); ?>  
                    <?php endif ?>                           
                                        
                    
                    <div>

                    </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                                               
                            $statement = $db->query("SELECT * FROM posts");
                            $posts = $statement->fetchAll();
                        ?>

                        <?php foreach($posts as $post): ?>
                        
                                <tr> 
                                <td><?php echo $post['id']; ?></td>
                                <td><?php echo $post['title']; ?></td>
                                <td><?php echo $post['description']; ?></td>
                                <td>                                
                                <a href="post-edit.php?postId=<?php echo $post['id']; ?>" type="button" class="btn btn-outline-success btn-sm me-3 mt-2">
                                    Edit
                                </a>
                                    <a href="post-delete.php?postIdDelete=<?php echo $post['id']; ?>" type="button" class="btn btn-outline-success btn-sm mt-2">Delete</a>
                                </td>
                            </tr>

                        <?php endforeach ?>                           
                                          
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>