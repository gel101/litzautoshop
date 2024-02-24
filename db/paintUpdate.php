<?php
include "connection.php";

try {
    $msg = $error = $paint_id = $img = $img2 = $img3 = $color = $quantity = "";
    $valid = true;

    
    if (isset($_FILES['epaintImg']) && is_uploaded_file($_FILES['epaintImg']['tmp_name'])) {
        $file = $_FILES['epaintImg'];

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

        // Move the uploaded file to the desired location
        $uniqueName = uniqid('', true);
        $directory = 'img/paints/';
        $destination = $directory . $uniqueName;
        move_uploaded_file($fileTmpName, $destination);
        $img = $destination;
    }

    if (isset($_FILES['epaintImg2']) && is_uploaded_file($_FILES['epaintImg2']['tmp_name'])) {
        $file = $_FILES['epaintImg2'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName2 = $file['tmp_name'];
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

        // Move the uploaded file to the desired location
        $uniqueName2 = uniqid('', true);
        $directory2 = 'img/paints/';
        $destination2 = $directory2 . $uniqueName2;
        move_uploaded_file($fileTmpName2, $destination2);
        $img2 = $destination2;
    }

    if (isset($_FILES['epaintImg3']) && is_uploaded_file($_FILES['epaintImg3']['tmp_name'])) {
        $file = $_FILES['epaintImg3'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName3 = $file['tmp_name'];
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

        // Move the uploaded file to the desired location
        $uniqueName3 = uniqid('', true);
        $directory3 = 'img/paints/';
        $destination3 = $directory3 . $uniqueName3;
        move_uploaded_file($fileTmpName3, $destination3);
        $img3 = $destination3;
    }
    
    if (isset($_POST['paint_id']) && !empty($_POST['paint_id'])) {
        $paint_id = $_POST['paint_id'];
    } else {
        $valid = false;
        $error .= "Paint ID is invalid";
        $paint_id = "";
    }

    if (isset($_POST['color']) && !empty($_POST['color'])) {
        $color = $_POST['color'];
    } else {
        $valid = false;
        $error .= "Color is invalid";
        $color = "";
    }

    if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    } else {
        $valid = false;
        $error .= "quantity is invalid";
        $quantity = "";
    }


    if ($valid) {
        // Check if engine_type already exists in the database
        $query = "SELECT * FROM paints WHERE paint_color = '$color' AND paint_id != '$paint_id' AND status!='archived' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $msg = array("valid" => false, "msg" => "Paint already existed.");
            echo json_encode($msg);
        } else {

            $sql = mysqli_query($conn, "UPDATE paints SET paint_color = '$color', quantity = '$quantity' WHERE paint_id = '$paint_id' ");

            if ($img !== "") {
                $sql = mysqli_query($conn, "UPDATE paints SET img = '$img' WHERE paint_id = '$paint_id' ");
            }
            if ($img2 !== "") {
                $sql = mysqli_query($conn, "UPDATE paints SET img2 = '$img2' WHERE paint_id = '$paint_id' ");
            }
            if ($img3 !== "") {
                $sql = mysqli_query($conn, "UPDATE paints SET img3 = '$img3' WHERE paint_id = '$paint_id' ");
            }
            $msg = array("valid" => true, "msg" => "Paint Updated!");
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