<?php
    session_start();
    require 'connect.php';   

    //delete data 
    if(isset($_GET['postIdDelete'])) {
        $idDelete = $_GET['postIdDelete'];
        $sql = "DELETE FROM posts WHERE id=$idDelete";

        $statement = $db->prepare($sql);
        $statement->execute();                         
           
        $susMsg = 'A post deleted successfully';
        $_SESSION["Msg"] = $susMsg;
        header('location:index.php');  

    }
    
?> 