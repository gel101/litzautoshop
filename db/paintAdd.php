<?php
include "connection.php";

try {
    $msg = $img = $img2 = $img3 = $color = $quantity = "";
    $error = "";
    $valid = true;

    // Check if a file was uploaded
    if (isset($_FILES['paintImg']) && is_uploaded_file($_FILES['paintImg']['tmp_name'])) {
        $file = $_FILES['paintImg'];

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

    }else {
		$error = "NO IMAGE INSERTED";
		$valid = false;
	}

    // Check if a file was uploaded
    if (isset($_FILES['paintImg2']) && is_uploaded_file($_FILES['paintImg2']['tmp_name'])) {
        $file = $_FILES['paintImg2'];

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

    // Check if a file was uploaded
    if (isset($_FILES['paintImg3']) && is_uploaded_file($_FILES['paintImg3']['tmp_name'])) {
        $file = $_FILES['paintImg3'];

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


    if (isset($_POST['color']) && !empty($_POST['color'])) {
        $color = $_POST['color'];
    } else {
        $valid = false;
        $error = "color is invalid";
        $color = "";
    }

    if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    } else {
        $valid = false;
        $error = "quantity is Invalid";
        $quantity = "";
    }

    if ($valid) {
        // Check if engine_type already exists in the database
        $query = "SELECT * FROM paints WHERE paint_color = '$color' AND quantity != 0 AND status='' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $msg = array("valid" => false, "msg" => "Paint already existed in the list.");
            echo json_encode($msg);
        } else {
            // Move the uploaded file to the desired location
            $uniqueName = uniqid('', true);
            $directory = 'img/paints/';
            $destination = $directory . $uniqueName;
            move_uploaded_file($fileTmpName, $destination);
            $img = $destination;

			$sql = mysqli_query($conn, "INSERT INTO paints(img, img2, img3, paint_color, quantity) VALUES ('$img', '$img2', '$img3', '$color', '$quantity')");
			
            $msg = array("valid" => true, "msg" => "Paint Added!");
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
