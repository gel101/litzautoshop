<?php
include_once("connection.php");
include_once('libs/fpdf.php');
$name = $dataURL = $filename = "";

if (isset($_POST['dataURL']) && isset($_POST['filename']) && isset($_POST['submit'])) {

    $db = new dbObj();
    $conn = $db->getConnstring();

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    class PDF extends FPDF{
        // Letter-Short Format Size
        // function __construct() {
        //     parent::__construct('P', 'mm', 'Letter'); // 'P' for portrait orientation, 'mm' for millimeters, 'Letter' for letter size
        // }

        // Long Format Size
        function __construct() {
            parent::__construct('P', 'mm', array(216, 330)); // 'P' for portrait orientation, 'mm' for millimeters, and custom dimensions (216mm x 330mm)
        }

        function Header(){
            // Logo
            $this->Image('../img/logo-light.png', 35, 5, 25);
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(80);
            $this->Cell(80, 10, 'Stock Record', 1, 0, 'C');
            $this->Ln(20);
        }
    
        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
        
        function AddCaption1(){
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(200, 220, 255); // Background color for the header row
            $this->Cell(0, 8, 'Cars Record', 1, 1, 'C', true);
        }
        
        function AddCaption2(){
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(200, 220, 255); // Background color for the header row
            $this->Cell(0, 8, 'Paints Record', 1, 1, 'C', true);
        }
        
        function AddCaption3(){
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(200, 220, 255); // Background color for the header row
            $this->Cell(0, 8, 'Spareparts Record', 1, 1, 'C', true);
        }
  
        function GeneratePDF($conn, $selectedOption) {
            $this->AddPage();
            $this->AliasNbPages();
            $this->SetFont('Arial', '', 11);

            global $name;
            // $this->Image('chart_image/' . $name, 60, $this->GetY(), 95);

            // // Create a table-like structure for the layout
            // $this->SetX(10); // Start from the left margin
            // $this->Cell(80); // Cell for image (80 units wide) - acts as a placeholder
            // $this->Cell(0); // Cell for text (takes up the remaining space)
            // $this->Ln(100); // Move to the next line

            // Handle the selection and generate PDF accordingly
            if ($selectedOption === "all") {
                $this->GenerateAllDataPDF($conn);
            } elseif ($selectedOption === "car") {
                $this->GenerateCarDataPDF($conn);
            } elseif ($selectedOption === "sparepart & accessory") {
                $this->GenerateSparepartAccessoryDataPDF($conn);
            } elseif ($selectedOption === "paint") {
                $this->GeneratePaintDataPDF($conn);
            }
        }

        function GenerateAllDataPDF($conn) {
            $this->GenerateCarDataPDF($conn);
            $this->GenerateSparepartAccessoryDataPDF($conn);
            $this->GeneratePaintDataPDF($conn);
        }

        function GenerateCarDataPDF($conn) {
            $display_columns1 = array('car_type', 'name', 'model', 'engine', 'price');
            $display_heading1 = array(
                'car_type' => 'Car Type',
                'name' => 'Name',
                'model' => 'Model',
                'engine' => 'Engine',
                'price' => 'Price');
            $columns1 = implode(', ', $display_columns1);
            $query1 = "SELECT $columns1 FROM cars WHERE status = '' ";
            $result1 = mysqli_query($conn, $query1) or die("Database error: " . mysqli_error($conn));

            // Calculate the total quantity
            $query1 = "SELECT $columns1 FROM cars WHERE status = '' ";
            $result1 = mysqli_query($conn, $query1) or die("Database error: " . mysqli_error($conn));
            $query11 = "SELECT SUM(Quantity) AS TotalQuantity FROM cars WHERE status = '' ";
            $result11 = mysqli_query($conn, $query11) or die("Database error: " . mysqli_error($conn));
            $row11 = mysqli_fetch_assoc($result11);
            $totalQuantity1 = $row11['TotalQuantity'];

            // Car Table
            $this->AddCaption1(); // Add the caption "Cars Record" before the table
            foreach ($display_heading1 as $column_heading1) {
                if ($column_heading1 === 'Car Type') {
                    $this->Cell(38, 8, $column_heading1, 1, 0, '', true);
                }elseif ($column_heading1 === 'Name') {
                    $this->Cell(78, 8, $column_heading1, 1, 0, '', true);
                }elseif ($column_heading1 === 'Model') {
                    $this->Cell(30, 8, $column_heading1, 1, 0, '', true);
                }elseif ($column_heading1 === 'Engine') {
                    $this->Cell(30, 8, $column_heading1, 1, 0, '', true);
                }elseif ($column_heading1 === 'Price') {
                    $this->Cell(20, 8, $column_heading1, 1, 0, '', true);
                } else {
                    $this->Cell(10, 8, $column_heading1, 1, 0, 'C', true);
                }
            }
            
            $this->SetFont('Arial', '', 8);
            while ($row = mysqli_fetch_assoc($result1)) {
                $this->Ln();
                foreach ($display_columns1 as $column) {
                    if ($column === 'car_type') {
                        $this->Cell(38, 10, $row[$column], 0);
                    }elseif ($column === 'name') {
                        $this->Cell(78, 10, $row[$column], 0);
                    }elseif ($column === 'model') {
                        $this->Cell(30, 10, $row[$column], 0);
                    }elseif ($column === 'engine') {
                        $this->Cell(30, 10, $row[$column], 0);
                    }elseif ($column === 'price') {
                        $TotalPrice = number_format($row[$column], 2);
                        $this->Cell(20, 10, $TotalPrice, 0, 0, 'C');
                    } else {
                        $this->Cell(30, 10, $row[$column], 0);
                    }
                }
            }
            // Add the row for the total quantity
            $this->Ln();
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(176, 8, 'Total Quantity Available: ', 1, 0, 'L', true);
            $this->Cell(0, 8, $totalQuantity1, 1, 0, 'C', true);
            $this->Ln(30); // Move to the next line

        }


        function GenerateSparepartAccessoryDataPDF($conn) {    
            $display_columns3 = array('Product', 'Price', 'Sold', 'Quantity');
            $display_heading3 = array(
                'Product' => 'Product',
                'Price' => 'Price',
                'Sold' => 'Sold',
                'Quantity' => 'Available',);
            $columns3 = implode(', ', $display_columns3);
            $query3 = "SELECT $columns3 FROM spareparts_accessories WHERE status = '' ";
            $result3 = mysqli_query($conn, $query3) or die("Database error: " . mysqli_error($conn));
            $query33 = "SELECT SUM(Quantity) AS TotalQuantity FROM spareparts_accessories WHERE status = '' ";
            $result33 = mysqli_query($conn, $query33) or die("Database error: " . mysqli_error($conn));
            $row33 = mysqli_fetch_assoc($result33);
            $totalQuantity3 = $row33['TotalQuantity'];
        
            // Spareparts Table
            $this->AddCaption3(); // Add the caption "Cars Record" before the table
            foreach ($display_heading3 as $column_heading3) {
                if ($column_heading3 === 'Product') {
                    $this->Cell(76, 8, $column_heading3, 1, 0, '', true);
                }elseif ($column_heading3 === 'Sold') {
                    $this->Cell(40, 8, $column_heading3, 1, 0, '', true);
                } else {
                    $this->Cell(40, 8, $column_heading3, 1, 0, 'C', true);
                }
            }

                
            // Check if $stmt has rows
            if (mysqli_num_rows($result3) > 0) {
                $this->SetFont('Arial', '', 10);
                while ($row = mysqli_fetch_assoc($result3)) {
                    $this->Ln();
                    foreach ($display_columns3 as $column) {
                        if ($column === 'Product') {
                            $this->Cell(76, 10, $row[$column], 0);
                        }elseif ($column === 'Price') {
                            $TotalPrice = number_format($row[$column], 2);
                            $this->Cell(40, 10, $TotalPrice, 0, 0, 'C');
                        } else {
                            $this->SetFont('Arial', '', 10);
                            $this->Cell(40, 10, $row[$column], 0, 0, 'C');
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
            $this->Ln();
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(156, 8, 'Total Quantity Available: ', 1, 0, 'L', true);
            $this->Cell(40, 8, $totalQuantity3, 1, 0, 'C', true);
            $this->Ln(30); // Move to the next line
        }


        function GeneratePaintDataPDF($conn) {
            $display_columns2 = array('Paint_color', 'Sold', 'Quantity');
            $display_heading2 = array(
                'Paint_color' => 'Paint',
                'Sold' => 'Used',
                'Quantity' => 'Available');
            $columns2 = implode(', ', $display_columns2);
            $query2 = "SELECT $columns2 FROM paints WHERE status = '' ";
            $result2 = mysqli_query($conn, $query2) or die("Database error: " . mysqli_error($conn));
            $query22 = "SELECT SUM(Quantity) AS TotalQuantity FROM paints WHERE status = '' ";
            $result22 = mysqli_query($conn, $query22) or die("Database error: " . mysqli_error($conn));
            $row22 = mysqli_fetch_assoc($result22);
            $totalQuantity2 = $row22['TotalQuantity'];

            // Paints Table
            $this->AddCaption2(); // Add the caption "Cars Record" before the table
            foreach ($display_heading2 as $column_heading2) {
                if ($column_heading2 === 'Paint') {
                    $this->Cell(116, 8, $column_heading2, 1, 0,'', true);
                } else {
                    $this->Cell(40, 8, $column_heading2, 1, 0, 'C', true);
                }
            }
            $this->SetFont('Arial', '', 10);
            while ($row = mysqli_fetch_assoc($result2)) {
                $this->Ln();
                foreach ($display_columns2 as $column) {
                    if ($column === 'Paint_color') {
                        $this->Cell(116, 10, $row[$column], 0);
                    }elseif ($column === 'sold') {
                        $this->Cell(40, 10, $row[$column], 0);
                    } else {
                        $this->SetFont('Arial', '', 10);
                        $this->Cell(40, 10, $row[$column], 0, 0, 'C');
                    }
                }
            }
            // Add the row for the total quantity
            $this->Ln();
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(156, 8, 'Total Quantity Available: ', 1, 0, 'L', true);
            $this->Cell(40, 8, $totalQuantity2, 1, 0, 'C', true);
            $this->Ln(30); // Move to the next line
        }
    }




    $selectedOption = $_POST['selectStock'];
    $pdf = new PDF();

    // Call the function to generate the PDF based on the selected option
    $pdf->GeneratePDF($conn, $selectedOption);


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
