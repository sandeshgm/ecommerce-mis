<?php
session_start();
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

$query = "SELECT * FROM users where username = ? AND email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username,$email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];

        if($user['is_admin']){
            header("Location: admin_panel.php");
        }
        else{
            header("Location: index.html");
        }
        exit();

    }else{
        echo "Invalid password";
    }
}else{
    echo "No user found!!!";
}
 
$stmt->close();
}


?>
