<?php
include 'connection.php';

// Retrieve the color parameter from the AJAX request
$color = $_GET['color'];

// Prepare and execute the query to retrieve the image source based on the selected color
$query = "SELECT * FROM paints WHERE paint_color = '$color'";
$result = $conn->query($query);

// Prepare the response
$response = array();


// Check if the query returned a result
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['color'] = $color;
    $response['imgSrc'] = 'db/' . $row['img'];
    $response['imgSrc2'] = 'db/' . $row['img2'];
    $response['imgSrc3'] = 'db/' . $row['img3'];
} else {
    $response['color'] = null;
    $response['imgSrc'] = null;
    $response['imgSrc2'] = null;
    $response['imgSrc3'] = null;
    $response['alt'] = "No available image";
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
