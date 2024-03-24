<?php 
include 'connection.php';

if(isset($_POST["action"]) && $_POST["action"] == 'productLineChart') {
    $startMonth = isset($_POST['start_month']) ? $_POST['start_month'] : null;
    $endMonth = isset($_POST['end_month']) ? $_POST['end_month'] : null;

    $monthCondition = "";

    if ($startMonth && $endMonth) {
        $monthCondition = " AND DATE_FORMAT(date, '%Y-%m') BETWEEN '$startMonth' AND '$endMonth'";
    }

    $query = "
        SELECT DATE_FORMAT(date, '%Y-%m') AS month_year, COUNT(*) AS total
        FROM orders WHERE status='completed' $monthCondition
        GROUP BY month_year
    ";

    $result = $conn->query($query);

    $data = array();

    foreach($result as $row)
    {
        $data[] = array(
            'month_year'   => $row["month_year"],
            'total'        => $row["total"],
            'color'        => 'rgba(46, 204, 113, 0.5)'
        );
    }

    echo json_encode($data);
}

if(isset($_POST["action"]) && $_POST["action"] == 'servicesLineChart') {
    $startMonth = isset($_POST['start_month']) ? $_POST['start_month'] : null;
    $endMonth = isset($_POST['end_month']) ? $_POST['end_month'] : null;

    $monthCondition = "";

    if ($startMonth && $endMonth) {
        $monthCondition = " AND DATE_FORMAT(date, '%Y-%m') BETWEEN '$startMonth' AND '$endMonth'";
    }

    $query = "
        SELECT DATE_FORMAT(date, '%Y-%m') AS month_year, COUNT(*) AS total
        FROM request_services WHERE status='request completed' $monthCondition
        GROUP BY month_year
    ";

    $result = $conn->query($query);

    $data = array();

    foreach($result as $row)
    {
        $data[] = array(
            'month_year'   => $row["month_year"],
            'total'        => $row["total"],
            'color'        => 'rgba(75, 192, 192, 1)'
        );
    }

    echo json_encode($data);
}



// if (isset($_POST["action"]) && $_POST["action"] == 'stockPieChart') {
//     $query = "
//         SELECT 'Cars' AS label, SUM(quantity) AS value, 'rgba(148, 125, 176, 0.5)' AS color FROM cars WHERE status IS NULL
//         UNION ALL
//         SELECT 'Paints' AS label, SUM(quantity) AS value, 'rgba(255, 206, 86, 0.5)' AS color FROM paints WHERE status IS NULL
//         UNION ALL
//         SELECT 'Spare Parts' AS label, SUM(quantity) AS value, 'rgba(153, 102, 255, 0.5)' AS color FROM spareparts_accessories WHERE status IS NULL
//     ";

//     $result = $conn->query($query);

//     $data = array();

//     foreach ($result as $row) {
//         $data[] = array(
//             'label' => $row["label"],
//             'value' => $row["value"],
//             'color' => $row["color"]
//         );
//     }

//     echo json_encode($data);
// }




if (isset($_POST["action"]) && $_POST["action"] == 'stockPieChart') {
    $query = "
        SELECT model AS label, SUM(quantity) AS value
        FROM cars 
        WHERE status IS NULL
        GROUP BY model
    ";

    $result = $conn->query($query);

    $data = array();

    // Define a color palette
    $colorPalette = array(
        'rgba(255, 0, 0, 0.5)',     // Red
        'rgba(255, 165, 0, 0.5)',   // Orange
        'rgba(255, 255, 0, 0.5)',   // Yellow
        'rgba(0, 128, 0, 0.5)',     // Green
        'rgba(0, 0, 255, 0.5)',     // Blue
        'rgba(75, 0, 130, 0.5)',    // Indigo
        'rgba(148, 0, 211, 0.5)'    // Violet
    );

    $colorIndex = 0; // Initialize color index

    foreach ($result as $row) {
        // Assign color from the palette
        $color = $colorPalette[$colorIndex % count($colorPalette)];

        $data[] = array(
            'label' => $row["label"],
            'value' => $row["value"],
            'color' => $color
        );

        $colorIndex++; // Increment color index
    }

    echo json_encode($data);
}


if (isset($_POST["action"]) && $_POST["action"] == 'stockPieChart2') {
    $query = "
        SELECT product AS label, SUM(quantity) AS value
        FROM spareparts_accessories 
        WHERE status IS NULL
        GROUP BY product
    ";

    $result = $conn->query($query);

    $data = array();

    // Define a color palette
    $colorPalette = array(
        'rgba(255, 0, 0, 0.5)',     // Red
        'rgba(255, 165, 0, 0.5)',   // Orange
        'rgba(255, 255, 0, 0.5)',   // Yellow
        'rgba(0, 128, 0, 0.5)',     // Green
        'rgba(0, 0, 255, 0.5)',     // Blue
        'rgba(75, 0, 130, 0.5)',    // Indigo
        'rgba(148, 0, 211, 0.5)'    // Violet
    );

    $colorIndex = 0; // Initialize color index

    foreach ($result as $row) {
        // Assign color from the palette
        $color = $colorPalette[$colorIndex % count($colorPalette)];

        $data[] = array(
            'label' => $row["label"],
            'value' => $row["value"],
            'color' => $color
        );

        $colorIndex++; // Increment color index
    }

    echo json_encode($data);
}




// if (isset($_POST["action"]) && $_POST["action"] == 'stockPieChart3') {
//     $query = "
//         SELECT paint_color AS label, SUM(quantity) AS value
//         FROM paints 
//         WHERE status IS NULL
//         GROUP BY paint_color
//     ";

//     $result = $conn->query($query);

//     $data = array();

//     // Define a color palette
//     $colorPalette = array(
//     'rgba(255, 0, 0, 0.5)',     // Red
//     'rgba(255, 165, 0, 0.5)',   // Orange
//     'rgba(255, 255, 0, 0.5)',   // Yellow
//     'rgba(0, 128, 0, 0.5)',     // Green
//     'rgba(0, 0, 255, 0.5)',     // Blue
//     'rgba(75, 0, 130, 0.5)',    // Indigo
//     'rgba(148, 0, 211, 0.5)'    // Violet
// );

//     $colorIndex = 0; // Initialize color index

//     foreach ($result as $row) {
//         // Assign color from the palette
//         $color = $colorPalette[$colorIndex % count($colorPalette)];

//         $data[] = array(
//             'label' => $row["label"],
//             'value' => $row["value"],
//             'color' => $color
//         );

//         $colorIndex++; // Increment color index
//     }

//     echo json_encode($data);
// }



if(isset($_POST["action"]) && $_POST["action"] == 'stakeholderBarChart') {

    $query = "
    SELECT 'Mechanic' AS label, COUNT(*) AS value FROM mechanic WHERE status IS NULL
    UNION ALL
    SELECT 'Staff' AS label, COUNT(*) AS value FROM staff WHERE status IS NULL
    UNION ALL
    SELECT 'Client' AS label, COUNT(*) AS value FROM clientacc
    ";

    $result = $conn->query($query);

    $data = array();

    foreach($result as $row)
    {
        $data[] = array(
            'label'	=>	$row["label"],
            'value'			=>	$row["value"],
            'color'			=>	'rgba(231, 76, 60, 0.5)'
        );
    }

    echo json_encode($data);
}
