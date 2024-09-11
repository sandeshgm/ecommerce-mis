<?php

include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users(username,email,password) VALUES(?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss",$username,$email,$hashed_password);

    if($stmt->execute()){
        echo "Registration Successfull";
        header("Location: index.html");
        exit();
    }else{
        echo "Error" .$stmt->error;
    }
    $stmt->close();
}

?>