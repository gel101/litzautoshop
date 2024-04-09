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

        
    $pass = "Gelsdflo123";

    function validatePassword($password) {
        // Define a regular expression pattern for the password requirements
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/';

        // Test the password against the pattern
        $isValid = preg_match($passwordPattern, $password);

        return $isValid;
    }

    if (strlen($pass) < 8) {
        $valid = false;
        $error = "Password should be at least 8 characters long.";
        $pass = "";
        echo $error;
    } else {
        if (!validatePassword($pass)) {
            $error = "Password should have Uppercase, Lowercase, and Number!";
            $pass = "";
            echo $error;
        }else{
            echo "passsed!";
        }
    }

    ?>

</body>
</html>
