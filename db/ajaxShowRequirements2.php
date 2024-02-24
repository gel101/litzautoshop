<?php
    include 'connection.php';
    
    if (isset($_POST['rent_id']) && !empty($_POST['rent_id'])) {
        $rent_id = $_POST['rent_id'];
    }

    $stmt = mysqli_query($conn, "SELECT * FROM rent_transactions WHERE rent_id='$rent_id'");

    while ($data = mysqli_fetch_assoc($stmt)) {
?>
                <div class="row">
                    <div class="col-md-4">
                <label for="" class="form-label">Driver's License</label>
                    <?php if (!empty($data['driver_license'])): ?>
                        <a class="form-control" href="db/<?php echo $data['driver_license']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['driver_license']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/noimage.jpg" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                <label for="" class="form-label">Government ID</label>
                    <?php if (!empty($data['government_id'])): ?>
                        <a class="form-control" href="db/<?php echo $data['government_id']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['government_id']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/noimage.jpg" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                <label for="" class="form-label">Proof of Address</label>
                    <?php if (!empty($data['address_proof'])): ?>
                        <a class="form-control" href="db/<?php echo $data['address_proof']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['address_proof']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/noimage.jpg" alt="">
                    <?php endif; ?>
                    </div>
                <br>

<?php
    }
?>