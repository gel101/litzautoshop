<?php
include_once("connection.php");
include_once('libs/fpdf.php');
$name = $dataURL = $filename = "";

if (isset($_POST['dataURL']) && isset($_POST['filename']) && isset($_POST['generate_pdf'])) {
    $selectedOption = $_POST['selectOption3'];
    $selectedMonths = $_POST['selectedMonths2'];
    $selectedYear = $_POST['year'];
    $dataURL = $_POST['dataURL'];
    $filename = $_POST['filename'];

    // Remove the "data:image/png;base64," prefix from the dataURL
    $data = substr($dataURL, strpos($dataURL, ',') + 1);

    // Decode the base64 data and save it as a PNG image
    $decodedData = base64_decode($data);

    // Generate a unique filename with a timestamp
    $timestamp = time();
    $uniqueFilename = 'chart_image_' . $timestamp . '.png';

    // Save the image with the unique filename
    file_put_contents('chart_image/' . $uniqueFilename, $decodedData);

    $name = $uniqueFilename;
    global $name;

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
            $this->Cell(80, 8, 'Rent Revenue Record', 1, 0, 'C');
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
    }

    $display_columns = array('rent_id', 'cust_id', 'rentTime', 'rentTimeType', 'date', 'price');
    $display_heading = array(
        'rent_id' => 'ID',
        'cust_id' => 'Name',
        'rentTime' => 'Rent Time',
        'rentTimeType' => 'Rent Time Type',
        'date' => 'Date',
        'price' => 'Revenue',
    );

    $columns = implode(', ', $display_columns);
    $query = "SELECT $columns FROM rent_transactions WHERE status = 'Rent Completed'";
    if ($selectedOption === "month") {
        // Assuming $selectedMonths[0] and $selectedMonths[1] are in the format 'YYYY-MM-DD'
        $startDate = date('Y-m-d', strtotime($selectedMonths[0]));
        $endDate = date('Y-m-d', strtotime($selectedMonths[1]));

        $query .= " AND date BETWEEN '$startDate' AND '$endDate'";
    } elseif ($selectedOption === "year") {
        $query .= " AND YEAR(date) = $selectedYear";
    }
    $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

    
    $query11 = "SELECT SUM(price) AS totalprice FROM rent_transactions WHERE status = 'Rent Completed'";
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
            $pdf->Cell(15, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Name') {
            $pdf->Cell(40, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Rent Time') {
            $pdf->Cell(25, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Rent Time Type') {
            $pdf->Cell(50, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Date') {
            $pdf->Cell(30, 8, $column_heading, 1, 0, 'L', true);
        } elseif ($column_heading === 'Revenue') {
            $pdf->Cell(30, 8, $column_heading, 1, 0, 'L', true);
        } else {
            $pdf->Cell(30, 8, $column_heading, 1, 0, 'L', true);
        }
    }

    
    // Check if $stmt has rows
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Ln();
            foreach ($display_columns as $column) {
                if ($column === 'rent_id') {
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(15, 8, $row[$column], 0, 0);
                } elseif ($column === 'cust_id') {

                    $cust_id = $row[$column];
                    $stmttt = mysqli_query($conn, "SELECT fname, lname FROM clientacc WHERE cust_id = '$cust_id' ");

                    $data = mysqli_fetch_assoc($stmttt);
                    $fname = $data['fname'];
                    $lname = $data['lname'];

                    $pdf->Cell(40, 8, $fname . " " . $lname, 0, 0);
                } elseif ($column === 'rentTimeType') {
                    $pdf->Cell(50, 8, $row[$column], 0, 0);
                } elseif ($column === 'rentTime') {
                    $pdf->Cell(25, 8, $row[$column], 0, 0);
                } elseif ($column === 'date') {
                    $pdf->Cell(30, 8, (new DateTime($row[$column]))->format('m-d-Y'), 0, 0);
                } elseif ($column === 'price') {
                    // Check if the 'price' column is numeric before formatting
                    if (is_numeric($row[$column])) {
                        $TotalPrice = number_format($row[$column], 2);
                        $pdf->Cell(30, 8, $TotalPrice, 0, 0, 'R');
                    }
                } else {
                    $pdf->Cell(30, 8, $row[$column], 0, 0);
                }
            }
        }
    } else {
        // Output a message if $stmt is empty
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Ln();
        $pdf->Cell(0, 10, 'No records found.', 1, 0, 'C');
    }
    
    // Add the row for the total quantity
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(160, 8, 'Total Revenue : ', 1, 0, 'L', true);
    $formattedTotalPrice = number_format($totalprice11, 2); // You can adjust the decimal places as needed
    $pdf->Cell(30, 8, "P " . $formattedTotalPrice, 1, 0, 'R', true);


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
