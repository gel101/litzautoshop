<?php
include "connection.php";

try {
    $msg = $error = $id = $img = $product = $quantity = $price = $details = "";
    $valid = true;


    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $valid = false;
        $error .= "Car ID is invalid";
        $id = "";
    }

    if (isset($_POST['product']) && !empty($_POST['product'])) {
        $product = $_POST['product'];
    } else {
        $valid = false;
        $error .= "Car Type is invalid";
        $product = "";
    }

    if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    } else {
        $valid = false;
        $error .= "quantity is invalid";
        $quantity = "";
    }

    if (isset($_POST['price']) && !empty($_POST['price'])) {
        $price = $_POST['price'];
    } else {
        $valid = false;
        $error .= "price is invalid";
        $price = "";
    }
    
    $details = $_POST['details'];

    if ($valid) {
        // Check if engine_type already exists in the database
        $query = "SELECT * FROM spareparts_accessories WHERE product = '$product' AND sparepart_id != '$id' AND status !='archived' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $msg = array("valid" => false, "msg" => "Product already existed.");
            echo json_encode($msg);
        } else {
            if (isset($_FILES['eproductImg']) && is_uploaded_file($_FILES['eproductImg']['tmp_name'])) {
                $file = $_FILES['eproductImg'];

                // Retrieve file information
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];

                // Validate file type
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedExtensions)) {
                    $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
                    $valid = false;
                }

                // Validate file size
                $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
                if ($fileSize > $maxFileSize) {
                    $error = "File size exceeds the maximum limit of 10MB.";
                    $valid = false;
                }

                if ($valid) {
                    // Move the uploaded file to the desired location
                    $uniqueName = uniqid('', true);
                    $directory = 'img/products/';
                    $destination = $directory . $uniqueName;
                    move_uploaded_file($fileTmpName, $destination);
                    $img = $destination;
                    
                    $sql = mysqli_query($conn, "UPDATE spareparts_accessories SET img = '$img', product = '$product', quantity = '$quantity', price = '$price', details = '$details' WHERE sparepart_id = '$id' ");

                    $msg = array("valid" => true, "msg" => "Product Updated!");
                    echo json_encode($msg);
                    exit; // Stop further execution
                } else {
                    $msg = array("valid" => false, "msg" => $error);
                    echo json_encode($msg);
                    exit; // Stop further execution
                }
            }

            $sql = mysqli_query($conn, "UPDATE spareparts_accessories SET product = '$product', quantity = '$quantity', price = '$price', details = '$details' WHERE sparepart_id = '$id' ");

            $msg = array("valid" => true, "msg" => "Product Updated!");
            echo json_encode($msg);
        }
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>