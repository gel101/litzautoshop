<?php
include "connection.php";

try{
    $msg = $id = $vehicle = $error = "";
    $valid = true;

    if (isset($_POST['addvehicleSell'])) {
        $vehicle = $_POST['addvehicleSell'];
        
        $sql = mysqli_query($conn, "INSERT INTO vehicletype_sell(vehicletype) VALUES('$vehicle')");

        $msg = array("valid"=>true, "msg"=>"Data added.");
        echo json_encode($msg);
    }if (isset($_POST['deletevehicleSell'])) {
        $vehicle = $_POST['deletevehicleSell'];
        
        $sql = mysqli_query($conn, "DELETE FROM vehicletype_sell WHERE id = '$vehicle' ");

        $msg = array("valid"=>true, "msg"=>"Data deleted.");
        echo json_encode($msg);
    }

    if (isset($_POST['addvehicleService'])) {
        $vehicle = $_POST['addvehicleService'];
        
        $sql = mysqli_query($conn, "INSERT INTO vehicletype_service(vehicletype) VALUES('$vehicle')");

        $msg = array("valid"=>true, "msg"=>"Data added.");
        echo json_encode($msg);
    }if (isset($_POST['deletevehicleService'])) {
        $vehicle = $_POST['deletevehicleService'];
        
        $sql = mysqli_query($conn, "DELETE FROM vehicletype_service WHERE id = '$vehicle' ");

        $msg = array("valid"=>true, "msg"=>"Data deleted.");
        echo json_encode($msg);
    }

    if (isset($_POST['addCarModel'])) {
        $vehicle = $_POST['addCarModel'];
        
        $sql = mysqli_query($conn, "INSERT INTO carmodel(model) VALUES('$vehicle')");

        $msg = array("valid"=>true, "msg"=>"Data added.");
        echo json_encode($msg);
    }if (isset($_POST['deleteModel'])) {
        $vehicle = $_POST['deleteModel'];
        
        $sql = mysqli_query($conn, "DELETE FROM carmodel WHERE id = '$vehicle' ");

        $msg = array("valid"=>true, "msg"=>"Data deleted.");
        echo json_encode($msg);
    }

    if (isset($_POST['addEngine'])) {
        $vehicle = $_POST['addEngine'];
        
        $sql = mysqli_query($conn, "INSERT INTO carengine(engine) VALUES('$vehicle')");

        $msg = array("valid"=>true, "msg"=>"Data added.");
        echo json_encode($msg);
    }if (isset($_POST['deleteEngine'])) {
        $vehicle = $_POST['deleteEngine'];
        
        $sql = mysqli_query($conn, "DELETE FROM carengine WHERE id = '$vehicle' ");

        $msg = array("valid"=>true, "msg"=>"Data deleted.");
        echo json_encode($msg);
    }

    if (isset($_POST['addService'])) {
        $vehicle = $_POST['addService'];
        $carType = $_POST['carType'];
        $addServicePrice = $_POST['addServicePrice'];
        
        $sql = mysqli_query($conn, "INSERT INTO services(vehicletype_id, service, price) VALUES('$carType', '$vehicle', '$addServicePrice')");

        $msg = array("valid"=>true, "msg"=>"Data added.");
        echo json_encode($msg);
    }if (isset($_POST['deleteService'])) {
        $vehicle = $_POST['deleteService'];
        
        $sql = mysqli_query($conn, "DELETE FROM services WHERE id = '$vehicle' ");

        $msg = array("valid"=>true, "msg"=>"Data deleted.");
        echo json_encode($msg);
    }if (isset($_POST['eserviceID'])) {
        $id = $_POST['eserviceID'];
        $newService = $_POST['eservice'];
        $newPrice = $_POST['eprice'];
    
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE services SET service = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssi", $newService, $newPrice, $id);
        $stmt->execute();
    
        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            $msg = array("valid" => true, "msg" => "Data Updated.");
            echo json_encode($msg);
        } else {
            $msg = array("valid" => false, "msg" => "No changes or update failed.");
            echo json_encode($msg);
        }
    
        $stmt->close();
        $conn->close();
    }
    
    if (isset($_GET['vehicleType'])) {
        $vehicleType = $_GET['vehicleType'];
        
        // Modify your query to include the WHERE clause
        $stmt = mysqli_query($conn, "SELECT * FROM services WHERE vehicletype_id = '$vehicleType' ORDER BY id DESC");
        
        $services = array();

        while ($data = mysqli_fetch_assoc($stmt)) {
            $services[] = $data;
        }

        echo json_encode($services);
    } 
    // else {
    //     echo json_encode(array());
    // }
    




    if (isset($_GET['action']) && $_GET['action'] === 'getcarDetails') {
        $response = array();

        // Fetch car models
        $vehicletype = array();
        $stmt1 = mysqli_query($conn, "SELECT id, vehicleType FROM vehicletype_sell ORDER BY id DESC");
        while ($data1 = mysqli_fetch_assoc($stmt1)) {
            $vehicletype[] = array(
                'id' => $data1['id'],
                'vehicleType' => $data1['vehicleType']
            );
        }
        $response['vehicletypes'] = $vehicletype;

        // Fetch car models
        $models = array();
        $stmt2 = mysqli_query($conn, "SELECT id, model FROM carmodel ORDER BY id DESC");
        while ($data2 = mysqli_fetch_assoc($stmt2)) {
            $models[] = array(
                'id' => $data2['id'],
                'model' => $data2['model']
            );
        }
        $response['carModels'] = $models;
    
        // Fetch car engines
        $carengine = array();
        $stmt3 = mysqli_query($conn, "SELECT id, engine FROM carengine ORDER BY id DESC");
        while ($data3 = mysqli_fetch_assoc($stmt3)) {
            $carengine[] = array(
                'id' => $data3['id'],
                'engine' => $data3['engine']
            );
        }
        $response['carEngines'] = $carengine;
    
        // Return the combined JSON response
        echo json_encode($response);
    }


} catch (Exception $e) {
    $msg =  array("valid"=>false, "msg"=>'Error-> '. $e->getMessage(). '\n');
    echo json_encode($msg);
}
?>