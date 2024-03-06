<?php

    include_once("connection.php");
    include_once('libs/fpdf.php');
    $chartName = $dataURL = $filename = "";

    if (isset($_POST['dataURL']) && isset($_POST['filename']) && isset($_POST['generate_pdf'])) {
        
        $selectedOption = $_POST['selectOption'];
        $selectedMonths = $_POST['selectedMonths'];
        $selectedYear = $_POST['year'];
    
        $db = new dbObj();
        $conn = $db->getConnstring();
    
        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    
        class PDF extends FPDF
        {
            function Header()
            {
                // Logo
                $this->Image('../img/logo-light.png', 35, 5, 25);
                $this->SetFont('Arial', 'B', 11);
                $this->Cell(80);
                $this->Cell(80, 10, 'Product Sales Record', 1, 0, 'C');
                $this->Ln(20);
            }
    
            function Footer()
            {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }
    
            // Modify the AddCaption1() function to add styling to the table
            function AddCaption1(){
                $this->SetFont('Arial', 'B', 10);
                $this->SetFillColor(200, 220, 255); // Background color for the header row
                $this->Cell(0, 8, 'Transaction Record', 1, 0, 'C', true);
                // Add similar lines for other columns
                $this->Ln();
            }

            function cellRow($order_id, $customerName, $payment_term, $payment_mode, $reference_number, $date, $totalprice, $tran_id, $plate, $receipt){
                $this->Cell(9, 8, $order_id, 0);
                $this->Cell(20, 8, $tran_id, 0);
                $this->Cell(26, 8, $customerName, 0);
                if ($reference_number == "" || is_null($reference_number)) {
                    $this->Cell(20, 8, $payment_term, 0);
                }else {
                    $this->Cell(20, 8, $payment_term . "(" . $payment_mode . ")", 0);
                }

                if ($receipt === "---") {
                    $receipt = "";
                }
                $this->Cell(16, 8, $receipt, 0);
                $this->Cell(13, 8, $plate, 0);
                $this->Cell(15, 8, $date, 0);
            
                // Your database query for products in each transaction
                global $conn;
                $productStmt = mysqli_query($conn, "SELECT product FROM carts WHERE tran_id='$tran_id' ORDER BY cart_id DESC");
                
                $productData = "";
                $i = 1;
                while ($productRow = mysqli_fetch_assoc($productStmt)) {
                    $productData .= $i . ".) " . $productRow['product'] . "\n";
                    $i++;
                }
            
                // Save the current Y position
                $currentY = $this->GetY();
            
                // Output $productData using MultiCell
                $this->MultiCell(50, 8, $productData, 0);
                
                // Set Y position to the saved current Y position
                // $this->SetY($currentY);
            
                // Set X position to start from the beginning of the line
                $this->SetX(183);
            
                // Output $totalprice
                $this->Cell(0, -10, "P " . number_format($totalprice, 2), 0);
            
                $this->Ln(1);
                // $this->Line(10, 20, 200, 20);
            }
            
            
        }
    

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', '', 1);
        
        // Modify the Image() function to adjust image placement
        // $pdf->Image('chart_image/' . $chartName, 38, 40, 120); // Adjusted X, Y position and width


        // // Create a table-like structure for the layout
        // $pdf->SetX(10); // Start from the left margin
        // $pdf->Cell(80); // Cell for image (80 units wide) - acts as a placeholder
        // $pdf->Cell(0); // Cell for text (takes up the remaining space)
        // $pdf->Ln(80); // Move to the next line
        
        
        // $pdf->Cell(0, 3, '', 0, 1, '', true);
        
        $pdf->AddCaption1(); // Add the caption "Transaction Record" before the table
    
        $display_columns = array('order_id', 'tran_id', 'customerName', 'payment_term','date', 'receipt', 'plate_number', 'product', 'totalprice');
        $display_heading = array(
            'order_id' => 'ID',
            'tran_id' => 'Transaction ID',
            'customerName' => 'Name',
            'payment_term' => 'Payment',
            'receipt' => 'Receipt No.',
            'plate_number' => 'Plate No.',
            'date' => 'Date',
            'product' => 'Product',
            'totalprice' => 'Sales'
        );
        
        $pdf->SetFont('Arial', 'B', 7);
        // Modify the foreach loop in AddCaption1() to set column widths
        foreach ($display_heading as $column_heading) {
            if ($column_heading === 'ID') {
                $pdf->Cell(9, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Transaction ID') {
                $pdf->Cell(20, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Name') {
                $pdf->Cell(26, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Payment') {
                $pdf->Cell(20, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Date') {
                $pdf->Cell(15, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Receipt No.') {
                $pdf->Cell(16, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Plate No.') {
                $pdf->Cell(13, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Sales') {
                $pdf->Cell(0, 6, $column_heading, 1, 0, 'L', true);
            } elseif ($column_heading === 'Product') {
                $pdf->Cell(54, 6, $column_heading, 1, 0, 'L', true);
            } else {
                $pdf->Cell(1, 6, $column_heading, 1, 0, 'L', true);
            }
        }
        
        $pdf->Ln();
        
    
        $query = "SELECT * FROM orders WHERE status = 'completed'";
        if ($selectedOption === "month") {
            // Assuming $selectedMonths[0] and $selectedMonths[1] are in the format 'YYYY-MM-DD'
            $startDate = date('Y-m-d', strtotime($selectedMonths[0]));
            $endDate = date('Y-m-d', strtotime($selectedMonths[1]));

            $query .= " AND date BETWEEN '$startDate' AND '$endDate'";
        } elseif ($selectedOption === "year") {
            $query .= " AND YEAR(date) = $selectedYear";
        }
        $stmt = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));
    
        $queryTotalprice = "SELECT SUM(totalprice) AS totalprice FROM orders WHERE status = 'completed'";
        if ($selectedOption === "month") {
            // Assuming $selectedMonths[0] and $selectedMonths[1] are in the format 'YYYY-MM-DD'
            $startDate = date('Y-m-d', strtotime($selectedMonths[0]));
            $endDate = date('Y-m-d', strtotime($selectedMonths[1]));

            $queryTotalprice .= " AND date BETWEEN '$startDate' AND '$endDate'";
        } elseif ($selectedOption === "year") {
            $queryTotalprice .= " AND YEAR(date) = $selectedYear";
        }
        $resultTotal = mysqli_query($conn, $queryTotalprice) or die("Database error: " . mysqli_error($conn));
        $rowTotal = mysqli_fetch_assoc($resultTotal);
        $tranTotalprice = $rowTotal['totalprice'];
    
        $pdf->SetFont('Arial', '', 8);
                
        // Check if $stmt has rows
        if (mysqli_num_rows($stmt) > 0) {
            // Your existing code to loop through and output rows
            $pdf->SetFont('Arial', '',6);
            while ($data = mysqli_fetch_assoc($stmt)) {
                $pdf->cellRow($data['order_id'], $data['customerName'], $data['payment_term'], $data['payment_mode'], $data['reference_number'], (new DateTime($data['date']))->format('m-d-Y'), $data['totalprice'], $data['tran_id'], $data['plate_number'], $data['receipt']);
            }
            $pdf->Ln(5);
        } else {
            // Output a message if $stmt is empty
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(0, 10, 'No records found.', 1, 1, 'C');
        }

        // Add the row for the total quantity
        $pdf->SetFont('Arial', 'B', 8);
        // $pdf->Cell(150, 11, 'Total Price : ', 1, 0, 'L');
        
        // $pdf->Ln();
        $pdf->Cell(165, 6, 'Total Sales : ', 1, 0, 'L', true);
        $formattedTotalPrice = number_format($tranTotalprice, 2); // You can adjust the decimal places as needed
        $pdf->Cell(0, 6, "P ". $formattedTotalPrice, 1, 0, 'C', true);


        // Add signature space
        $pdf->Ln(); // Add some space
        $pdf->Ln(); // Add some space
        $pdf->Ln(); // Add some space
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, '_______________________________', 0, 1, 'R');
        $pdf->Cell(0, 1, 'Signature over printed name      ', 0, 1, 'R');
        
        date_default_timezone_set('Asia/Manila');
        // Add date
        $pdf->Cell(0, 8, '', 0, 1, 'R');
        $pdf->Cell(0, 10, 'Date: ' . date('m/d/Y'), 0, 1, 'R');

        // Output the PDF
        $pdf->Output();
        mysqli_close($conn);
    }

?>