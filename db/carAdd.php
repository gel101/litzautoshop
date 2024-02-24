<?php
include "connection.php";

try {
    $msg = $car_img = $car_type = $carName = $model = $engine = $quantity = $price = $details = "";
    $error = "";
    $valid = true;

    // Check if a file was uploaded
    if (isset($_FILES['carImg']) && is_uploaded_file($_FILES['carImg']['tmp_name'])) {
        $file = $_FILES['carImg'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, WEBP) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize > $maxFileSize) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }

    }else {
		$error = "NO MAIN IMAGE INSERTED";
		$valid = false;
	}
    
    // Check if a file was uploaded
    if (isset($_FILES['img1']) && is_uploaded_file($_FILES['img1']['tmp_name'])) {
        $file = $_FILES['img1'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName1 = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, WEBP) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize > $maxFileSize) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }

    }else {
		// $error = "NO IMAGE INSERTED";
        $fileTmpName1 = "";
	}
    
    // Check if a file was uploaded
    if (isset($_FILES['img2']) && is_uploaded_file($_FILES['img2']['tmp_name'])) {
        $file = $_FILES['img2'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName2 = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, WEBP) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize > $maxFileSize) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }

    }else {
		// $error = "NO IMAGE INSERTED";
        $fileTmpName2 = "";
	}
    
    // Check if a file was uploaded
    if (isset($_FILES['img3']) && is_uploaded_file($_FILES['img3']['tmp_name'])) {
        $file = $_FILES['img3'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName3 = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, WEBP) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize > $maxFileSize) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }

    }else {
		// $error = "NO IMAGE INSERTED";
        $fileTmpName3 = "";
	}
    
    // Check if a file was uploaded
    if (isset($_FILES['img4']) && is_uploaded_file($_FILES['img4']['tmp_name'])) {
        $file = $_FILES['img4'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName4 = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, WEBP) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize > $maxFileSize) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }

    }else {
		// $error = "NO IMAGE INSERTED";
        $fileTmpName4 = "";
	}


    if (isset($_POST['car_type']) && !empty($_POST['car_type'])) {
        $car_type = $_POST['car_type'];
    } else {
        $valid = false;
        $error = "Car Type is invalid";
        $car_type = "";
    }
    
    if (isset($_POST['carName']) && !empty($_POST['carName'])) {
        $carName = $_POST['carName'];
    } else {
        $valid = false;
        $error = "Car Name is invalid";
        $carName = "";
    }

    if (isset($_POST['model']) && !empty($_POST['model'])) {
        $model = $_POST['model'];
    } else {
        $valid = false;
        $error = "model is invalid";
        $model = "";
    }

    if (isset($_POST['engine']) && !empty($_POST['engine'])) {
        $engine = $_POST['engine'];
    } else {
        $valid = false;
        $error = "engine is invalid";
        $engine = "";
    }

    if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    } else {
        $valid = false;
        $error = "quantity is invalid";
        $quantity = "";
    }

    if (isset($_POST['price']) && !empty($_POST['price'])) {
        $price = $_POST['price'];
    } else {
        $valid = false;
        $error = "price is invalid";
        $price = "";
    }
    
    $chassis = $_POST['chassis'];
    $tempPlate = $_POST['tempPlate'];


    $details = $_POST['details'];


    if ($valid) {
        // Check if engine_type already exists in the database
        // $query = "SELECT * FROM cars WHERE name='$carName' AND car_type = '$car_type' AND model = '$model' AND engine = '$engine' AND price='$price' AND status='' ";
        // $result = mysqli_query($conn, $query);

        // if (mysqli_num_rows($result) > 0) {
        //     $msg = array("valid" => false, "msg" => "Car already existed in the list.");
        //     echo json_encode($msg);
        // } else {
            // Move the uploaded file to the desired location
            $uniqueName = uniqid('', true);
            $directory = 'img/cars/';
            $destination = $directory . $uniqueName;
            move_uploaded_file($fileTmpName, $destination);
            $car_img = $destination;

            if ($fileTmpName1 != "") {
                $uniqueName1 = uniqid('', true);
                $directory1 = 'img/cars/';
                $destination1 = $directory1 . $uniqueName1;
                move_uploaded_file($fileTmpName1, $destination1);
                $img1 = $destination1;
            }else {
                $img1 = $fileTmpName1;
            }
            if ($fileTmpName2 != "") {
                $uniqueName2 = uniqid('', true);
                $directory2 = 'img/cars/';
                $destination2 = $directory2 . $uniqueName2;
                move_uploaded_file($fileTmpName2, $destination2);
                $img2 = $destination2;
            }else {
                $img2 = $fileTmpName2;
            }
            if ($fileTmpName3 != "") {
                $uniqueName3 = uniqid('', true);
                $directory3 = 'img/cars/';
                $destination3 = $directory3 . $uniqueName3;
                move_uploaded_file($fileTmpName3, $destination3);
                $img3 = $destination3;
            }else {
                $img3 = $fileTmpName3;
            }
            if ($fileTmpName4 != "") {
                $uniqueName4 = uniqid('', true);
                $directory4 = 'img/cars/';
                $destination4 = $directory4 . $uniqueName4;
                move_uploaded_file($fileTmpName4, $destination4);
                $img4 = $destination4;
            }else {
                $img4 = $fileTmpName4;
            }

			$sql = mysqli_query($conn, "INSERT INTO cars(car_img, img1, img2, img3, img4, car_type, name, model, engine, quantity, price, chassis, tempPlate, details) VALUES ('$car_img', '$img1', '$img2', '$img3', '$img4', '$car_type', '$carName', '$model', '$engine', '$quantity', '$price', '$chassis', '$tempPlate', '$details')");
			
            $msg = array("valid" => true, "msg" => "Car Added!");
            echo json_encode($msg);
        // }
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>
