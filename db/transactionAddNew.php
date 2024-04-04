<?php
include "connection.php";

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "litzautoshop@gmail.com";
$mail->Password = "afwaansxpvhbrtcw";


try {
    $msg = $addname =  $addemail = $addphone = $productData = "";
    $error = "";
    $valid = true;


    if (isset($_POST['addname']) && !empty($_POST['addname'])) {
        $addname = $_POST['addname'];
    } else {
        $valid = false;
        $error = "Customer Name is invalid";
        $addname = "";
    }

    if (isset($_POST['addemail']) && !empty($_POST['addemail'])) {
        $addemail = $_POST['addemail'];
    } else {
        $valid = false;
        $error = "Customer Email is invalid";
        $addemail = "";
    }
    
    if (isset($_POST['addphone']) && !empty($_POST['addphone'])) {
        $addphone = $_POST['addphone'];
    } else {
        $valid = false;
        $error = "Customer Phone is invalid";
        $addphone = "";
    }
    
    if (isset($_POST['productData']) && !empty($_POST['productData'])) {
        $productData = $_POST['productData'];
    } else {
        $valid = false;
        $error = "Product Data is invalid";
        $productData = "";
    }

    $status = "Pending";
    // Set the timezone to the Philippines
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date("Y-m-d H:i:s");


    if ($valid) {

        function generateUniqueID() {
            global $conn;
            // Fetch the current TransactionIndexID
            $stmt = mysqli_query($conn, "SELECT TransactionIndexID FROM datastoring WHERE id = 1 ");
            $dataTransaction = mysqli_fetch_assoc($stmt);
            $TransactionIndexID = $dataTransaction['TransactionIndexID'];
        
            // Increment TransactionIndexID by 1
            $TransactionIndexID++;
        
            // Pad the numerical part with zeros to ensure it's always six digits
            $paddedTransactionIndexID = str_pad($TransactionIndexID, 6, '0', STR_PAD_LEFT);
        
            // Construct the final ID with the current year and padded TransactionIndexID
            $currentYear = date('Y');
            $tran_id = $currentYear . '-' . $paddedTransactionIndexID;
        
            // Update the datastoring table with the incremented TransactionIndexID
            $stmt = mysqli_query($conn, "UPDATE datastoring SET TransactionIndexID = '$TransactionIndexID' WHERE id = 1 ");
        
            // Return the generated tran_id
            return $tran_id;
        }

        $tran_id = generateUniqueID();  // Use a different variable for orders
        $tran_id = $tran_id;

        foreach ($productData as $product) {
            $addid = $product["addid"];
            $addproduct = $product["addproduct"];
            $addimg = $product["addimg"];
            $addprice = $product["addprice"];
            $addquantity = $product["addquantity"];
            $adddetails = $product["adddetails"];
            $addquantityleft = $product["addquantityleft"];

            $sql = mysqli_query($conn, "INSERT INTO carts(img, tran_id, sparepart_id, product, price, quantity, leftQuantity, details, date, status) VALUES('$addimg','$tran_id','$addid','$addproduct','$addprice','$addquantity','$addquantityleft','$adddetails','$currentDateTime','$status')");
        
            // $query = "INSERT INTO orders (addname, addemail, addphone, addid, addproduct, addimg, addprice, addquantity, adddetails, addquantityleft) 
            //           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            // $stmt = $conn->prepare($query);
            // $stmt->bind_param("ssiissiisi", $addname, $addemail, $addphone, $addid, $addproduct, $addimg, $addprice, $addquantity, $adddetails, $addquantityleft);
            // $stmt->execute();
            // Handle the result as needed
        }
        

        $totalprice = 0;
        $totalpriceStmt = mysqli_query($conn, "SELECT price, quantity FROM carts WHERE tran_id = '$tran_id' ");
        while ($pricedata = mysqli_fetch_assoc($totalpriceStmt)) {
            $subtotal = $pricedata['price'] * $pricedata['quantity']; // Calculate subtotal for each item
            $totalprice += $subtotal; // Add subtotal to totalprice
        }
        $sqll123 = mysqli_query($conn, "INSERT INTO orders(customerName, tran_id, totalprice, noAccEmail, noAccPhone, date, transaction_type, status) VALUES('$addname','$tran_id','$totalprice','$addemail','$addphone','$currentDateTime', 'sparepart', '$status')");

        $msg = array("valid" => true, "msg" => "Adding Order Success!");
        echo json_encode($msg);
        exit;

    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>