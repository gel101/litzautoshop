<?php 
include 'connection.php';

if(isset($_POST["action"]) && $_POST["action"] == 'fetch') {

    $query = "
    SELECT SUM(quantity) AS total_quantity
    FROM (
        SELECT quantity FROM cars
        UNION ALL
        SELECT quantity FROM paints
        UNION ALL
        SELECT quantity FROM spareparts_accessories
    ) AS all_quantities";
    $stmt = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($stmt);
    echo $data['total_quantity'];


    
    $result = $conn->query($query);

    $data = array();

    foreach($result as $row)
    {
        $data[] = array(
            'month_year'	=>	$row["month_year"],
            'total'			=>	$row["total"],
            'color'			=>	'rgba(54, 162, 235, 0.5)'
        );
    }
    
    $query2 = "
        SELECT DATE_FORMAT(date, '%Y-%m') AS month_year2, SUM(price) AS total2
        FROM request_services WHERE status='Request Completed'
        GROUP BY month_year2
    ";

    $resultt = $conn->query($query2);

    foreach($resultt as $row)
    {
        $data[] = array(
            'month_yearr'		=>	$row["month_year2"],
            'totall'			=>	$row["total2"],
            'colorr'			=>	'rgba(54, 162, 235, 0.5)'
        );
    }

    echo json_encode($data);
}

?>
