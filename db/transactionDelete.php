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
    $msg = $tran_id = $order_id = $status = $error = "";
    $valid = true;


    if (isset($_POST['tran_id']) && !empty($_POST['tran_id'])) {
        $tran_id = $_POST['tran_id'];
    } else {
        $valid = false;
        $error .= "Transaction ID is invalid";
        $tran_id = "";
    }
    
    $cust_id = $_POST['cust_id'];
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    // Set the timezone to the Philippines
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date("Y-m-d H:i:s");
	$status = "Declined";
	$messageSystem = "The Order was Unfortunately Declined. Feel free to make a new Order. " . "Transaction ID : " . $tran_id;
	$tran = "order";
	

    if ($valid) {

        if ($order_status == "Accepted") {

            $stmt = mysqli_query($conn, "SELECT car_id, sparepart_id, product, color, quantity FROM carts WHERE tran_id='$tran_id'");
            
            
            if ($stmt) {
    
    
                    $stmt1 = mysqli_query($conn, "SELECT car_id, sparepart_id, product, color, quantity FROM carts WHERE tran_id='$tran_id'");
                    
                    while ($row = mysqli_fetch_assoc($stmt1)){
    
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
    
    
                                // Update the quantity in the cars table
                                $updateCarsQuery = "UPDATE cars SET quantity = quantity + $totalquantity, sold = sold - $totalquantity WHERE car_id = $prodID AND car_type = '$prodName'";
                                if (!mysqli_query($conn, $updateCarsQuery)) {
                                    // Handle the case where the update query for the cars table failed
                                    $error .= "Error updating quantity in cars table: " . mysqli_error($conn);
                                }
    
                                
                        } else {
                            // Query to get the current quantity from the database
                            $getCurrentQuantityQuery2 = "SELECT quantity FROM spareparts_accessories WHERE sparepart_id = $prodID AND product = '$prodName'";
                            $result2 = mysqli_query($conn, $getCurrentQuantityQuery2);
                            
                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                $row2 = mysqli_fetch_assoc($result2);
                                $currentQuantity2 = $row2['quantity'];
                                
    
                                    // Update the quantity in the cars table
                                    $updateSparepartQuery = "UPDATE spareparts_accessories SET quantity = quantity + $totalquantity, sold = sold - $totalquantity WHERE sparepart_id = $prodID AND product = '$prodName'";
                                    if (!mysqli_query($conn, $updateSparepartQuery)) {
                                        // Handle the case where the update query for the cars table failed
                                        $error .= "Error updating quantity in cars table: " . mysqli_error($conn);
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
                                
    
                                    // Update the quantity in the paints table
                                    $updatePaintsQuery = "UPDATE paints SET quantity = quantity - $totalquantity, sold = sold + $totalquantity WHERE paint_color = '$usingcolor'";
                                    if (!mysqli_query($conn, $updatePaintsQuery)) {
                                        // Handle the case where the update query for the paints table failed
                                        $error .= "Error updating quantity in paints table: " . mysqli_error($conn);
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
                
    
    
    
            // Handle the case where no matching row is found
            $error .= "No data found for the specified Transaction ID";
                
            } else {
                // Handle the case where the query execution failed
                $error .= "Error: " . mysqli_error($conn);
            }

        }








        $sql = mysqli_query($conn, "UPDATE orders SET status = '$status', date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
        $sql = mysqli_query($conn, "UPDATE carts SET status = '$status', date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
        $sqlll = mysqli_query($conn, "UPDATE client_documents SET status = '$status' WHERE tran_id = '$tran_id' ");
        if ($cust_id != "") {
            $sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageSystem','$currentDateTime','$tran','$status')");
        }

        
        if ($cust_id == "") {
            //Email query
            $custEmailQuery1 = mysqli_query($conn, "SELECT noAccEmail, customerName FROM orders WHERE tran_id='$tran_id'");
            
            $row16 = mysqli_fetch_assoc($custEmailQuery1);
            $customerEmail = $row16['noAccEmail'];
            $customerName = $row16['customerName'];
            $custLname = $row16['customerName'];
        }else {
            //Email query
            $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
            
            $row5 = mysqli_fetch_assoc($custEmailQuery);
            $customerEmail = $row5['email'];
            $customerName = $row5['fname'] . " " . $row5['lname'] ;
            $custLname = $row5['lname'];
        }
			

        if ($customerEmail != "") {
            
            $signature = "<br>";
            $signature .= "<p>Regards,<br>";
            $signature .= "Litz Autoshop<br>";
            $signature .= "Email Notification<br>";
            $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
            $signature .= "Phone: 09169834159<br>";
            $signature .= "Email: marjlit1@gmail.com</p>";
            
            $message = "<html><body>";
            $message .= "<p>Dear Mr/Mrs. $custLname,</p>";
            $message .= "<p>I hope this message finds you well. Regrettably, we must inform you that your recent order request has been declined. We understand that this news may be disappointing, and we sincerely apologize for any inconvenience this may cause.</p>";
            $message .= "<p>While we are unable to fulfill the order at this time, we encourage you to submit another order in the future. Our team is here to assist you, and we appreciate your understanding.</p>";			
            $message .= "<br>";        
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
            $message .= $signature;
            $message .= "</body></html>";


            $emailName = "Litz Autoshop";
            $emailAdd = "litzautoshop@gmail.com";
            $emailSubject = "Order Declined";

            $mail->setFrom($emailAdd, $emailName);
            $mail->addAddress($customerEmail, $customerName);

            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = $message;
            $mail->send();
        }
        


        $msg = array("valid" => true, "msg" => "Transaction Declined!");
        echo json_encode($msg);
    }

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>