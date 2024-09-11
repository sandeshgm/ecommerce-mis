<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.html");
    exit();
}

if (isset($_POST['save_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    $target_file = null;
        // Handling file upload
    //////////////////////


    if ($image['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



        // Check if image file is a real image or fake image
        ////////////////////////////////////

        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            if(move_uploaded_file($image["tmp_name"], $target_file)){
                //success
        } else {
            echo "Error occur during uploading file";
            exit();
        }
    } else {
       echo "File is not am image.";
       exit();
    }
}

    // If ID is set, update the product
    ///////////////////////////////
    
    if ($id) {
        if ($target_file) {
            $query = "UPDATE products SET name=?, price=?, description=?, image=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sdsdi", $name, $price, $description, $target_file, $id);
        } else {
            $query = "UPDATE products SET name=?, price=?, description=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sdsi", $name, $price, $description, $id);
        }
    } else { 
        $query = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdss", $name, $price, $description, $target_file);
    }

    if ($stmt->execute()) {
        header("Location: admin_panel.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
//Deleting the Product///
/////////////////////

 if (isset($_POST['delete_product']) && $_POST['delete_product'] == '1') 
 {
    $id = $_POST['id'];


    //this is where fetching image that is going to be delete//
    //////////////////////////////////////
    $query = "SELECT image FROM products WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($image_path);
    $stmt->fetch();
    $stmt->close();



    ///////////Deleting the product
    $query = " DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        if($image_path && file_exists($image_path)){
            unlink(!$image_path);
            echo "Error occur during deleting the image file";
        }
        header("Location: admin_panel.php");
        exit();
    }else{
        echo "Error:". $stmt->error;
    }
}
// if (isset($_POST['delete_product'])) {
//     $id = $_POST['id'];
//     $query = "DELETE FROM products WHERE id=?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("i", $id);


//     if($stmt->execute()){
//         if($image_path && file_exists($image_path)){
//             unlink($image_path);
//         }
//         header("Location: admin_panel.php");
//         exit();
//     }
//     else {
//         echo "Error: " . $stmt->error;
//     }
// }
?>
