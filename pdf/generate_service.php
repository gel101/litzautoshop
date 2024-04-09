<?php
include_once("connection.php");
include_once('libs/fpdf.php');
$name = $dataURL = $filename = "";

if (isset($_POST['dataURL']) && isset($_POST['filename']) && isset($_POST['generate_pdf'])) {
    $selectedOption = $_POST['selectOption2'];
    $selectedMonths = $_POST['selectedMonths1'];
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
            $this->Cell(80, 8, 'Service Revenue Record', 1, 0, 'C');
            $this->Ln(20);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }

        function AddCaption1(){
            $this->SetFont('Arial', 'B', 12);
            $this->SetFillColor(200, 220, 255); // Background color for the header row
            $this->Cell(0, 10, 'Transaction Record', 1, 1, 'C', true);
        }

        
        function cellRow($request_id, $cust_name, $vehicleType, $request, $date, $price){
        
            $this->Cell(8, 8, $request_id, 0);
            $this->Cell(40, 8, $cust_name, 0);
            $this->Cell(35, 8, $vehicleType, 0);
            $this->Cell(25, 8, $date, 0);
            
            // Your database query for products in each transaction
            global $conn;
            $serviceStmt = mysqli_query($conn, "SELECT request FROM request_services WHERE request_id='$request_id' ");
            
            $productData = "";
            while ($serviceRow = mysqli_fetch_assoc($serviceStmt)) {
                $productData .= $serviceRow['request'];
            }
        
            $currentY = $this->GetY();
            // Save the current Y position
        
            // Output $productData using MultiCell
            $this->MultiCell(40, 8, $productData, 0);
            
            // Set Y position to the saved current Y position
            // $this->SetY($currentY);
        
            // Set X position to start from the beginning of the line
            $this->SetX(175);
        
            // Output $totalprice
            $this->Cell(10, -10, "P " . number_format($price, 2), 0);
        
        
            $this->Ln(1);
            // $this->Line(10, 20, 200, 20);
        }
        



    }



    $display_columns = array('request_id', 'cust_name', 'vehicleType', 'date', 'request', 'price');
    $display_heading = array(
        'request_id' => 'ID',
        'cust_name' => 'Name',
        'vehicleType' => 'Vehicle Type',
        'date' => 'Date',
        'request' => 'Service',
        'price' => 'Revenue',
    );

    $columns = implode(', ', $display_columns);
    $query = "SELECT $columns FROM request_services WHERE status = 'Request Completed'";
    if ($selectedOption === "month") {
        // Assuming $selectedMonths[0] and $selectedMonths[1] are in the format 'YYYY-MM-DD'
        $startDate = date('Y-m-d', strtotime($selectedMonths[0]));
        $endDate = date('Y-m-d', strtotime($selectedMonths[1]));

        $query .= " AND date BETWEEN '$startDate' AND '$endDate'";
    } elseif ($selectedOption === "year") {
        $query .= " AND YEAR(date) = $selectedYear";
    }
    $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

    
    $query11 = "SELECT SUM(price) AS totalprice FROM request_services WHERE status = 'Request Completed'";
    if ($selectedOption === "month") {
        // Assuming $selectedMonths[0] and $selectedMonths[1] are in the format 'YYYY-MM-DD'
        $startDate = date('Y-m-d', strtotime($selectedMonths[0]));
        $endDate = date('Y-m-d', strtotime($selectedMonths[1]));

        $query11 .= " AND date BETWEEN '$startDate' AND '$endDate'";
    } elseif ($selectedOption === "year") {
        $query11 .= " AND YEAR(date) = $selectedYear";
    }
    $result11 = mysqli_query($conn, $query11) or die("Database error: " . mysqli_error($conn));
    $row11 = mysqli_fetch_assoc($result11);
    $totalprice11 = $row11['totalprice'];

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial', 'B', 10);
    
    // $pdf->Image('chart_image/' . $name, 25, $pdf->GetY(), 150);
    // $pdf->Image('chart_image/' . $name, 38, 40, 120); // Adjusted X and Y position for the image
    
    // // Create a table-like structure for the layout
    // $pdf->SetX(10); // Start from the left margin
    // $pdf->Cell(80); // Cell for image (80 units wide) - acts as a placeholder
    // $pdf->Cell(0); // Cell for text (takes up the remaining space)
    // $pdf->Ln(90); // Move to the next line

    // Transaction Table
    $pdf->AddCaption1(); // Add the caption "Cars Record" before the table
    foreach ($display_heading as $column_heading) {
        if ($column_heading === 'ID') {
            $pdf->Cell(8, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Name') {
            $pdf->Cell(40, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Vehicle Type') {
            $pdf->Cell(35, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Service') {
            $pdf->Cell(55, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Date') {
            $pdf->Cell(25, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Revenue') {
            $pdf->Cell(27, 8, $column_heading, 1, 0, 'L', true);
        } else {
            $pdf->Cell(1, 8, $column_heading, 1, 0, 'L', true);
        }
    }

    $pdf->Ln();

    // Check if $stmt has rows
    if (mysqli_num_rows($result) > 0) {
        $pdf->SetFont('Arial', '', 10);
        while ($data = mysqli_fetch_assoc($result)) {
            $pdf->cellRow($data['request_id'], $data['cust_name'], $data['vehicleType'], $data['request'], (new DateTime($data['date']))->format('m-d-Y'), $data['price']);
        }
        
        $pdf->Ln(10);
    } else {
        // Output a message if $stmt is empty
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 10, 'No records found.', 1, 0, 'C');
    }
    
    // Add the row for the total quantity
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(163, 8, 'Total Revenue : ', 1, 0, 'L', true);
    $formattedTotalPrice = number_format($totalprice11, 2); // You can adjust the decimal places as needed
    $pdf->Cell(0, 8, "P " . $formattedTotalPrice, 1, 0, 'R', true);


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

    $pdf->Output();
    mysqli_close($conn);
}
?>
