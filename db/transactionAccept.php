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
    $msg = $tran_id = $cust_id = $error = $transaction_type = "";
    $valid = true;


    if (isset($_POST['tran_id']) && !empty($_POST['tran_id'])) {
        $tran_id = $_POST['tran_id'];
    } else {
        $valid = false;
        $error .= "Transaction ID is invalid";
        $tran_id = "";
    }

    if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
        $cust_id = $_POST['cust_id'];
    } else {
        $noAccStmt = mysqli_query($conn, "SELECT noAccEmail, noAccPhone, customerName FROM orders WHERE tran_id = '$tran_id'");
        $noAccRow = mysqli_fetch_assoc($noAccStmt);
        $noAccEmail = $noAccRow['noAccEmail'];
        $noAccPhone = $noAccRow['noAccPhone'];
        $noAccName = $noAccRow['customerName'];
    }
    
    if (isset($_POST['transaction_type']) && !empty($_POST['transaction_type'])) {
        $transaction_type = $_POST['transaction_type'];
    } else {
        $valid = false;
        $error .= "Transaction Type is invalid";
        $transaction_type = "";
    }

    // Set the timezone to the Philippines
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date("Y-m-d H:i:s");
	$status = "Accepted";
	$CustomerMessage = "The Order was Accepted. You can Visit the Shop to see your Desired Order. " . "Transaction ID : " . $tran_id ;
	$tran = "order";
	

    if ($valid) {

        $stmt = mysqli_query($conn, "SELECT car_id, sparepart_id, product, color, quantity FROM carts WHERE tran_id='$tran_id'");
        
        
        if ($stmt) {

            $flag = true;


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
                $getCurrentQuantityQuery = "SELECT quantity FROM cars WHERE car_id = $prodID AND car_type = '$prodName'";
                $result = mysqli_query($conn, $getCurrentQuantityQuery);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $currentQuantity = $row['quantity'];

                    // Check if subtracting the totalquantity will result in a non-negative quantity
                    if ($currentQuantity - $totalquantity >= 0) {

                    } else {
                        $flag = false;
                        $msg = array("valid" => false, "msg" => "Not enough quantity available for product: $prodName");
                        echo json_encode($msg);
                        exit; // Exit the script
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
                            $flag = false;
                            $msg = array("valid" => false, "msg" => "Not enough quantity available for product: $prodName");
                            echo json_encode($msg);
                            exit; // Exit the script
                        }
                    }
                    // Handle the case where no matching row is found
                    $error .= "No data found for Product Name: $prodName";
                }
            }

            if ($flag) {

                $stmt = mysqli_query($conn, "SELECT car_id, sparepart_id, product, color, quantity FROM carts WHERE tran_id='$tran_id'");
                
                while ($row = mysqli_fetch_assoc($stmt)){

                    if (isset($row['car_id'])) {
                        $prodID = $row['car_id'];
                    }else {
                        $prodID = $row['sparepart_id'];
                    }

                    $prodName = $row['product'];
                    $usingcolor = $row['color'];
                    $totalquantity = $row['quantity'];
                    // Process or display the retrieved data

                    // Query to get the current quantity from the database
                    $getCurrentQuantityQuery = "SELECT quantity FROM cars WHERE car_id = $prodID AND car_type = '$prodName'";
                    $result = mysqli_query($conn, $getCurrentQuantityQuery);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $currentQuantity = $row['quantity'];

                        // Check if subtracting the totalquantity will result in a non-negative quantity
                        if ($currentQuantity - $totalquantity >= 0) {
                            // Update the quantity in the cars table
                            $updateCarsQuery = "UPDATE cars SET quantity = quantity - $totalquantity, sold = sold + $totalquantity WHERE car_id = $prodID AND car_type = '$prodName'";
                            if (!mysqli_query($conn, $updateCarsQuery)) {
                                // Handle the case where the update query for the cars table failed
                                $error .= "Error updating quantity in cars table: " . mysqli_error($conn);
                            }
                        } else {
                            // Return a JSON response indicating failure
                            $msg = array("valid" => false, "msg" => "Not enough quantity available for product: $prodName");
                            echo json_encode($msg);
                            exit; // Exit the script
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
                                // Update the quantity in the cars table
                                $updateSparepartQuery = "UPDATE spareparts_accessories SET quantity = quantity - $totalquantity, sold = sold + $totalquantity WHERE sparepart_id = $prodID AND product = '$prodName'";
                                if (!mysqli_query($conn, $updateSparepartQuery)) {
                                    // Handle the case where the update query for the cars table failed
                                    $error .= "Error updating quantity in cars table: " . mysqli_error($conn);
                                }
                            } else {
                                // Return a JSON response indicating failure
                                $msg = array("valid" => false, "msg" => "Not enough quantity available for product: $prodName");
                                echo json_encode($msg);
                                exit; // Exit the script
                            }
                        }

                        // Handle the case where no matching row is found
                        $error .= "No data found for Product Name: $prodName";
                    }

                    // Check if the product uses color
                    if (!empty($usingcolor)) {
                        // Query to get the current quantity of the paint color from the database
                        $getCurrentPaintQuantityQuery = "SELECT quantity FROM paints WHERE paint_color = '$usingcolor'";
                        $paintResult = mysqli_query($conn, $getCurrentPaintQuantityQuery);

                        if ($paintResult && mysqli_num_rows($paintResult) > 0) {
                            $paintRow = mysqli_fetch_assoc($paintResult);
                            $currentPaintQuantity = $paintRow['quantity'];

                            // Check if subtracting the totalquantity will result in a non-negative quantity
                            if ($currentPaintQuantity - $totalquantity >= 0) {
                                // Update the quantity in the paints table
                                $updatePaintsQuery = "UPDATE paints SET quantity = quantity - $totalquantity, sold = sold + $totalquantity WHERE paint_color = '$usingcolor'";
                                if (!mysqli_query($conn, $updatePaintsQuery)) {
                                    // Handle the case where the update query for the paints table failed
                                    $error .= "Error updating quantity in paints table: " . mysqli_error($conn);
                                }
                            } else {
                                // Return a JSON response indicating failure
                                $msg = array("valid" => false, "msg" => "Not enough quantity available for color: $usingcolor");
                                echo json_encode($msg);
                                exit; // Exit the script
                            }
                        } else {
                            // Handle the case where no matching row is found
                            $error .= "No data found for paint color: $usingcolor";
                        }
                    } else {
                        // Handle the case where the color is empty in the carts table
                        $error .= "Color is empty in the carts table";
                    }
                }
            }else {
                // Close the script
                exit;
            }



        // Handle the case where no matching row is found
        $error .= "No data found for the specified Transaction ID";
            
        } else {
            // Handle the case where the query execution failed
            $error .= "Error: " . mysqli_error($conn);
        }




        $sqlll = mysqli_query($conn, "UPDATE orders SET status = '$status', date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
        $sqlll = mysqli_query($conn, "UPDATE carts SET status = '$status', date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
        $sqll2 = mysqli_query($conn, "UPDATE client_documents SET status = '$status' WHERE tran_id = '$tran_id' ");
        if (!empty($cust_id)) {
            $sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$CustomerMessage','$currentDateTime','$tran','$status')");
        }


        //Transaction Detail query
        $transactionDetailQuery = mysqli_query($conn, "SELECT customerName, totalprice FROM orders WHERE tran_id='$tran_id'");
        
        $rowtransaction = mysqli_fetch_assoc($transactionDetailQuery);
        $totalpricetran = $rowtransaction['totalprice'];
        $customernametran = $rowtransaction['customerName'];

        if (!empty($cust_id)) {
            //Email query
            $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
            
            $row5 = mysqli_fetch_assoc($custEmailQuery);
            $customerEmail = $row5['email'];
            $customerName = $row5['fname'] . " " . $row5['lname'] ;
            $custLname = $row5['lname'];
        }else {
            $customerEmail = $noAccEmail;
            $customerName = $noAccName;
            $custLname = $customerName;
        }

        $signature = "<br>";
        $signature .= "<br>";
        $signature .= "Regards,<br>";
        $signature .= "Litz Autoshop<br>";
        $signature .= "Email Notification<br>";
        $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
        $signature .= "Phone: 09169834159<br>";
        $signature .= "Email: marjlit1@gmail.com</p>";

        $message = "<html><body>";
        $message .= "<p>Dear Mr/Mrs. $custLname,</p>";
        $message .= "<p>I hope this message finds you well. We want to inform you that your transaction has been successfully accepted. We welcome you to our store for the payment process, requirements (for cars only), and to review your order.</p>";
        $message .= "<br>";
        $message .= "<h4>Transaction Details</h4>";
        $message .= "<p>Total Price: &#8369;" . number_format($totalpricetran, 2) . "<br>Transaction ID: $tran_id <br>Customer Name: $customernametran</p>";        
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

        if ($transaction_type == "car") {
            $message .= "<h4>List of Requirements:</h4>";
            $message .= "<h5>For Employeed One:</h5><p>
            - COE<br>
            - LATEST PAYSLIP(3MONTHS)<br>
            - LATEST ELECTRIC BILLING <br>
            - BRGY.CLEARANCE <br>
            - 2 VALID ID & WIFE(IF MARRIED)<br>
            - MARRIAGE CONTRACT(IF MARRED)<br>
            - BIRTH CERTIFICATE(APPLICABLE FOR NOT MARRIED)<br>
            </p><h5>For Self-Employeed One</h5><p>
            - BUSINESS PERMIT <br>
            - LATEST BANK STATEMENT (3 MONTHS/RECEIPT 3MONNTHS)<br>
            - LATEST ELECTRIC BILLING <br>
            - BRGY.CLEARANCE <br>
            - 2 VALID ID & WIFE(IF MARRIED)<br>
            - MARRIAGE CONTRACT(IF MARRED)<br>
            - BIRTH CERTIFICATE(APPLICABLE FOR NOT MARRIED)<br>
            </p>";
                
        }
        $message .= $signature;
        $message .= "</body></html>";

        $emailName = "Litz Autoshop";
        $emailAdd = "litzautoshop@gmail.com";
        $emailSubject = "Order Accepted";

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
        
$price = number_format($totalpricetran, 2);
$textMessage = "Hi Mr/Mrs. $custLname, this is Litz Autoshop. We are pleased to inform you that your order has been accepted.
Total Price: ₱$price
Transaction ID: $tran_id
Ordered Product: ";


$productQuery = mysqli_query($conn, "SELECT * FROM carts WHERE tran_id='$tran_id'");
while ($productRow = mysqli_fetch_assoc($productQuery)) {
    if ($productRow['car_id'] !== null) {
        $textMessage .= $productRow['product'] . " " . $productRow['engine'] . "(" . $productRow['model'] . ")";
    }else {
        $textMessage .= $productRow['product'] . "(" . $productRow['quantity'] . "x) ₱" . number_format($productRow['price'], 2) . ", ";
    }
}


// Please submit the requirements to the store:
// IF YOU ARE EMPLOYEED ONE:
// - COE
// - LATEST PAYSLIP(3 MOS)
// - ELECTRIC BILL
// - BRGY. CLEARANCE
// - 2 VALID ID & WIFE(IF MARRIED)
// - MARRIAGE CONTRACT(IF MARRIED)
// - BIRTH CERTIFICATE(IF NOT MARRIED)

// SELF-EMPLOYEED ONE:
// - BUSINESS PERMIT
// - LATEST BANK STATEMENT(3 MOS)
// - ELECTRIC BILL
// - BRGY. CLEARANCE
// - 2 VALID ID & WIFE(IF MARRIED)
// - MARRIAGE CONTRACT(IF MARRIED)
// - BIRTH CERTIFICATE(IF NOT MARRIED)
        
        if (!empty($cust_id)) {
            $stmtclientNum = mysqli_query($conn, "SELECT phoneNum FROM clientacc WHERE cust_id = '$cust_id' ");
            $dataPhone = mysqli_fetch_assoc($stmtclientNum);
    
            $oldnumber = $dataPhone['phoneNum'];
        }else {
            $oldnumber = $noAccPhone;
        }
        // $prefixedNumber = "+63" . substr($number, 1);

        $msg = array("valid" => true, "msg" => "Order Accepted!", "number" => $oldnumber, "message" => $textMessage);
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