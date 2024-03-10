<?php
    include 'connection.php';

    
    if (isset($_POST['docu_id']) && !empty($_POST['docu_id'])) {
        $docu_id = $_POST['docu_id'];
    }
    
    if (isset($_POST['tran_id']) && !empty($_POST['tran_id'])) {
        $tran_id = $_POST['tran_id'];
    }

    $stmt = mysqli_query($conn, "SELECT * FROM client_documents WHERE tran_id='$tran_id'");

    while ($data = mysqli_fetch_assoc($stmt)) {
?>
                <div class="row">
                    <div class="col-md-3">
                        <label for="" class="form-label">Certificate of Employee</label>
                    <?php if (!empty($data['coe'])): ?>
                        <a class="form-control" href="db/<?php echo $data['coe']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['coe']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Latest Payslip(3 months)</label>
                    <?php if (!empty($data['payslip_3m'])): ?>
                        <a class="form-control" href="db/<?php echo $data['payslip_3m']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['payslip_3m']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Latest Electic Bill</label>
                    <?php if (!empty($data['electric_bill'])): ?>
                        <a class="form-control" href="db/<?php echo $data['electric_bill']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['electric_bill']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Brgy. Clearance</label>
                    <?php if (!empty($data['brgy_clearance'])): ?>
                        <a class="form-control" href="db/<?php echo $data['brgy_clearance']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['brgy_clearance']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for="" class="form-label">Valid ID 1</label>
                    <?php if (!empty($data['validID_1'])): ?>
                        <a class="form-control" href="db/<?php echo $data['validID_1']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['validID_1']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Valid ID 2</label>
                    <?php if (!empty($data['validID_2'])): ?>
                        <a class="form-control" href="db/<?php echo $data['validID_2']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['validID_2']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Marriage Contract</label>
                <?php if (!empty($data['marriage_contract'])): ?>
                        <a class="form-control" href="db/<?php echo $data['marriage_contract']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['marriage_contract']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Business Permit</label>
                    <?php if (!empty($data['business_permit'])): ?>
                        <a class="form-control" href="db/<?php echo $data['business_permit']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['business_permit']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Latest Bank Statement</label>
                    <?php if (!empty($data['bankStatement_3m'])): ?>
                        <a class="form-control" href="db/<?php echo $data['bankStatement_3m']; ?>" rel="noopener noreferrer" target="_blank">
                            <img class="form-control" src="db/<?php echo $data['bankStatement_3m']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img class="form-control" src="./img/system/notRequiredImage.png" alt="">
                    <?php endif; ?>
                    </div>
                </div>
                <br>

<?php
    }
?>