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

$mail->Username = "malano.angelo@dnsc.edu.ph";
$mail->Password = "chllzawmbgoskeyk";


try {
    $msg = $tran_id = $paymentMode = $paymentTerm = $cust_id = $date = $receipt = "";
    $error = "";
    $valid = true;

    // Check if a file was uploaded
    if (isset($_FILES['screenshot']) && is_uploaded_file($_FILES['screenshot']['tmp_name'])) {
        $file = $_FILES['screenshot'];

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

    }

    $cust_id = $_POST['cust_id'];

    if (isset($_POST['tran_id']) && !empty($_POST['tran_id'])) {
        $tran_id = $_POST['tran_id'];
    } else {
        $valid = false;
        $error = "Transaction ID is invalid";
        $tran_id = "";
    }

    if (isset($_POST['paymentTerm']) && !empty($_POST['paymentTerm'])) {
        $paymentTerm = $_POST['paymentTerm'];
    } else {
        $valid = false;
        $error = "Payment Term is invalid";
        $paymentTerm = "";
    }

    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = $_POST['date'];
    } else {
        $valid = false;
        $error = "Date is empty";
        $date = "";
    }

    // $paymentReceived = $_POST['paymentReceived'];
    $paymentMode = $_POST['paymentMode'];
    $referenceInput = $_POST['referenceInput'];
    $receipt = $_POST['receipt'];
    
    if ($receipt == "" OR empty($_POST['receipt'])) {
        $receipt = "---";
    }

    $status = "Completed";
    $currentDateTime = date("Y-m-d H:i:s");
    $messageStaff = "A New Transaction that Requirements are Complete has been made. " . "Transaction ID : " . $tran_id;
    $messageClient = "The Order claims that Requirements are Complete, Order Soon to Prepare. " . "Transaction ID : " . $tran_id;
    $tran = "order";
    
    if ($valid) {

        $stmt = mysqli_query($conn, "SELECT car_id, sparepart_id, product, color, quantity FROM carts WHERE tran_id='$tran_id'");
        
        
        if ($stmt) {

            while ($row = mysqli_fetch_assoc($stmt)){

                if (isset($row['car_id'])) {
                    $prodID = $row['car_id'];
                }else {
                    $prodID = $row['sparepart_id'];
                }

                $prodName = $row['product'];
                $usingcolor = $row['color'];
                $totalquantity = $row['quantity'];

                // Query to get the current quantity from the database
                $getOldQuantity = "SELECT quantity FROM cars WHERE car_id = $prodID AND car_type = '$prodName'";
                $result = mysqli_query($conn, $getOldQuantity);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $currentQuantity = $row['quantity'];

                    // Check if subtracting the totalquantity will result in a non-negative quantity
                    if ($currentQuantity - $totalquantity >= 0) {

                    } else {
                        $msg = array("valid" => false, "msg" => "Not enough quantity available for product: $prodName");
                        echo json_encode($msg);
                        exit;
                    }
                } else {
                    // Query to get the current quantity from the database
                    $getCurrentQuantityQuery2 = "SELECT quantity FROM spareparts_accessories WHERE sparepart_id = $prodID AND product = '$prodName'";
                    $result2 = mysqli_query($conn, $getCurrentQuantityQuery2);

                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        $row2 = mysqli_fetch_assoc($result2);
                        $currentQuantity2 = $row2['quantity'];

                        // Check if subtracting the totalquantity will result in a non-negative quantity
                        if ($currentQuantity2 - $totalquantity >= 0) {
                            
                        } else {
                            $msg = array("valid" => false, "msg" => "Not enough quantity available for product: $prodName");
                            echo json_encode($msg);
                            exit;
                        }
                    }
                    // Handle the case where no matching row is found
                    $error .= "No data found for Product Name: $prodName";
                }
            }




        // Handle the case where no matching row is found
        $error .= "No data found for the specified Transaction ID";
            
        } else {
            // Handle the case where the query execution failed
            $error .= "Error: " . mysqli_error($conn);
        }


        if (isset($_FILES['screenshot']) && is_uploaded_file($_FILES['screenshot']['tmp_name'])) {
            $uniqueName = uniqid('', true);
            $directory = 'img/screenshots/';
            $destination = $directory . $uniqueName;
            move_uploaded_file($fileTmpName, $destination);
            $img = $destination;
            
            $sql = mysqli_query($conn, "UPDATE orders SET status = '$status', date = '$currentDateTime', payment_term='$paymentTerm', payment_mode='$paymentMode', receipt = '$receipt', reference_number='$referenceInput', screenshot='$img' WHERE tran_id = '$tran_id' ");
        }else {
            $sql = mysqli_query($conn, "UPDATE orders SET status = '$status', date = '$currentDateTime', payment_term='$paymentTerm', payment_mode='$paymentMode', receipt = '$receipt', reference_number='$referenceInput' WHERE tran_id = '$tran_id' ");
        }




        $sqlll = mysqli_query($conn, "UPDATE carts SET status = '$status', date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
        $sqlll = mysqli_query($conn, "UPDATE client_documents SET status = '$status' WHERE tran_id = '$tran_id' ");
        if ($cust_id != "") {
            $sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageClient','$currentDateTime','$tran','$status')");
        }
        // $sql223 = mysqli_query($conn, "INSERT INTO notifications(messageTo, message, date, transaction, status) VALUES('staff','$messageStaff','$currentDateTime','$tran','$status')");

        if ($paymentTerm == "For Finance") {
            $sql123 = mysqli_query($conn, "UPDATE orders SET totalprice = totalprice + 8250, date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
            $sqlll123 = mysqli_query($conn, "UPDATE carts SET price = price + 8250, date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
        }


        //Transaction Detail query
        $transactionDetailQuery = mysqli_query($conn, "SELECT * FROM orders WHERE tran_id='$tran_id'");

        $rowtransaction = mysqli_fetch_assoc($transactionDetailQuery);
        $totalpricetran = $rowtransaction['totalprice'];
        $customernametran = $rowtransaction['customerName'];
        if ($rowtransaction['payment_term'] == "For Finance") {
            $finalpaymentTerm = $rowtransaction['payment_term'];
        }else {
            $finalpaymentTerm = $rowtransaction['payment_term'] . "(" . $rowtransaction['payment_mode'] . " " . $rowtransaction['reference_number'] . ")";
        }

        $stmtcarts = mysqli_query($conn, "SELECT * FROM carts WHERE tran_id = '$tran_id' ");
        global $stmtcarts;

        // Function to generate email body and signature
        function generateEmailBody($messageContent, $totalpricetran, $customernametran, $tran_id, $finalpaymentTerm) {
            $signature = "<br>";
            $signature .= "<p>Regards,<br>";
            $signature .= "Litz Autoshop<br>";
            $signature .= "Email Notification<br>";
            $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
            $signature .= "Phone: 09169834159<br>";
            $signature .= "Email: marjlit1@gmail.com</p>";

            $message = "<html><body>";
            $message .= $messageContent;
            $message .= "<br>";
            $message .= "<h4>Transaction Details</h4>";
            $message .= "<p>Total Price: &#8369;" . number_format($totalpricetran, 2) . "<br>Payment Status: $finalpaymentTerm<br>Transaction ID: $tran_id</p>";
            $message .= "<h4>Order Details: </h4>";
            $message .= "<table style='width: 100%; border-collapse: collapse;' class='table text-center'>";
            $message .= "<thead style='background-color: #f2f2f2;' class='text-secondary'>";
            $message .= "<tr>";
            $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>ID</th>";
            $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Product</th>";
            $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Color</th>";
            $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Engine</th>";
            $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Model</th>";
            $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Quantity</th>";
            $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Price</th>";
            $message .= "</tr>";
            $message .= "</thead>";
    
            
            global $conn;
            global $tran_id;
            $stmtcarts = mysqli_query($conn, "SELECT * FROM carts WHERE tran_id = '$tran_id' ");
            while ($rowcarts = mysqli_fetch_assoc($stmtcarts)) {
                $cart_id = $rowcarts['cart_id'];
                $product = $rowcarts['product'];
                $color = $rowcarts['color'];
                $engine = $rowcarts['engine'];
                $model = $rowcarts['model'];
                $quantity = $rowcarts['quantity'];
                $price = number_format($rowcarts['price'], 2);
    
                $message .= "<tr>";
                $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$cart_id</td>";
                $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$product</td>";
                $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$color</td>";
                $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$engine</td>";
                $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$model</td>";
                $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$quantity</td>";
                $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>&#8369;$price</td>";
                $message .= "</tr>";
            }
    
            $message .= "</table>";
            $message .= "<br>";
            $message .= "<p>Thank you for choosing Litz Autoshop for your purchase. We appreciate your trust in us and it is a pleasure if you order on us again.</p>";
            $message .= $signature;
            $message .= "</body></html>";

            return $message;
        }

        if ($cust_id != "") {
            // Customer email sending logic
            $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
            $row5 = mysqli_fetch_assoc($custEmailQuery);
            $customerEmail = $row5['email'];
            $customerName = $row5['fname'] . " " . $row5['lname'];
            $custLname = $row5['lname'];
        }else {
            $custEmailQuery2 = mysqli_query($conn, "SELECT noAccEmail, customerName FROM orders WHERE tran_id = '$tran_id' ");
            $rowemail = mysqli_fetch_assoc($custEmailQuery2);
            $customerEmail = $rowemail['noAccEmail'];
            $customerName = $rowemail['customerName'];
            $custLname = $rowemail['customerName'];
        }
        
        $messageContent = "<p>Dear Mr/Mrs. $custLname,</p>";
        $messageContent .= "<p>I hope this message finds you well. We want to inform you that your order transaction has been successfully completed.</p>";

        $message = generateEmailBody($messageContent, $totalpricetran, $customernametran, $tran_id, $finalpaymentTerm);

        $emailName = "Litz Autoshop";
        $emailAdd = "malano.angelo@dnsc.edu.ph";
        $emailSubject = "Order Completed!";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($customerEmail, $customerName);

        $mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body = $message;
        $mail->send();

        // Clear recipients and reset the email object for the next iteration
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        // Close the mail connection after sending all emails
        $mail->smtpClose();


        $msg = array("valid" => true, "msg" => "Transaction Status: Completed!");
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