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
    $msg = $addname = $addemail = $addid = $addimg = $addproduct = $addcartype = $addmodel = $addengine = $addprice = $addcolor
    = $addquantity = $addquantityLeft = $adddetails = $addscreenshot = $addpaymentTerm = $addpaymentMode = $addreferenceInput = $adddate = $error = "";
    $valid = true;


    if (isset($_POST['addname']) && !empty($_POST['addname'])) {
        $addname = $_POST['addname'];
    } else {
        $valid = false;
        $error .= "Customer Name is invalid";
        $addname = "";
    }

    if (isset($_POST['addemail']) && !empty($_POST['addemail'])) {
        $addemail = $_POST['addemail'];
    } else {
        $valid = false;
        $error .= "Customer Email is invalid";
        $addemail = "";
    }

    $addid = $_POST['addid'];
    $addimg = $_POST['addimg'];
    $addproduct = $_POST['addproduct'];
    $addcartype = $_POST['addcartype'];
    $addcolor = $_POST['addcolor'];
    $addmodel = $_POST['addmodel'];
    $addengine = $_POST['addengine'];
    $addprice = $_POST['addprice'];
    $addquantity = $_POST['addquantity'];
    $addquantityLeft = $_POST['addquantityLeft'];
    $adddetails = $_POST['adddetails'];
    $adddate = $_POST['adddate'];
    $totalprice = $addprice * $addquantity;

    $status = "Accepted";
    $tran_id = uniqid(); // GENERATE Transaction ID

    $sql = mysqli_query($conn, "INSERT INTO carts(img, tran_id, car_id, product, name, model, engine, price, color, quantity, leftQuantity, details, status) VALUES('$addimg','$tran_id','$addid','$addproduct','$addcartype','$addmodel','$addengine','$addprice','$addcolor','$addquantity','$addquantityLeft','$adddetails','$status')");
    $sqll123 = mysqli_query($conn, "INSERT INTO orders(customerName, tran_id, totalprice, date, status, noAccEmail) VALUES('$addname','$tran_id','$totalprice','$adddate', '$status', '$addemail')");

    
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


        
        //Transaction Detail query
        $transactionDetailQuery = mysqli_query($conn, "SELECT * FROM orders WHERE tran_id='$tran_id'");

        $rowtransaction = mysqli_fetch_assoc($transactionDetailQuery);
        $totalpricetran = $rowtransaction['totalprice'];
        // if ($rowtransaction['payment_term'] == "For Finance") {
        //     $finalpaymentTerm = $rowtransaction['payment_term'];
        // }else {
        //     $finalpaymentTerm = $rowtransaction['payment_term'] . "(" . $rowtransaction['payment_mode'] . " " . $rowtransaction['reference_number'] . ")";
        // }

        $customerEmail = $addemail;
        $customerName = $addname;
						

		$signature = "<br>";
        $signature .= "Regards,<br>";
		$signature .= "Litz Autoshop<br>";
		$signature .= "Email Notification<br>";
		$signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
		$signature .= "Phone: 09169834159<br>";
		$signature .= "Email: marjlit1@gmail.com</p>";

		$message = "<html><body>";
		$message .= "<p>Dear Mr/Mrs. $customerName,</p>";
        $message .= "<p>I hope this message finds you well. We want to inform you that your transaction has been successfully accepted. We will welcome you in our building for the payment process, requirements and to take a look at your order.</p>";
		$message .= "<br>";
        $message .= "<h4>Transaction Details</h4>";
        $message .= "<p>Total Price: &#8369;" . number_format($totalpricetran, 2) . "<br>Transaction ID: $tran_id</p>";
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
		$message .= $signature;
		$message .= "</body></html>";

	
		$emailName = "Litz Autoshop";
		$emailAdd = "malano.angelo@dnsc.edu.ph";
		$emailSubject = "Order Accepted";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($customerEmail, $customerName);

		$mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body = $message;
        $mail->send();

        // Close the mail connection after sending all emails
        $mail->smtpClose();


        $msg = array("valid" => true, "msg" => "Transaction Status: Requirements Complete!");
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