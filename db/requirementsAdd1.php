<?php
include "connection.php";

try {
    $msg = $id = $tran_id = $img1 = $img2 = $img3 = $img4 = $img5 = $img6 = $img7 = "";
    $error = "";
    $valid = true;


    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $cust_id = $_POST['id'];
    } else {
        $valid = false;
        $error = "CUSTOMER ID invalid";
        $cust_id = "";
    }

    if (isset($_POST['tran_id']) && !empty($_POST['tran_id'])) {
        $tran_id = $_POST['tran_id'];
    } else {
        $valid = false;
        $error = "tran_id invalid";
        $tran_id = "";
    }


    // Check if a file was uploaded
    if (isset($_FILES['img1']) && is_uploaded_file($_FILES['img1']['tmp_name'])) {
        $file1 = $_FILES['img1'];

        // Retrieve file information
        $fileName1 = $file1['name'];
        $fileTmpName1 = $file1['tmp_name'];
        $fileSize1 = $file1['size'];
        $fileError1 = $file1['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "CERTIFICATE OF EMPLOYEE EMPTY";
		$valid = false;
	}


    // Check if a file was uploaded
    if (isset($_FILES['img2']) && is_uploaded_file($_FILES['img2']['tmp_name'])) {
        $file2 = $_FILES['img2'];

        // Retrieve file information
        $fileName1 = $file2['name'];
        $fileTmpName2 = $file2['tmp_name'];
        $fileSize1 = $file2['size'];
        $fileError1 = $file2['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "PAYSLIP EMPTY";
		$valid = false;
	}


    // Check if a file was uploaded
    if (isset($_FILES['img3']) && is_uploaded_file($_FILES['img3']['tmp_name'])) {
        $file3 = $_FILES['img3'];

        // Retrieve file information
        $fileName1 = $file3['name'];
        $fileTmpName3 = $file3['tmp_name'];
        $fileSize1 = $file3['size'];
        $fileError1 = $file3['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "ELECTRIC BILL EMPTY";
		$valid = false;
	}


    // Check if a file was uploaded
    if (isset($_FILES['img4']) && is_uploaded_file($_FILES['img4']['tmp_name'])) {
        $file4 = $_FILES['img4'];

        // Retrieve file information
        $fileName1 = $file4['name'];
        $fileTmpName4 = $file4['tmp_name'];
        $fileSize1 = $file4['size'];
        $fileError1 = $file4['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "BARANGAY CLEARANCE EMPTY";
		$valid = false;
	}


    // Check if a file was uploaded
    if (isset($_FILES['img5']) && is_uploaded_file($_FILES['img5']['tmp_name'])) {
        $file5 = $_FILES['img5'];

        // Retrieve file information
        $fileName1 = $file5['name'];
        $fileTmpName5 = $file5['tmp_name'];
        $fileSize1 = $file5['size'];
        $fileError1 = $file5['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "VALID ID 1 EMPTY";
		$valid = false;
	}


    // Check if a file was uploaded
    if (isset($_FILES['img6']) && is_uploaded_file($_FILES['img6']['tmp_name'])) {
        $file6 = $_FILES['img6'];

        // Retrieve file information
        $fileName1 = $file6['name'];
        $fileTmpName6 = $file6['tmp_name'];
        $fileSize1 = $file6['size'];
        $fileError1 = $file6['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "VALID ID 2 EMPTY";
	}


    // Check if a file was uploaded
    if (isset($_FILES['img7']) && is_uploaded_file($_FILES['img7']['tmp_name'])) {
        $file7 = $_FILES['img7'];

        // Retrieve file information
        $fileName1 = $file7['name'];
        $fileTmpName7 = $file7['tmp_name'];
        $fileSize1 = $file7['size'];
        $fileError1 = $file7['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "MARRIAGE CONTRACT OR BIRTH CERT EMPTY";
		$valid = false;
	}
    


    if ($valid) {
        if (isset($_FILES['img6']) && is_uploaded_file($_FILES['img6']['tmp_name'])) {
            // Move the uploaded file to the desired location
            $uniqueName1 = uniqid('', true);
            $directory1 = 'img/documents/';
            $destination1 = $directory1 . $uniqueName1;
            move_uploaded_file($fileTmpName1, $destination1);
            $moveimg1 = $destination1;

            $uniqueName2 = uniqid('', true);
            $directory2 = 'img/documents/';
            $destination2 = $directory2 . $uniqueName2;
            move_uploaded_file($fileTmpName2, $destination2);
            $moveimg2 = $destination2;

            $uniqueName3 = uniqid('', true);
            $directory3 = 'img/documents/';
            $destination3 = $directory3 . $uniqueName3;
            move_uploaded_file($fileTmpName3, $destination3);
            $moveimg3 = $destination3;

            $uniqueName4 = uniqid('', true);
            $directory4 = 'img/documents/';
            $destination4 = $directory4 . $uniqueName4;
            move_uploaded_file($fileTmpName4, $destination4);
            $moveimg4 = $destination4;

            $uniqueName5 = uniqid('', true);
            $directory5 = 'img/documents/';
            $destination5 = $directory5 . $uniqueName5;
            move_uploaded_file($fileTmpName5, $destination5);
            $moveimg5 = $destination5;

            $uniqueName6 = uniqid('', true);
            $directory6 = 'img/documents/';
            $destination6 = $directory6 . $uniqueName6;
            move_uploaded_file($fileTmpName6, $destination6);
            $moveimg6 = $destination6;

            $uniqueName7 = uniqid('', true);
            $directory7 = 'img/documents/';
            $destination7 = $directory7 . $uniqueName7;
            move_uploaded_file($fileTmpName7, $destination7);
            $moveimg7 = $destination7;


			$sql = mysqli_query($conn, "UPDATE client_documents SET coe='$moveimg1', payslip_3m='$moveimg2', electric_bill='$moveimg3', brgy_clearance='$moveimg4', validID_1='$moveimg5', validID_2='$moveimg6', marriage_contract='$moveimg7' WHERE cust_id='$cust_id' AND tran_id='$tran_id' ");
			
            $msg = array("valid" => true, "msg" => "Requirements Added!");
            echo json_encode($msg);
        }else {
            // Move the uploaded file to the desired location
            $uniqueName1 = uniqid('', true);
            $directory1 = 'img/documents/';
            $destination1 = $directory1 . $uniqueName1;
            move_uploaded_file($fileTmpName1, $destination1);
            $moveimg1 = $destination1;

            $uniqueName2 = uniqid('', true);
            $directory2 = 'img/documents/';
            $destination2 = $directory2 . $uniqueName2;
            move_uploaded_file($fileTmpName2, $destination2);
            $moveimg2 = $destination2;

            $uniqueName3 = uniqid('', true);
            $directory3 = 'img/documents/';
            $destination3 = $directory3 . $uniqueName3;
            move_uploaded_file($fileTmpName3, $destination3);
            $moveimg3 = $destination3;

            $uniqueName4 = uniqid('', true);
            $directory4 = 'img/documents/';
            $destination4 = $directory4 . $uniqueName4;
            move_uploaded_file($fileTmpName4, $destination4);
            $moveimg4 = $destination4;

            $uniqueName5 = uniqid('', true);
            $directory5 = 'img/documents/';
            $destination5 = $directory5 . $uniqueName5;
            move_uploaded_file($fileTmpName5, $destination5);
            $moveimg5 = $destination5;

            $uniqueName7 = uniqid('', true);
            $directory7 = 'img/documents/';
            $destination7 = $directory7 . $uniqueName7;
            move_uploaded_file($fileTmpName7, $destination7);
            $moveimg7 = $destination7;


			$sql = mysqli_query($conn, "UPDATE client_documents SET coe='$moveimg1', payslip_3m='$moveimg2', electric_bill='$moveimg3', brgy_clearance='$moveimg4', validID_1='$moveimg5', marriage_contract='$moveimg7' WHERE cust_id='$cust_id' AND tran_id='$tran_id' ");
			
            $msg = array("valid" => true, "msg" => "Requirements Added!");
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
