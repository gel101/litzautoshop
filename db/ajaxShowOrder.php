<?php
include "connection.php";

// $customerID = $_POST['thecustomerID'];
$tran_id = $_POST['thetran_id'];
$tranStatus = $_POST['tranStatus'];

    $stmt = mysqli_query($conn, "SELECT * FROM carts WHERE tran_id='$tran_id'");

    while ($data = mysqli_fetch_assoc($stmt)) {

        ?>
                <tr>
                    <td><img src="<?php echo "db/" . $data['img']; ?>" style="width:50px" alt="Product Image"></td>
                    <td><?php echo $data['product']; ?></td>
                    <td><?php echo $data['color']; ?></td>
                    <td><?php echo $data['engine']; ?></td>
                    <td><?php echo $data['model']; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td>&#8369;<?php echo number_format($data['price'], 2); ?></td>
                </tr>
<?php
    }
?>