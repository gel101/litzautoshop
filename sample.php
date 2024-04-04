<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        // Set the timezone to the Philippines
        date_default_timezone_set('Asia/Manila');

        // Get the current date and time in the Philippines timezone
        $currentDateTime = date("Y-m-d H:i:s");
        echo $currentDateTime;
    ?>

</body>
</html>
